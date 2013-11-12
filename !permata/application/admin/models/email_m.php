<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	function getuser($uname){
		$data = array();
		$this->db->select("email,firstname,lastname");
		$this->db->from("users");
		$this->db->where("username",$uname);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_newsletter_member(){
		$data = array();
		$this->db->select("email");
		$this->db->from("site_newsletter");
		$this->db->where("enable",1);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_notification_list(){
		$data = array();
		$this->db->select('a.email,b.name,c.thumb25,d.base_price,d.disc,d.disc_type');
		$this->db->from('customer_notif as a');
		$this->db->join('product as b','a.id = b.id_product','left');
		$this->db->join('product_pic as c','a.id = b.id_product','left');
		$this->db->join('product_price as d','a.id = b.id_product','left');
		$this->db->group_by('a.email'); 
		//$this->db->where('newsletter',1);

		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
}
