<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ir_Renja_model extends CI_Model {

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

	public function insert_jenis($data){
        $this->db->set('cby', $this->session->id_user);
		$this->db->set('cdd', date('Y-m-d H:i:s'));
		$this->db->insert('m_jenis_informasi',$data);
		return $this->db->insert_id();
	}

	public function update_jenis($where, $data){
		$this->db->set('uby', $this->session->id_user);
		$this->db->set('udd', date('Y-m-d H:i:s'));
		$this->db->update('m_jenis_informasi', $data, $where);
		return $this->db->affected_rows();
	}

	public function insert_file($data){
        $this->db->set('cby', $this->session->id_user);
		$this->db->set('cdd', date('Y-m-d H:i:s'));
		$this->db->insert('t_file_informasi',$data);
		return $this->db->insert_id();
	}

	public function insert_informasi($data){
        $this->db->set('cby', $this->session->id_user);
		$this->db->set('cdd', date('Y-m-d H:i:s'));
		$this->db->insert('c_dokumen_informasi',$data);
		return $this->db->insert_id();
	}

	public function update_informasi($where, $data){
		$this->db->set('uby', $this->session->id_user);
		$this->db->set('udd', date('Y-m-d H:i:s'));
		$this->db->update('c_dokumen_informasi', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_child_by_id_jenis($id){
		$this->db->select('*,judul as informasi, isian as deskripsi');
		$this->db->from('t_daftar_informasi');
		$this->db->where('id_jenis_informasi', $id);
		$this->db->order_by('id_informasi','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_child_by_id_informasi($id){
		$this->db->select('*');
		$this->db->from('c_dokumen_informasi');
		$this->db->where('id_informasi', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_file_by_id_informasi($id){
		$this->db->select('*');
		$this->db->from('t_file_informasi');
		$this->db->where('id_informasi', $id);
		$this->db->order_by('id_file','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_query($filter = array()){
		$this->db->select('*,jenis_informasi as informasi');
		$this->db->from('m_jenis_informasi');
        // $this->db->where_not_in('m_user.username', 'egov');
		// $this->db->where('m_user.status', 1);
		if(@$filter['username'])
			$this->db->like('m_user.username', $filter['username']);
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
		$this->db->from('m_jenis_informasi');
		return $this->db->count_all_results();
	}

	function count_filtered($filter){
		$this->_get_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_by_id($id){
		$this->db->select('*');
        $this->db->from('m_jenis_informasi');
		$this->db->where('id_jenis_informasi', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_kategori(){
		$this->db->select('*');
		$this->db->from('m_kategori_pembantu');
		$query = $this->db->get();
        return $query->result();
	}

	public function get_tree(){
		$this->db->select('*');
		$this->db->from('c_dokumen_informasi');
		$this->db->where('hapus','0');
		$result = $this->db->get()->result();
		return $result;
	}

	public function get_tree_byid($id){
		$this->db->select('*');
		$this->db->from('c_dokumen_informasi');
		if($id == '99'){
		$this->db->where('id_jenis_informasi','5');
		$this->db->where('hapus','0');
		$this->db->or_where('id_jenis_informasi','13');
		$this->db->where('hapus','0');
		}else if($id == '100'){
			$this->db->where('id_jenis_informasi','1');
			$this->db->where('hapus','0');
			$this->db->or_where('id_jenis_informasi','2');
			$this->db->where('hapus','0');	
			$this->db->or_where('id_jenis_informasi','3');
			$this->db->where('hapus','0');	
			$this->db->or_where('id_jenis_informasi','4');
			$this->db->where('hapus','0');	
		}else{
			$this->db->where('id_jenis_informasi',$id);
			$this->db->where('hapus','0');
			}
		$this->db->order_by('urutan', 'ASC');
		$result = $this->db->get()->result();
		return $result;
	}

	public function get_jenis(){
		$this->db->select('*');
		$this->db->from('m_jenis_informasi');
		$query = $this->db->get();
        return $query->result();
	}

	public function get_data_jenis($id){
		$this->db->select('*');
		$this->db->from('m_jenis_informasi');
		$this->db->where('id_jenis_informasi',$id);
		$query = $this->db->get();
		return $query->row();
	}


	public function delete($id){
		$data=array(
			'hapus' => '1',
		);
		$where = array(
			'id_informasi' => $id,
		);
		$this->db->update('c_dokumen_informasi', $data, $where);
		return $this->db->affected_rows();
	}


	

}
