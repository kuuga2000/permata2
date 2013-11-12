<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model {

	var $dbtable;
	var $dbtable_faq;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'posts';
    }

	public function view($id)
	{
		$this->db->select('orderby');
		$this->db->where(array('page_id' => $id, 'status' => '1'));
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if ($q->num_rows() > 0)
		{
			$r = $q->row();
			$this->db->select('*');
			$this->db->where(array('page_id' => $id, 'status' => '1'));
			$this->db->order_by($r->orderby == 'dt' ? $r->orderby.' DESC' : $r->orderby.' ASC');
			$this->db->from($this->dbtable);
			$qu = $this->db->get();
			if ($qu->num_rows() > 0)
				return $qu->result();
		}

		return false;
	}

	public function find($id, $alias)
	{
		$this->db->select('*');
		$this->db->where(array('page_id' => $id, 'alias' => $alias, 'status' => '1'));
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function find_alias($alias)
	{
		$this->db->select('*');
		$this->db->where(array('alias' => $alias, 'status' => '1'));
		$this->db->limit(1);
		$this->db->from($this->dbtable);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function faq($id)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array($this->dbtable.'.page_id' => $id, $this->dbtable.'.status' => '1'));
		$this->db->order_by($this->dbtable.'.position');
		$qu = $this->db->get();
		if ($qu->num_rows() > 0)
			return $qu->result();
		else
			return false;
	}
}
