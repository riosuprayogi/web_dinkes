<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class diklat extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('dasar_hukum/Dasar_hukum_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
		
	}

	public function batas($string, $length){
		if(strlen($string)<=($length)){
			return $string;
		} else {
			$cetak = substr($string,0,$length). '...';
			return $cetak;
		}
	}



	public function index()

	{
		// ================= berita

		$listProfiles = $this->db->query("SELECT t_berita.*

			FROM t_berita 
			    -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			    -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			    WHERE t_berita.status = 'show' AND trash='0'  ORDER BY tgl_jam DESC LIMIT 4");
			// var_dump($listProfiles);
			            	// die();

		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {

			$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_foto_berita WHERE id_berita=" . $row['id_berita'] . "")->result_array();
			            	// var_dump($result);
			            	// die();
			if ($result) {

				$arr = array(
					"id_berita" => $row["id_berita"],
					"id_kategori" => $row["id_kategori"],
					"judul_berita" => $row["judul_berita"],
					"isi_berita" => $this->batas($row["isi_berita"], 50),
			                    // "nama_admin"  =>  $row["nama_admin"],
			                    // "publish" => $row["publish"],
					"tgl_jam" => $row["tgl_jam"],
					"path_foto_artikel" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["berita3"] = $arrProfile;
			// var_dump($datae);
			// die();


// ================= akhir berita
		$data['alasan'] = $this->main_model->get_alasan();
		$this->template->render_home('diklat/frontend/index',$data);
	}
}