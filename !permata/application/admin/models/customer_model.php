<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

	var $dbtable;
	var $dbtable_item;

	function __construct() {
		parent::__construct();
		$this->dbtable 			= 'customer';
	}

	public function find($id_customer)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where('id_customer', $id_customer);
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
}
