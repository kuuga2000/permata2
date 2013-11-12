<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

	function manuf_list(){
		$data = array();
		$this->db->select("*");
		$this->db->from("manufacturer");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result(); // ini bisa loop
		}
		$hasil->free_result();
		return $data;
	}
	function get_all($table){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by("manuf_name", "asc");
	/* 	if($page)
			{
				$this->db->limit(5,$page);
			}
			else
			{
				$this->db->limit(5,0);
			} */
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_manuf(){
		$id = $this->uri->segment(3);

		$data = array();
		$this->db->select("*");
		$this->db->from("manufacturer");
		$this->db->where("id_manufacturer",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row(); // ini ngga bisa loop cuma ambil 1 row saja
		}
		$hasil->free_result();
		return $data;
	}
	function search_lib(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('manufacturer');
		$this->db->like('manufacturer.manuf_name', $this->input->post("search")); 
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function manufaktur_save($nFile){
		$i = 1;
		$hasil = '';
		$cek = '';
		$newalias = '';
		$diskon = $this->input->post('diskon');
		$alias = strtolower(url_title($this->input->post("name"), '-'));	
		$alias_lama = url_title($this->input->post("alias"), '-');		
		$enable = $this->input->post("enable");
		if($enable) $enable = $this->input->post("enable");
		else $enable = 0;			
		$descenable = $this->input->post("descenable");
		if($descenable) $descenable = $this->input->post("descenable");
		else $descenable = 0;	
		
		$this->db->from("manufacturer");
		$this->db->where("alias",$alias);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1; } // dia pasti ada
		
		while($cek)
		{
			$cek = '';
			$newalias = $alias.'-'.$i;
			$this->db->from("manufacturer");
			$this->db->where("alias",$newalias);

			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	$cek = 1;	}
			$i++;
		}

		if($newalias) $alias = $newalias;
		
		if($this->input->post("name"))
		{
			if($this->input->post("id_manufacturer"))
			{
				if($nFile)
				{
					$data = array(
							"alias"				=> $alias,
							"logo"				=> $nFile,
							"manuf_name"		=> $this->input->post("name"),
							"deskripsi"			=> $this->input->post("description"),
							"meta_title"		=> $this->input->post("metatitle"),
							"meta_description"	=> $this->input->post("metadesc"),
							"meta_keyword"		=> $this->input->post("metakey"),
							"deskripsi_enable"	=> $descenable,
							"enable"			=> $enable,
							"diskon"			=> $diskon,
					);
				}
				else
				{
					$data = array(
							"alias"				=> $alias,
							"manuf_name"		=> $this->input->post("name"),
							"deskripsi"			=> $this->input->post("description"),
							"meta_title"		=> $this->input->post("metatitle"),
							"meta_description"	=> $this->input->post("metadesc"),
							"meta_keyword"		=> $this->input->post("metakey"),
							"deskripsi_enable"	=> $descenable,
							"enable"			=> $enable,
							"diskon"			=> $diskon,
					);
				}
		
				$this->db->where("id_manufacturer", $this->input->post('id_manufacturer'));
				$this->db->update("manufacturer", $data);
				$this->session->set_flashdata('info',"Data manufacturer successfully changed");
			}
			else
			{
				if($nFile)
				{
					$data = array(
							"alias"				=> $alias,
							"logo"				=> $nFile,
							"manuf_name"		=> $this->input->post("name"),
							"deskripsi"			=> $this->input->post("description"),
							"meta_title"		=> $this->input->post("metatitle"),
							"meta_description"	=> $this->input->post("metadesc"),
							"meta_keyword"		=> $this->input->post("metakey"),
							"deskripsi_enable"	=> $descenable,
							"enable"			=> 1,
							"diskon"			=> $diskon,
					);
				}
				else
				{
					$data = array(
							"alias"				=> $alias,
							"manuf_name"		=> $this->input->post("name"),
							"deskripsi"			=> $this->input->post("description"),
							"meta_title"		=> $this->input->post("metatitle"),
							"meta_description"	=> $this->input->post("metadesc"),
							"meta_keyword"		=> $this->input->post("metakey"),
							"deskripsi_enable"	=> $descenable,
							"enable"			=> 1,
							"diskon"			=> $diskon,
					);
				}
				$this->db->insert("manufacturer",$data);
				$this->session->set_flashdata('success',"Data Manufacturer successfully added");
			}
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete");
		}
	}
	function manuf_delete(){
		$s = '';
		$storesult = '';
		$id = $this->uri->segment(3);
		$this->db->select("*");
		$this->db->from("product as a");
		$this->db->join("manufacturer as b", "a.id_manufacturer = b.id_manufacturer");
		$this->db->where("b.id_manufacturer",$id);
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
			$this->db->where("id_manufacturer", $id);
			$this->db->delete("manufacturer");
			$this->session->set_flashdata('alert',"Data manufacturer successfully deleted");
		}
	}
}
