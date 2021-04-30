<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foto_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function update_data($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}

	public function get_data($table)
	{
		return $this->db->get($table);
	}


	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}


	public function deleteData($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}


	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$this->db->where('trash', '0');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('t_kategori');
		$this->db->where('trash', '0');
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

	public function insert_kategori($data)
	{
		$this->db->insert('t_kategori', $data);
		return $this->db->insert_id();
	}

	public function update_album($where, $data)
	{
		// $this->db->set('uby', $this->session->id_user);
		// $this->db->set('udd', date('Y-m-d H:i:s'));
		$this->db->update('t_foto_galery', $data, $where);
		return $this->db->affected_rows();
	}

	public function insert_foto($data)
	{
		$this->db->insert('t_detail_foto_galery', $data);
		return $this->db->insert_id();
	}

	public function insert_album($data)
	{
		$this->db->set('tgl_jam', date('Y-m-d H:i:s'));
		$this->db->insert('t_foto_galery', $data);
		return $this->db->insert_id();
	}

	private function _get_query($filter = array())
	{
		$this->db->select('t_berita.*, t_kategori.nama_kategori');
		$this->db->from('t_berita');
		$this->db->join('t_kategori', 't_kategori.id_kategori = t_berita.id_kategori', 'LEFT');
		// $this->db->where('m_user.status', 1);
		$this->db->where('t_berita.trash', '0');
		$this->db->order_by('t_berita.id_berita DESC');
		if (@$filter['username'])
			$this->db->like('t_flayer.judul', $filter['username']);
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
		$this->db->from('t_kategori');
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
		$this->db->select('t_berita.*');
		$this->db->from('t_berita');
		$this->db->where('id_berita', $id);
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
