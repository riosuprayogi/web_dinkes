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

  



}