<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_opd_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    //////STRUKTUR////////////
    public function get_isi_struktur($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->result();
  }
  
  public function get_isi($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->row_array();
  }

  public function get_tree_byid($id){
    $this->db->select('*');
    $this->db->from('c_dokumen_informasi');
    if($id == '99'){
        $this->db->where('id_jenis_informasi','5');
        $this->db->where('hapus','0');
        $this->db->or_where('id_jenis_informasi','13');
        $this->db->where('hapus','0');
    }else if($id == '100'){
        $this->db->where('id_jenis_informasi','1');
        $this->db->where('hapus','0');
        $this->db->or_where('id_jenis_informasi','2');
        $this->db->where('hapus','0');  
        $this->db->or_where('id_jenis_informasi','3');
        $this->db->where('hapus','0');  
        $this->db->or_where('id_jenis_informasi','4');
        $this->db->where('hapus','0');  
    }else{
        $this->db->where('id_jenis_informasi',$id);
        $this->db->where('hapus','0');
    }
    $this->db->order_by('urutan', 'ASC');
    $result = $this->db->get()->result();
    return $result;
}





}