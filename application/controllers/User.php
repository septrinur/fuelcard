<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('general_model');
        $this->load->model('users_model');
        $this->load->library('apifunct');

        ini_set('display_errors', 1);
        if (!$this->session->userdata('is_login')) {
            redirect('home/index');
        }

    }
	public function index()
	{
		$data['error'] = "";
		if($this->input->post()){
			$param = $this->input->post();

			if (!$this->apifunct->check_user($param['username'])) {
				$data['error'] = "User belum terdaftar";
	        }
	        $param['username'] = str_replace(' ', '', $param['username']);
            $param['password'] = str_replace(' ', '', $param['password']);
            $user = $this->users_model->login_app($param);

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

    public function add(){
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($this->apifunct->check_user($param['username'])) {
                $data['error'] = "User sudah terdaftar";
            }
            $param['username'] = str_replace(' ', '', $param['username']);
            $param['password'] = str_replace(' ', '', $param['password']);
            $user = $this->users_model->login_app($param);

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
        $this->load->view('user/add', $data);
    }

    public function logout(){
        session_destroy();
        redirect('home/index');
    }

}
