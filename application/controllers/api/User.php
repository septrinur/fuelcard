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
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->library("Services");
        $this->load->library('apifunct');
        $this->load->model('users_model');
        $this->load->model('general_model');

        ini_set('display_errors', 1);

        $this->time_now = date('H:i:s');

    }

    public function login_post(){
        $function = "user_login";
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
        }elseif (!array_key_exists('password', $param) || $param['password'] ===NULL || empty($param['password'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '04',
                'desc'      => 'Password Kosong',
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

            $param['username'] = str_replace(' ', '', $param['username']);
            $param['password'] = str_replace(' ', '', $param['password']);
            if (!$this->apifunct->check_user($param['username'])) {
                $this->set_response([
                    'status'    => false,
                    'code'      => '96',
                    'desc'      => 'Invalid Username',
                    'data'      =>  $this->post()
                    ], REST_Controller::HTTP_BAD_REQUEST);
            }else{
                $user = $this->users_model->login_app($param);

                if ($user == 1) {
                    $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => 'Success',
                    'data'      => $this->session->userdata()
                    ], REST_Controller::HTTP_OK);
                }elseif ($user == 2){
                    $this->set_response([
                    'status'    => false,
                    'code'      => '03',
                    'desc'      => 'Kata sandi Tidak Sesuai',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }elseif ($user == 3){
                    $this->set_response([
                    'status'    => false,
                    'code'      => '04',
                    'desc'      => 'Akun Anda DiBlokir',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }elseif ($user == 5){
                    $this->set_response([
                    'status'    => false,
                    'code'      => '06',
                    'desc'      => 'Akun Tidak Berhak login',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }elseif ($user == 96){
                    $this->set_response([
                    'status'    => false,
                    'code'      => '04',
                    'desc'      => 'Akun Anda DiBlokir',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }else{
                    $this->set_response([
                    'status'    => false,
                    'code'      => '05',
                    'desc'      => 'Nama Pengguna atau Kata Sandi tidak valid',
                    'data'      => $this->post()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
                }
            }
        }
    }
}
