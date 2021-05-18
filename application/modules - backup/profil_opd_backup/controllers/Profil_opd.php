<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_opd extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('dasar_hukum/Dasar_hukum_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		// $this->load->model('profil_opd/Profil_opd_model', 'main_model2', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
		$this->load->model('profil_opd/Profil_opd_model', 'main_model2', TRUE);
		
	}

	public function index()
	{
		$data['gambaranumum'] = $this->main_model2->get_isi('gambaran_umum');
		$data['ruanglingkup'] = $this->main_model2->get_isi('ruang_lingkup');
		// $data['struktur1'] = $this->main_model2->get_isi_struktur('struktur1');
		// $data["struktur2"] = $this->db->query("SELECT * FROM m_profil WHERE option = 'struktur'")->result();
		// var_dump($data3);
		// die();
		$data['hasil']=$this->db->query("SELECT * FROM m_profil WHERE option='gambaran_umum'")->result_array();
		// var_dump($hasil);
		// die();
		$listProfiles = $this->db->query("SELECT m_profil.*

			FROM m_profil
			    -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			    -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			    WHERE m_profil.option = 'struk_organisasi'");
			// var_dump($listProfiles);
			            	// die();

		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {

			$result = $this->db->query("SELECT * FROM m_profil WHERE option='struk_organisasi'")->result_array();
			            	// var_dump($result);
			            	// die();
			if ($result) {

				$arr = array(
					// "id_berita" => $row["id_berita"],
					// "id_kategori" => $row["id_kategori"],
					// "judul_berita" => $row["judul_berita"],
					// "isi_berita" => $this->batas($row["isi_berita"], 50),
			                    // "nama_admin"  =>  $row["nama_admin"],
			                    // "publish" => $row["publish"],
					// "tgl_jam" => $row["tgl_jam"],
					"isi" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["struktur3"] = $arrProfile;
		$data['alasan'] = $this->main_model->get_alasan();
		$this->template->render_home('profil_opd/frontend/index', $data);
	}


	public function ajax_tree2(){
		$id = $this->input->get('key');

		$hasil = $this->main_model2->get_tree_byid(htmlentities($id));
		// echo $this->db->last_query();die;
		if (!IS_AJAX) {
			$this->load->view('site/404');
		} else {
            // $this->load->view($content, $data);

			$no=1;
			// echo json_encode($hasil);die;
			foreach ($hasil as $key => $value)
			{
				$aksi1 = '
				<button class="btn btn-sm btn-primary" onclick="add_parent('.$value->id_informasi.')"> 
				<i class="fas fa-fw fa-plus-square">  </i>
				</button>
				<button class="btn btn-sm btn-info" onclick="edit_parent('.$value->id_informasi.')"> 
				<i class="fas fa-fw fa-pen-square">  </i>
				</button>
				<button class="btn btn-sm btn-danger" onclick="hapus_daftar('.$value->id_informasi.')"> 
				<i class="fas fa-fw fa-trash">  </i>
				</button>
				';
				$sub_data["aksi"] = $aksi1;
				

				
				if($value->option == 'file'){
					$value->file = '<center><a href="'.base_url().$value->file.'" target="_blank" class="btn btn-sm btn-success" > <img style="width:20px;" src="https://img.icons8.com/fluent/48/000000/file.png"/> Unduh </a></center>';
				}else if($value->option == 'link'){
					$value->file = '<center><a href="'.$value->link.'" target="_blank" class="btn btn-sm btn-success" > <img style="width:20px;" src="https://img.icons8.com/fluent/48/000000/file.png"/> Lihat </a></center>';
				}else{
					$value->file = '';
				}

				$sub_data["id"] = $value->id_informasi;
				$sub_data["number"] = $no;
				// $sub_data['state'] = $this->has_child($value->id_informasi) ? 'closed' : 'open';
				$sub_data["name"] = $value->nama;
				$sub_data["parent_id"] = $value->parent_id;
				$sub_data["deskripsi"] = $value->deskripsi;
				$sub_data["urutan"] = $value->urutan;
				$sub_data["tahun"] = $value->tahun;
				$sub_data["file"] = $value->file;
				$data[] = $sub_data;
				$no++;
			}


			echo json_encode(array_values($data));
		}
	}

}