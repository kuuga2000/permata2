<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'settings';
    }

	public function get_value($name)
	{
		$this->db->select('value');
		$this->db->where('name', $name);
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
}
