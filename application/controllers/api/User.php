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

   
    public function add_post(){
        $function = "user_add";
        if (array_key_exists(0, $this->post())) {
            $param = (array)json_decode($this->post()[0]);
        }else{
            $param = $this->post();
        }
        
        if (array_key_exists('nonce', $param) && array_key_exists('key', $param)) {
            $post_data = $param['key'].$param['nonce'];
            $sign = hash_hmac('sha512', $post_data, $this->config->item('sandi'));
        }

        if (!array_key_exists('key', $param) || $param['key'] ===NULL || empty($param['key'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '01',
                'desc'      => 'Key Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('nonce', $param) || $param['nonce'] ===NULL || empty($param['nonce'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '02',
                'desc'      => 'Nonce Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('level', $param) || $param['level'] ===NULL || empty($param['level'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '05',
                'desc'      => 'Level Kosong',
                'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!is_numeric($param['level'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '06',
                'desc'      => 'Level Harus Berupa Angka',
                'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_nonce($param['nonce'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '97',
                'desc'      => 'Invalid Nonce',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_key($sign,$param['key'])) {
             $this->set_response([
                'status'    => false,
                'code'      => '98',
                'desc'      => 'Invalid Key',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('email', $param) || $param['email'] ===NULL || empty($param['email'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '09',
                'desc'      => 'Email Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('username', $param) || $param['username'] ===NULL || empty($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '03',
                'desc'      => 'Username Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif ($this->apifunct->check_user($param['email'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '97',
                'desc'      => 'User Exists',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }else{
            if ($param['level'] == '3' || $param['level'] == '4') {
                if (!array_key_exists('nama', $param) || $param['nama'] ===NULL || empty($param['nama'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '06',
                        'desc'      => 'Nama Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('nip', $param) || $param['nip'] ===NULL || empty($param['nip'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '07',
                        'desc'      => 'Nip Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('nik', $param) || $param['nik'] ===NULL || empty($param['nik'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '08',
                        'desc'      => 'Nik Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('no_hp', $param) || $param['no_hp'] ===NULL || empty($param['no_hp'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '10',
                        'desc'      => 'No Hp Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('file', $param) || $param['file'] ===NULL || empty($param['file'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '10',
                        'desc'      => 'File Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                $length = 6;

                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $param['password'] = $randomString;
            }else{
                if (!array_key_exists('password', $param) || $param['password'] ===NULL || empty($param['password'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '04',
                        'desc'      => 'Password Kosong',
                        'data'      => $this->post()
                        ], REST_Controller::HTTP_OK);
                }elseif (!$this->apifunct->validate_password($param['password'])['status']) {
                     $this->set_response([
                        'status'    => false,
                        'code'      => '96',
                        'desc'      => $this->apifunct->validate_password($param['password'])['msg'],
                        'data'      => $this->post()
                        ], REST_Controller::HTTP_OK);
                }
            }
            $user = $this->users_model->insert_users($param);

            if ($param['level'] == '3' || $param['level'] == '4') {
                $data['nama'] = $param['nama'];
                $data['no_telp'] = $param['no_hp'];
                $data['password'] = $param['password'];
                $data['email'] = $param['email'];
                // $data['user_created'] = $b64image;
                $sendTo = $param['email'];
                $subject = 'Selamat '.$param['nama'].' Kamu terdaftar di Govstore';

                $data_email = json_encode($data);
                $param_email_notif['data'] = $data_email;
                $param_email_notif['sendto'] = $sendTo;
                $param_email_notif['subject'] = $subject;
                $param_email_notif['email_type'] = 1;
                $param_email_notif['date_created'] = date("Y-m-d H:i:s");

                $this->general_model->insert_data('email_notif', $param_email_notif);

                // $body = $this->load->view('theme/email_new_user',$data,true);
                // $log_email = array(
                //     'send_to'   => $sendTo,
                //     'date'      => date("Y-m-d H:i:s"),
                //     'type'      => '4',
                //     'id_order'  => $param['no_hp']
                // );
                // if ($this->surel->send($sendTo, $subject, $body)) {
                //     $log_email['status'] = '1';
                //     $this->orders_model->insert_log_email($log_email);
                // }else{
                //     $log_email['status'] = '0';
                //     $this->orders_model->insert_log_email($log_email);
                // }
            }


            if ($user) {
                $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => 'Success',
                    'data'      => $param
                    ], REST_Controller::HTTP_OK);
            }else{
               $this->set_response([
                    'status'    => true,
                    'code'      => '99',
                    'desc'      => 'Failed',
                    'data'      => $param
                    ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function update_post(){
        $function = "user_update";
        if (array_key_exists(0, $this->post())) {
            $param = (array)json_decode($this->post()[0]);
        }else{
            $param = $this->post();
        }

        if (array_key_exists('nonce', $param) && array_key_exists('username', $param)) {
            if ($this->apifunct->check_user($param['username']) && !$this->apifunct->has_permission($param['username'],$function)) {
                 $this->set_response([
                    'status'    => false,
                    'code'      => '44',
                    'desc'      => 'Username tidak berhak mengakses API ini',
                    'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
            }
            $post_data = $param['username'].$param['nonce'];
            $sign = hash_hmac('sha512', $post_data, $this->config->item('sandi'));
        }

        if (!array_key_exists('key', $param) || $param['key'] ===NULL || empty($param['key'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '01',
                'desc'      => 'Key Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('nonce', $param) || $param['nonce'] ===NULL || empty($param['nonce'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '02',
                'desc'      => 'Nonce Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('username', $param) || $param['username'] ===NULL || empty($param['username'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '03',
                'desc'      => 'Username Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('id_user', $param) || $param['id_user'] ===NULL || empty($param['id_user'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '08',
                'desc'      => 'Id User Kosong',
                'data'      => $this->post()
            ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('level', $param) || $param['level'] ===NULL || empty($param['level'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '05',
                'desc'      => 'Level Kosong',
                'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!array_key_exists('status', $param) || $param['status'] ===NULL || empty($param['status'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '06',
                'desc'      => 'Status Kosong',
                'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!is_numeric($param['level'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '07',
                'desc'      => 'Level Harus Berupa Angka',
                'data'      => $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_nonce($param['nonce'])) {
            $this->set_response([
                'status'    => false,
                'code'      => '97',
                'desc'      => 'Invalid Nonce',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_key($sign,$param['key'])) {
             $this->set_response([
                'status'    => false,
                'code'      => '98',
                'desc'      => 'Invalid Key',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_user($param['username'])) {
             $this->set_response([
                'status'    => false,
                'code'      => '97',
                'desc'      => 'Invalid Username',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }elseif (!$this->apifunct->check_user($param['id_user'])) {
             $this->set_response([
                'status'    => false,
                'code'      => '96',
                'desc'      => 'Invalid Id User',
                'data'      =>  $this->post()
                ], REST_Controller::HTTP_OK);
        }else{
            if ($param['level'] == '3' || $param['level'] == '4') {
                if (!array_key_exists('nama', $param) || $param['nama'] ===NULL || empty($param['nama'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '06',
                        'desc'      => 'Nama Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('nip', $param) || $param['nip'] ===NULL || empty($param['nip'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '07',
                        'desc'      => 'Nip Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('nik', $param) || $param['nik'] ===NULL || empty($param['nik'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '08',
                        'desc'      => 'Nik Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }elseif (!array_key_exists('no_hp', $param) || $param['no_hp'] ===NULL || empty($param['no_hp'])) {
                    $this->set_response([
                        'status'    => false,
                        'code'      => '10',
                        'desc'      => 'No Hp Kosong',
                        'data'      => $this->post()
                    ], REST_Controller::HTTP_OK);
                }
            }

            if (!array_key_exists('file', $param) || $param['file'] ===NULL || empty($param['file'])) {
                $param['file'] = '';
            }

            //get level
            $level = $this->apifunct->get_level($param['id_user']);

            //if user->level != $param[level] -> changed
            if ($param['level'] != $level) {
                //get list level of retailer
                $retailer_level = $this->apifunct->get_list_level('retailer');

                //check if level to update is retailer
                if (in_array($level, $retailer_level)) {
                    //get retailer data
                    $retailer = $this->agen_model->get_agen(array('user_id' => $param['id_user']))[0];
                    $satker_id = $retailer->satker_id;



                    //get unit data
                    $filter_unit = array(
                        'agen_id' => $retailer->id_agen
                    );
                    $agen_unit = $this->general_model->get_data('unit_satker', '*', $filter_unit);

                    //if update to level 11 & 15 register unit
                    if ($param['level'] == '11' || $param['level'] == '15') {
                        if (!array_key_exists('nama_unit', $param) || $param['nama_unit'] ===NULL || empty($param['nama_unit'])) {
                            $this->set_response([
                                'status'    => false,
                                'code'      => '11',
                                'desc'      => 'Nama Unit Kosong',
                                'data'      => $this->post()
                            ], REST_Controller::HTTP_OK);
                        }
                        if (empty($agen_unit)) {
                            $param_insert = array(
                                'satker_id' => $satker_id,
                                'nama_unit' => $param['nama_unit'],
                                'agen_id'   => $retailer->id_agen
                            );

                            $update = $this->general_model->insert_data('unit_satker',$param_insert);


                            $param_placement = array(
                                'satker_id'     => $satker_id,
                                'unit_nama'     => $param['nama_unit'],
                                'agen_id'       => $retailer->id_agen,
                                'level_id'      => $param['level'],
                                'date_created'  => date("Y-m-d H:i:s")
                            );
                            
                            $placement = $this->general_model->insert_data('placement_hist',$param_placement);
                        }else{
                            $param_update = array(
                                'satker_id' => $satker_id,
                                'nama_unit' => $param['nama_unit'],
                            );

                            $con = array(
                                'agen_id' => $retailer->id_agen
                            );

                            $update = $this->general_model->update_data('unit_satker', $con, $param_update);

                            $param_placement = array(
                                'satker_id'     => $satker_id,
                                'unit_nama'     => $param['nama_unit'],
                                'agen_id'       => $retailer->id_agen,
                                'level_id'      => $param['level'],
                                'date_created'  => date("Y-m-d H:i:s")
                            );
                            
                            $placement = $this->general_model->insert_data('placement_hist',$param_placement);
                        }
                    }

                    //if update from level 11 & 15 to other remove unit
                    if ($level == '11' || $level == '15') {
                        if (empty($agen_unit)) {
                            $param_insert = array(
                                'satker_id' => $satker_id,
                                'nama_unit' => null,
                                'agen_id'   => $retailer->id_agen
                            );

                            $update = $this->general_model->insert_data('unit_satker',$param_insert);


                            $param_placement = array(
                                'satker_id'     => $satker_id,
                                'unit_nama'     => null,
                                'agen_id'       => $retailer->id_agen,
                                'level_id'      => $param['level'],
                                'date_created'  => date("Y-m-d H:i:s")
                            );
                            
                            $placement = $this->general_model->insert_data('placement_hist',$param_placement);


                        }else{
                            $param_update = array(
                                'satker_id' => $satker_id,
                                'nama_unit' => null,
                            );

                            $con = array(
                                'agen_id' => $retailer->id_agen
                            );

                            $update = $this->general_model->update_data('unit_satker', $con, $param_update);

                            $param_placement = array(
                                'satker_id'     => $satker_id,
                                'unit_nama'     => null,
                                'agen_id'       => $retailer->id_agen,
                                'level_id'      => $param['level'],
                                'date_created'  => date("Y-m-d H:i:s")
                            );
                            
                            $placement = $this->general_model->insert_data('placement_hist',$param_placement);
                        }
                    }
                }
            }

            $user = $this->users_model->update_user_app($param);

            if ($user) {
                $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => 'Success',
                    'data'      => []
                    ], REST_Controller::HTTP_OK);
            }else{
               $this->set_response([
                    'status'    => true,
                    'code'      => '99',
                    'desc'      => 'Failed',
                    'data'      => []
                    ], REST_Controller::HTTP_OK);
            }
        }
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
