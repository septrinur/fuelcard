<?php

header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Verifikasi extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library("Services");
        $this->load->library('apifunct');
        $this->load->model('users_model');
        $this->load->model('general_model');

        ini_set('display_errors', 1);

        date_default_timezone_set('Asia/Jakarta');

        $this->time_now = date('H:i:s');

    }

   
    public function add_post(){
        $function = "verifikasi_add";
        if (array_key_exists(0, $this->post())) {
            $param = (array)json_decode($this->post()[0]);
        }else{
            $param = $this->post();
        }
        

        // $headers = apache_request_headers();
        // if(isset($headers['Authorization'])){
        //     $matches = array('Token 12345');
        //     preg_match('/Token (.*)/', $headers['Authorization'], $matches);
        //     // print_r($matches);exit();
        //     if(isset($matches[1])){
        //       $token = $matches[1];
        //     }else{
        //         $this->set_response([
        //             'status'    => false,
        //             'code'      => '02',
        //             'desc'      => 'Token Not Found',
        //             'data'      => $this->post()
        //         ], REST_Controller::HTTP_UNAUTHORIZED);
        //     }
        // }else{
        //     $this->set_response([
        //         'status'    => false,
        //         'code'      => '01',
        //         'desc'      => 'No Authorization',
        //         'data'      => $this->post()
        //     ], REST_Controller::HTTP_UNAUTHORIZED);
        // } 

        if (!array_key_exists('username', $param) || $param['username'] ===NULL || empty($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '03',
                'desc'      => 'Username Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_BAD_REQUEST);
        }elseif (!$this->apifunct->check_user($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '96',
                'desc'      => 'Invalid Username',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            // if ($this->apifunct->check_token($param['username'],$token)) {
            //     $this->set_response([
            //         'status'    => false,
            //         'code'      => '97',
            //         'desc'      => 'Invalid Token',
            //         'data'      =>  $this->post()
            //         ], REST_Controller::HTTP_UNAUTHORIZED);
            // }
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = '*';
            $config['max_size']             = 53083730;
            $config['max_width']            = 10240;
            $config['max_height']           = 10240;

            $this->load->library('upload', $config);

            // echo json_encode($_FILES['file']);exit();

            if ( ! $this->upload->do_upload('nopolimage'))
            {
                 $this->set_response([
                    'status'    => false,
                    'code'      => '99',
                    'desc'      => 'Gagal Menyimpan Data, Mohon Dicoba Lagi',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);

            }
            else
            {
                $image = $this->upload->data();
                $param_save['user_id'] = $this->apifunct->get_user_id($param['username']);
                $param_save['no_kartu'] = $param['no_kartu'];
                $param_save['no_polisi'] = $param['no_polisi'];
                $param_save['foto'] = 'uploads/'.$image['file_name'];
                $param_save['status'] = 1;
                $param_save['trx_date'] = date("Y-m-d H:i:s");


                $save = $this->general_model->insert_data('verifikasi',$param_save);

                if ($save) {
                    $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => 'Success',
                    'data'      => $param
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->set_response([
                    'status'    => false,
                    'code'      => '99',
                    'desc'      => 'Gagal Menyimpan Data, Mohon Dicoba Lagi',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }
            }
        }
    }

    public function failed_post(){
        $function = "verifikasi_failed";
        if (array_key_exists(0, $this->post())) {
            $param = (array)json_decode($this->post()[0]);
        }else{
            $param = $this->post();
        }
        

        // $headers = apache_request_headers();
        // if(isset($headers['Authorization'])){
        //     $matches = array('Token 12345');
        //     preg_match('/Token (.*)/', $headers['Authorization'], $matches);
        //     // print_r($matches);exit();
        //     if(isset($matches[1])){
        //       $token = $matches[1];
        //     }else{
        //         $this->set_response([
        //             'status'    => false,
        //             'code'      => '02',
        //             'desc'      => 'Token Not Found',
        //             'data'      => $this->post()
        //         ], REST_Controller::HTTP_UNAUTHORIZED);
        //     }
        // }else{
        //     $this->set_response([
        //         'status'    => false,
        //         'code'      => '01',
        //         'desc'      => 'No Authorization',
        //         'data'      => $this->post()
        //     ], REST_Controller::HTTP_UNAUTHORIZED);
        // } 

        if (!array_key_exists('username', $param) || $param['username'] ===NULL || empty($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '03',
                'desc'      => 'Username Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_BAD_REQUEST);
        }elseif (!$this->apifunct->check_user($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '96',
                'desc'      => 'Invalid Username',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            // if ($this->apifunct->check_token($param['username'],$token)) {
            //     $this->set_response([
            //         'status'    => false,
            //         'code'      => '97',
            //         'desc'      => 'Invalid Token',
            //         'data'      =>  $this->post()
            //         ], REST_Controller::HTTP_UNAUTHORIZED);
            // }

            $param_save['user_id'] = $this->apifunct->get_user_id($param['username']);
            $param_save['no_kartu'] = $param['no_kartu'];
            $param_save['no_polisi'] = $param['no_polisi'];
            $param_save['reason_failed'] = $param['reason'];
            $param_save['status'] = 0;
            $param_save['trx_date'] = date("Y-m-d H:i:s");

            $save = $this->general_model->insert_data('verifikasi',$param_save);

            if ($save) {
                $this->set_response([
                'status'    => true,
                'code'      => '00',
                'desc'      => 'Success',
                'data'      => $param
                ], REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                'status'    => false,
                'code'      => '99',
                'desc'      => 'Gagal Menyimpan Data, Mohon Dicoba Lagi',
                'data'      => $this->post()
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
    }
}
