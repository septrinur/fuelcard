<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
	}

    function count_data_dashboard($filter='',$like='')
    {

        $this->db->from('spbu');
        
        if($filter!='') {
            $this->db->where($filter);
        }

        if($like!='') {
            $this->db->where($like);
        }

        return $this->db->count_all_results();
    }

    function get_data_dashboard($filter='',$limit='',$start='',$like='')
    {

        $this->db->select('id_spbu, nama_spbu, COUNT(id_verifikasi) as total_scan, SUM(IF(verifikasi.status = 1, 1,0)) as success_scan, SUM(IF(verifikasi.status = 0, 1,0)) as failed_scan', false);
        $this->db->from('spbu');
        $this->db->join('users', 'id_spbu = users.spbu_id');
        $this->db->join('verifikasi', 'id_user = verifikasi.user_id');
        
        if($filter!='') {
            $this->db->where($filter);
        }

        if($like!='') {
            $this->db->like($like);
        }
        // print_r($start);exit();
        if ($limit != '') {
           $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result();
    }

    function get_data_detail($filter='',$limit='',$start='')
    {

        $this->db->select('id_spbu, nama_spbu, name, verifikasi.no_kartu as kartu,verifikasi.no_polisi as nopol, verifikasi.foto as image, verifikasi.trx_date as trxdate, verifikasi.status as stat', false);
        $this->db->from('spbu');
        $this->db->join('users', 'id_spbu = users.spbu_id');
        $this->db->join('verifikasi', 'id_user = verifikasi.user_id');
        
        if($filter!='') {
            $this->db->where($filter);
        }
        // print_r($start);exit();
        if ($limit != '') {
           $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result();
    }

    function count_data_detail($filter='')
    {

        $this->db->select('id_spbu, nama_spbu, name, verifikasi.no_kartu as kartu,verifikasi.no_polisi as nopol, verifikasi.foto as image, verifikasi.trx_date as trxdate, verifikasi.status as stat', false);
        $this->db->from('spbu');
        $this->db->join('users', 'id_spbu = users.spbu_id');
        $this->db->join('verifikasi', 'id_user = verifikasi.user_id');
        
        if($filter!='') {
            $this->db->where($filter);
        }
        // print_r($start);exit();
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $this->db->count_all_results();
    }
}