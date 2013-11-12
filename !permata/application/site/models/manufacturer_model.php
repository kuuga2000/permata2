<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer_model extends CI_Model {

	var $dbtable;

	function __construct() {
		parent::__construct();
		$this->dbtable 							= 'manufacturer';
	}

	public function view($alias) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('alias' => $alias, 'enable' => '1'));
		$this->db->order_by('manuf_name');
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
		$this->db->order_by('manuf_name');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function getAlias($id) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('id_manufacturer' => $id, 'enable' => '1'));
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

}
