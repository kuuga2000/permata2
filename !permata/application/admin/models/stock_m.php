<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function get_stock_view(){
		$id = $this->uri->segment(4);
		$data = array();
		$this->db->select("product_stock.id_prod_stock,
							product_stock.qty,
							product_stock.deskripsi,
							product_stock.base_price as bas_price,
							product_stock.tax as etax,
							product_stock.disc as edisc,
							product_stock.disc_type as edisc_type,
							
							product_stock.re_order,
							product_price.base_price,
							product_price.tax,
							product_price.disc
							"); // remove product_price.actual_price and product_stock.actual_price as act_price,
		$this->db->from("product_stock");
		$this->db->join('product_price','product_price.id_product = product_stock.id_product','left');
		$this->db->where("id_prod_stock",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_stock_pic(){
		$idpic = $this->uri->segment(3);
		$idstock = $this->uri->segment(4);
		$data = array();
		$this->db->select("product_pic.thumb25,product_pic.idproduct_pic,
							product_pic.cover,product_stock_pic.id_prod_stock");
		$this->db->from("product_pic");
		$this->db->join('product_stock_pic','product_pic.idproduct_pic = product_stock_pic.idproduct_pic','left');
		$this->db->where("product_pic.id_product",$idpic);
		
				$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function stock_info_save(){
		$id_stock = $this->input->post("id_prod_stock");
		$id_prod = $this->input->post("id_product");
		$baseprice = $this->input->post("baseprice");
		$tax = $this->input->post("tax");
		$disc = $this->input->post("disc");
		$actual_price = $this->input->post("actual_price");
		
		
		$data = array(
			"base_price"	=> $baseprice,
			"tax"			=> $tax,
			"disc"			=> $disc,
			//"actual_price"	=> $actual_price
		);
		$this->db->where("id_prod_stock",$id_stock);
		$this->db->update("product_stock", $data);
		$this->session->set_flashdata('info',"Stock information successfully changed");

		if($this->input->post("tag") != NULL)
		{
			$tag = $this->input->post("tag");
			$tag = explode('_',$tag);
			$data = array(

				"id_product"		=> $id_prod,
				"id_prod_stock"		=> $id_stock,
				"alias"		=> @$tag[0],
				"tag"		=> @$tag[1]
				);
			$this->db->insert("product_tag_stock",$data);
			
		}
		
		$this->db->select("*");
		$this->db->from("product_pic");
		$this->db->where("id_product",$id_prod);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$ada = '';
			$covercheck = 'cover_'.$row->idproduct_pic;
			$captcheck = 'name_prod_'.$row->idproduct_pic;
			$id_stock = $this->input->post($covercheck);
			$name_stock = $this->input->post($captcheck);
			$idprodpic = $row->idproduct_pic;
			//echo ' idproduct = '.$id_prod.' idprodpic = '.$row->idproduct_pic.' prodpic = '.$name_stock.' stat = '.$id_stock;
			
			$this->db->select("idprod_stock_pic");
			$this->db->from("product_stock_pic");
			$this->db->where("id_product",$id_prod);
			$this->db->where("idproduct_pic",$row->idproduct_pic);
			$this->db->where("id_prod_stock",$name_stock);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$ada = $row->idprod_stock_pic;
			}
			if(!$ada)
			{
				$data = array(
					"id_product"		=> $id_prod,
					"idproduct_pic"		=> $row->idproduct_pic,
					"id_prod_stock"		=> $name_stock
					);
				$this->db->insert("product_stock_pic",$data);
			}
			if(!$id_stock)
			{
				$this->db->where('id_product', $id_prod);
				$this->db->where('idproduct_pic', $idprodpic);
				$this->db->where('id_prod_stock', $name_stock);
				$this->db->delete('product_stock_pic'); 
			}
			$idprodpic = '';
		}
	}
	function stock_save(){
		$cek = '';
		$id = $this->input->post("id_prod");
		$id_prod = $this->input->post("id_prod_stock");
		$stock = $this->input->post("stock");
		
		$this->db->from("product_stock");
		$this->db->where("id_product",$id);
		$this->db->where("id_prod_stock",$id_prod);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$cek = 1;
		}
		if($cek)
		{
			$data = array(
			"qty"		=> $stock
			);
			$this->db->where("id_product", $id);
			$this->db->where("id_prod_stock",$id_prod);
			$this->db->update("product_stock", $data);
			
			
			$this->session->set_flashdata('info',"Stock Quantity successfully changed");
		}
		else
		{
			$data = array(
			"id_product"		=> $id,
			"id_prod_stock"		=> $id_prod,
			"qty"				=> $stock
			);
			$this->db->insert("product_stock",$data);
			$this->session->set_flashdata('info',"Stock Quantity successfully changed");
		}
	}
	function get_stock_info($id){
		$data = array();
		$this->db->select("product_stock.id_prod_stock,
							product_stock.qty,
							product_stock.base_price as bas_price,
							product_stock.disc as edisc,
							product_stock.disc_type as edisc_type,
							product.name,
							product.code,
							product.deskripsi,
							customer_notif.email
							"); 
		$this->db->from("product_stock");
		$this->db->join('product','product_stock.id_product = product.id_product','left');
		$this->db->join('customer_notif','product_stock.id_product = customer_notif.id_product','left');
		$this->db->where("id_prod_stock",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function delete_notif($id){
		$this->db->where('email',$id);
		$this->db->delete('customer_notif'); 
	}
}
