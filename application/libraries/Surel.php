<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Surel{
    public function __construct()
    {
        // Get the CodeIgniter reference
        $this->_CI = &get_instance();

        $this->_CI->load->model('orders_model');
    }

    public function send($sendTo, $subject,$htmlContent){
        $this->_CI->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'notifications@service-kjt.id',
            'smtp_pass' => 'kjtone123',//'P@ssw0rdbest',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );
        // print_r($config);exit();
        $this->_CI->email->initialize($config);
        $this->_CI->email->set_mailtype("html");
        $this->_CI->email->set_newline("\r\n");

      
        $this->_CI->email->to($sendTo);
        $this->_CI->email->from('support_brismartbilling@service-kjt.id','GovStore');
        $this->_CI->email->subject($subject);
        $this->_CI->email->message($htmlContent);


        // Set to, from, message, etc.

        $this->_CI->load->library('encryption');
        if (!$this->_CI->email->send()) {  
            // show_error($this->_CI->email->print_debugger());   //exit();
            $log_email = array(
                    'send_to'   => $sendTo,
                    'date'      => date("Y-m-d H:i:s"),
                    'type'      => '4',
                    'id_order'  => $sendTo,
                    'status'    => '0'
                );
            $this->_CI->orders_model->insert_log_email($log_email);
            return false;
        }else{  
            $log_email = array(
                    'send_to'   => $sendTo,
                    'date'      => date("Y-m-d H:i:s"),
                    'type'      => '4',
                    'id_order'  => $sendTo,
                    'status'    => '1'
                );
            $this->_CI->orders_model->insert_log_email($log_email);
            return true;
        }  
    }
}
?>
