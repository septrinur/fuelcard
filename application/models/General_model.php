<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
	}

    function get_data($table, $select, $filter='',$join_table='',$join_condition='',$limit='',$start='')
    {

        $this->db->select($select, false);
        $this->db->from($table);
        if ($join_table != '' && $join_condition!='') {
            $this->db->join($join_table, $join_condition);
        }
        
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

    function get_data_random($table, $select, $filter='',$join_table='',$join_condition='',$limit='',$start='')
    {

        $this->db->select($select, false);
        $this->db->from($table);
        if ($join_table != '' && $join_condition!='') {
            $this->db->join($join_table, $join_condition);
        }
        
        if($filter!='') {
            $this->db->where($filter);
        }
        $this->db->order_by('rand()');
        // print_r($start);exit();
        if ($limit != '') {
           $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result();
    }

    function get_data_array_single($table, $select, $filter='')
    {

        $this->db->select($select, false);
        $this->db->from($table);
        if($filter!='') {
            $this->db->where($filter);
        }
        $query = $this->db->get()->result();
        // echo $this->db->last_query();exit();
        $data = array();
        foreach ($query as $key => $value) {
            $data[] = $value->$select;
        }
        return $data;
    }

    function update_data($table, $con, $param){
        
        $this->db->where($con);
        $this->db->update($table, $param); 

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


    function insert_data($table,$param){
        $this->db->insert($table,$param);

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

    function insert_batch_data($table,$param){
        $this->db->insert_batch($table,$param);

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

    function delete_data($table,$con){
        $this->db->where($con);
        $this->db->delete($table);


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