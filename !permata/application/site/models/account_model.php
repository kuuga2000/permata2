<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

	var $dbtable;
	var $dbtable_address;
	var $dbtable_newsletter;
	var $dbtable_notif;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'customer';
		$this->dbtable_address = 'customer_address';
		$this->dbtable_newsletter = 'site_newsletter';
		$this->dbtable_notif = 'customer_notif';
    }

	public function find_email($email)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('email' => $email));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}

	public function new_account($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}
	
	public function update_account($data, $email)
	{
		$this->db->trans_start();
		$this->db->where('email', $email);
		$this->db->update($this->dbtable, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}
	
	public function get_address($id)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_address);
		$this->db->where(array('id_customer' => $id));
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->result();
		
		return false;
	}
	
	public function new_address($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable_address, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}
	
	public function find_address($id, $acc)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_address);
		$this->db->where(array('id_address' => $id, 'id_customer' => $acc));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
	
	public function find_newsletter($email)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_newsletter);
		$this->db->where(array('email' => $email));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
	
	public function new_newsletter($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable_newsletter, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}
	
	public function find_notify($id, $email)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_notif);
		$this->db->where(array('email' => $email));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
	
	public function new_notify($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable_notif, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}

	public function update_balance($id_customer, $value) {
		$this->db->trans_start();
		$this->db->set("account_balance","account_balance - ".$value, false);
		$this->db->where(array('id_customer' => $id_customer));
		$this->db->update($this->dbtable);

		if($this->db->trans_complete())
			return true;
		else
			return false;
	}

	public function get_balance($email) {
		$this->db->select('account_balance');
		$this->db->from($this->dbtable);
		$this->db->where(array('email' => $email));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}
}
