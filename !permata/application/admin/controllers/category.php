<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model','category_m'));
	}

	// **** display data list **** // 
	
	function add()
	{
		$data['title'] = 'Add New Category';
		$data['page'] = 'catalog';
		$data['subpage'] = 'category';
		$id = '';
		$name = '';
		$parent_array = '';
		if($this->input->post("parent"))
		{
			$parent_array = explode('_',$this->input->post("parent"));
			$name = $parent_array[1];
			$id = $parent_array[0];
		}
		$level = $this->input->post("level");
		if($level)
		{ $level = $level+1; }
		if($this->input->post("parentnew")) { $data['cat_base'] = 'new_'.$this->input->post("parentnew"); $id = 'new'; }
		else if($this->input->post("parent")) { $data['cat_base'] = $this->input->post("parent"); }
		else { $data['cat_base'] = $name; }
		$data['level'] = $this->input->post("level");
			
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu4();
		$data['catlist'] = $this->category_m->category_list();
		if($id == 'new')
		{ $data['select_list'] = 'none'; $this->category_m->insert_cat(); }
		else {$data['select_list'] = $this->category_m->select_list($level,$id);}
		
		$this->load->view('category_add.php', $data);
	}
	function edit()
	{
		$data['title'] = 'Edit Category';
		$data['page'] = 'catalog';
		$data['subpage'] = 'category';
		$id = '';
		$name = '';
		$parent_array = '';
		if($this->input->post("parent"))
		{
			$parent_array = explode('_',$this->input->post("parent"));
			$name = $parent_array[1];
			$id = $parent_array[0];
		}
		$level = $this->input->post("level");
		if($level)
		{ $level = $level+1; }
		if($this->input->post("parentnew")) { $data['cat_base'] = 'new_'.$this->input->post("parentnew"); $id = 'new'; }
		else if($this->input->post("parent")) { $data['cat_base'] = $this->input->post("parent"); }
		else { $data['cat_base'] = $name; }
		$data['level'] = $this->input->post("level");
		
		$catedit = explode('_',$this->uri->segment(3));
		if(isset($catedit[2]))
		{
			$level = $catedit[2];
			$id = $catedit[3];
			$name = $catedit[1];
			$idne = $catedit[0];
			$data['level'] = $catedit[2];
			$data['cat_base'] = $idne.'_'.$name;
		}
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu4();
		$data['catlist'] = $this->category_m->category_list();
		if($id == 'new')
		{ $data['select_list'] = 'none'; $this->category_m->insert_cat(); }
		else {$data['select_list'] = $this->category_m->select_list($level,$id);}
		$data['select_cat_list'] = $this->category_m->select_cat_list();
		
		$data['records'] = $this->category_m->get_level();

		$this->load->view('category_edit.php', $data);
	}
	function save_edit(){
		$this->category_m->save_edit();
		$id = $this->input->post("idcat");
		redirect('catalog/category', 'refresh');
	}
	function category_enable(){ // use
		$this->category_m->enable_category();
		redirect('catalog/category', 'refresh');
	}	
	function cprod_enable(){ // use
		$this->category_m->enable_product_category();
		redirect('product/product_category/'.$this->uri->segment(3), 'refresh');
	}
	function category_delete() { // use
		$this->category_m->delete_category();
		redirect('catalog/category', 'refresh');
	}
	function cprod_delete(){
		$this->category_m->delete_product_category();
		redirect('product/product_category/'.$this->uri->segment(3), 'refresh');
	}
	function save_data(){ // use
		$this->category_m->save_data();
		redirect('catalog/category', 'refresh');
	}
}
