<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('pages_model');
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$hal = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		//$data['subpages'] = $this->pages_model->all();
		
		if ($this->auth->signed_in())
			$this->load->view('home.php', $data);
		else
			$this->load->view('login.php');

	}
	function new_order()
	{
		$this->load->model('pages_model');
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$hal = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		//$data['subpages'] = $this->pages_model->all();
		if($this->uri->segment(2) == 'new_order')
		{
		}
		
		if ($this->auth->signed_in())
			$this->load->view('home.php', $data);
		else
			$this->load->view('login.php');

	}
	
	public function logout()
	{
		$this->auth->sign_out();
		$this->load->view('login.php');
	}
}
