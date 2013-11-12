<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Model extends CI_Model {

	var $dbtable;

	function __construct()
    {
        parent::__construct();
		$this->dbtable = 'pages';
    }

	public function menu(){
		$data = array();
		$this->db->select("*");
		$this->db->from("menus");
		$this->db->where("level",0);
		$this->db->where("enable",1);
		$this->db->order_by("position", "ASC");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	public function submenu()
	{
		$this->db->select('b.alias,b.name');
		$this->db->from("menus as a");
		$this->db->join('menus as b','a.id = b.owner','left');
		$this->db->where("a.alias",$this->uri->segment(2));
		$this->db->where("b.enable",'1');
		$this->db->order_by("b.position", "ASC");
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	public function submenu2()
	{
		$this->db->select('b.alias,b.name');
		$this->db->from("menus as a");
		$this->db->join('menus as b','a.id = b.owner','left');
		$this->db->where("a.alias",$this->uri->segment(1));
		$this->db->where("b.enable",'1');
		$this->db->order_by("b.position", "ASC");
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	public function pages(){
		$this->db->select('a.id,a.alias,a.title,a.status,a.edit,count(b.alias) as count');
		$this->db->from("pages as a");
		$this->db->join('pages as b','a.id = b.owner','left');
		//$this->db->where("a.status",'1');
		
		$this->db->where("a.owner",'0');
		$this->db->group_by("a.id");
		$q = $this->db->get();
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function all()
	{
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->order_by('name');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function breadcrumb(){
		$max = '';
		if($this->uri->segment(2))
		{
			$take = $this->uri->segment(2);
			$this->db->select("level");
			$this->db->from("menus");
			$this->db->where("alias",$take);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$max = $row->level;
			}
		}
		else
		{
			$take = $this->uri->segment(1);
		}
		if($max)
		{
		$fielselect = '';
		for($c=1;$c<=$max;$c++){
		$arrayselect = 't'.$c.'.name as cru'.$c;
		$levelselect = 't'.$c.'.level as level';
		$fielselect = $fielselect.','.$arrayselect;
		}
		//$fieldt = substr($fielselect, 1); 
		$fieldt = $fielselect.','.$levelselect;
		$this->db->select($fieldt);
		$this->db->from('menus AS t1');
		if($max == 0)
		{
			$this->db->where("t1.alias",$take);
		}
		else if($max == 1)
		{
			$this->db->join('menus AS t2','t1.id = t2.owner','left');
			$this->db->where("t2.alias",$take);
		}
		else
		{
			$this->db->join('menus AS t2','t1.id = t2.owner','left');
			$this->db->join('menus AS t3','t2.id = t3.owner','left');
			$this->db->where("t3.alias",$take);
		}
		
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
		}
		
	}
}
