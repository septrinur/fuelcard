<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apifunct {
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model('users_model');
        $this->CI->load->model('general_model');

        $this->CI->check_key = false;
        $this->CI->check_nonce = false;
	}

	function debug($param){
        echo "<pre>";
        print_r($param);
        exit();
    }

    //CHECK USER
    function check_user($username){
        $user = $this->CI->users_model->get_users(array('username' => $username));
        if (empty($user) || $user == null) {
            return false;
        }else{
            return true;
        }
    }

    function get_user_id($username){
        $user = $this->CI->users_model->get_users(array('username' => $username))[0];
        return $user->id_user;
    }

    function check_token($username, $token){
        $user = $this->CI->users_model->get_users(array('username' => $username))[0];
        if ($user->token == $token) {
            return false;
        }else{
            return true;
        }
    }

    function check_password($username, $password){
    	$user = $this->CI->users_model->get_users(array('username' => $username))[0];

    	if ($user->password == md5($password)) {
    		return false;
    	}else{
    		return true;
    	}
    }

    function validate_password($password){
    	$regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';

        if (preg_match_all($regex_lowercase, $password) < 1){
        	$err['status'] = false;
           	$err['msg']  = 'Password harus mempunyai minimal 1 huruf kecil';
           	return $err;
        }elseif (preg_match_all($regex_uppercase, $password) < 1){
        	$err['status'] = false;
            $err['msg'] = 'Password harus mempunyai minimal 1 huruf besar';
            return $err;
        }elseif (preg_match_all($regex_number, $password) < 1){
        	$err['status'] = false;
            $err['msg'] = 'Password harus mempunyai minimal 1 angka';
            return $err;
        }elseif (strlen($password) < 6){
        	$err['status'] = false;
            $err['msg'] = 'Password harus lebih dari 6';
            return $err;
        }else{
        	$err['status'] = true;
        	return $err;
        }
    }



    function is_exist_data($table, $filter){
        if (count($this->CI->general_model->get_data($table, "*", $filter)) > 0) {
            return true;
        }else{
            return false;
        }
    }

    function toJson() {
        return json_encode([
            'fields' => $this->fields
        ]);
    }
	
}
