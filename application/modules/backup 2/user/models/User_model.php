<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	private function _get_query($filter = array()){
		$this->db->select('
			m_user.id_user as id_user,
			m_user.username as username,
			m_user.nama as nama,
			m_user.login as login,
			m_user.nama_unor as nama_unor,
			m_user.last_login as last_login,
			m_user.id_skpd as id_skpd,
			m_skpd.kode as kode_skpd,
			m_skpd.nama_lengkap as skpd
			');
		$this->db->from('m_user');
		$this->db->join('m_skpd','m_skpd.id_skpd = m_user.id_skpd','LEFT');
		$this->db->where_not_in('m_user.username', 'egov');
		$this->db->where('m_user.status', 1);
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

	public function get_all(){
		$this->db->select('
			m_user.id_user as id_user,
			m_user.username as username,
			m_user.nama as nama,
			m_user.login as login,
			m_user.last_login as last_login,
			m_user.id_skpd as id_skpd,
			m_skpd.kode as kode_skpd,
			m_skpd.nama_lengkap as skpd
			');
		$this->db->from('m_user');
		$this->db->join('m_skpd','m_skpd.id_skpd = m_user.id_skpd','LEFT');
		$this->db->where('m_user.status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($id){
		$this->db->select('
			u.id_user,
			u.kode_unor,
			u.username,
			u.nama,
			u.login,
			u.last_login,
			u.nama_unor,
			u.id_skpd,
			s.kode as kode_skpd,
			s.nama_lengkap as skpd
		');
		$this->db->from('m_user u');
		$this->db->join('m_skpd s', 's.id_skpd = u.id_skpd', 'LEFT');
		$this->db->where('u.id_user', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id_skpd($id_skpd){
		$this->db->select('
			m_user.id_user as id_user,
			m_user.username as username,
			m_user.nama as nama,
			m_user.login as login,
			m_user.last_login as last_login,
			m_user.id_skpd as id_skpd,
			m_skpd.kode as kode_skpd,
			m_skpd.nama_lengkap as skpd
			');
		$this->db->from('m_user');
		$this->db->join('m_skpd','m_skpd.id_skpd = m_user.id_skpd','LEFT');
		$this->db->where('m_user.id_skpd',$id_skpd);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_username($username='', $skip_pass=true) {
		if (!$username) return FALSE;
		$this->db->select('
			m_user.id_user as id_user,
			m_user.username as username,
			m_user.nama as nama,
			m_user.kode_unor as kode_unor,
			m_user.login as login,
			m_user.last_login as last_login,
			m_user.id_skpd as id_skpd,
			m_skpd.kode as kode_skpd,
			m_skpd.nama_lengkap as skpd,
			m_skpd.nama_singkat as skpd_singkat
			');
		$this->db->join('m_skpd','m_skpd.id_skpd = m_user.id_skpd','LEFT');
		$this->db->where('m_user.username',$username);
		$this->db->where('m_user.status', 1);
		if (!$skip_pass)
			$this->db->where('m_user.password', md5($this->input->post('password')));
		$query = $this->db->get('m_user');
		return $query->row();
	}
	public function get_by_username2($username='', $skip_pass=true) {
		if (!$username) return FALSE;
		$this->db->select('
			u.id_user,
			u.username,
			u.nama,
			u.kode_unor,
			u.login,
			u.last_login,
			u.id_skpd,
			s.kode as kode_skpd,
			s.nama_lengkap as skpd,
			s.nama_singkat as skpd_singkat
			');
		$this->db->join('m_skpd s','s.id_skpd = u.id_skpd','LEFT');
		$this->db->where('u.username',$username);
		$this->db->where('u.status', 1);
		if (!$skip_pass)
			$this->db->where('u.password', md5($this->input->post('password')));
		$query = $this->db->get('m_user u');
		return $query->row();
	}

	public function get_access($user_id='',$app_id=null,$access=null) {
		if (!$user_id) return FALSE;
		$this->db->select('app_id,access,nama_app,short_name,long_name,icon,scheme');
		$this->db->join('m_app', 'id_app = app_id');
		$this->db->where(['user_id' => $user_id, 'status' => 1]);
		if ($app_id)
			$this->db->where('app_id', $app_id);
		if ($access)
			$this->db->where('access', $access);
		$query = $this->db->get('t_app');
		if ($app_id)
			return $query->row();
		else
			return $query->result();
	}

	public function count_all(){
		$this->db->from('m_user');
		$this->db->where('status', 1);
		return $this->db->count_all_results();
	}

	function count_filtered($filter){
		$this->_get_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function insert($data){
		$this->db->set('status', '1');
		$this->db->insert('m_user', $data);
		return $this->db->insert_id();
	}

	public function insert_roles($data){
		return $this->db->insert('t_app', $data);
	}

	public function delete_roles_by_userid($id){
		$this->db->where('user_id', $id);
		return $this->db->delete('t_app');
	}

	public function update($where, $data){
		$this->db->update('m_user', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id){
		$this->db->where('id_user', $id);
		$deleted = $this->db->delete('m_user');
		if ($deleted)
			$this->delete_roles_by_userid($id);
	}

	public function update_login($username) {
		$this->db->set('login', 'login + 1', FALSE);
		$this->db->set('last_login', 'current_login', FALSE);
		$this->db->set('current_login', 'NOW()', FALSE);
		$this->db->where('username', $username);
		$this->db->update('m_user');
	}

	public function cek_user($username){
		$this->db->from('m_user');
		$this->db->where('username', $username);
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}