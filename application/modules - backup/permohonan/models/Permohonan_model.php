<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_kategori(){
		$this->db->select('*');
		$this->db->from('m_kategori_permohonan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_cara(){
		$this->db->select('*');
		$this->db->from('m_memperoleh_informasi');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_bentuk(){
		$this->db->select('*');
		$this->db->from('m_bentuk_informasi');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_last_no($id){
		$this->db->select('no_permohonan');
		$this->db->from('t_permohonan');
		$this->db->where('no_permohonan', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insert_permohonan($data){
		$this->db->insert('t_permohonan',$data);
		return $this->db->insert_id();
	}

	public function insert_histori_permohonan($data){
		$this->db->insert('t_histori_permohonan',$data);
		return $this->db->insert_id();
	}

	public function update_permohonan($where, $data){
		$this->db->update('t_permohonan', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_histori_permohonan($where, $data){
		$this->db->update('t_histori_permohonan', $data, $where);
		return $this->db->affected_rows();
	}

	private function _get_query($filter = array()){
		$this->db->select('t_permohonan.*, m_kategori_permohonan.nama_permohonan, m_memperoleh_informasi.nama_informasi
			');
		$this->db->from('t_permohonan');
		$this->db->join('m_kategori_permohonan','m_kategori_permohonan.id_kategori_permohonan = t_permohonan.id_kategori_permohonan','LEFT');
		$this->db->join('m_memperoleh_informasi','m_memperoleh_informasi.id_memperoleh_informasi = t_permohonan.id_memperoleh_informasi','LEFT');
		$this->db->join('m_bentuk_informasi','m_bentuk_informasi.id_bentuk = t_permohonan.bentuk_informasi','LEFT');
		// $this->db->order_by('t_permohonan.selesai_perbaikan','DESC');
		// $this->db->order_by('t_permohonan.tanggal_perbaikan','DESC');
		// $this->db->order_by('t_permohonan.status_lengkap','ASC');
		// $this->db->order_by('t_permohonan.cdd','DESC');
		// $this->db->where_not_in('m_user.username', 'egov');
		$this->db->where('t_permohonan.trash', '0');
		if(@$filter['no_permohonan'])
			$this->db->like('t_permohonan.no_permohonan', $filter['no_permohonan']);
		if(@$filter['nama'])
			$this->db->like('t_permohonan.nama_pemohon', $filter['nama']);
		if(@$filter['kategori'] != 'ALL' && @$filter['kategori'] != '')
			$this->db->where('t_permohonan.id_kategori_permohonan', $filter['kategori']);
	}

	public function get($start, $length, $sort, $order, $filter){
		$this->_get_query($filter);
		$this->db->limit($length, $start);
		$this->db->order_by($sort, $order);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all(){
		$this->db->from('t_permohonan');
		$this->db->where('t_permohonan.trash', '0');
		return $this->db->count_all_results();
	}

	function count_filtered($filter){
		$this->_get_query($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_by_id($id){
		$this->db->select('t_permohonan.*, m_kategori_permohonan.nama_permohonan, m_memperoleh_informasi.nama_informasi, m_bentuk_informasi.bentuk_informasi as informasi
			');
		$this->db->from('t_permohonan');
		$this->db->join('m_kategori_permohonan','m_kategori_permohonan.id_kategori_permohonan = t_permohonan.id_kategori_permohonan','LEFT');
		$this->db->join('m_memperoleh_informasi','m_memperoleh_informasi.id_memperoleh_informasi = t_permohonan.id_memperoleh_informasi','LEFT');
		$this->db->join('m_bentuk_informasi','m_bentuk_informasi.id_bentuk = t_permohonan.bentuk_informasi','LEFT');
		$this->db->where('t_permohonan.id_permohonan', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function send_email($recipient = '', $subject = '', $message_data = '',$file='') {//
		if (empty($recipient) || empty($subject) || empty($message_data) )
			return FALSE;
		
		switch($subject){
			case 'perbaikan': 
				$subjects = 'Perbaikan Permohonan';
			break;
			case 'gugur': 
				$subjects = 'Permohonan Ditolak';
			break;
			case 'terima': 
				$subjects = 'Permohonan Diterima';
			break;
		}

		$smtp_user = 'ppid@tangerangkota.go.id';
		$smtp_pass = 'Ppid2020!@#';

		$config = [
			'charset'      => 'utf-8',
			'protocol'     => 'ssmtp',
			'smtp_host'    => 'ssl://mail.tangerangkota.go.id',
			'smtp_user'    => $smtp_user,
			'smtp_pass'    => $smtp_pass,
			'smtp_timeout' => '30',
			'smtp_port'    => 465,
			'starttls'     => true,
			'newline'      => "\r\n",
		];

		$this->load->library('email', $config);

        // Set to, from, message, etc.
		$this->email->from($smtp_user, 'PPID Tangerang Kota');
		$this->email->to($recipient);
		$this->email->subject($subjects);
		$message = $this->load->view('template/email_confirm', $message_data, TRUE);
		$this->email->message($message);
		$this->email->attach($file);
		$this->email->set_mailtype('html');

		return $this->email->send();
	}

	public function get_all_history($id){
		$this->db->select('a.*,b.nama as nama_user');
		$this->db->select('DATE_FORMAT(a.cdd, "%d-%m-%Y %h:%i") as tanggal_proses', FALSE);
		$this->db->select('UPPER(a.status_putusan) as status_putusan');
		$this->db->from('t_histori_permohonan a');
		$this->db->join('m_user b','b.id_user = a.cby','LEFT');
		$this->db->where('id_permohonan',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_last_history($id){
		$this->db->from('t_histori_permohonan');
		$this->db->where('id_permohonan',$id);
		$this->db->order_by('id_histori', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_permohonan(){
		$this->db->select('*');
		$this->db->from('t_permohonan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_byhash($id){
        $this->db->select('*');
		$this->db->from('t_permohonan');
        $this->db->where('hash',$id);
        $query = $this->db->get();
		return $query->row();
	}

}
