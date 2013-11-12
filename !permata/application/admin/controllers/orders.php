<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model'));
	}

	// **** display data list **** // 
	
	public function index()
	{
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['title'] = 'Product';
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$table = 'product';
		$data['base_url'] = base_url().'catalog/product';
		$data['total_rows'] = $this->lib->count_all($table);
		$data['per_page'] = 5; 
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['data_all'] = $this->product_m->all();
		$this->pagination->initialize($data); 

		$this->load->view('product_.php', $data);
	}

}
