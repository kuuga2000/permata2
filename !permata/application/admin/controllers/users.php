<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model'));
		$this->load->library('breadcrumb');
	}

	public function index()
	{
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['title'] = 'Users';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'users';
		$data['subpage'] = 'settings';
		$table = 'users';
		$data['base_url'] = base_url().'catalog/product';
		$data['total_rows'] = $this->lib->count_all($table);
		$data['per_page'] = 5; 
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['data_all'] = $this->lib->get_all($table);
		$this->pagination->initialize($data); 

		$this->load->view('users.php', $data);
	}
}
