<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	private function _get_query($filter = array()){
        $this->db->from('m_skpd');
		if(@$filter['kode']) $this->db->like('kode', $filter['kode']);
		if(@$filter['nama_lengkap']) $this->db->like('nama_lengkap', $filter['nama_lengkap']);
		if(@$filter['nama_singkat']) $this->db->like('nama_singkat', $filter['nama_singkat']);
		if(@$filter['kode_unor']) $this->db->like('kode_unor', $filter['kode_unor']);
    }

	public function get($start, $length, $sort, $order, $filter){
        $this->_get_query($filter);
		$this->db->limit($length, $start);
		$this->db->order_by($sort, $order);
        $query = $this->db->get();
        return $query->result();
    }

	public function get_all(){
        $this->db->from('m_skpd');
		$this->db->order_by('kode_unor','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id){
        $this->db->from('m_skpd');
        $this->db->where('id_skpd',$id);
        $query = $this->db->get();
        return $query->row();
    }

	public function get_by_kode_unor($kode_unor){
        $this->db->from('m_skpd');
        $this->db->where('kode_unor',$kode_unor);
        $query = $this->db->get();
        return $query->row();
    }

	public function count_all(){
		$this->db->from('m_skpd');
		return $this->db->count_all_results();
    }

	function count_filtered($filter){
        $this->_get_query($filter);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
