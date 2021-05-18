<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_pembantu_model extends CI_Model {

	public function __construct(){
		parent::__construct(); 
	}


	public function insert($data){
        $this->db->set('cby', $this->session->id_user);
		$this->db->set('cdd', date('Y-m-d H:i:s'));
		$this->db->insert('t_daftar_pembantu',$data);
		return $this->db->insert_id();
	}

	public function update($where, $data){
		$this->db->set('uby', $this->session->id_user);
		$this->db->set('udd', date('Y-m-d H:i:s'));
		$this->db->update('t_daftar_pembantu', $data, $where);
		return $this->db->affected_rows();
	}

	private function _get_query($filter = array()){
		$this->db->select('t_daftar_pembantu.*,m_skpd.nama_lengkap as skpd, m_kategori_pembantu.nama as kategori');
		$this->db->from('t_daftar_pembantu');
		$this->db->join('m_skpd','m_skpd.id_skpd = t_daftar_pembantu.id_skpd', 'LEFT');
		$this->db->join('m_kategori_pembantu','m_kategori_pembantu.id_kategori_pembantu = t_daftar_pembantu.id_kategori_pembantu', 'LEFT');
        // $this->db->where_not_in('m_user.username', 'egov');
		$this->db->where('t_daftar_pembantu.hapus', '0');
		if(@$filter['username'])
			$this->db->like('m_skpd.nama_lengkap', $filter['username']);
		if(@$filter['nama'])
			$this->db->like('m_user.nama', $filter['nama']);
		if(@$filter['skpd'] != 'ALL' && @$filter['skpd'] != '')
			$this->db->where('m_user.id_skpd', $filter['skpd']);
	}

	public function get($start, $length, $sort, $order, $filter){
		$this->_get_query($filter);
		$this->db->limit($length, $start);
		$this->db->order_by($sort, $order);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all(){
		$this->db->from('t_daftar_pembantu');
		$this->db->where('t_daftar_pembantu.hapus', '0');

		return $this->db->count_all_results();
	}

	function count_filtered($filter){
		$this->_get_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_by_id($id){
		$this->db->select('t_daftar_pembantu.*,m_skpd.nama_lengkap as nama_skpd, m_kategori_pembantu.nama as nama_kategori');
		$this->db->from('t_daftar_pembantu');
		$this->db->join('m_skpd','m_skpd.id_skpd = t_daftar_pembantu.id_skpd', 'LEFT');
		$this->db->join('m_kategori_pembantu','m_kategori_pembantu.id_kategori_pembantu = t_daftar_pembantu.id_kategori_pembantu', 'LEFT');
		$this->db->where('t_daftar_pembantu.id_daftar_pembantu', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_kategori(){
		$this->db->select('*');
		$this->db->from('m_kategori_pembantu');
		$query = $this->db->get();
        return $query->result();
	}


	public function delete($id){
		$data=array(
			'hapus' => '1',
		);
		$where = array(
			'id_daftar_pembantu' => $id,
		);
		$this->db->update('t_daftar_pembantu', $data, $where);
		return $this->db->affected_rows();
	}


	

}
