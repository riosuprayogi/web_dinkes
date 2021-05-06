<?php
class Template extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}
	public function render($view = null, $data = null) {
		$data['content'] = $view;
		$this->load->view('template/template', $data);
	}
	public function ajax($response = '', $content_type = 'application/json') {
		$this->output->set_content_type($content_type);
		$this->output->set_output(json_encode($response));
	}

	public function render_home($view = null, $data = null) {
		$this->load->model('profil/Profil_model', 'profil', TRUE);
		$data['content'] = $view;
		$data['kontak'] = $this->profil->get_kontak();
		$this->load->view('template/template_home', $data);
	}


}