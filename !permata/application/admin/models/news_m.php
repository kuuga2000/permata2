<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function get_news(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("news_parent.title as page,news.title,news.date,news.author,news.enable_publish");
		$this->db->from("news");
		$this->db->join('news_parent','news_parent.id_parent = news.id_parent','left');
		$this->db->order_by("date",'desc');
		if($page)
		{
			$this->db->limit(5,$page);
		}
		else
		{
			$this->db->limit(5,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	public function pages(){
		$page = $this->uri->segment(3);
		$this->db->select('a.id,a.alias,a.title,a.status,a.edit,a.status_lock,count(b.alias) as count');
		$this->db->from("pages as a");
		$this->db->join('pages as b','a.id = b.owner','left');
		//$this->db->where("a.status",'1');
		
		$this->db->where("a.owner",'0');
		if($page)
		{
			$this->db->limit(6,$page);
		}
		else
		{
			$this->db->limit(6,0);
		}
		$this->db->group_by("a.id");
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	function get_pages(){
		$data = array();
		$this->db->select("*");
		$this->db->from("news_parent");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_post(){
		$page = $this->uri->segment(4);
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("posts.id,posts.title,posts.tx");
		$this->db->from("pages,posts");
		$this->db->where("posts.page_id = zpxf_pages.id");
		$this->db->where("pages.id",$id);
		if($page)
		{
			$this->db->limit(6,$page);
		}
		else
		{
			$this->db->limit(6,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	public function get_pages_selected(){
		$this->db->select('*');
		$this->db->from("pages");
		$this->db->where("id",$this->uri->segment(3));
		
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	public function get_post_selected(){
		$this->db->select('*');
		$this->db->from("posts");
		$this->db->where("id",$this->uri->segment(4));
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	function save_post(){
	$alias = url_title($this->input->post("title"), '-');
	$alias_lama = url_title($this->input->post("aliaspost"), '-');
	if($alias_lama === ''){
		
			$this->db->from("posts");
			$this->db->where("alias",$alias);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	$cek = 1; } // dia pasti ada
	}
	while(@$cek)
	{
		$cek = '';
		$newalias = $alias.'_'.$i;
		$this->db->from("product");
		$this->db->where("alias",$newalias);

		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1;	}
		$i++;
	}
	if(@$newalias) $alias = $newalias;
	
		$date = new DateTime(null, new DateTimeZone('Asia/Jakarta'));
		if($this->input->post("pagesalias"))
		{
			$data = array(
					"alias"				=> strtolower($alias),
					"page_id"			=> $this->input->post("pagesalias"),
					"title"				=> $this->input->post("title"),
					"tx"				=> $this->input->post("postcontent"),
					"dt"				=> $date->format('Y-m-d\TH:i:sO'),
					"meta_title"		=> $this->input->post("metatitle"),
					"meta_keywords"		=> $this->input->post("metakeyword"),
					"meta_description"	=> $this->input->post("metadesc")
			//		"status"			=> $this->input->post("status")
			);
		}
		else
		{
			$data = array(
					"alias"				=> strtolower($alias),
					"page_id"			=> $this->input->post("newpost"),
					"title"				=> $this->input->post("title"),
					"tx"				=> $this->input->post("postcontent"),
					"dt"				=> $date->format('Y-m-d\TH:i:sO'),
					"meta_title"		=> $this->input->post("metatitle"),
					"meta_keywords"		=> $this->input->post("metakeyword"),
					"meta_description"	=> $this->input->post("metadesc")
					//"status"			=> $this->input->post("status")
			);
		}
		if($this->input->post("title"))
		{
			if($this->input->post("idpost"))
			{
				$this->db->where("id", $this->input->post('idpost'));
				$this->db->update("posts", $data);
				$this->session->set_flashdata('info',"Data post successfully changed");
				
			}
			else
			{
				$this->db->insert("posts",$data);
				$this->session->set_flashdata('success',"Data post successfully added");
			}
		}
	}
	function display_home(){
		$this->db->select('gallery.id,gallery.title,gallery.img,posts.position as pos,posts.status as edit,gallery.url');
		$this->db->from("gallery");
		$this->db->join('posts','gallery.post_id = posts.id','left');
		//$this->db->where("posts.position",1);
		$this->db->where("gallery.id",$this->uri->segment(5));
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	function home_gall_save(){

		if($this->input->post('idpost'))
		{
			if($this->input->post("caption") AND $this->input->post("url") AND $this->input->post("picture"))
			{
			$data = array(
				"title"	=> $this->input->post("caption"),
				"url"	=> $this->input->post("url"),
				"img"	=> $this->input->post("picture")
			);
			$this->db->where("id", $this->input->post('idpost'));
			$this->db->update("gallery", $data);
			}
			else
			{
				$this->session->set_flashdata('error',"Please Insert Data");
			}
		}
		else
		{
			if($this->input->post("picture"))
			{
				$data = array(
					"page_id"	=> $this->input->post("idpagesnew"),
					"post_id"	=> $this->input->post("idpostnew"),
					"title"		=> $this->input->post("caption"),
					"url"		=> $this->input->post("url"),
					"img"		=> $this->input->post("picture")
				);
				$this->db->insert("gallery", $data);
			}
			else
			{
				$data = array(
					"page_id"	=> $this->input->post("idpagesnew"),
					"post_id"	=> $this->input->post("idpostnew"),
					"title"		=> $this->input->post("caption"),
					"url"		=> $this->input->post("url")
				);
				$this->db->insert("gallery", $data);
			}
		}
		
	}
	function save_pages($nfile){
		$newalias = '';
		$cek = '';
		$i = 1;
		$alias = url_title($this->input->post("title"), '-');
		$alias_lama = url_title($this->input->post("aliaspost"), '-');

		$this->db->from("pages");
		$this->db->where("alias",$alias);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1; } // dia pasti ada
	
		while($cek)
		{
			$cek = '';
			$newalias = $alias.'-'.$i;
			$this->db->from("pages");
			$this->db->where("alias",$newalias);

			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	$cek = 1;	}
			$i++;
		}
			
		if($newalias) $alias = $newalias;
		if($nfile)
		{
			$data = array(
					"image"				=> $nfile,
				//	"alias"				=> strtolower($alias),
					"icon"				=> $this->input->post("icon"),
				//	"title"				=> $this->input->post("title"),
					"tx"				=> $this->input->post("postcontent"),
					"meta_title"		=> $this->input->post("metatitle"),
					"meta_keywords"		=> $this->input->post("metakeyword"),
					"meta_description"	=> $this->input->post("metadesc"),
					"latitude"			=> $this->input->post("latitude"),
				//	"status"			=> $this->input->post("status")
			);
		}
		else
		{
			$data = array(
				//	"alias"				=> strtolower($alias),
					"icon"				=> $this->input->post("icon"),
				//	"title"				=> $this->input->post("title"),
					"tx"				=> $this->input->post("postcontent"),
					"meta_title"		=> $this->input->post("metatitle"),
					"meta_keywords"		=> $this->input->post("metakeyword"),
					"meta_description"	=> $this->input->post("metadesc"),
					"latitude"			=> $this->input->post("latitude"),
				//	"status"			=> $this->input->post("status")
			);
		}
		/*
		if($this->input->post("ti")) 
		{ if($this->input->post("title")){	$cek = 1;} else{	$uncheck = 1;	}	}
		
		if($this->input->post("ic"))
		{	if($this->input->post("icon")){	$cek = 1;} else{	$uncheck = 1;	}	}
		
		if($this->input->post("mt"))
		{	if($this->input->post("metatitle")){	$cek = 1;} else{	$uncheck = 1;	}	}
		
		if($this->input->post("mk"))
		{	if($this->input->post("metakeyword")){	$cek = 1;} else{	$uncheck = 1;	}	}
		
		if($this->input->post("md"))
		{	if($this->input->post("metadesc")){	$cek = 1;} else{	$uncheck = 1;	}	}
		*/
		if($this->input->post("tx"))
		{	if($this->input->post("postcontent")){	$cek = 1;} else{	$uncheck = 1;	}	}
		
		if($this->input->post("lt"))
		{	if($this->input->post("latitude")){	$cek = 1;} else{	$uncheck = 1;	}	}

		if(@$uncheck)
		{
			$this->session->set_flashdata('error',"Please fill in the required data");
		}
		else
		{
			$this->db->where("id", $this->input->post('idpost'));
			$this->db->update("pages", $data);
			$this->session->set_flashdata('info',"Data pages successfully changed");
		}
	}
	function delete_post(){
		$this->db->where("id", $this->uri->segment(4));
		$this->db->delete("posts");
		$this->session->set_flashdata('alert',"Data post successfully deleted");
	}
}
