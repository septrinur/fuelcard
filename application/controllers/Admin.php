<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('apifunct');
        $this->load->library('ciqrcode');

        $this->load->model('general_model');
        $this->load->model('admin_model');

        date_default_timezone_set('Asia/Jakarta');

        ini_set('display_errors', 1);
        if (!$this->session->userdata('is_login')) {
        	redirect('home/index');
        }

    }

	public function index()
	{
		$config['base_url'] = site_url('admin/index'); //site url
        $config['total_rows'] = $this->db->count_all('spbu'); //total row
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

        $filter = '';
        $spbu = $this->admin_model->get_data_dashboard($filter,$config["per_page"],$data['page']);

        $data['spbu'] = $spbu;
        
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/index', $data);
	}

    public function detail($id)
    {
        $config['base_url'] = site_url('admin/detail'); //site url
        $config['total_rows'] = $this->db->count_all('spbu'); //total row
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

        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter = array('id_spbu' => $id);
        $spbu = $this->admin_model->get_data_detail($filter,$config["per_page"],$data['page']);

        $data['spbu'] = $spbu;
        
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/detail', $data);
    }

	public function data()
	{
		$config['base_url'] = site_url('admin/data'); //site url
        $config['total_rows'] = $this->db->count_all('data_qr'); //total row
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

		$filter = '';
		$dataqrs = $this->general_model->get_data('data_qr','*',$filter,'','',$config["per_page"],$data['page']);

		$data['dataqrs'] = $dataqrs;
		
		// echo "<pre>";
		// print_r($this->session->userdata());
		// exit();
		$this->load->admin('admin/data', $data);
	}

	public function input()
	{
		$data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();
            $param['user_created'] = $this->session->userdata('user_id');
            $param['date_created'] = date("Y-m-d H:i:s");
            $param['status_approve'] = 0;

            $param['no_pol'] = str_replace(' ', '', $param['no_pol']);
            $param['no_kartu'] = str_replace(' ', '', $param['no_kartu']);
            $param['code'] = $param['no_pol'].strtotime($param['date_created']);

            if ($this->apifunct->is_exist_data('data_qr', array('no_pol'=>$param['no_pol']))) {
                $data['error'] = "No Polisi sudah terdaftar";
                $data['param'] = $param;
            }

            if ($this->apifunct->is_exist_data('data_qr', array('no_kartu'=>$param['no_kartu']))) {
                $data['error'] = "No Kartu sudah terdaftar";
                $data['param'] = $param;
            }

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $qr_data = $param['no_pol'].",".$param['no_kartu'];
                $base64 = $this->encryption->encrypt($param['no_pol']);
                $qr_name = strtr($base64, '+/=', '.-~');

                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './assets/images/qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224,255,255); // array, default is array(255,255,255)
                $config['white']        = array(70,130,180); // array, default is array(0,0,0)
                $this->ciqrcode->initialize($config);
         
                $image_name=$qr_name.'.png'; //buat name dari qr code sesuai dengan nip
         
                $params['data'] = $qr_data; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
                $this->ciqrcode->generate($params);

                $param['qr_image'] =  '/assets/images/qr/'.$image_name;

                $data_qr = $this->general_model->insert_data('data_qr',$param);

                if ($data_qr) {
                    $this->session->set_flashdata('data_success', 'Berhasil menambahkan data baru');
                    redirect('admin/data');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
		
		// echo "<pre>";
		// print_r($this->session->userdata());
		// exit();
		$this->load->admin('admin/input', $data);
	}

    public function update($id){
        $data['id'] = $id;
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $con = array('id_qr' => $param['id_qr']);
                $param_update['nama_pemilik'] = $param['nama_pemilik'];
                $param_update['kuota_bbm'] = $param['kuota_bbm'];
                $param_update['jenis_kendaraan'] = $param['jenis_kendaraan'];
                $param_update['no_kartu'] = str_replace(' ', '', $param['no_kartu']);
                $param_update['dokumen'] = $param['dokumen'];

                $qr_data = $param['no_pol'].",".$param['no_kartu'];
                $base64 = $this->encryption->encrypt($param['no_pol']);
                $qr_name = strtr($base64, '+/=', '.-~');

                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './assets/images/qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224,255,255); // array, default is array(255,255,255)
                $config['white']        = array(70,130,180); // array, default is array(0,0,0)
                $this->ciqrcode->initialize($config);
         
                $image_name=$qr_name.'.png'; //buat name dari qr code sesuai dengan nip
         
                $params['data'] = $qr_data; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
                $this->ciqrcode->generate($params);

                $param_update['qr_image'] =  '/assets/images/qr/'.$image_name;

                $data_qr = $this->general_model->update_data('data_qr', $con, $param_update);

                if ($data_qr) {
                    $this->session->set_flashdata('data_success', 'Berhasil update data');
                    redirect('admin/data');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter['id_qr'] = $id;
        $data['param'] = json_decode(json_encode($this->general_model->get_data('data_qr','*',$filter)[0]), true);
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/update', $data);
    }

	public function approve_list()
	{
		$config['base_url'] = site_url('admin/data'); //site url
        $config['total_rows'] = $this->db->where('status_approve',0)->count_all('data_qr'); //total row
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

        $filter = array('status_approve'=>0);
        $dataqrs = $this->general_model->get_data('data_qr','*',$filter,'','',$config["per_page"],$data['page']);

        $data['dataqrs'] = $dataqrs;
		
		// echo "<pre>";
		// print_r($this->session->userdata());
		// exit();
		$this->load->admin('admin/approve_list', $data);
	}

    public function approve($id){
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $con = array('id_qr' => $id);

        $param['user_approved'] = $this->session->userdata('user_id');
        $param['date_approved'] = date("Y-m-d H:i:s");
        $param['status_approve'] = 1;

        $data_qr = $this->general_model->update_data('data_qr', $con, $param);
        if ($data_qr) {
            $this->session->set_flashdata('data_success', 'Berhasil update data');
            redirect('admin/approve_list');
        }else{
            $this->session->set_flashdata('data_failed', 'Gagal Approve Data');
            redirect('admin/approve_list');
        }
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/update', $data);
    }

    public function print_qr($id){
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter['id_qr'] = $id;
        $data['param'] = json_decode(json_encode($this->general_model->get_data('data_qr','*',$filter)[0]), true);
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->view('admin/print_qr', $data);
    }

	public function spbu()
	{
		$config['base_url'] = site_url('admin/spbu'); //site url
        $config['total_rows'] = $this->db->count_all('spbu'); //total row
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

        $filter = "";
        $spbus = $this->general_model->get_data('spbu','*',$filter,'','',$config["per_page"],$data['page']);

        $data['spbus'] = $spbus;
        
        // echo "<pre>";
        // print_r($this->session->userdata());
        // exit();
        $this->load->admin('admin/spbu', $data);
	}

    public function spbu_add(){
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

                $spbu = $this->general_model->insert_data('spbu',$param);

                if ($spbu) {
                    $this->session->set_flashdata('spbu_success', 'Berhasil menambahkan spbu baru');
                    redirect('admin/spbu');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/spbu_add', $data);
    }

    public function spbu_update($id){
        $data['id'] = $id;
        $data['error'] = "";
        if($this->input->post()){
            $param = $this->input->post();

            if ($data['error'] == "" || $data['error'] == null || empty($data['error'])) {

            	$con = array('id_spbu' => $param['id_spbu']);
            	$param_update['no_spbu'] = $param['no_spbu'];
            	$param_update['nama_spbu'] = $param['nama_spbu'];
            	$param_update['wilayah'] = $param['wilayah'];

                $spbu = $this->general_model->update_data('spbu', $con, $param_update);

                if ($spbu) {
                    $this->session->set_flashdata('spbu_success', 'Berhasil update data spbu');
                    redirect('admin/spbu');
                }else{
                    $data['error'] = "Gagal Menyimpan Data";
                    $data['param'] = $param;
                }
            }
           

        }
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);
        $filter['id_spbu'] = $id;
        $data['param'] = json_decode(json_encode($this->general_model->get_data('spbu','*',$filter)[0]), true);
        // echo "<pre>";
        // print_r($data);
        // exit();
        $this->load->admin('admin/spbu_update', $data);
    }

    public function spbu_delete($id){
        $base64 = strtr($id, '.-~', '+/=');
        $id = $this->encryption->decrypt($base64);

        $con = array('id_spbu' => $id);
        $delete = $this->general_model->delete_data('spbu',$con);
         if ($delete) {
            $this->session->set_flashdata('spbu_success','Data Berhasil Dihapus');
        }else{
            $this->session->set_flashdata('spbu_failed','Gagal Menghapus Data');
        }
        redirect('admin/spbu');
    }

}
