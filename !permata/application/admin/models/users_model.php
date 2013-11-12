<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model {

	var $dbtable;

	public $id = null;
	public $name = '';
	public $username = '';
	public $email = '';
	public $password = '';

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'users';
    }

	public function all()
	{
		$this->db->select('*');
		$this->db->order_by('username');
		$this->db->from($this->dbtable);
		$this->db->join('zpxf_users_group', 'zpxf_users_group.alias = zpxf_users.user_group', 'left');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function find($username)
	{
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function insert($data) {
		$insert = $this->db->insert('zpxf_users', $data);
		
		if($insert) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
	}
	
	public function update($username, $data)
	{
		$this->db->where('username', $username);
		$this->db->update($this->dbtable, $data);
	}

	public function set_reset_token($user_id, $reset_token) {
		$this->db->set('reset_token', $reset_token);
		$this->db->where('id', $user_id);
		$this->db->update('zpxf_users');
	}
}
