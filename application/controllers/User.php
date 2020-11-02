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
        $this->load->library('pagination');

        ini_set('display_errors', 1);
        if (!$this->session->userdata('is_login')) {
            redirect('home/index');
        }

    }

    protected function generateApiKey()
    {
        $tokenLen = 40;
        if (file_exists('/dev/urandom')) { // Get 100 bytes of random data
            $randomData = file_get_contents('/dev/urandom', false, null, 0, 100) . uniqid(mt_rand(), true);
        } else {
            $randomData = mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true);
        }
        return substr(hash('sha512', $randomData), 0, $tokenLen);
    }

	public function index()
	{
		$config['base_url'] = site_url('user/index'); //site url
        $config['total_rows'] = $this->db->where('level !=',5)->count_all('users'); //total row
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
 
        $data['pagination'] = $this->pagination->create_links();

        $filter = array(
            'level != ' => '5',
        );
        $users = $this->general_model->get_data('users','*',$filter,'','',$config["per_page"],$data['page']);

        $data['users'] = $users;
        
        // echo "<pre>";
        // print_r($this->session->userdata());
        // exit();
        $this->load->admin('user/index', $data);
	}

    public function add(){
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();
            $param['user_id'] = $this->session->userdata('user_id');
            $param['token'] = $this->generateApiKey();


            if ($this->apifunct->check_user($param['username'])) {
                $data['error'] = "User sudah terdaftar";
                $data['param'] = $param;
            }

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $param['username'] = str_replace(' ', '', $param['username']);
                $param['password'] = str_replace(' ', '', $param['password']);

                $user = $this->users_model->insert_users($param);

                if ($user) {
                    $this->session->set_flashdata('user_success', 'Berhasil menambahkan pengguna baru');
                    redirect('user/index');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('user/add', $data);
    }

    public function update($id){
        $data['id'] = $id;
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $user = $this->users_model->update_users($param);

                if ($user) {
                    $this->session->set_flashdata('user_success', 'Berhasil update data pengguna');
                    redirect('user/index');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter['id_user'] = $id;
        $data['param'] = json_decode(json_encode($this->users_model->get_users($filter)[0]), true);
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('user/update', $data);
    }

    public function delete($id){
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);

        $delete = $this->users_model->delete_users($id);
         if ($delete) {
            $this->session->set_flashdata('user_success','Data Berhasil Dihapus');
        }else{
            $this->session->set_flashdata('user_failed','Gagal Menghapus Data');
        }
        redirect('user/index');
    }

    public function aplikasi()
    {
        $config['base_url'] = site_url('user/aplikasi'); //site url
        $config['total_rows'] = $this->db->where('level',5)->count_all('users'); //total row
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
 
        $data['pagination'] = $this->pagination->create_links();

        $filter = array(
            'level' => '5',
        );
        $join_table = 'spbu';
        $join_condition = 'users.spbu_id = spbu.id_spbu';
        $users = $this->general_model->get_data('users','*',$filter,$join_table,$join_condition,$config["per_page"],$data['page']);

        $data['users'] = $users;
        
        // echo "<pre>";
        // print_r($this->session->userdata());
        // exit();
        $this->load->admin('user/aplikasi', $data);
    }

    public function create(){
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();
            $param['user_id'] = $this->session->userdata('user_id');
            $param['token'] = $this->generateApiKey();
            $param['level'] = 5;

            if ($this->apifunct->check_user($param['username'])) {
                $data['error'] = "User sudah terdaftar";
                $data['param'] = $param;
            }

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $param['username'] = str_replace(' ', '', $param['username']);
                $param['password'] = str_replace(' ', '', $param['password']);

                $user = $this->users_model->insert_users($param);

                if ($user) {
                    $this->session->set_flashdata('user_success', 'Berhasil menambahkan pengguna baru');
                    redirect('user/aplikasi');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }

        $data['spbus'] =  $this->general_model->get_data('spbu','*');
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('user/create', $data);
    }

    public function edit($id){
        $data['id'] = $id;
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $user = $this->users_model->edit_users($param);

                if ($user) {
                    $this->session->set_flashdata('user_success', 'Berhasil update data pengguna');
                    redirect('user/aplikasi');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter['id_user'] = $id;
        $data['param'] = json_decode(json_encode($this->users_model->get_users($filter)[0]), true);
        $data['spbus'] =  $this->general_model->get_data('spbu','*');
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('user/edit', $data);
    }

    public function remove($id){
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);

        $delete = $this->users_model->delete_users($id);
         if ($delete) {
            $this->session->set_flashdata('user_success','Data Berhasil Dihapus');
        }else{
            $this->session->set_flashdata('user_failed','Gagal Menghapus Data');
        }
        redirect('user/aplikasi');
    }

    public function logout(){
        session_destroy();
        redirect('home/index');
    }

}
