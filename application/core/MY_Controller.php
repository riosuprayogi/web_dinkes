<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();
		$this->load->module('template');
		$this->load->model('menu/Menu_level_model', 'menu');

		$auth = false;
		// $this->auto_login();
		if (!$this->session->id_user){
			$url =  $this->uri->uri_string();
			
			// $url1 = $this->uri->segment(1, '');
			// $url2 = $this->uri->segment(2, '');
			// $url3 = $this->uri->segment(3, '');
			// $url4 = $this->uri->segment(4, '');
			// return redirect(base_url('?next='.$url1.'/'.$url2.'/'.$url3.'/'.$url4));
			return redirect(base_url('site/login?next='.$url));
		}
		if ($this->session->menu_all) {
			foreach ($this->session->menu_all as $menu) {
				if ($menu->path == $this->uri->segment(1) || !empty($this->session->id_user)) {
					$auth = true;
					break;
				}
			}
		} 
		
		if (!$auth) return $this->template->render('my404/index');
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
