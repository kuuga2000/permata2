<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	public function display_all(){
		$data = array();
		$this->db->select("a.id,a.page_id,a.img,a.title,a.position,a.status,count(b.id) as count");
		$this->db->from("gallery as a");
		$this->db->join('gallery as b','a.id = b.id','left');
		$this->db->where("b.post_id",$this->uri->segment(4));
		$this->db->group_by("a.img");
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	public function get_gallery_selected(){
		$this->db->select('*');
		$this->db->from("gallery");
		$this->db->where("title !=",'');
		$this->db->where("post_id",$this->uri->segment(4));
		if($this->uri->segment(5))
		{
			$this->db->limit(6,$this->uri->segment(5));
		}
		else
		{
			$this->db->limit(6,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0)
			return $hasil->result();
		else
			return false;
	}
	function count_gallery(){
		$this->db->from('gallery');
		$this->db->where('page_id',$this->uri->segment(3));
		$this->db->where('post_id',$this->uri->segment(4));
		$this->db->where('title !=','');
		
		return $this->db->count_all_results();
	}
	function gallery_setting($id){
		$data = array();
		$this->db->select("*");
		$this->db->from('gallery_size');
		$this->db->where("id",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function save_image($nfile){
		$data = array(
			"img"			=> $nfile,
			"page_id"	=> $this->input->post("idpage"),
			"post_id"	=> $this->input->post("idpost"),
			"position"		=> 0,
			"status"		=> 1
		);
		$this->db->insert("gallery",$data);
	}
	function delete_gallery_info(){
		$this->db->where('id',$this->uri->segment(5));
		$this->db->delete('gallery'); 
		$this->session->set_flashdata('alert',"Data gallery successfully deleted");
	}
	function delete_image(){
		$this->db->where('img',$this->uri->segment(6));
		$this->db->delete('gallery'); 
		$this->session->set_flashdata('alert',"Data gallery successfully deleted");
	}
	
}
