<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'settings';
    }

	public function get_value($name)
	{
		$this->db->select('value');
		$this->db->where('name', $name);
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	function newsletter_enable(){
		$this->db->where("id_newsletter", $this->uri->segment(3));
		$this->db->update("site_newsletter", array("enable"=> $this->uri->segment(4)));
		$this->session->set_flashdata('info',"Data newsletter successfully changed");
	}
	function get_newsletter(){
		$page = $this->uri->segment(3);
		$data = array();
		$this->db->select('*');
		$this->db->from('site_newsletter');
		//$this->db->where('newsletter',1);
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
	function search_newsletter(){
		$data = array();
		$this->db->select('*');
		$this->db->from('site_newsletter');
		$this->db->like('email', $this->input->post("search")); 
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function count_all(){
		$data = array();
		$this->db->select('*');
		$this->db->from('site_newsletter');
		return $this->db->count_all_results();
	}
	function get_notifications(){
		$page = $this->uri->segment(3);
		$data = array();
		$this->db->select('a.email,b.name,c.thumb25,d.base_price,d.disc,d.disc_type');
		$this->db->from('customer_notif as a');
		$this->db->join('product as b','a.id = b.id_product','left');
		$this->db->join('product_pic as c','a.id = b.id_product','left');
		$this->db->join('product_price as d','a.id = b.id_product','left');
		$this->db->group_by('a.email'); 
		//$this->db->where('newsletter',1);
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
	function count_notification(){
		$data = array();
		$this->db->select('*');
		$this->db->from('customer_notif');
		return $this->db->count_all_results();
	}
}
