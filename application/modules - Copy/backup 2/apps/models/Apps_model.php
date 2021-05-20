<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	private function _get_query($filter = array()){
        $this->db->from('m_app');
		if(@$filter['nama_app'])
            $this->db->like('nama_app', $filter['nama_app']);
        if(@$filter['short_name'])
            $this->db->like('short_name', $filter['short_name']);
        if(@$filter['long_name'])
            $this->db->like('long_name', $filter['long_name']);
        if(@$filter['icon'])
            $this->db->like('icon', $filter['icon']);
        if(@$filter['scheme'] != 'ALL' && @$filter['scheme'] != '')
            $this->db->where('scheme', $filter['scheme']);
        if(@$filter['status'] != 'ALL' && @$filter['status'] != '')
            $this->db->where('status', $filter['status']);
    }

	public function get($start, $length, $sort, $order, $filter){
        $this->_get_query($filter);
		$this->db->limit($length, $start);
		$this->db->order_by($sort, $order);
        $query = $this->db->get();
        return $query->result();
    }

	public function get_all(){
        $this->db->from('m_app');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id){
        $this->db->from('m_app');
        $this->db->where('id_app',$id);
        $query = $this->db->get();
        return $query->row();
    }

	public function count_all(){
        $this->db->from('m_app');
        return $this->db->count_all_results();
    }

	function count_filtered($filter){
        $this->_get_query($filter);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function insert($data){
        $this->db->set('cdd', 'NOW()', FALSE);
        $this->db->set('cdb', $this->session->id_user);
        $this->db->insert('m_app', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data){
        $this->db->set('mdd', 'NOW()', FALSE);
        $this->db->set('mdb', $this->session->id_user);
        $this->db->update('m_app', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id_app', $id);
        $this->db->delete('m_app');
    }
}
