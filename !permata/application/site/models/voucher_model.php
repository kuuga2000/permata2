<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {

	var $dbtable;

	function __construct() {
		parent::__construct();
		$this->dbtable 			= 'voucher';
	}

	public function check($code) {
		$this->db->select('code');
		$this->db->from($this->dbtable);
		$this->db->where(array('code' => $code, 'qty > ' => 0));
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return true;
		else
			return false;
	}

	public function getDetail($code) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where(array('code' => $code, 'qty > ' => 0));
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function useCode($code) {
		$this->db->set('qty', 'qty-1', false);
		$this->db->where('code', $code);
		if($this->db->update($this->dbtable))
			return true;
		else
			return false;
	}
}
