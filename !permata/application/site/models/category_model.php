<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	var $dbtable;

	function __construct() {
		parent::__construct();
		$this->dbtable 			= 'prod_category';
	}

	public function view($alias) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('alias' => $alias, 'enable' => '1'));
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function getlist() {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where('enable', '1');
		$this->db->order_by('name');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

}
