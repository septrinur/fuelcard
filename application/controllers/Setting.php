<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
		if($this->input->post()){

			$param = $this->input->post();
			$con = array('id_markup'=>1);
			// echo "<pre>";
			// print_r($param);
			// exit();
			$this->general_model->update_data('markup',$con, $param);
		}

		$filter = array('id_markup' => 1);
		$markup = $this->general_model->get_data('markup','*',$filter);

		$data['markup'] = $markup;
		$this->load->admin('settings/index', $data);
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

}
