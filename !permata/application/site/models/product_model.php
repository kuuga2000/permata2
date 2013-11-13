<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {

	var $dbtable;
	var $dbtable_manufacturer;
	var $dbtable_category;
	var $dbtable_cat;
	var $dbtable_stock;
	var $dbtable_price;
	var $dbtable_pic;

	function __construct() {
		parent::__construct();
		$this->dbtable 							= 'product';
		$this->dbtable_manufacturer = 'manufacturer';
		$this->dbtable_category 		= 'prod_category';
		$this->dbtable_cat 					= 'product_cat';
		$this->dbtable_stock 				= 'product_stock';
		$this->dbtable_price 				= 'product_price';
		$this->dbtable_pic 					= 'product_pic';
	}
	
	public function listByFilter($filter, $sort) {
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_manufacturer.'.alias AS `manufacturer_alias`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1'
			)
		);
		$this->db->or_like( array(
				$this->dbtable_category.'.name' => $filter, 
				$this->dbtable_manufacturer.'.manuf_name' => $filter, 
				$this->dbtable.'.name' => $filter)
			);
		
		if($sort == 'name' OR $sort == 'code')
			$this->db->order_by($this->dbtable.'.'.$sort);
		else if($sort == 'price')
			$this->db->order_by($this->dbtable_price.'.base_price * (100 - '.$this->db->dbprefix($this->dbtable_price).'.disc)/100');
		$this->db->group_by($this->dbtable.".id_product");
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function listByCategory($category, $sort,$limit='') {
		$page = $this->uri->segment(4);	
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_price.'.disc,'.
			$this->dbtable_manufacturer.'.diskon AS `diskonManufaktur`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1', 
				$this->dbtable_category.'.alias' => $category
			)
		);
		if($sort == 'name' OR $sort == 'code')
			$this->db->order_by($this->dbtable.'.'.$sort);
		else if($sort == 'price')
			$this->db->order_by($this->dbtable_price.'.base_price * (100 - '.$this->db->dbprefix($this->dbtable_price).'.disc)/100');
		$this->db->group_by($this->dbtable.".id_product");
		
		
		
		
		if($page && $limit){
			$this->db->limit($limit,$page);
		}elseif($limit){
			$this->db->limit($limit,0);
		}
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function listByManufacturer($manufacturer, $sort,$limit='') {
		
		$page = $this->uri->segment(4);
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_manufacturer.'.diskon AS diskonManufaktur'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1', 
				$this->dbtable_manufacturer.'.alias' => $manufacturer
			)
		);
		if($sort == 'name' OR $sort == 'code')
			$this->db->order_by($this->dbtable.'.'.$sort);
		else if($sort == 'price')
			$this->db->order_by($this->dbtable_price.'.base_price * (100 - '.$this->db->dbprefix($this->dbtable_price).'.disc)/100');
		$this->db->group_by($this->dbtable.".id_product");
		
		if($page && $limit){
			$this->db->limit($limit, $page);
		}else if ($limit) {
			$this->db->limit($limit, 0);
		}
		
		//echo $this->db->_compile_select();exit;
		
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function listByFeatured($featured, $sort) {
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_manufacturer.'.diskon AS `diskonManufaktur`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1', 
				$this->dbtable.'.'.$featured => '1'
			)
		);
		if($sort == 'name' OR $sort == 'code')
			$this->db->order_by($this->dbtable.'.'.$sort);
		else if($sort == 'price')
			$this->db->order_by($this->dbtable_price.'.base_price * (100 - '.$this->db->dbprefix($this->dbtable_price).'.disc)/100');
		$this->db->group_by($this->dbtable.".id_product");
		//echo $this->db->_compile_select();
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function getNameByID($id) {
		$this->db->select('name');
		$this->db->from($this->dbtable);
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1',
				$this->dbtable.'.id_product' => $id)
		);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	
	public function getDetailByList($list) {
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_price.'.tax, '.
			$this->dbtable_cat.'.id_cat, '.
			$this->dbtable_category.'.alias AS `category_alias`, '.
			$this->dbtable_stock.'.qty,'.
			$this->dbtable_manufacturer.'.diskon AS `diskonManufaktur`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1',
				$this->dbtable_manufacturer.'.enable' => '1',
				$this->dbtable_category.'.enable' => '1',
				$this->dbtable_cat.'.enable' => '1'
			)
		);
		$this->db->where_in($this->dbtable.'.id_product', $list);
		$this->db->group_by($this->dbtable.".id_product");
		//echo $this->db->_compile_select();exit; 
		
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function checkID($id) {
		$this->db->select('*');
		$this->db->from($this->dbtable);
		$this->db->where('id_product', $id);
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	public function getDetail($alias) {
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_cat.'.id_cat, '.
			$this->dbtable_category.'.alias AS `category_alias`, '.
			$this->dbtable_stock.'.qty,'.
			$this->dbtable_manufacturer.'.diskon AS `diskonManufaktur`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1',
				$this->dbtable_manufacturer.'.enable' => '1',
				$this->dbtable_category.'.enable' => '1',
				$this->dbtable_cat.'.enable' => '1',
				$this->dbtable.'.alias' => $alias
			)
		);
		//echo $this->db->_compile_select();exit;
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}
	
	public function getlist($order='', $limit = '') {
		
		//echo $page;exit;
		/*$stop=20;
		if(empty($page)){
			$start=0;$page=1;
		}else{
			$start=($page-1)*$stop;	
		}*/
		
		//echo $this->db->query("SELECT * FROM zpxf_".$this->dbtable."")->num_rows();
		
		$this->session->set_userdata('crit',$order); 
		$crit = $this->session->userdata('crit');
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_manufacturer.'.alias AS `manufacturer_alias`,'.
			$this->dbtable_manufacturer.'.diskon AS `diskonManufaktur`'
		);
		$this->db->from($this->dbtable);
		 
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1'
			)
		);
		 
		$page = $this->uri->segment(3);
		if(empty($crit)){
			$this->db->order_by($this->dbtable.'.name');
			$this->db->group_by($this->dbtable.".id_product");
		}else{
			if($this->session->userdata('crit')=='price'){
				$this->db->order_by($this->dbtable_price.'.base_price');
			}elseif($crit=='code'){
				$this->db->order_by($this->dbtable.'.code');
			}else{
				$this->db->order_by($this->dbtable.'.name');
			}
		}
		$this->db->group_by($this->dbtable.".id_product");
		
		//echo $this->db->_compile_select();exit;
		
		if($page && $limit){
			$this->db->limit($limit, $page);
		}else if ($limit) {
			$this->db->limit($limit, 0);
		}
		
		//$this->db->limit(20,80);
		 
		//$this->db->limit($stop,$start);
		//echo $this->db->_compile_select();exit;
		$q = $this->db->get();
		 
		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function getRelated($id_category, $id_product) {
		$this->db->select(
			$this->dbtable.'.*, '.
			$this->dbtable_price.'.base_price, '.
			$this->dbtable_price.'.disc, '.
			$this->dbtable_price.'.disc_type, '.
			$this->dbtable_category.'.alias AS `category_alias`'
		);
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$this->db->join($this->dbtable_cat, $this->dbtable_cat.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_category, $this->dbtable_category.'.id_category = '.$this->dbtable_cat.'.id_cat' );
		$this->db->join($this->dbtable_stock, $this->dbtable_stock.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->join($this->dbtable_price, $this->dbtable_price.'.id_product = '. $this->dbtable.'.id_product');
		$this->db->where(
			array(
				$this->dbtable.'.enable' => '1', 
				$this->dbtable_manufacturer.'.enable' => '1', 
				$this->dbtable_category.'.enable' => '1', 
				$this->dbtable_cat.'.enable' => '1',
				$this->dbtable_cat.'.id_cat' => $id_category,
				$this->dbtable.'.id_product <> ' => $id_product
			)
		);
		$this->db->group_by($this->dbtable.".id_product");
		$this->db->order_by($this->dbtable.'.name');
		
		$this->db->limit(5);
		//echo $this->db->_compile_select();exit;
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function category() {
		$this->db->select('*');
		$this->db->from($this->dbtable_category);
		$this->db->where(array('parent' => '0', 'enable' => '1'));
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function check_stock($shop_cart) {
		$total = count($shop_cart); $isvalid = 0;
		foreach($shop_cart AS $key => $val) {
			$this->db->select('*');
			$this->db->from($this->dbtable_stock);
			$this->db->where(array('qty >= ' => $val, 'id_product' => $key));
			$q = $this->db->get();
			
			if($q->num_rows() > 0)
				$isvalid++;
		}
		
		if($isvalid == $total)
			return true;
		else
			return false;
	}

	public function update_stock($shop_cart) {
		$this->db->trans_start();
		foreach($shop_cart AS $key => $val) {
			$this->db->set("qty","qty - ".$val, false);
			$this->db->where(array('id_product' => $key));
			$this->db->update($this->dbtable_stock);
		}

		if($this->db->trans_complete())
			return true;
		else
			return false;
	}

	public function getManufacturerAlias($id) {
		$this->db->select($this->dbtable_manufacturer.'.alias');
		$this->db->from($this->dbtable);
		$this->db->join($this->dbtable_manufacturer, $this->dbtable.'.id_manufacturer = '. $this->dbtable_manufacturer.'.id_manufacturer');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->row();
		else
			return false;
	}

	public function manufacturer() {
		$this->db->select('*');
		$this->db->from($this->dbtable_manufacturer);
		$this->db->where('enable','1');
		$this->db->order_by('manuf_name');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}

	public function customCategory() {
		$this->db->select('*');
		$this->db->from($this->dbtable_category);
		$this->db->where(array('parent' => '0', 'enable' => '1'));
		$this->db->order_by('position');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
	}
	
	public function pic($id_product, $limit=1) {
		$this->db->select($this->dbtable_pic.'.*');
		$this->db->from($this->dbtable_pic);
		if($limit == 1) {
			$this->db->where(array($this->dbtable_pic.'.id_product' => $id_product, $this->dbtable_pic.'.enable' => '1', $this->dbtable_pic.'.cover' => '1'));
		} else {
			$this->db->where(array($this->dbtable_pic.'.id_product' => $id_product, $this->dbtable_pic.'.enable' => '1'));
		}
		$this->db->order_by($this->dbtable_pic.'.cover DESC, '.$this->dbtable_pic.'.photo');
		$q = $this->db->get();

		if($q->num_rows() > 0)
			return $q->result();
		else
			return false;
		
	}
	
	//sorry merepotkan
	public function sumData(){
		return $this->db->query("SELECT `zpxf_product`.*,`zpxf_product_price`.`base_price`, `zpxf_product_price`.`disc`, `zpxf_product_price`.`disc_type`, `zpxf_manufacturer`.`alias` AS `manufacturer_alias` 
			FROM (`zpxf_product`) 
			JOIN `zpxf_manufacturer` ON `zpxf_product`.`id_manufacturer` = `zpxf_manufacturer`.`id_manufacturer` 
			JOIN `zpxf_product_cat` ON `zpxf_product_cat`.`id_product` = `zpxf_product`.`id_product` 
			JOIN `zpxf_prod_category` ON `zpxf_prod_category`.`id_category` = `zpxf_product_cat`.`id_cat` 
			JOIN `zpxf_product_stock` ON `zpxf_product_stock`.`id_product` = `zpxf_product`.`id_product` 
			JOIN `zpxf_product_price` ON `zpxf_product_price`.`id_product` = `zpxf_product`.`id_product` 
			WHERE `zpxf_product`.`enable` = '1' 
			AND `zpxf_manufacturer`.`enable` = '1' 
			AND `zpxf_prod_category`.`enable` = '1' 
			AND `zpxf_product_cat`.`enable` = '1' 
			GROUP BY `zpxf_product`.`id_product` 
			ORDER BY `zpxf_product`.`name`")->num_rows();
	
	}

}
