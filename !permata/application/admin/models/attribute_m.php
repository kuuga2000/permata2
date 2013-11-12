<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	function get_all(){
		$data = array();
		$this->db->select("p_attribute.id_prod_att,p_attribute.name,p_attribute.enable,count(zpxf_p_val_attr.name) as counts");
		$this->db->from("p_attribute");
		$this->db->join('p_val_attr','p_attribute.id_prod_att = p_val_attr.id_prod_att','left');
		$this->db->group_by("p_attribute.id_prod_att");
		$this->db->order_by("p_attribute.name", "asc");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_sub_all(){
		$data = array();
		$this->db->select("*");
		$this->db->from("p_val_attr");
		$this->db->where("id_prod_att",$this->uri->segment(3));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_attrlist(){
		$data = array();
		$this->db->select("p_attribute.name AS attname,p_val_attr.name AS valname,p_val_attr.idp_val_attr,p_val_attr.id_prod_att");
		$this->db->from("p_attribute");
		$this->db->join('p_val_attr','p_attribute.id_prod_att = p_val_attr.id_prod_att','left');
		$this->db->order_by("p_attribute.name", "asc");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_attr_stock(){
		$data = array();
		$this->db->select("product_val_attr.idp_val_attr,product_val_attr.id_prod_stock,p_attribute.name AS atname,product_val_attr.name AS vlname");
		$this->db->from("product_val_attr");
		$this->db->join('p_attribute','p_attribute.id_prod_att = product_val_attr.id_prod_att','left');
		$this->db->where("id_product",$this->uri->segment(3));
		$this->db->order_by("product_val_attr.id_prod_stock", "asc");
		$this->db->order_by("p_attribute.name", "asc");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_attr_check(){
		$data = array();
		$this->db->select("id_prod_stock");
		$this->db->from("product_val_attr");
		$this->db->where("id_product",$this->uri->segment(3));
		$this->db->order_by("id_prod_stock", "asc");
	//	$this->db->group_by("id_prod_stock");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function attr_save(){
		$prostock = '';
		$ada = '';
		$idproduct = $this->input->post("idproduct");
		$idprodstock = $this->input->post("idprodstock");
		if(!$idprodstock) $idprodstock = 1;

		$value_name = trim($this->input->post("value_name"));		
		$value = explode('_',$value_name);
		$id_prod_att = $value[2];
		$name = $value[1];
		// proses cek dan membentuk tabel product_stock
		$this->db->select("id_prod_stock");
		$this->db->from("product_stock");
		$this->db->where("id_product",$idproduct);
		$this->db->where("id_prod_stock",$idprodstock);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$prostock = $row->id_prod_stock;
		}
		if(!$prostock)
		{
			$this->db->set('id_prod_stock',$idprodstock);
			$this->db->set('id_product',$idproduct);
			$this->db->set('re_order',1);
			$this->db->insert("product_stock");
		}

		// proses cek dan membentuk tabel product_val_attr
		$this->db->select("*");
		$this->db->from("product_val_attr");
		$this->db->where("id_product",$idproduct);
		$this->db->where("id_prod_att",$id_prod_att);
		$this->db->where("name",$name);
		$this->db->where("id_prod_stock",$idprodstock);
		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			$ada = $row->idp_val_attr;
		}
		if(!$ada)
		{
				$this->db->set('id_product',$idproduct);
				$this->db->set('id_prod_stock',$idprodstock);
				$this->db->set('name',$name);
				$this->db->set('id_prod_att',$id_prod_att);
				$this->db->insert("product_val_attr");
		}
		else
		{
			$data = array(
			"name"	=> $name
			);
				$this->db->where("id_product", $idproduct);
				$this->db->where("id_prod_stock", $idprodstock);
				$this->db->where("id_prod_att", $id_prod_att);
				$this->db->update("product_val_attr", $data);
		}
		// sinkronisasi deskripsi pada field deskripsi pada tabel product_stock 
		$loop = 1;
		$dataloop = '';
		$datakhir = '';
		$this->db->select("product_val_attr.id_prod_att,p_attribute.name as att_name,product_val_attr.name as val_name");
		$this->db->from("product_val_attr");
		$this->db->join('p_attribute','p_attribute.id_prod_att = product_val_attr.id_prod_att','left');
		$this->db->where("id_prod_stock",$idprodstock);
		$this->db->group_by("id_prod_att");
		$query = $this->db->get();
		$name = '';
		foreach ($query->result() as $row)
		{
			$attname = $row->att_name;
			$this->db->select("name");
			$this->db->from("product_val_attr");
			$this->db->where("id_prod_att",$row->id_prod_att);
			$this->db->where("id_prod_stock",$idprodstock);
			$query = $this->db->get();
			$name = '';
			foreach ($query->result() as $row)
			{
				$valname = $row->name;
				$namearray = array($valname,$name);
				$name = implode(',',$namearray);
			}
			$strname = substr($name,0,-1);
			$hasil = $attname.' = '.$strname;
			$datavrray = array($hasil,$datakhir);
			$datakhir = implode(';',$datavrray);
		}
		$datakhir = substr($datakhir,0,-1);
		$data = array("deskripsi"	=> $datakhir);
		$this->db->where("id_prod_stock", $idprodstock);
		$this->db->where("id_product", $idproduct);
		$this->db->update("product_stock", $data);
	}
	function attr_delete(){
		$protock = '';
		$data = array(
			"idp_val_attr"			=> $this->uri->segment(5)
		);
		$this->db->delete("product_val_attr", $data);
		
		$this->db->select("id_prod_stock");
		$this->db->from("product_val_attr");
		$this->db->where("id_prod_stock",$this->uri->segment(4));
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$protock = $row->id_prod_stock;
		}
		if(!$protock)
		{
			$data = array("id_prod_stock"	=> $this->uri->segment(4));
			$this->db->delete("product_stock", $data);
		}
	}
	function add_new_attr(){
		$attrname = $this->input->post("attrname");
		$enable = $this->input->post("enable");
		$data = array(
			"name"			=> $attrname,
			"enable"		=> $enable
		);
		$this->db->insert("p_attribute",$data);
	}
	function add_new_valattr(){
		$attrname = $this->input->post("attval");
		$idval = $this->input->post("idval");
		$enable = $this->input->post("enable");
		$data = array(
			"name"			=> $attrname,
			"id_prod_att"	=> $idval
		);
		$this->db->insert("p_val_attr",$data);
	}
}
