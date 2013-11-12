<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {

	var $dbtable;

	function __construct() {
        parent::__construct();
		$this->dbtable = 'pages';
  }

	public function view($navigation) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('status' => '1', 'owner' => 0));
		$this->db->like('navigation', $navigation);
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function view_child($id) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('status' => '1', 'owner' => $id));
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function find_id($id) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('id' => $id, 'status' => '1'));
		$this->db->limit(1);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function find($alias) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('alias' => $alias, 'status' => '1'));
		$this->db->limit(1);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	public function find_template($alias) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('template' => $alias, 'status' => '1'));
		$this->db->limit(1);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
}
