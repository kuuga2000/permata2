<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {

	var $dbtable;
	var $dbtable_item;

	function __construct() {
		parent::__construct();
		$this->dbtable 			= 'order';
		$this->dbtable_item = 'order_item';
	}

	public function new_order($data, $data_item)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable, $data);
		foreach($data_item AS $key => $val ) {
			$this->db->insert($this->dbtable_item, $val);
		}
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}

	public function new_item($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable_item, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}

	public function confirm_payment($invoice_number, $data)
	{
		$this->db->trans_start();
		$this->db->set($data);
		$this->db->where(array('invoice_number' => $invoice_number));
		$this->db->update($this->dbtable);
		if ($this->db->trans_complete())
			return true;
		
		return false;
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

	public function getList($id_customer)
	{
		$this->db->select('*, date AS `order_date`');
		$this->db->from($this->dbtable);
		$this->db->where('id_customer', $id_customer);
		$this->db->order_by('date', 'desc');
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->result();
		
		return false;
	}

	public function getDetailList($invoice_number)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_item);
		$this->db->where('invoice_number', $invoice_number);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->result();
		
		return false;
	}
}
