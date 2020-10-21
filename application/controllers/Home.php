<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library("Services");
        $this->load->model('general_model');

        ini_set('display_errors', 1);

    }
	public function index()
	{
		$filter = array('parent' => 1, 'id !=' => 1);
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
		$data['categories'] = $categories;


		$filter = array('id_markup' => 1);
		$markup = $this->general_model->get_data('markup','*',$filter);

		$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);
		
		$a = array('5','6','7','9','10','14','17','18','19','22','24','41','42','43','44','45','55','56','57','58','59','69','70','71','72','73','74','76','77','78','79','80','82','83','84','85','86','88','90','134','137','138','139');
    	$cat_id = $a[mt_rand(0, count($a) - 1)];

		$param = array(
                'brand'     => '',
                'search' => '',
                'sort' => '7',
                'category' => $cat_id,
                'min_price' => '',
                'max_price' => '',
                'rpp' => '10',
                'page'	=> '1',
                'email' => 'hagia.style@gmail.com'
            );

        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
        
		$product_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);

		$get_products = $this->general_model->get_data('products','*');
		$i=0;
		$new_arrivals = array();
		foreach ($product_rd->detail->result as $product) {
			if (!empty($markup)) {
				$up = $product->price->nett*100/(100 - $markup[0]->up);
				if ($markup[0]->disc != 0) {
					$price = $up * ((100-$markup[0]->disc)/100);
					$new_arrivals[$i]['disc'] = $markup[0]->disc;
				}else{
					$price = $up;
					$new_arrivals[$i]['disc'] = $markup[0]->disc;
				}

				$new_arrivals[$i]['price_b_dic'] =  round($up, -2);
			}else{
				$price = $product->price->nett;
				$new_arrivals[$i]['price_b_dic'] = round($price, -2);
			}
			$new_arrivals[$i]['id'] =  $product->id;
			$new_arrivals[$i]['name'] =  $product->name->full;
			$new_arrivals[$i]['name_code'] =  $product->name->code;
			$new_arrivals[$i]['code'] =  $product->code;
			$new_arrivals[$i]['price'] =  round($price,-2);
			$new_arrivals[$i]['image'] =  $product->image->_1;
			$new_arrivals[$i]['stock'] =  $product->stock;

			$key = array_search($product->code, array_column($get_products, 'code_product'));
			if (false !== $key)
			{
				$new_arrivals[$i]['mp'] = $get_products[$key];
			}else{
				$new_arrivals[$i]['mp'] = "";
			}
			$i++;
		}
		$data['new_arrivals'] = $new_arrivals;

		$filter = array('shopee' => 1);
		$favourites = $this->general_model->get_data_random('products','*',$filter,'','',6,0);

		// echo "<pre>";
		// print_r($products);
		// exit();
		foreach ($favourites as $product) {
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

			if (!empty($markup)) {
				$up = $data_rd->detail->result[0]->price->nett*100/(100 - $markup[0]->up);
				if ($markup[0]->disc != 0) {
					$price = $up * ((100-$markup[0]->disc)/100);
					$product->disc = $markup[0]->disc;
				}else{
					$price = $up;
					$product->disc = $markup[0]->disc;
				}

				$product->price_b_disc =  round($up, -2);
			}else{
				$price = $data_rd->detail->result[0]->price->nett;
				$product->price_b_disc = round($price, -2);
			}

			$product->id =  $data_rd->detail->result[0]->id;
			$product->name_code =  $data_rd->detail->result[0]->name->code;
			$product->image =  $data_rd->detail->result[0]->image->_1;
			$product->price =  round($price,-2);
		}


		$data['favourites'] = $favourites;

		$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);

		$param = array(
                'brand'     => '',
                'search' => '',
                'sort' => '6',
                'min_price' => '',
                'max_price' => '',
                'rpp' => '24',
                'page'	=> '1',
                'email' => 'hagia.style@gmail.com'
            );

        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
        
		$product_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);

		$get_products = $this->general_model->get_data('products','*');
		$i=0;
		$products = array();
		foreach ($product_rd->detail->result as $product) {
			if (!empty($markup)) {
				$up = $product->price->nett*100/(100 - $markup[0]->up);
				if ($markup[0]->disc != 0) {
					$price = $up * ((100-$markup[0]->disc)/100);
					$products[$i]['disc'] = $markup[0]->disc;
				}else{
					$price = $up;
					$products[$i]['disc'] = $markup[0]->disc;
				}

				$products[$i]['price_b_dic'] =  round($up, -2);
			}else{
				$price = $product->price->nett;
				$products[$i]['price_b_dic'] = round($price, -2);
			}
			$products[$i]['id'] =  $product->id;
			$products[$i]['name'] =  $product->name->full;
			$products[$i]['name_code'] =  $product->name->code;
			$products[$i]['code'] =  $product->code;
			$products[$i]['price'] =  round($price,-2);
			$products[$i]['image'] =  $product->image->_1;
			$products[$i]['stock'] =  $product->stock;

			$key = array_search($product->code, array_column($get_products, 'code_product'));
			if (false !== $key)
			{
				$products[$i]['mp'] = $get_products[$key];
			}else{
				$products[$i]['mp'] = "";
			}
			$i++;
		}
		$data['products'] = $products;

		// echo "<pre>";
		// print_r($new_arrivals);
		// exit();
		$this->load->landing('home/index', $data);
	}

	public function categories()
	{
		$filter = array('parent' => 1, 'id !=' => 1);
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
		$data['categories'] = $categories;

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
		$data['contact'] = $this->general_model->get_data('marketplace','*');

		$filter = array('parent' => 1, 'id !=' => 1);
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
		$data['categories'] = $categories;

		$filter = array('id_markup' => 1);
		$markup = $this->general_model->get_data('markup','*',$filter);

		if (isset($_GET['orderby'])) {
			$sort = $_GET['orderby'];
		}else{
			$sort = '6';
		}

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}else{
			$page = '1';
		}

		if (isset($_GET['s'])) {
			$search = $_GET['s'];
		}else{
			$search = '';
		}

		if (isset($_GET['cat'])) {
			$cat = $_GET['cat'];
		}else{
			$cat = '';
		}

		$data['search'] = $search;
		$data['cat'] = $cat;
		$data['sort'] = $sort;
		$headers = array(
        				'Content-Type: application/json',
        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
    				);

		$param = array(
                'brand'     => '',
                'search' 	=> $search,
                'sort' 		=> $sort,
                'category' 	=> $cat,
                'min_price' => '',
                'max_price' => '',
                'rpp' 		=> '24',
                'page'		=> $page,
                'email' 	=> 'hagia.style@gmail.com'
            );

        $url = 'https://www.resellerdropship.com/v1.0/product/service/get';
        
		$product_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);

		$get_products = $this->general_model->get_data('products','*');
		$i=0;
		$products = array();
		foreach ($product_rd->detail->result as $product) {
			if (!empty($markup)) {
				$up = $product->price->nett*100/(100 - $markup[0]->up);
				if ($markup[0]->disc != 0) {
					$price = $up * ((100-$markup[0]->disc)/100);
					$products[$i]['disc'] = $markup[0]->disc;
				}else{
					$price = $up;
					$products[$i]['disc'] = $markup[0]->disc;
				}

				$products[$i]['price_b_dic'] =  round($up, -2);
			}else{
				$price = $product->price->nett;
				$products[$i]['price_b_dic'] = round($price, -2);
			}
			$products[$i]['id'] =  $product->id;
			$products[$i]['name'] =  $product->name->full;
			$products[$i]['name_code'] =  $product->name->code;
			$products[$i]['code'] =  $product->code;
			$products[$i]['price'] =  round($price,-2);
			$products[$i]['image'] =  $product->image->_1;
			$products[$i]['stock'] =  $product->stock;

			$key = array_search($product->code, array_column($get_products, 'code_product'));
			if (false !== $key)
			{
				$products[$i]['mp'] = $get_products[$key];
			}else{
				$products[$i]['mp'] = "";
			}
			$i++;
		}
		$data['products'] = $products;
		$data['metadata'] = $product_rd->detail->metadata;
		// echo "<pre>";
		// print_r($product_rd);
		// exit();
		$this->load->landing('home/product', $data);
	}

	public function detail(){

		$data['contact'] = $this->general_model->get_data('marketplace','*');
		
		$filter = array('parent' => 1, 'id !=' => 1);
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
		$data['categories'] = $categories;

		$id = $_GET['id'];
		if (!empty($id) || $id != null) {
			$filter = array('id_markup' => 1);
			$markup = $this->general_model->get_data('markup','*',$filter);
			// print_r($markup);exit;

			$headers = array(
	        				'Content-Type: application/json',
	        				'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MDYyODAxMTQsInN1YiI6Mjc1MjgsImlzcyI6Imh0dHBzOi8vd3d3LnJlc2VsbGVyZHJvcHNoaXAuY29tL3YxLjAvYWNjb3VudC9zZXJ2aWNlL2xvZ2luIiwiaWF0IjoxNTk4MzMxMzE0LCJuYmYiOjE1OTgzMzEzMTQsImp0aSI6InB4cFVJQzBybW9UQnZpaG8ifQ.unapxlUwV94bJwICyVm20y-vCQocJjDtoNWbb3C0IXU'
	    				);

			$param = array(
	                'product'	=> $id
	            );

	        $url = 'https://www.resellerdropship.com/v1.0/beforelogin/produk/detail';
	        
			$product = array();
			$product_rd = $this->services->restServices(json_encode($param),"POST",$url,$headers);
			$product['id'] =  $product_rd->detail->id;
			$product['name'] =  $product_rd->detail->name->full;
			$product['code'] =  $product_rd->detail->code;
			$product['description'] =  $product_rd->detail->description->long;
			if (!empty($markup)) {
				$up = $product_rd->detail->price->nett*100/(100 - $markup[0]->up);
				if ($markup[0]->disc != 0) {
					$price = $up * ((100-$markup[0]->disc)/100);
					$product['disc'] = $markup[0]->disc;
				}else{
					$price = $up;
					$product['disc'] = $markup[0]->disc;
				}

				$product['price_b_dic'] =  round($up, -2);
			}else{
				$price = $product_rd->detail->price->nett;
				$product['price_b_dic'] = round($price, -2);
			}
			$product['price'] =  round($price, -2);
			$product['weight'] =  $product_rd->detail->weight->scale;
			$product['image'] =  $product_rd->detail->image_;
			$product['category_id'] =  $product_rd->detail->category->id;
			$product['category_name'] =  $product_rd->detail->category->name;
			$product['total_stock'] =  $product_rd->detail->total_stock;
			$product['url_video'] =  $product_rd->detail->url_video;
			$product['stock'] =  $product_rd->detail->stock;

			$filter = array('code_product' => $product_rd->detail->code);
			$get_products = $this->general_model->get_data('products','*',$filter);

			if (!empty($get_products)) {
				$product['name'] = $get_products[0]->name;
				$product['description'] = $get_products[0]->description;
				$product['shopee'] = $get_products[0]->shopee;
				$product['tokped'] = $get_products[0]->tokped;
				if ($get_products[0]->shopee == 1) {
					$product['shopee_link'] = $get_products[0]->shopee_link;
				}else{

				}
				if ($get_products[0]->tokped == 1) {
					$product['tokped_link'] = $get_products[0]->tokped_link;
				}else{

				}
			}else{
				$product['shopee'] = 0;
				$product['tokped'] = 0;
			}
			$data['product'] = $product;

			$filter = array('shopee' => 1);
			$favourites = $this->general_model->get_data_random('products','*',$filter,'','',3,0);

			// echo "<pre>";
			// print_r($products);
			// exit();
			foreach ($favourites as $product) {
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

				if (!empty($markup)) {
					$up = $data_rd->detail->result[0]->price->nett*100/(100 - $markup[0]->up);
					if ($markup[0]->disc != 0) {
						$price = $up * ((100-$markup[0]->disc)/100);
						$product->disc = $markup[0]->disc;
					}else{
						$price = $up;
						$product->disc = $markup[0]->disc;
					}

					$product->price_b_disc =  round($up, -2);
				}else{
					$price = $data_rd->detail->result[0]->price->nett;
					$product->price_b_disc = round($price, -2);
				}

				$product->id =  $data_rd->detail->result[0]->id;
				$product->name_code =  $data_rd->detail->result[0]->name->code;
				$product->image =  $data_rd->detail->result[0]->image->_1;
				$product->price =  round($price,-2);
			}


			$data['favourites'] = $favourites;
			// echo "<pre>";
			// print_r($product);
			// exit();
			$this->load->landing('home/detail', $data);
		}
		
	}

}
