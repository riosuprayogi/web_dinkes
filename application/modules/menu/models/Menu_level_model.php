<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_level_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_level($level)
    { //note: will be unused
        $this->db->select('
			m_menu.id_menu as id_menu,
			m_menu.id_parent as id_parent,
			m_menu.nama as nama,
			m_menu.path as path,
			m_menu.icon as icon
		');
        $this->db->from('t_menu_level');
        $this->db->join('m_menu', 't_menu_level.id_menu = m_menu.id_menu');
        $this->db->where('t_menu_level.id_level', $level);
        //$this->db->order_by('m_menu.id_menu','asc');
        $this->db->order_by('m_menu.index', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_app($app_id)
    { //changed with this!
        $this->db->select('
            m.id_menu,
            m.id_parent,
            m.nama,
            m.path,
            m.icon
        ');
        $this->db->from('t_menu_level l');
        $this->db->join('m_menu m', 'm.id_menu = l.id_menu');
        $this->db->where('l.app_id', $app_id);
        $this->db->order_by('m.index', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert('t_menu_level', $data);
        return $this->db->insert_id();
    }

    public function delete_by_level($id_level)
    { //note: will be unused
        $this->db->where('id_level', $id_level);
        $this->db->delete('t_menu_level');
    }

    public function delete_by_appid($id_app)
    { //changed with this!
        $this->db->where('app_id', $id_app);
        $this->db->delete('t_menu_level');
    }

    public function delete_by_menu($id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('t_menu_level');
    }


    // public function get_all(){
    //     $this->db->select('*');
    //     $this->db->from('t_menu_level');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
