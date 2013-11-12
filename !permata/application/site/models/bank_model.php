<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model {
	
	var $dbtable;
	
	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'bank_account';
    }
	
	public function all()
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->result();
		
		return false;
	}
	
	public function find($id)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('id_bank_acc' => $id));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
}
