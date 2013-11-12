<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('product_m'));
	}

	// **** display data list **** // 
	
	function save(){
		$this->product_m->tag_save();
		redirect('catalog/tag', 'refresh');
	}
	function delete(){	
		$this->product_m->delete_tag_save();
		redirect('catalog/tag', 'refresh');
	}
	function delete_stock(){
		$this->product_m->delete_tag_stock();
		redirect('product/stock_view/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'refresh');
	}


}
