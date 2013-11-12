<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

	var $dbtable;
	var $dbtable_item;

	function __construct() {
		parent::__construct();
		$this->dbtable 			= 'order';
		$this->dbtable_item = 'order_item';
	}

	public function find($invoice_number)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where('invoice_number', $invoice_number);
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
}
