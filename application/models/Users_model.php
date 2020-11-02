<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->library("Services");
        $this->load->library('apifunct');

        //user status
        //0 input, 1 verifikasi, 2 reject verifikasi, 3 approve, 4 reject approve
    }
	

    function get_users($filter='',$sort='',$filter_in=''){
    	$this->db->select('*', false);
        $this->db->from('users');
        if($filter_in!='') {
            foreach ($filter_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }
        if($filter!='') {
            $this->db->where($filter);
        }
        if($sort!='') {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key,$value);
            }
            
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    function login_app($param){
        $cln_userid = $this->db->escape($param['username']);
        $encrypt_pass = md5($param['password']);
        $cln_password = $this->db->escape($encrypt_pass);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username',$param['username']);
        //$this->db->where('password',$encrypt_pass);
        //$this->db->where('status',1);
        $query = $this->db->get();
        // echo '<pre>';
        // print_r($cln_userid);
        // echo '</pre>';
        // exit();
        if($query->num_rows()>0){
            $row = $query->row();
            if ($row->login_attempt >= 6) {
                $this->db->set('status', 0);
                $this->db->where('id_user', $row->id_user);
                $this->db->update('users'); 
                return 96;
            }
            if ($row->password == $encrypt_pass) {
                
                if ($row->status == 1) {
                    $this->session->set_userdata('is_login',TRUE);
                    $this->session->set_userdata('user_id',$row->id_user);
                    $this->session->set_userdata('token',$row->token);
                    $this->session->set_userdata('username',$row->username);
                    $this->session->set_userdata('last_login',$row->last_login);

                    $data = array('last_login' => date("Y-m-d H:i:s"), 'login_attempt' => 0);
                    
                    $this->db->where('id_user', $row->id_user);
                    $this->db->update('users', $data); 
                    return true;
                }else{
                    return 3;
                }
            }else{
                $this->db->set('login_attempt', 'login_attempt+1', FALSE);
                $this->db->where('id_user', $row->id_user);
                $this->db->update('users'); 
                return 2;
            }
            
        }else{
            return 98;
        }
    }

    function insert_users($param)
    {
        $this->db->trans_begin();
        $data = array();

        if ($param['level'] == '2' || $param['level'] == '3' || $param['level'] == '4') {
            $data = array(
                'username'      =>  $param['username'],
                'password'      =>  md5($param['password']),
                'name'          =>  $param['name'],
                'instansi'      =>  $param['instansi'],
                'jabatan'       =>  $param['jabatan'],
                'email'         =>  $param['email'],
                'no_hp'         =>  $param['no_hp'],
                'status'        =>  1,
                'level'         =>  $param['level'],
                'user_created'  =>  $param['user_id'],
                'date_created'  =>  date("Y-m-d H:i:s")
            ); 
        }else{
            $data = array(
                'username'      =>  $param['username'],
                'password'      =>  md5($param['password']),
                'name'          =>  $param['name'],
                'no_hp'         =>  $param['no_hp'],
                'status'        =>  1,
                'level'         =>  $param['level'],
                'user_created'  =>  $param['user_id'],
                'date_created'  =>  date("Y-m-d H:i:s")
            );
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $this->db->insert('users',$data);
        
        if ($this->db->trans_status() === FALSE || $this->db->affected_rows() === 0)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            if ($param['level'] == '5') {
                $data_petugas = array(
                        'user_id'       =>  $this->db->insert_id(),
                        'id_petugas'    =>  $param['id_petugas'],
                        'nama_petugas'  =>  $param['name'],
                        'no_hp_petugas' =>  $param['no_hp'],
                        'spbu_id'       =>  $param['spbu_id']
                );
                
                $this->db->insert('user_spbu',$data_petugas);
                if ($this->db->trans_status() === FALSE || $this->db->affected_rows() === 0)
                {
                    $this->db->trans_rollback();
                    return false;
                }
                else
                {
                    $this->db->trans_commit();
                    return true;
                }
            }
        }
    }

    function update_users($param){
        $this->db->trans_begin();
        if ($param['password'] != '' || !empty($param['password'])) {
            $data = array('password' => md5($param['password']),
                        'level'             => $param['level'],
                        'type'              =>  $param['type'],
                        'status'            =>  2,
                        'active'            =>  0);
        }else{
            $data = array('level'             => $param['level'],
                        'type'              =>  $param['type'],
                        'status'            =>  2,
                        'active'            =>  0);
        }
        

        $this->db->where('id_user', $param['username']);
        $this->db->update('users', $data); 

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    function update_user_app($param){
        $this->db->trans_begin();

        if ($param['level'] == '3' || $param['level'] == '4') {
            if ($param['file'] == '') {
                $data = array(
                    'nama'          =>  $param['nama'],
                    'nik'           =>  $param['nik'],
                    'nip'           =>  $param['nip'],
                    'no_hp'         =>  $param['no_hp'],
                    'status'        =>  1,
                    'login_attempt' =>  0,
                    'level'         =>  $param['level']
                ); 
            }else{
                $data = array(
                    'nama'          =>  $param['nama'],
                    'nik'           =>  $param['nik'],
                    'nip'           =>  $param['nip'],
                    'no_hp'         =>  $param['no_hp'],
                    'file'          =>  $param['file'],
                    'status'        =>  1,
                    'login_attempt' =>  0,
                    'level'         =>  $param['level']
                ); 
            }
            
        }else{
            $data = array('level'           => $param['level'],
                    'status'            =>  $param['status']);
        }
        
        
        

        $this->db->where('id_user', $param['id_user']);
        $this->db->update('users', $data); 

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    function update_user($param, $id){
        $this->db->trans_begin();


        $this->db->where('id_user', $id);
        $this->db->update('users', $param); 

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    function update_password($param){
        $this->db->trans_begin();
        $data = array(
            'password'      => md5($param['password']), 
            'status'        => 1, 
            'login_attempt' => 0, 
            'pswchg'        => 1
        );
        $this->db->where('id_user', $param['username']);
        $this->db->update('users', $data); 

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }


    function delete_users($id){
        $this->db->trans_begin();

        $this->db->where('id_user', $id);
        $this->db->delete('users');

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

}