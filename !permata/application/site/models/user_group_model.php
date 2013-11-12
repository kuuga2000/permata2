<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_group_model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'users_group';
    }

	public function all()
	{
		$this->db->select('*');
		$this->db->order_by('title');
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function find($id)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('id' => $id));
		$this->db->limit(1);
		$q = $this->db->get();

		if ($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
}
