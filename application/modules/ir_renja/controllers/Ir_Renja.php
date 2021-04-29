<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ir_Renja extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('ir_renja/Ir_Renja_model', 'main_model', TRUE);
		$this->load->model('skpd/Skpd_model','skpd',TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		
	} 


	public function index()
	{
		if($this->input->get('key')){
			$key = $this->input->get('key',true);
			$data['key'] = htmlentities($key);
			$this->load->view('ir_renja/frontend/index', $data);
			// echo json_encode($data);
		}else{
			if(@$this->session->has_access[0]->nama_app != "Admin"){	
				$this->load->view('site/404');
			}else{
				$this->template->render('ir_renja/backend/index');
				
			}	
		}
	}

	public function data($id)
	{
		
		if(@$this->session->has_access[0]->nama_app != "Admin"){	
			$this->load->view('site/404');
		}else{
			if($id){
				$data['key'] = htmlentities($id);
				// $this->load->view('dokumen/frontend/index', $data);
				$this->template->render('ir_renja/backend/index');
			}
			
		}	
	}
	
	public function tambah_tanggal(){
		$jumlah = 16;
		echo date('Y-m-d H:i:s', strtotime(' + '.$jumlah.' day'));
	}

	public function ajax_insert(){
		$data = array(
			'id_skpd' => $this->input->post('skpd'),
			'id_kategori_pembantu' => $this->input->post('kategori'),
		);
		$where = array(
			'id_daftar_pembantu' => $this->input->post('id'),
		);
		if(!$this->input->post('id')){

			$this->main_model->insert($data);
		}else{
			$this->main_model->update($where, $data);
		}
		$this->template->ajax(array('status'=>true));
	}

	public function ajax_add(){
		$data = (object) array();
		// $data->skpd = $this->skpd->get_all();
		// $data->kategori = $this->main_model->get_all_kategori();
		$data->jenis = $this->main_model->get_jenis();
		$this->template->ajax($data);
	}

	public function ajax_cek($id){
		// echo $id;
		$cek = $this->main_model->cek_keberatan($id);
		if( $cek > 0){
			$ada = 'ada';
		}else{
			$ada = 'ga ada';
		}
		$this->template->ajax(array('status'=> $ada));
	}

	public function ajax_list(){
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$keberatan = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($keberatan as $row) {
			$row->no = $number++;
			$row->deskripsi = '';

			$row->aksi = '
				<div style="text-align:left">
					<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="add_parent('.$row->id_jenis_informasi.')" data-toggle="tooltip" title="Tambah"><i class="fas fa-fw fa-plus"></i></a>
					<a class="btn btn-xs btn-success" href="javascript:void(0)" onclick="edit_jenis('.$row->id_jenis_informasi.')" data-toggle="tooltip" title="Ubah"><i class="fas fa-fw fa-edit"></i></a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="del('.$row->id_jenis_informasi.')" data-toggle="tooltip" title="Hapus"><i class="fas fa-fw fa-trash"></i></a>
				</div>
			';
			$data[] = $row;
			$child = $this->main_model->get_child_by_id_jenis($row->id_jenis_informasi);
			$numbers = 1;
			foreach($child as $chl){
				$chl->no = '<div style="text-align:center">'.$numbers++.'</div>';
				$chl->aksi = '
					<div style="text-align:center">
						<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="file_parent('.$chl->id_informasi.')" data-toggle="tooltip" title="File"><i class="fas fa-fw fa-file"></i></a>
						<a class="btn btn-xs btn-success" href="javascript:void(0)" onclick="edit_parent('.$chl->id_informasi.')" data-toggle="tooltip" title="Ubah"><i class="fas fa-fw fa-edit"></i></a>
						<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="del('.$chl->id_informasi.')" data-toggle="tooltip" title="Hapus"><i class="fas fa-fw fa-trash"></i></a>
					</div>
				';
				
				
				$file = $this->main_model->get_file_by_id_informasi($chl->id_informasi);
				$filex = array();
				$chl->file = '';
				if($file >0){
					foreach($file as $fl){
						
						$filex[] = '<a target="_blank" href='.$fl->file.'>'.$fl->tahun.'</a>';; 
					}
					$chl->informasi = $chl->informasi.'<br> Tahun : '.implode(' / ',$filex);
					// $chl->file = '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i> ' . $chl->informasi.'<br>'.$chl->file;
				}else{
					$chl->informasi = '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i> ';
					
				}
				$data[] = $chl;
			}

		}

		$output = array(
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->main_model->count_all(),
			'recordsFiltered' => $this->main_model->count_filtered($filter),
			'data' => $data,
			'post' => $_GET,
		);

		$this->template->ajax($output);
	}


	public function ajax_tree(){

		$hasil = $this->main_model->get_tree();
		// echo json_encode($hasil);die;
		foreach ($hasil as $key => $value)
				{
					// $status = cek_status($value->id);
					// if($status == 'S')
					// {
						
					// }else{
					// 	$sub_data["text"] = '
					// 		<span> '.$value->nama.' </span>
					// 		<span style="float:right;">
					// 			<button class="btn-sm btn-primary" onclick="tambah_daftar('.$value->id.')"> 
					// 				<i class="fas fa-plus-square">  </i>
					// 			</button>
					// 			<button class="btn-sm btn-info" onclick="ubah_daftar('.$value->id.')"> 
					// 				<i class="fas fa-pen-square">  </i>
					// 			</button>
					// 		</span>
					// 	';
					// }

					// $sub_data["text"] = '
					// 		<table style="width: 97%;float: right;">
					// 		<td style="width:150px"> '.$value->nama.' </td>
					// 		<td style="width:150px">'.$value->deskripsi.'</td>
					// 		<td style="width:50px">
					// 			<button class="btn-sm btn-primary" onclick="add_parent('.$value->id_informasi.')"> 
					// 				<i class="fas fa-plus-square">  </i>
					// 			</button>
					// 			<button class="btn-sm btn-info" onclick="edit_parent('.$value->id_informasi.')"> 
					// 				<i class="fas fa-pen-square">  </i>
					// 			</button>
					// 			<button class="btn-sm btn-danger" onclick="hapus_daftar('.$value->id_informasi.')"> 
					// 				<i class="fas fa-trash">  </i>
					// 			</button>
					// 		</td></table>
					// 	';
					$aksi1 ='
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
					
					
					

					if($value->file != null ){
						$value->file = '<center><a href="'.$value->file.'" target="_blank" class="btn btn-sm btn-success" > <i class="fas fa-fw fa-download"></i> Unduh </a></center>';
					}else{
						$value->file = '';
					}

					$sub_data["id"] = $value->id_informasi;
					
					$sub_data["name"] = $value->nama;
					$sub_data["parent_id"] = $value->parent_id;
					$sub_data["deskripsi"] = $value->deskripsi;
					$sub_data["tahun"] = $value->tahun;
					$sub_data["file"] = $value->file;
					$data[] = $sub_data;
				}

				foreach($data as $key => &$value)
				{
					$output[$value["id"]] = &$value;
				}
				foreach($data as $key => &$value)
				{
					if($value["parent_id"] && isset($output[$value["parent_id"]]))
					{
						$output[$value["parent_id"]]["children"][] = &$value;
					}
				}
				foreach($data as $key => &$value)
				{
					$aksi2 ='
					<button class="btn btn-sm btn-primary" onclick="add_parent('.$value["parent_id"].')"> 
						<i class="fas fa-fw fa-plus-square">  </i>
					</button>
					 <button class="btn btn-sm btn-info" onclick="edit_parent('.$value["parent_id"].')"> 
						 <i class="fas fa-fw fa-pen-square">  </i>
					 </button>
					 
					';
					if($value["parent_id"] && isset($output[$value["parent_id"]]))
					{
						if(isset($output[$value["parent_id"]]["children"])){
							$output[$value["parent_id"]]["aksi"] = $aksi2;
						}
						unset($data[$key]);
					}

				}
				echo json_encode(array_values($data));
	}

	public function get_data_jenis($id){
		$data = $this->main_model->get_data_jenis($id);
		$this->template->ajax($data);
	}

	public function ajax_trees(){
		$id = $this->input->get('key');
			
		$hasil = $this->main_model->get_tree_byid(htmlentities($id));
		// echo $this->db->last_query();die;
		if (!IS_AJAX) {
         $this->load->view('site/404');
        } else {
            // $this->load->view($content, $data);
        
			
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
						// $sub_data['state'] = $this->has_child($value->id_informasi) ? 'closed' : 'open';
						$sub_data["name"] = $value->nama;
						$sub_data["parent_id"] = $value->parent_id;
						$sub_data["deskripsi"] = $value->deskripsi;
						$sub_data["urutan"] = $value->urutan;
						$sub_data["tahun"] = $value->tahun;
						$sub_data["file"] = $value->file;
						$data[] = $sub_data;
					}

					foreach($data as $key => &$value)
					{
						$output[$value["id"]] = &$value;
					}
					foreach($data as $key => &$value)
					{	
						// $output[$value["id"]]["state"] = 'open';
						if($value["parent_id"] && isset($output[$value["parent_id"]]))
						{
							$output[$value["parent_id"]]["children"][] = &$value;
							// $output[$value["id"]]["state"] = $this->has_child($value["id"]) ? 'closed' : 'open';
						}
					}
					// foreach($data as $key => &$value)
					// {
					// 	if($value["parent_id"] && isset($output[$value["parent_id"]]))
					// 	{
					// 		unset($data[$key]);
					// 	}

					// }
					foreach($data as $key => &$value){
						$aksi2 ='
						<button class="btn btn-sm btn-primary" onclick="add_parent('.$value["parent_id"].')"> 
							<i class="fas fa-fw fa-plus-square">  </i>
						</button>
						<button class="btn btn-sm btn-info" onclick="edit_parent('.$value["parent_id"].')"> 
							<i class="fas fa-fw fa-pen-square">  </i>
						</button>
						
						';
						if($value["parent_id"] && isset($output[$value["parent_id"]]))
						{
							if(isset($output[$value["parent_id"]]["children"])){
								$output[$value["parent_id"]]["aksi"] = $aksi2;
							}
							unset($data[$key]);
						}

					}
					echo json_encode(array_values($data));
			}
	}

		
	function has_child($id){
		// $rs = mysql_query("select count(*) from products where parentId=$id");
		$rs = $this->db->query('select count(*) from c_dokumen_informasi where parent_id='.$id.'')->result_array();
		$row = $rs;
		return $row[0] > 0 ? true : false;
	}

	public function ajax_edit($id){

		$data = $this->main_model->get_by_id($id);
		// echo $this->db->last_query();die;
		// $data->skpd = $this->skpd->get_all();
		$data->kategori = $this->main_model->get_all_kategori();
		$data->jenis = $this->main_model->get_jenis();
		$this->template->ajax($data);
	}

	public function ajax_delete(){
		$key = $this->input->get('key');
		$data = $this->main_model->delete($key);
		
		if($data){
			$this->template->ajax(array('status'=>TRUE));
		}else{
			$this->template->ajax(array('status'=>FALSE));
		}
	}

	public function ajax_edit_jenis($id){

		$data = $this->main_model->get_by_id($id);
		$this->template->ajax($data);
	}

	public function ajax_edit_parent($id){

		$data = $this->main_model->get_child_by_id_informasi($id);
		// $data->file = $this->main_model->get_file_by_id_informasi($id);
		$data->jenis = $this->main_model->get_jenis();

		$this->template->ajax($data);
	}

	public function ajax_insert_jenis(){
		$data = array(
			'jenis_informasi' => $this->input->post('jenis'),
		);
		$where = array(
			'id_jenis_informasi' => $this->input->post('id_jenis'),
		);
		if(!$this->input->post('id_jenis')){

			$this->main_model->insert_jenis($data);
		}else{
			$this->main_model->update_jenis($where, $data);
		}
		$this->template->ajax(array('status'=>true));
	}

	public function ajax_insert_parent(){
		$uploadPath = './assets/dokumen/upload/' . date("Y/m/d") . '/';
			if (is_dir($uploadPath) === false) {
				mkdir($uploadPath, 0777, true);
			}
			if ($_FILES['files']['name']) {
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['encrypt_name'] = TRUE;
				$config['file_name'] = md5(date("YmdHms") . '_' . rand(100, 999));
				$config['overwrite'] = TRUE;
				$this->load->library('upload'); 
				$this->upload->initialize($config);
				if($this->upload->do_upload("files")) {
					$files = $this->upload->data();
					// $this->resize($files);
					$file  = $uploadPath.$files['file_name'];
				} 
			}else{
				$file = $this->input->post('oldfile')?$this->input->post('oldfile') : null;
			}
		$data = array(
			'parent_id' => $this->input->post('id_parent')?$this->input->post('id_parent') : null,
			'nama' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('isian')?$this->input->post('isian') : null,
			'urutan' => $this->input->post('urutan')?$this->input->post('urutan') : null,
			'id_jenis_informasi' =>$this->input->post('jenis')?$this->input->post('jenis') : null,
			'file' =>  $file,
			'tahun' =>$this->input->post('tahun')?$this->input->post('tahun') : null,
			'link' =>$this->input->post('link')?$this->input->post('link') : null,
			'option' =>$this->input->post('option')?$this->input->post('option') : null,

		);
		$where = array(
			'id_informasi' => $this->input->post('id_informasi'),
		);

		if(!$this->input->post('id_informasi')){

			$this->main_model->insert_informasi($data);
		}else{
			$this->main_model->update_informasi($where, $data);
		}
		$this->template->ajax(array('status'=>TRUE));
		// echo json_encode($data+$where);
	}

	public function ajax_inserts(){
		$descount = count($_FILES['file']['name']);
		$uploadPath = './assets/dokumen/upload/' . date("Y/m/d") . '/';
			if (is_dir($uploadPath) === false) {
				mkdir($uploadPath, 0777, true);
			}

		if($_FILES['file']['name']){
			for($i = 0; $i < $descount; $i++){
				
				$_FILES['upload_File']['name'] = $_FILES['file']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['file']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['file']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['file']['size'][$i];
				$config['upload_path'] = $uploadPath;
				$config['file_name']  = md5(date("YmdHms").'_'.rand(100, 999));
				$config['allowed_types'] = 'pdf';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('upload_File')) {
					$fileData = $this->upload->data();

					$data = array(
						'id_informasi' => $this->input->post('id_informasi'),
						'tahun' => $this->input->post('tahun')[$i],
						'file' => $uploadPath.$fileData['file_name'],
					);
					
					$this->main_model->insert_file($data);
					// echo json_encode($data);
					
				}else{
					print_r($this->upload->display_errors());
					// $this->template->ajax(array('status' => $this->upload->display_errors()));
				}
			}

			// $this->template->ajax(array('status' => TRUE));
			
		}
			$this->template->ajax(array('status' => TRUE));
		
	}
}