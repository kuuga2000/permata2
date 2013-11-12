<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	function category_option(){
		$data = array();
		$this->db->select("*");
		$this->db->from('p_category');
		$this->db->order_by("parent", "ASC");
		$this->db->order_by("child_lv_one", "ASC");
		$this->db->order_by("child_lv_two", "ASC");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function category_list(){
		$data = array();
		$i = 1;
		$piece = '';
		$wordnumber = 0;

		$this->db->select_max("level");
		$this->db->from("prod_category");
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$max = $row->level;
		}
		if(@$max != NULL)
		{
			$fielselect = '';
			if($max){
				for($c=1;$c<=$max;$c++){
				$arrayselect = 't'.$c.'.name as lev'.$c;
				$idarrayselect = 't'.$c.'.id_category as idlev'.$c;
				$fielselect = $fielselect.','.$arrayselect.','.$idarrayselect;
				}
				$fieldt = substr($fielselect, 1).',t1.enable'; 
			}
			$this->db->select(@$fieldt);
			$this->db->from('prod_category AS t1');
			$this->db->join('prod_category AS t2','t2.parent = t1.id_category','left');
			$this->db->join('prod_category AS t3','t3.parent = t2.id_category','left');
			$this->db->join('prod_category AS t4','t4.parent = t3.id_category','left');
			$this->db->where("t1.level",1);

			$hasil = $this->db->get();
			if($hasil->num_rows() >0)
			{	
				$data = $hasil->result();
			}
			$hasil->free_result();
			return $data;
		}
	}
	function select_list($level,$id){
		if(!$level) $level = 1;
		$data = array();
		$this->db->select("*");
		$this->db->from("prod_category");
		$this->db->where("level",$level);
		if($id){ $this->db->where("parent",$id); }
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function insert_cat(){
		$newname = $this->input->post("parentnew");
		$newparent = $this->input->post("idcat");
		$newlevel = $this->input->post("level");
		
		$this->db->select("id_category");
		$this->db->from("prod_category");
		$this->db->order_by("id_category",'ASC');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{ $idpro = $row->id_category;}

		if(!$newparent){ $newparent = $idpro;}
		if($newlevel == 1){ $newparent = 0;}
		$data = array(
			"id_category"	=> $idpro,
			"name"			=> $newname,
			"parent"		=> $newparent,
			"level"			=> $newlevel,
			"enable"		=> 1
		);
		$this->db->insert("prod_category",$data);
		$this->session->set_flashdata('info',"Category successfully added ??");
	}
	function save_data(){ // use

		$this->db->from("prod_category");
		$this->db->where("name",$this->input->post("catname"));
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{ $cek = 1; }
		if(@$cek)
		{
			$this->session->set_flashdata('error',"This data already exist");
		}
		else
		{
			if($this->input->post("catname"))
			{
				if($this->input->post("catid"))
				{
					$data = array(
					"alias"		=> strtolower(url_title($this->input->post("catname"), '-')),		
					"name"		=> $this->input->post("catname")
					);
					$this->db->where("id_category",$this->input->post("catid"));
					$this->db->update("prod_category", $data);
					$this->session->set_flashdata('alert',"Data category successfully changed");
				}
				else
				{
					$data = array(
						"alias"		=> strtolower(url_title($this->input->post("catname"), '-')),		
						"name"		=> $this->input->post("catname"),
						"parent"	=> 0,
						"level"		=> 1,
						"enable"	=> 1
					);
					$this->db->insert("prod_category",$data);
					$this->session->set_flashdata('success',"Data category successfully added");
				}
			}
			else
			{
				$this->session->set_flashdata('error',"Data category is empty");
			}
		}
	}
	function select_cat_list(){
		$data = array();
		$id = $this->uri->segment(3);
		$this->db->select("level");
		$this->db->from("prod_category");
		$this->db->where("id_category",$id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$max = $row->level;
		}
		$fielselect = '';
		if($max){
			for($c=1;$c<=$max;$c++){
			$arrayselect = 't'.$c.'.name as lev'.$c;
			$idarrayselect = 't'.$c.'.id_category as idlev'.$c;
			$pararrayselect = 't'.$c.'.parent as parlev'.$c;
			$fielselect = $fielselect.','.$arrayselect.','.$idarrayselect.','.$pararrayselect;
			}
			$fieldt = substr($fielselect, 1); 
		}
		$this->db->select($fieldt);
		$this->db->from('prod_category AS t1');
		if($max >= 2){ $this->db->join('prod_category AS t2','t2.parent = t1.id_category','left'); }
		if($max >= 3){ $this->db->join('prod_category AS t3','t3.parent = t2.id_category','left'); }
		if($max >= 4){ $this->db->join('prod_category AS t4','t4.parent = t3.id_category','left'); }
		$this->db->where("t".$max.".id_category",$this->uri->segment(3));
		
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	function get_level(){
		$data = array();
		$this->db->select_max("level");
		$this->db->from("prod_category");
		$this->db->where("id_category",$this->uri->segment(3));
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;;
	}
	/*
	function save_edit(){
		$idcat = $this->input->post("idcat");
		$newname = $this->input->post("newname");
		
		$this->db->where("id_category",$idcat);
		$this->db->update("prod_category", array("name"	=> $newname));
	}
	*/
	function enable_category(){ // use
		$this->db->where("id_category",$this->uri->segment(3));
		$this->db->update("prod_category", array("enable"	=> $this->uri->segment(4)));
		$this->session->set_flashdata('info',"Data category successfully changed");
	}
	function enable_product_category(){ // use
		$this->db->where("id_prod_cat",$this->uri->segment(4));
		$this->db->update("product_cat", array("enable"	=> $this->uri->segment(5)));
		$this->session->set_flashdata('info',"Data category successfully changed");
	}
	function delete_category(){ // use
		$s = '';
		$storesult = '';
		$id = $this->uri->segment(3);
		$this->db->select("c.name");
		$this->db->from("product_cat as a");
		$this->db->join("prod_category as b", "a.id_cat = b.id_category");
		$this->db->join("product as c", "a.id_product = c.id_product");
		$this->db->where("b.id_category",$id);
		$hasil = $this->db->get();
		foreach($hasil->result() as $h)
		{
			$s = $h->name;
			$storesult = $storesult.'<li>'.$h->name.'</li>';
		}
		if($s)
		{ $this->session->set_flashdata('stop','<h4>Data manufacturer still in use on other product</h4><br>'.@$storesult); }
		else
		{
	
			$this->db->where("id_category",$id);
			$this->db->delete("prod_category");
			$this->session->set_flashdata('alert',"Data category successfully deleted");
		}
	}
	function delete_product_category(){ // use
		$this->db->where("id_product",$this->uri->segment(3));
		$this->db->where("id_prod_cat",$this->uri->segment(4));
		$this->db->delete("product_cat");
		$this->session->set_flashdata('alert',"Data category product successfully deleted");
	}
	function cat_save(){ // use
		$cek = '';
		$category_name = explode('_',$this->input->post("category_name"));
		$id_cat = $category_name[0];
		$idprod = $category_name[2];
		$name_cat = $category_name[1];
		$this->db->from("product_cat");
		$this->db->where("id_cat",$id_cat);
		$this->db->where("id_product",$idprod);
		$this->db->where("cat_name",$name_cat);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{ $cek = 1;}

		if($cek)
		{
			$this->session->set_flashdata('error',"Data category product is already exist");
		}
		else
		{
			$this->db->select("position");
			$this->db->from("product_cat");
			$this->db->order_by("position",'ASC');
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{ $position = $row->position;}
			
			if(@$position) { $position = $position + 1; } else { $position = 1; }
			
			$data = array(
			"id_product"	=> $this->input->post("id_product"),
			"id_cat"		=> $id_cat,
			"cat_name"		=> $name_cat,
			"position"		=> $position,
			"enable"		=> 1,
			);
			$this->db->insert("product_cat",$data);
			$this->session->set_flashdata('success',"Data category product successfully added");
		}
	}
}
