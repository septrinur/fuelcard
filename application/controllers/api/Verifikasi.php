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

        $this->time_now = date('H:i:s');

    }

   
    public function add_post(){
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
                'status'    => true,
                'code'      => '00',
                'desc'      => $this->upload->display_errors(),
                'data'      => $this->upload->display_errors()
                ], REST_Controller::HTTP_UNAUTHORIZED);
        }
        else
        {
            if ( ! $this->upload->do_upload('nokartuimage'))
            {

                $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => $this->upload->display_errors(),
                    'data'      => $this->upload->display_errors()
                    ], REST_Controller::HTTP_UNAUTHORIZED);
            }
            else
            {
                    $this->set_response([
                    'status'    => true,
                    'code'      => '00',
                    'desc'      => '',
                    'data'      => ''
                    ], REST_Controller::HTTP_OK);
            }
        }
    }
}
