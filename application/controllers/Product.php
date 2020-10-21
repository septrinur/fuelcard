<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library("Services");
        $this->load->model('general_model');

        ini_set('display_errors', 1);

    }
	public function index()
	{
		$this->load->admin('products/index');
	}

	public function add()
	{
		if($this->input->post()){
			$param = $this->input->post();

			if (isset($param['tokped'])) {
				$param['tokped'] = 1;
			}else{
				$param['tokped'] = 0;
			}
			if (isset($param['shopee'])) {
				$param['shopee'] = 1;
			}else{
				$param['shopee'] = 0;
			}
			$param_product = array(
				'code_product' 	=>$param['code_product'],
				'name' 			=>$param['name'],
				'description' 	=>$param['description'],
				'tokped' 		=>$param['tokped'],
				'shopee' 		=>$param['shopee'],
				'harga_tokped' 	=>$param['harga_tokped'],
				'harga_shopee' 	=>$param['harga_shopee'],
				'tokped_link' 	=>$param['tokped_link'],
				'shopee_link' 	=>$param['shopee_link']
			);
			// echo "<pre>";
			// print_r($param);
			// exit();
			$this->general_model->insert_data('products', $param_product);
			foreach ($param['varian_name'] as $key => $value) {
				$param_varian = array(
					'product_code'	=>$param['code_product'],
					'varian_name' 	=>$param['varian_name'][$key],
					'stok_tokped' 	=>$param['stok_tokped'][$key],
					'stok_shopee' 	=>$param['stok_shopee'][$key]
				);
				$this->general_model->insert_data('product_varian', $param_varian);
			}
   
			$this->load->admin('products/add');
		}else{
			$this->load->admin('products/add');
		}
	}

	public function tokped()
	{
		$config['base_url'] = site_url('product/tokped'); //site url
        $config['total_rows'] = $this->db->count_all('products'); //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        // $data['data'] = $this->mahasiswa_model->get_mahasiswa_list($config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

		$filter = array('tokped' => 1);
		$products = $this->general_model->get_data('products','*',$filter,'','',$config["per_page"],$data['page']);

		// echo "<pre>";
		// print_r($products);
		// exit();
		foreach ($products as $product) {
			$filter_varian = array('product_code' => $product->code_product);
			$product->varian = $this->general_model->get_data('product_varian','*',$filter_varian);
			$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);

			$param = array(
					'search'		=>$product->code_product,
	                'brand'     	=> '',
	                'status'		=>4,
	                'rpp' 			=>10,
                	'email' => 'hagia.style@gmail.com'
	            );

	        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
	        
			$data_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);
			$product->rd_stock = $data_rd->detail->result[0]->stock;
			$product->rd_price = $data_rd->detail->result[0]->price->nett;
			$product->image = $data_rd->detail->result[0]->image->_1;
			$product->id = $data_rd->detail->result[0]->id;
		}
		// echo "<pre>";
		// print_r($products);
		// exit();
		$data['products'] = $products;
		$this->load->admin('products/tokped', $data);
	}

	public function shopee()
	{
		$config['base_url'] = site_url('product/shopee'); //site url
        $config['total_rows'] = $this->db->where('shopee',1)->from("products")->count_all_results();
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
      	$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        // $data['data'] = $this->mahasiswa_model->get_mahasiswa_list($config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();

		$filter = array('shopee' => 1);
		$products = $this->general_model->get_data('products','*',$filter,'','',$config["per_page"],$data['page']);

		// echo "<pre>";
		// print_r($products);
		// exit();
		foreach ($products as $product) {
			$filter_varian = array('product_code' => $product->code_product);
			$product->varian = $this->general_model->get_data('product_varian','*',$filter_varian);
			$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);

			$param = array(
					'search'		=>$product->code_product,
	                'brand'     	=> '',
	                'status'		=>4,
	                'rpp' 			=>10,
                	'email' => 'hagia.style@gmail.com'
	            );

	        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
	        
			$data_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);
			$product->rd_stock = $data_rd->detail->result[0]->stock;
			$product->rd_price = $data_rd->detail->result[0]->price->nett;
			$product->image = $data_rd->detail->result[0]->image->_1;
			$product->id = $data_rd->detail->result[0]->id;
		}
		// echo "<pre>";
		// print_r($products);
		// exit();
		$data['products'] = $products;
		$this->load->admin('products/shopee', $data);
	}

	public function categories()
	{
		$filter = array('parent' => 1);
		$categories = $this->general_model->get_data('categories','*',$filter);
		
		foreach ($categories as $key => $value) {
			if ($value->id != 1) {
				$filter = array('parent' => $value->id);
				$categories[$key]->childs = $this->general_model->get_data('categories','*',$filter);
			}
		}
		foreach ($categories as $key => $value) {
			if ($value->id != 1) {
				foreach ($categories[$key]->childs as $k => $v) {
					$filter = array('parent' => $v->id);
					$categories[$key]->childs[$k]->childs = $this->general_model->get_data('categories','*',$filter);
				}
			}
		}
		echo "<pre>";
		print_r($categories);
		exit();
		$this->load->admin('home/index');
	}


	public function products()
	{
		$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);

		$param = array(
                'brand'     => '',
                'category' => '5',
                'rpp' => '2',
                'page'	=> '1',
                'email' => 'hagia.style@gmail.com'
            );

        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
        
		$data = $this->services->restServices(json_encode($param),"POST",$url,$headers);
		echo "<pre>";
		print_r($data);
		exit();
		$this->load->admin('home/product');
	}

}
