<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi_informasi extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->model('user/User_model', '', TRUE);
		$this->load->model('menu/Menu_level_model', '', TRUE);
		$this->load->model('profil/Profil_model', 'main_model', TRUE);
		$this->load->model('berita/Berita_model', 'berita', TRUE);

		
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

		$this->load->helper('text');
		// $this->load->library('curl');
		// $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		// $json_url = 'https://tangerangkota.go.id/home/api_get_siaran/';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// // curl_setopt($ch, CURLOPT_ENCODING, '');
		// curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $result =  @$hasil['data'];

		// $json_url = 'https://tangerangkota.go.id/banner/api-banner';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $results =  @$hasil['banner'];

		// $json_url = 'https://tangerangkota.go.id/video/rest-api-widget';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $videos =  @$hasil['video'];
		

		if ($this->session->id_user == "") {
			// $this->logout();
			// $this->template->render_home('home/index');
			$data['title'] = 'PPID Kota Tangerang';
			$data['profil'] = $this->main_model->get_isi('intro');
			$data['profil_image'] = $this->main_model->get_isi_file('profil');
			$data['struktur'] = $this->main_model->get_isi_struktur('struktur');
			$data['visi'] = $this->main_model->get_isi_file('visi');
			$data['kepwal'] = $this->main_model->get_isi_file('kepwal');
			$data['maklumat'] = $this->main_model->get_isi_file('maklumat');
			$data['kontak'] =$this->main_model->get_kontak();
			$data['image'] = $this->main_model->get_banner();
			// $data['latest_news'] = $result;
			$data['siaran'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_siaran/');
			// $data['banner'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_banner/');
			
			// $data['banner'] = $this->site->get_curl('https://tangerangkota.go.id/banner/api-banner/');
			// $data['berita2'] = $this->berita->get_isi_berita();
			$data['berita'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_berita/');
			
			$data['video_tng'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_video_tng/');
			$data['video_humas'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_video_humas/');

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

// ================= Galeri

			$listProfiles = $this->db->query("SELECT t_foto_galery.*, t_detail_foto_galery.*

				FROM t_foto_galery 
				JOIN t_detail_foto_galery ON t_foto_galery.id_galery = t_detail_foto_galery.id_foto_galery
			                                        -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			                                        WHERE t_foto_galery.status = 'show' AND trash='0'  ORDER BY tgl_jam DESC LIMIT 4");
			// var_dump($listProfiles);
			            	// die();

			$arrProfile = [];
			$arr = [];
			foreach ($listProfiles->result_array() as $key => $row) {

				$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_detail_foto_galery WHERE id_foto_galery=" . $row['id_foto_galery'] . "")->result_array();
			            	// var_dump($result);
			            	// die();
				if ($result) {

					$arr = array(
						"id_foto_galery" => $row["id_foto_galery"],
			                    // "kategori_artikel" => $row["kategori_artikel"],
						"nama_album" => $row["nama_album"],
			                    // "isi_berita" => $row["isi_berita"],
			                    // "nama_admin"  =>  $row["nama_admin"],
			                    // "publish" => $row["publish"],
						"tgl_jam" => $row["tgl_jam"],
						"path_detail_foto" => $result
					);
					array_push($arrProfile, $arr);
				}
			}

			$data["galeri3"] = $arrProfile;
			// var_dump($dataa);
			// die();

// ================= Akhir Galeri


 // $data7["videoBerita"] = $this->db->query("SELECT * FROM t_video WHERE id_video = '18' AND status = 'show' ")->result();
   // Query Untuk Video;
			$data["video_dinkes"] = $this->db->query("SELECT * FROM t_video WHERE status = 'show' AND trash='0' ORDER BY tgl_jam DESC LIMIT 4")->result();

// var_dump($data7);
// die();
/*echo "<pre>";
print_r($data);
echo "<pre>";
die();*/

			// json_decode($)
			// echo json_encode($data);
			// $this->load->view('ppid/ppid_kota/core', $data);

$this->template->render_home('Dokumentasi_informasi/home',$data);

} else {

	$this->template->render('site/index');
}
}


public function detail($id, $id2)
{
    	// ============== isi berita
	$data['foto'] = $this->db->query("SELECT t_berita.*, t_foto_berita.*
		FROM t_berita
		JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
		WHERE t_berita.id_berita = '$id' AND t_berita.status = 'show'")->result();

	$data["detailBerita"] = $this->db->query("SELECT * FROM t_berita WHERE  status = 'show'")->result();
// ============== akhir isi berita



	$listProfiles2 = $this->db->query("SELECT t_berita.* 

		FROM t_berita 
			                                        -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			                                        -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			                                        WHERE t_berita.status = 'show' AND trash='0' AND id_kategori = $id2   ORDER BY tgl_jam DESC LIMIT 4");
			// var_dump($listProfiles2);
			            	// die();

	$arrProfile2 = [];
	$arr2 = [];
	foreach ($listProfiles2->result_array() as $key => $row) {

		$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_foto_berita WHERE id_berita=" . $row['id_berita'] . "")->result_array();
			            	// var_dump($result);
			            	// die();
		if ($result) {

			$arr2 = array(
				"id_berita" => $row["id_berita"],
			                    // "id_kategori" => $row["id_kategori"],
				"judul_berita" => $row["judul_berita"],
				"isi_berita" => $row["isi_berita"],
				"id_kategori"  =>  $row["id_kategori"],
			                    // "publish" => $row["publish"],
				"tgl_jam" => $row["tgl_jam"],
				"path_foto_artikel" => $result
			);
			array_push($arrProfile2, $arr2);

		}
	}

	$data["berita4"] = $arrProfile2;
	// var_dump($data4);
	// die();
        // var_dump($data);
        // die();
	$data['title'] = "Detail Artikel";
	$this->template->render_home('site/detail',$data);
        // $data ['detailFeatured'] = $this->crudBaznas->getById($id);
        // $data ['image'] = $this->crudBaznas->imgById($id);
        // $this->load->view('templates_users/header', $data);
        // $this->load->view('templates_users/navbar');
        // $this->load->view('users/detailBerita', $data);
        // $this->load->view('templates_users/footer');
}

public function login() {
	if ($this->session->id_user)
		redirect(base_url());
	$redirect = '/';
	if ($this->input->get('next'))
		$redirect = '?next='.$this->input->get('next');
	$data['action'] = site_url('site/check'.$redirect);
	$this->load->view('login', $data);
}


public function logout() {
	$this->session->sess_destroy();
		// redirect(base_url());
	$redirect = '/';
	$data['action'] = site_url('site/check'.$redirect);
	$this->load->view('login', $data);
}


public function check() {
	$username = $this->input->post('username');
	$password = $this->input->post('password');


	switch (strtoupper($username)) {
		case 'EGOV':
		case 'SUPERADMIN':
		case 'ENTRY':
		case 'REGUSER':
		case 'SARKES':
		$user = (array) $this->User_model->get_by_username2($username, false);
		if ($user) {

			$user['has_access'] = [];
			$user['app_id'] = null;
			$user['app_name'] = null;
			$user['app_lname'] = null;
			$user['app_access'] = null;
			$user['app_module'] = null;
			$user['app_scheme'] = null;
			$access = (array) $this->User_model->get_access($user['id_user']);
			if ($access) {
				$user['has_access'] = $access;
				if (count($access) == 1) {
					$user['app_id'] = $access[0]->app_id;
					$user['app_name'] = $access[0]->short_name;
					$user['app_lname'] = $access[0]->long_name;
					$user['app_access'] = $access[0]->access;
					$user['app_module'] = $access[0]->nama_app;
					$user['app_scheme'] = $access[0]->scheme;
							//create menu
					$menu = $this->Menu_level_model->get_by_app($access[0]->app_id);
					$user['menu'] = $this->buildtree($menu);
					$user['menu_all'] = $menu;
				}
			}
			$this->session->set_userdata($user);
			$this->User_model->update_login($username);

		} else
		$this->session->set_flashdata('pesan','Username atau Password Salah');
		break;

		default:
		$user = (array) $this->User_model->get_by_username2($username);

		if ($user) {
			$rest_u = 'r35t51kd4';
			$rest_p = '5ksnpcua5x6z79yk5xgbtkg89a4zdwc8ym7p2f4z';
			$this->load->library('curl');
			$this->curl->http_login($rest_u, $rest_p);
			$this->curl->create('http://opendatav2.tangerangkota.go.id/services/auth/login/uid/'.$username.'/pid/'.$password.'/format/json');
			$result = json_decode($this->curl->execute(), true);
					// echo json_encode($result);die;
			if ($result) {
				$user['has_access'] = [];
				$user['app_id'] = null; 
				$user['app_name'] = null;
				$user['app_lname'] = null;
				$user['app_access'] = null;
				$user['app_module'] = null;
				$user['app_scheme'] = null;
				$access = (array) $this->User_model->get_access($user['id_user']);
				if ($access) {
					$user['has_access'] = $access;
					if (count($access) == 1) {
						$user['app_id'] = $access[0]->app_id;
						$user['app_name'] = $access[0]->short_name;
						$user['app_lname'] = $access[0]->long_name;
						$user['app_access'] = $access[0]->access;
						$user['app_module'] = $access[0]->nama_app;
						$user['app_scheme'] = $access[0]->scheme;
								//create menu
						$menu = $this->Menu_level_model->get_by_app($access[0]->app_id);
						$user['menu'] = $this->buildtree($menu);
						$user['menu_all'] = $menu;
					}
				}					
				$this->session->set_userdata($user);
				$this->User_model->update_login($username);
			} else{
				$this->session->set_flashdata('pesan','Username atau Password Salah');
			}
		} else{
			$this->session->set_flashdata('pesan','NIP Tidak terdaftar');
			$redirect = '/site/login';
			redirect(base_url($redirect));
			die();
		}
		break;
	}

	$redirect = '/';
	if ($this->input->get('next'))
		$redirect = $this->input->get('next');
	if (!$this->session->app_id)
		$redirect = 'switcher';
	redirect(base_url($redirect));


}

private function buildtree($src_arr, $id_parent = 0, $tree = array()){
	$data = array();
	foreach($src_arr as $idx => $row){
		if($row->id_parent == $id_parent){
			foreach($row as $k => $v){
				$tree[$k] = $v;
			}
			unset($src_arr[$idx]);
			$tree['children'] = $this->buildtree($src_arr, $row->id_menu);
			$data[] = $tree;
		}
	}
	return $data;
}

public function notfound_404(){
	$this->load->view('404');
}
}
