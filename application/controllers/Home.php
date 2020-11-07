<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library("Services");
        $this->load->model('general_model');
        $this->load->model('users_model');
        $this->load->library('apifunct');

        ini_set('display_errors', 1);
        if ($this->session->userdata('is_login')) {
        	redirect('admin/index');
        }

    }
	public function index()
	{
		
		// echo "<pre>";
		// print_r($this->session->userdata());
		// exit();
		$data['error'] = "";
		if($this->input->post()){
			$param = $this->input->post();

			if (!$this->apifunct->check_user($param['username'])) {
				$data['error'] = "User belum terdaftar";
	        }
	        $param['username'] = str_replace(' ', '', $param['username']);
            $param['password'] = str_replace(' ', '', $param['password']);
            $user = $this->users_model->login($param);

            if ($user == 1) {
            	redirect('admin/index');
            }elseif ($user == 96 || $user == 3) {
            	$data['error'] = "User anda diblokir";
            }elseif ($user == 2) {
            	$data['error'] = "Username dan Password Salah";
            }

		}
		// echo "<pre>";
		// print_r($new_arrivals);
		// exit();
		$this->load->view('home/index', $data);
	}

}
