<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_by_id($id){
		$this->db->from('m_menu');
		$this->db->where('id_menu', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all(){
		$this->db->from('m_menu');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_parent(){
		if ($this->session->app_id) {
			$this->db->join('t_menu_level l', 'l.id_menu = m.id_menu');
			$this->db->where('l.app_id', $this->session->app_id);
		}
		$this->db->where('m.id_parent', NULL);
		$this->db->order_by('m.index','ASC');
		$query = $this->db->get('m_menu m');
		return $query->result();
	}

	public function get_child_by_id_parent($id){
		$this->db->from('m_menu');
		$this->db->where('id_parent', $id);
		$this->db->order_by('index','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all(){
		$this->db->from('m_menu');
		return $this->db->count_all_results();
	}

	public function insert($data){
		$this->db->insert('m_menu', $data);
		return $this->db->insert_id();
	}

	public function update($where, $data){
		$this->db->update('m_menu', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id){
		$this->db->where('id_menu', $id);
		$this->db->delete('m_menu');
	}

}
