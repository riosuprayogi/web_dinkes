<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flayer_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('m_kategori_permohonan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_cara()
	{
		$this->db->select('*');
		$this->db->from('m_memperoleh_informasi');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_last_no($id)
	{
		$this->db->select('no_permohonan');
		$this->db->from('t_permohonan');
		$this->db->where('no_permohonan', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insert_flayer($data)
	{
		$this->db->set('cby', $this->session->id_user);
		$this->db->set('cdd', date('Y-m-d H:i:s'));
		$this->db->insert('t_flayer', $data);
		return $this->db->insert_id();
	}

	public function update_flayer($where, $data)
	{
		$this->db->set('uby', $this->session->id_user);
		$this->db->set('udd', date('Y-m-d H:i:s'));
		$this->db->update('t_flayer', $data, $where);
		return $this->db->affected_rows();
	}

	private function _get_query($filter = array())
	{
		$this->db->select('t_flayer.*');
		$this->db->from('t_flayer');
		$this->db->where('trash', '0');
		// $this->db->where('m_user.status', 1);
		if (@$filter['username'])
			$this->db->like('t_flayer.judul', $filter['username']);
		if (@$filter['nama'])
			$this->db->like('m_user.nama', $filter['nama']);
		if (@$filter['skpd'] != 'ALL' && @$filter['skpd'] != '')
			$this->db->where('m_user.id_skpd', $filter['skpd']);
	}

	public function get($start, $length, $sort, $order, $filter)
	{
		$this->_get_query($filter);
		$this->db->limit($length, $start);
		$this->db->order_by($sort, $order);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all()
	{
		$this->db->from('t_flayer');
		$this->db->where('trash', '0');
		return $this->db->count_all_results();
	}

	function count_filtered($filter)
	{
		$this->_get_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_by_id($id)
	{
		$this->db->select('t_flayer.*');
		$this->db->from('t_flayer');
		$this->db->where('id_flayer', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_history($id)
	{
		$this->db->select('a.*,b.nama as nama_user');
		$this->db->select('DATE_FORMAT(a.cdd, "%d-%m-%Y %h:%i") as tanggal_proses', FALSE);
		$this->db->select('UPPER(a.status_putusan) as status_putusan');
		$this->db->from('t_histori_permohonan a');
		$this->db->join('m_user b', 'b.id_user = a.cby', 'LEFT');
		$this->db->where('id_permohonan', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_last_history($id)
	{
		$this->db->from('t_histori_permohonan');
		$this->db->where('id_permohonan', $id);
		$this->db->order_by('id_histori', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_byhash($id)
	{
		$this->db->select('*');
		$this->db->from('t_permohonan');
		$this->db->where('hash', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_alasan()
	{
		$this->db->select('*');
		$this->db->from('m_alasan_keberatan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tanggapan()
	{
		$this->db->select('*');
		$this->db->from('m_tanggapan');
		$query = $this->db->get();
		return $query->row();
	}
}
