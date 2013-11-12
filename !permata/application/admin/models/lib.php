<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function count_all($table){
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	function count_page($id){
		$this->db->from("pages,posts");
		//$this->db->where($select,$value);
		$this->db->where("posts.page_id = zpxf_pages.id");
		$this->db->where("pages.id",$id);
		return $this->db->count_all_results();
	}
	function get_all($table){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from($table);
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

	function get_selected($table,$idfield,$id){
		$data = array();

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($idfield,$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function change_enable($table,$idfield,$id,$field,$enable){ // table,id_field,id_value,edited_field,edited_value
		if($enable) { $new_enable = 0;} else { $new_enable = 1; }
		$this->db->where($idfield,$id);
		$this->db->update($table,array($field	=> $new_enable));
	}
	function search($table){
		
	}
	function get_setting($id)
	{
		$this->db->select('value');
		$this->db->from('settings');
		$this->db->where('name',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
}
