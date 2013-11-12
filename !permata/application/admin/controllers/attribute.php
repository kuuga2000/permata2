<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('attribute_m'));
	}
		
	function save(){
		$this->attribute_m->add_new_attr();
		redirect('catalog/attribute/', 'refresh');
	}
	function save_val(){
		$id = $this->input->post("idval");
		$this->attribute_m->add_new_valattr();
		redirect('catalog/attribute/'.$id, 'refresh');
	}
}
