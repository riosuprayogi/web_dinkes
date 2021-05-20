<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    //////KONTAK////////

    public function get_kontak(){
      $this->db->select('*');
      $this->db->from('m_kontak');
      $query = $this->db->get();
      return $query->row_array();
    }

    public function insert_kontak($data){
      $this->db->insert('m_kontak', $data);
      return $this->db->insert_id();
    }

    public function update_kontak($where, $data){
      $this->db->update('m_kontak', $data, $where);
      return $this->db->affected_rows();
    }

    public function cek_kontak($id){
      $this->db->select('*');
      $this->db->from('m_kontak');
      $this->db->where('id_kontak', $id);
      $query = $this->db->get();
      return $query->num_rows();
    }


    ////////////////////////PROFIL///////

    public function get_isi($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->row_array();
    }

    public function get_isi_file($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->result();
    }

    public function insert($data){
      $this->db->insert('m_profil', $data);
		  return $this->db->insert_id();
    }

    public function update($where, $data){
      $this->db->update('m_profil', $data, $where);
      return $this->db->affected_rows();
    }

    public function cek_isi($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->num_rows();
    }


    //////STRUKTUR////////////
    public function get_isi_struktur($option){
      $this->db->select('*');
      $this->db->from('m_profil');
      $this->db->where('option', $option);
      $query = $this->db->get();
      return $query->result();
    }

    public function delete_by_isi($id){
      $this->db->delete('m_profil', array('isi' => $id));
    }


    ////////BAnner////////
    public function get_banner(){
      $this->db->select('*');
      $this->db->from('c_banner');
      $query = $this->db->get();
      return $query->result();
    }


    public function insert_banner($data){
      $this->db->set('cby', $this->session->id_user);
		  $this->db->set('cdd', date('Y-m-d H:i:s'));
      $this->db->insert('c_banner', $data);
		  return $this->db->insert_id();
    }

}