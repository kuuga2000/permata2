<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'menus';
    }

	public function all()
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->order_by('position');
		$q = $this->db->get();

		if ($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function find($alias)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('alias' => $alias));
		$this->db->limit(1);
		$q = $this->db->get();

		if ($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
}
