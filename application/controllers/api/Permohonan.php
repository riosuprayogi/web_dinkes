<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Permohonan extends REST_Controller{
    public function __construct()
	{
		# code...
		parent :: __construct();
		$this ->load -> model('M_permohonan');
    }
    
    //method index menampilkan data person
	// public function ambilpermohonan_get(){
	// 	$response = $this ->M_permohonan->all_permohonan();
	// 	$this ->response($response);
    // }
    

	//method untuk menambah permohonan
	public function add_post(){        
		$response =$this ->M_permohonan->add_permohonan(
            $this -> post ('nik'),
			$this -> post ('nama_pemohon'),
            $this -> post ('alamat'),
            $this -> post ('no_tlp'),
            $this -> post ('email'),
            $this -> post ('id_kategori_permohonan'),
            $this -> post ('file_ktp'),
            $this -> post ('file_ktp_kuasa'),
            $this -> post ('file_surat_kuasa'),
            $this -> post ('file_akta'),
            $this -> post ('file_pengesahan'),
            $this -> post ('file_surat_keterangan'),
            $this -> post ('rincian_informasi'),
            $this -> post ('tujuan'),
            $this -> post ('id_memperoleh_informasi'),
            $this -> post ('bentuk_informasi')
		);
		$this ->response ($response);
    }

    //ambil satu id
    public function ambilsatudata_get(){
         $id = $this ->get('hash');
         $data = $this -> M_permohonan -> getid($id); 
        // var_dump($data);
         $ambil=($data[0]);
         $idkategori = ($ambil['id_kategori_permohonan']);
         $hasc = ($ambil['hash']);
         $idpermohonan = ($ambil['id_permohonan']);
         $f_ktp = ($ambil['file_ktp']);
         $f_ktp_kuasa = ($ambil['file_ktp_kuasa']);
         $f_ktp_surat_kuasa = ($ambil['file_surat_kuasa']);
         $f_akta = ($ambil['file_akta']);
         $f_pengesahan = ($ambil['file_pengesahan']);
         $f_suratketerangan = ($ambil['file_surat_keterangan']);
        
    
         //cek status
         if($idkategori==='1'){
           if($f_ktp === null){
               $status = "tidak lengkap";
           }else {
               $status = "lengkap";
           }
         }elseif ($idkategori === '2') {
        
            if($f_ktp === null | $f_ktp_surat_kuasa===null | $f_ktp_kuasa === null){
                $status = "tidak lengkap";
            }else{
                $status = "lengkap";
            }    
         }elseif($idkategori ==='3'){
             if($f_ktp === null | $f_ktp_surat_kuasa===null | $f_ktp_kuasa === null){
                $status = "tidak lengkap";
             }else{
                $status = "lengkap";
             }
         }elseif($idkategori === '4'){
            if($f_ktp === null | $f_ktp_surat_kuasa===null | $f_ktp_kuasa===null | $f_akta===null |$f_pengesahan===null){
                $status ="tidak lengkap";
            }else{
                $status = "lengkap";
            }
         }elseif ($idkategori ==='5') {
            if($f_ktp === null|$f_ktp_surat_kuasa=== null|$f_ktp_kuasa===null|$f_akta===null|$f_suratketerangan===null){
                $status ="tidak lengkap";
            }else {
                $status = "lengkap";
            }
        }

         if($data){
         $this->set_response([
             'status' => TRUE,
             'data'   => $data,
             'id_kategori_permohonan' => $idkategori,
             'id_permohonan' => $idpermohonan,
             'status'=>$status,
             'message'=> 'Success'
              ], REST_Controller::HTTP_OK);
         }else{
         $this->set_response([
             'status' => FALSE,
             'message' => 'Not Found'
              ], REST_Controller::HTTP_NOT_FOUND);
            }
     }

     //update status
	public function update_put(){
		$response = $this -> M_permohonan-> update_permohonan(
			$this -> put('id_permohonan'),
			$this -> put('status_lengkap')
		);
		$this ->response($response);
	}
    
    //upload file
    public function uploadfile_post()
               
        {
            

                $userfilektp ='ktp';
                $userfilesuratkuasa ='surat_kuasa';
                $userfilektpkuasa ='pemberi_ktp_kuasa';
                $userfilesuratketerangan ='surat_keterangan';
                $userfileaktanotaris ='akta_notaris';
                $userfilepengesahan ='pengesahan_notaris';

                $tangkap = $this->post('jenis');
                if ($tangkap === $userfilektp ){
                    $userfile =$userfilektp;
                }elseif ($tangkap === $userfilesuratkuasa) {
                    $userfile =$userfilesuratkuasa;
                }elseif ($tangkap === $userfilektpkuasa) {
                    $userfile =$userfilektpkuasa;
                }elseif ($tangkap === $userfilesuratketerangan) {
                    $userfile =$userfilesuratketerangan;
                }elseif ($tangkap === $userfileaktanotaris) {
                    $userfile =$userfileaktanotaris;
                }elseif ($tangkap === $userfilepengesahan) {
                    $userfile =$userfilepengesahan;
                }
                
                
               
                if($userfile==='ktp'){
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/ktp/';
                    $filename = $_FILES['ktp']['name'];
                }elseif($userfile==='surat_kuasa'){
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/surat_kuasa/';
                    $filename = $_FILES['surat_kuasa']['name'];
                }elseif($userfile==='pemberi_ktp_kuasa'){
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/pemberi_ktp_kuasa/';
                    $filename = $_FILES['pemberi_ktp_kuasa']['name'];
                }elseif ($userfile==='surat_keterangan') {
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/surat_keterangan/';
                    $filename = $_FILES['surat_keterangan']['name'];
                }elseif ($userfile==='akta_notaris') {
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/akta_notaris/';
                    $filename = $_FILES['akta_notaris']['name'];
                }elseif ($userfile==='pengesahan_notaris') {
                    $uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/pengesahan_notaris/';
                    $filename = $_FILES['pengesahan_notaris']['name'];
                }
               
                if (is_dir($uploadPathKtp) === false) {
                    mkdir($uploadPathKtp, 0777, true);
                }
                
                //var_dump($filename);
                $extension = substr(strrchr($filename, '.'), 1);
                //var_dump($extension);
                $filenamenya = md5(date("YmdHms") . '_' . rand(100, 999));

                $pathnya = $uploadPathKtp . $filenamenya .'.'. $extension;

                $config['upload_path']          = $uploadPathKtp;
                $config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
                $config['max_size']             = 5120; 
                $config['file_name']  			= $filenamenya;
                $config['overwrite'] = TRUE;
              
                $this->load->library('upload', $config);
              
               
                if ($this->upload->do_upload($userfile ))
                {

                    $this->set_response([
                        'status' => TRUE,
                        'message'=> 'Success',
                        'jenis' => $userfile,
                        'path' => $pathnya,
                        'filenaem'=>$filename
                         ], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Not Found',
                         ], REST_Controller::HTTP_NOT_FOUND);
                     
                }
        }

}
