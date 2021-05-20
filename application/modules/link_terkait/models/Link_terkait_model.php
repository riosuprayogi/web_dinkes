<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Link_terkait_model extends CI_Model
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
		$this->db->order_by('t_mitra.tgl_jam DESC');
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
}
