<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_server extends REST_Controller {

    public function __construct()
	{
		# code...
        parent :: __construct();
        $this->ci =& get_instance(); 
        $this->ci->load->library('session'); 
        // $this->load->library('session');
		$this ->load -> model('M_permohonan');
    }

    public function index()
    {
        $this->load->helper('url');

        $this->load->view('rest_server');
    }
}
