<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	var $dbtable;
	var $dbtable_category;
	var $dbtable_size;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'gallery';
		$this->dbtable_size = 'gallery_size';
		$this->dbtablepost = 'posts';
    }

	public function view($page_id)
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('page_id' => $page_id, 'status' => '1'));
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function viewByPost($alias)
	{
		$this->db->select($this->dbtable.'.*, ', $this->dbtable_size.'.width AS `width`, ', $this->dbtable_size.'.height AS `height`');
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_size, $this->dbtable_size.'.id = '.$this->dbtable.'.size_id');
		$this->db->join($this->dbtablepost, $this->dbtablepost.'.id = '.$this->dbtable.'.post_id', 'left');
		$this->db->where(array($this->dbtablepost.'.alias' => $alias, $this->dbtable.'.status' => '1', $this->dbtable.'.title <>' => ''));
		$this->db->order_by($this->dbtable.'.position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
}
