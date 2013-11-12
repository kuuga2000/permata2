<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
	}

	public function index()
	{
		$this->load->model('pages_model');
		$data['title'] = 'Report';
		$data['page'] = 'report';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();

		$this->load->view('pages.php', $data);
	}
}
