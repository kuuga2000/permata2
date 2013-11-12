<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	var $dbtable;
	var $dbtable_ug;

	public $id = null;
	public $username = '';
	public $email = '';

	public function __construct()
    {
        parent::__construct();
		$this->dbtable = 'users';
		$this->dbtable_ug = 'users_group';
    }

	public function all($offset = '', $limit = '')
	{
		$this->db->select('*, '.$this->dbtable.'.id AS `uid`, '.$this->dbtable_ug.'.id AS `gid`');
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_ug, $this->dbtable_ug.'.id = '.$this->dbtable.'.user_group_id', 'left');

		if ($this->session->userdata('sess_orderby'))
		{
			$arr = array('username', 'email', 'name', 'user_group');
			if (in_array($this->session->userdata('sess_orderby'), $arr))
			{
				if ($this->session->userdata('sess_orderby') == 'name')
				{
					$this->db->order_by($this->dbtable.'.firstname', $this->session->userdata('sess_orderdir'));
					$this->db->order_by($this->dbtable.'.lastname', $this->session->userdata('sess_orderdir'));
				}
				else if ($this->session->userdata('sess_orderby') == 'user_group')
					$this->db->order_by($this->dbtable_ug.'.title', $this->session->userdata('sess_orderdir'));
				else
					$this->db->order_by($this->dbtable.'.'.$this->session->userdata('sess_orderby'), $this->session->userdata('sess_orderdir'));
			}
			else
				$this->db->order_by($this->dbtable.'.username');
		}
		else
			$this->db->order_by($this->dbtable.'.username');

		if ($limit)
			$this->db->limit($limit, $offset);

		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function rows()
	{
		$this->db->select('id');
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->num_rows();
		else
			return false;
	}

	public function find($username)
	{
		$this->db->select('*, '.$this->dbtable.'.id AS `uid`');
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_ug, $this->dbtable_ug.'.id = '.$this->dbtable.'.user_group_id', 'left');
		$this->db->where(array($this->dbtable.'.username' => $username));
		$this->db->limit(1);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function insert($data)
	{
		$this->db->trans_start();
		$this->db->insert($this->dbtable, $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
			return false;
		else
			return true;
	}

	public function update($username, $data)
	{
		$this->db->trans_start();
		$this->db->where('username', $username);
		$this->db->update($this->dbtable, $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
			return false;
		else
			return true;
	}

	/* public function set_reset_token($user_id, $reset_token)
	{
		$this->db->set('reset_token', $reset_token);
		$this->db->where('id', $user_id);
		$this->db->update('users');
	} */
}
