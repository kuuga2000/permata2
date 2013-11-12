<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Group_Model extends CI_Model {

	var $dbtable;

	public $id = null;
	public $name = '';
	public $username = '';
	public $email = '';
	public $password = '';

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'zpxf_users_group';
    }

	public function all()
	{
		$this->db->select('*');
		$this->db->order_by('name');
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function find($alias)
	{
		$this->db->select('*');
		$this->db->where('alias', $alias);
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
}
