<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta_model extends CI_Model {

	var $dbtable_page;
	var $dbtable_post;

	function __construct()
    {
        parent::__construct();
		$this->dbtable_page = 'pages';
		$this->dbtable_post = 'posts';
    }

	public function get_meta_tags_page($value, $page)
	{
		$this->db->select($value);
		$this->db->from($this->dbtable_page);
		$this->db->where(array('alias' => $page));
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row()->$value;
		else
			return false;
	}

	public function get_meta_tags_post($value, $post)
	{
		$this->db->select($value);
		$this->db->from($this->dbtable_post);
		$this->db->where(array('alias' => $post));
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row()->$value;
		else
			return false;
	}
}
