<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reward_model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'reward_list';
		$this->dbtable_setting = 'reward_setting';
		$this->dbtable_customer = 'customer';
    }

	public function find_reward_value($total)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable_setting);
		$this->db->where(array('value <= ' => $total, 'enable' => 1));
		$this->db->order_by('value', 'desc');
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}

	public function insert_reward_list($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}

	public function find_code($code)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('code' => $code, 'used' => 0));
		$this->db->limit(1);
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
			return $q->row();
		
		return false;
	}

	public function add_balance($id, $data, $email)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update($this->dbtable, array('used' => 1));
		$this->db->where('email', $email);
		$this->db->update($this->dbtable_customer, $data);
		if ($this->db->trans_complete())
			return true;
		
		return false;
	}
}
