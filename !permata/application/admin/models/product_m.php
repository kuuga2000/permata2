<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function all(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select('product.status,product.code,product.alias,product.id_product,product.name,product.brand_name,product.hotdeal,product.enable,product_pic.thumb25,product_price.base_price,product_price.tax');
		$this->db->from('product');
		$this->db->join('product_pic','product.id_product = product_pic.id_product','left');
		$this->db->join('product_price','product.id_product = product_price.id_product','left');
		$this->db->group_by("product.alias"); 
		//order by "id_product desc" in order to be easy to find new data was inserted
		$this->db->order_by("id_product", "desc");
		//$this->db->order_by("name", "asc");
		//$this->db->get();
		//print_r($this->db->last_query());exit;

		if($page)
			{
				$this->db->limit(20,$page);
			}
			else
			{
				$this->db->limit(20,0);
			}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function search(){
		$data = array();
		$this->db->select('product.code,product.alias,product.id_product,product.name,product.brand_name,product.hotdeal,product.enable,product_pic.thumb25,product_price.base_price,product_price.tax');
		$this->db->from('product');
		$this->db->join('product_pic','product.id_product = product_pic.id_product','left');
		$this->db->join('product_price','product.id_product = product_price.id_product','left');
		$this->db->like('product.name', $this->input->post("search")); 
		$this->db->group_by("product.alias"); 
		$this->db->order_by("id_product", "desc");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	function count_like(){
		$this->db->from('product');
		$this->db->like('product.name', $this->input->post("search")); 
		return $this->db->count_all_results();
	}
	
	function product_detail(){
		$id = $this->uri->segment(3);

		$data = array();
		$this->db->select("a.*,b.id_manufacturer");
		$this->db->from("product as a");
		$this->db->join('manufacturer as b','a.brand_name = b.manuf_name','left');
		$this->db->where("a.id_product",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;
	}
	function price(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("*");
		$this->db->from("product_price");
		$this->db->where("id_product",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;
	}
	
	function get_avaiable_code(){
		$data = array();
		$this->db->from("product");
		$this->db->where("code",$this->input->post("code"));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function prod_save(){
		$status = $this->input->post('status');
		$cek = '';
		$newalias = '';
		$i = 1;
		$id	= $this->input->post("productid");
		$alias = strtolower(url_title($this->input->post("product"), '-'));		
		$alias_lama = url_title($this->input->post("alias"), '-');
		if($this->input->post("idbrand"))
		{
			$this->db->from("manufacturer");
			$this->db->where("id_manufacturer",$this->input->post("idbrand"));
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	 @$manufname = $row->manuf_name;	}
		}

		$date = explode('/',$this->input->post("date"));
		$date = @$date[2].'-'.@$date[1].'-'.@$date[0];
		$enable = $this->input->post("enable");
		if($enable) $enable = $this->input->post("enable");
		else $enable = 0;		
		
		$hotdeal = $this->input->post("hotdeal");
		if($hotdeal) $hotdeal = $this->input->post("hotdeal");
		else $hotdeal = 0;
		
		$paket = $this->input->post("paket");
		if($paket) $paket = $this->input->post("paket");
		else $paket = 0;		
		
		$promosi = $this->input->post("promosi");
		if($promosi) $promosi = $this->input->post("promosi");
		else $promosi = 0;
		
		$clear = $this->input->post("clear");
		if($clear) $clear = $this->input->post("clear");
		else $clear = 0;
		
		$new = $this->input->post("new");
		if($new) $new = $this->input->post("new");
		else $new = 0;

		$this->db->from("product");
		$this->db->where("alias",$alias);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1; } // dia pasti ada
		
		if($this->input->post("code"))
		{
			$this->db->from("product");
			$this->db->where("code",$this->input->post("code"));
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	 @$code = $row->code; @$idprod = $row->id_product;	}
		}
			
		while($cek)
		{
			$cek = '';
			$newalias = $alias.'-'.$i;
			$this->db->from("product");
			$this->db->where("alias",$newalias);

			$query = $this->db->get();
			foreach ($query->result() as $row)
			{	$cek = 1;	}
			$i++;
		}
		if($newalias) $alias = $newalias;

		if($alias_lama == $alias){
			if($this->input->post("product") AND $this->input->post("code"))
			{
			 
			$data = array(
			"name"			=> $this->input->post("product"),
			"code"			=> $this->input->post("code"),
			"deskripsi"		=> $this->input->post("description"),
			"id_manufacturer"	=> $this->input->post("idbrand"),
			"brand_name"	=> @$manufname,
			"date_release"	=> $date,
			"hotdeal"		=> $hotdeal,
			"paket"			=> $paket,
			"promotion"		=> $promosi,
			"clearance"		=> $clear,
			"new"			=> $new,
			"enable"		=> $enable,
			"status"		=> empty($status) ? 'unprocess' : 'processed'
			);
			$this->db->where("id_product", $this->input->post('id_product'));
			$this->db->update("product", $data);
			$this->session->set_flashdata('info',$this->input->post("product"). " successfully change?");
			}
			else
			{
				$this->session->set_flashdata('error',"Data you have entered is incomplete");
				
			}
		}
		else
		{

			if($this->input->post("product") AND $this->input->post("code"))
			{
				if($this->input->post('id_product'))
				{
					if(@$idprod == $this->input->post('id_product'))
					{
						 
						 
						$data = array(
						"alias"			=> $alias,
						"name"			=> $this->input->post("product"),
						"code"			=> $this->input->post("code"),
						"deskripsi"		=> $this->input->post("description"),
						"id_manufacturer"	=> $this->input->post("idbrand"),
						"brand_name"	=> @$manufname,
						"date_release"	=> $date,
						"hotdeal"		=> $hotdeal,
						"paket"			=> $paket,
						"promotion"		=> $promosi,
						"clearance"		=> $clear,
						"new"			=> $new,
						"enable"		=> $enable,
						"status"		=> empty($status) ? 'unprocess' : 'processed'
						);
						$this->db->trans_start();
						$this->db->where("id_product", $this->input->post('id_product'));
						$this->db->update("product", $data);
						$this->db->trans_complete();
						$this->session->set_flashdata('info',$this->input->post("product"). " already change");
					}
					else
					{
						$this->session->set_flashdata('error',"Code already exist");
						redirect('product/information/'.$this->input->post('id_product'), 'refresh');
					}
				}
				else
				{	
					$data = array(
					"id_product"	=> $id,
					"alias"			=> $alias,
					"name"			=> $this->input->post("product"),
					"code"			=> $this->input->post("code"),
					"deskripsi"		=> $this->input->post("description"),
					"id_manufacturer"	=> $this->input->post("idbrand"),
					"brand_name"	=> @$manufname,
					"date_release"	=> $date,
					"hotdeal"		=> $hotdeal,
					"paket"			=> $paket,
					"promotion"		=> $promosi,
					"clearance"		=> $clear,
					"new"			=> $new,
					"enable"		=> $enable,
					"status"		=> empty($status) ? 'unprocess' : 'processed'
					);
					
					if(!@$code)
					{
						$this->db->trans_start();
						$this->db->insert("product",$data);
						$this->db->trans_complete();
						
						$this->db->select("id_product");
						$this->db->from("product");
						$this->db->order_by("id_product", "asc");
						$query = $this->db->get();
						foreach ($query->result() as $row)
						$hasil = $row->id_product;
						
						$data2 = array(
						"id_product"		=> $hasil,
						"deskripsi"			=> 'General',
						"re_order"			=> 1
						);
						$this->db->insert("product_stock",$data2);
						$this->session->set_flashdata('success',$this->input->post("product")." successfully added");
					}
					else
					{
						$this->session->set_flashdata('error',"Code already exist");

						return @$code;
					}
				}
			}
			else
			{
				$this->session->set_flashdata('error',"Data you have entered is incomplete");
				redirect('product/information/'.$this->input->post('id_product'), 'refresh');
			}
		}

	}
	
	function prod_import_save($name)
	{
		$data = array(
			'value' => $name
		);
		$this->db->where(array('id'=>5, 'name'=>'import'));
		$this->db->update("zpxf_settings", $data);
		return true;
	}
	
	function save_photo($nFile,$nfile_25,$nfile_135,$nfile_347){
		$hasil = '';
		$this->db->select("position");
		$this->db->from("product_pic");
		$this->db->where("id_product",$this->input->post("id_prod"));
		$this->db->order_by("position", "desc");
		$query = $this->db->get();
		foreach ($query->result() as $row)
		$hasil = $row->position;
		
		if(!$hasil){ $position = 1; }
		else { $position = $hasil+1; }
		
		if($nFile)
		{
			$data = array(
					"photo"			=> $nFile,
					"thumb25"		=> $nfile_25,
					"thumb135"		=> $nfile_135,
					"thumb347"		=> $nfile_347,
					"id_product"	=> $this->input->post("id_prod"),
					"caption"		=> $this->input->post("caption"),
					"position"		=> $position,
					"cover"			=> ($position == 1 ? 1:0),
					"enable"		=> 1
			);
			$this->db->insert("product_pic",$data);
			$this->session->set_flashdata('success',"Image ".$nFile." successfully added");
		}
	}
	
	function photo_setting(){
		$data = array();
		$this->db->select("*");
		$this->db->from('product_pic_setting');
		$this->db->where("section", "product");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	function category_option(){
		$data = array();
		$this->db->select("*");
		$this->db->from('p_category');
		$this->db->order_by("parent", "ASC");
		$this->db->order_by("child_lv_one", "ASC");
		$this->db->order_by("child_lv_two", "ASC");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}

	function price_save(){
		$cek = '';
		$id = $this->input->post("id_prod");
		$this->db->from("product_price");
		$this->db->where("id_product",$id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1;	}
		if($cek)
		{
			$data = array(
			"whole_price"		=> $this->input->post("wholesale"),
			"base_price"		=> $this->input->post("baseprice"),
			"tax"				=> $this->input->post("tax"),
			"disc"				=> $this->input->post("disc"),
			"disc_type"			=> $this->input->post("disc_type"),
			//"actual_price"		=> $this->input->post("actualprice")
			);
			$this->db->where("id_product", $id);
			$this->db->update("product_price", $data);
			$this->session->set_flashdata('info',"Price information successfully change");
		}
		else
		{
			$data = array(
			"id_product"		=> $id,
			"whole_price"		=> $this->input->post("wholesale"),
			"base_price"		=> $this->input->post("baseprice"),
			"tax"				=> $this->input->post("tax"),
			"disc"				=> $this->input->post("disc"),
			"disc_type"			=> $this->input->post("disc_type"),
			//"actual_price"		=> $this->input->post("actualprice")
			);
			$this->db->insert("product_price",$data);
			$this->session->set_flashdata('info',"Price information successfully change");
		}
	}
	
	function display_category(){
		$data = array();
		$this->db->select("*");
		$this->db->from("product_cat");
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;
	}
	
	function get_cat(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("*");
		$this->db->from("product_cat");
		$this->db->where("id_product",$id);
		$this->db->order_by("position",'ASC');
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	function get_pic(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("product_pic.idproduct_pic,
							product_pic.id_product,
							product_pic.thumb25,
							product_pic.caption,
							product_pic.position,
							product_pic.cover,
							product_pic.enable,
							COUNT(zpxf_product_stock_pic.idprod_stock_pic)  AS countstock");
		$this->db->from("product_pic");
		$this->db->join('product_stock_pic','product_stock_pic.idproduct_pic = product_pic.idproduct_pic','left');
		$this->db->where("product_pic.id_product",$id);
		$this->db->order_by("product_pic.position", "asc");
		$this->db->group_by("product_pic.idproduct_pic");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_new_id(){
		$data = array();
		$this->db->select_max("id_product");
		$this->db->from("product");
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0)
		{	
			$data = $hasil->result(); 
		}
		return $data;
	}
	function get_qty_pic(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("product_stock.id_prod_stock,product_stock.qty,product_stock.deskripsi,product_stock.base_price as bse_price,product_stock.re_order,product_stock.tax as stax,product_price.base_price,product_price.tax");
		$this->db->from("product_stock");
		$this->db->join('product_price','product_price.id_product = product_stock.id_product','left');
		$this->db->where("product_stock.id_product",$id);
		//$this->db->group_by("color"); 
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function pic_enable(){
		$id = $this->uri->segment(3);
		$id_pic = $this->uri->segment(4);
		$dataenable = $this->uri->segment(5);
		$data = array(
			"enable"	=> $dataenable
		);
		$this->db->where("idproduct_pic", $id_pic);
		$this->db->update("product_pic", $data);
		$this->session->set_flashdata('info',"Image already change");
	}
	function pic_delete(){
		$this->db->where('idproduct_pic', $this->uri->segment(4));
		$this->db->delete('product_pic'); 
		$this->session->set_flashdata('alert',"Image already deleted");
	}
	function cover_change(){
		$idpro = '';
		$cek = '';
		$id = $this->uri->segment(3);
		$id_pic = $this->uri->segment(4);
		
		$this->db->select("idproduct_pic");
		$this->db->from("product_pic");
		$this->db->where("id_product",$id);
		$this->db->where("cover",1);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{	$cek = 1; $idpro = $row->idproduct_pic;	}
		if($cek){
			$data = array(
			"cover"	=> 1
			);
			$this->db->where("idproduct_pic", $id_pic);
			$this->db->update("product_pic", $data);
			
			$data2 = array(
			"cover"	=> 0
			);
			$this->db->where("idproduct_pic", $idpro);
			$this->db->update("product_pic", $data2);
			$this->session->set_flashdata('info',"Cover image successfully changed [disable]");
		}
		else{
			$data = array(
			"cover"	=> 1
			);
			$this->db->where("idproduct_pic", $id_pic);
			$this->db->update("product_pic", $data);
			$this->session->set_flashdata('info',"Cover image successfully changed [enable]");
		}
	}
	function tag_save(){
		$alias = url_title($this->input->post("tagname"), '-');
		$data = array(
		"tag"	=> $this->input->post("tagname"),
		"alias"	=> strtolower($alias)
		);

		if($this->input->post("alias"))
		{
			$this->db->where("alias",$this->input->post("alias"));
			$this->db->update("tag", $data);
		}
		else
		{
			$this->db->insert("tag",$data);
		}
	}
	function delete_tag_save(){
		$this->db->where("alias", $this->uri->segment(3));
		$this->db->delete("tag");
		$this->session->set_flashdata('alert',"Tag successfully deleted");
	}
	function get_tag_all(){
		$data = array();
		$this->db->select("*");
		$this->db->from("tag");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_select_tag(){
		$data = array();
		$this->db->select("*");
		$this->db->from("tag");
		$this->db->where("alias",$this->uri->segment(3));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_tag_stock_select(){
		$data = array();
		$this->db->select("*");
		$this->db->from("product_tag_stock");
		$this->db->where("id_prod_stock",$this->uri->segment(4));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function delete_tag_stock(){
		$this->db->where("id_tag_stock", $this->uri->segment(5));
		$this->db->delete("product_tag_stock");
		$this->session->set_flashdata('alert',"Tag successfully deleted");
	}
	
	function GetAutocompleteCategory($options = array())
    {
	    $this->db->select('tag');
	    $this->db->like('tag', $options['keyword'], 'after');
		$this->db->or_like('alias', $options['keyword'], 'after');
   		$query = $this->db->get('tag');
		if($query->num_rows() > 0)
			return $query->result();
		else return false;
    }
}
