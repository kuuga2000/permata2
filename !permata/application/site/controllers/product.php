<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('manufacturer_model');
		$this -> load -> model('category_model');
		$this -> load -> model('lib');
		$this -> load -> library('pagination');
	}

	/*public function order($order=''){

	 }*/

	public function index($order = '') {
		//error_reporting(0);
		
		//$array = array('100','000');
		//echo implode($array,'.');

		//$pages = isset($_GET['page']) ? $_GET['page'] : '';
		//$data['pageto'] = $page;

		$data['page'] = 'product';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array( array("url" => base_url(), "label" => "HOME"), array("url" => base_url('product'), "label" => "Product"));
		$data['type'] = '';
		$data['selected_type'] = '';

		$limit = 20;
		$sort = $this -> input -> post('sort');
		if ($sort) {
			//echo "dsfdsfsdf";exit;
			$this -> session -> set_userdata('sort', $sort);
		}
		$data['sortby'] = $this -> session -> userdata('sort');
		$data['product_list'] = $this -> product_model -> getlist($this -> session -> userdata('sort'), $limit);
		//$data['sumData']				= $this->product_model->sumData();
		//$data['totalPage']				= ceil($this->product_model->sumData()/20);
		$table = "product";
		$config['base_url'] = base_url() . 'product/page';
		$config['total_rows'] = count($this -> product_model -> getlist($this -> session -> userdata('sort')));
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = $limit;
		$this -> pagination -> initialize($config);

		$data['manufacturer_list'] = $this -> manufacturer_model -> getlist($order);
		$data['category_list'] = $this -> category_model -> getlist();
		$data['featured_list'] = array();

		foreach (array('sale', 'paket', 'promotion', 'clearance', 'new') AS $key => $val) {
			$feat = new stdClass();
			$feat -> alias = $val;
			$feat -> title = ucwords($val);
			$feat -> id = '';
			array_push($data['featured_list'], $feat);
		}
		$this -> load -> view('products.php', $data);
	}

	public function search() {
		if (!$_POST)
			redirect();

		$filter = $this -> input -> post('search-input');
		if (!$filter)
			redirect();

		$sort = $this -> input -> post('sort');
		if ($sort)
			$this -> session -> set_userdata('sort', $sort);

		$data['sortby'] = $this -> session -> userdata('sort');
		$data['product_list'] = $this -> product_model -> listByFilter($filter, $data['sortby']);

		$data['page'] = 'product';
		$data['page_detail'] = '';
		$data['key'] = $filter;
		$data['breadcrumb'] = array( array("url" => base_url(), "label" => "HOME"), array("url" => base_url('product'), "label" => "Product"), array("url" => '', "label" => "Search"));
		$data['type'] = '';
		$data['selected_type'] = '';

		$this -> load -> view('search.php', $data);
	}

	public function page() {
		// mfc = manufacturer or featured or category
		//$segment_1 = $thi->uri->segment(1);
		$type = $this -> uri -> segment(2);
		$mfc = $this -> uri -> segment(3);
		//echo $this->uri->segment(4);
		$label = '';

		if (!in_array($type, array('manufacturer', 'category', 'featured'))) {
			redirect();
		}
		$sort = $this -> input -> post('sort');
		if ($sort)
			$this -> session -> set_userdata('sort', $sort);

		//echo $sort; exit;
		$data['sortby'] = $this -> session -> userdata('sort');

		if ($type == 'manufacturer') {
			
			if (!$mfc_detail = $this -> manufacturer_model -> view($mfc))
				redirect();
			else {
					
				$limit = 20;
				
				$data['product_list'] = $this -> product_model -> listByManufacturer($mfc, $data['sortby'],$limit);
				
				
				
				
				$config['base_url'] = base_url() . 'products/'.$type.'/'.$mfc;
				$config['total_rows'] = count($this -> product_model -> listByManufacturer($mfc,$data['sortby']));
				//echo count($this -> product_model -> listByCategory($mfc,$data['sortby']));
				$config['uri_segment'] = 4;
				$config['use_page_numbers'] = TRUE;
				$config['per_page'] = $limit;
				$this -> pagination -> initialize($config);
				
				
				
				$label = $mfc_detail -> manuf_name;
				$data['url_con'] = 'manufacturer/' . $mfc . '/';
			}
		}

		if ($type == 'category') {
			if (!$mfc_detail = $this -> category_model -> view($mfc))
				redirect();
			else {
				//echo $this->uri->segment(3);
				$limit = 20;
				$data['product_list'] = $this -> product_model -> listByCategory($mfc, $data['sortby'], $limit);

				$config['base_url'] = base_url() . 'products/'.$type.'/'.$mfc;
				$config['total_rows'] = count($this -> product_model -> listByCategory($mfc,$data['sortby']));
				//echo count($this -> product_model -> listByCategory($mfc,$data['sortby']));
				
				$config['uri_segment'] = 4;
				$config['use_page_numbers'] = TRUE;
				$config['per_page'] = $limit;
				$this -> pagination -> initialize($config);

				$label = $mfc_detail -> name;
				$data['url_con'] = 'category/' . $mfc . '/';
				
			}
		}

		if ($type == 'featured') {
			if (!in_array($mfc, array('sale', 'paket', 'promotion', 'clearance', 'new')))
				redirect();
			else {
				$mfc_detail = new stdClass();
				$mfc_detail -> alias = $mfc;
				$mfc_detail -> title = ucwords($mfc);
				$mfc_detail -> id = '';

				$data['product_list'] = $this -> product_model -> listByFeatured(($mfc == 'sale' ? 'hotdeal' : $mfc), $data['sortby']);
				$label = $mfc_detail -> title;
				$data['url_con'] = 'featured/' . $mfc . '/';
			}
		}

		$data['page'] = 'product';
		$data['page_detail'] = $mfc_detail;
		$data['breadcrumb'] = array( array("url" => base_url(), "label" => "HOME"), array("url" => base_url('product'), "label" => "Product"), array("url" => base_url('product/' . $mfc), "label" => $label));
		$data['type'] = $type;
		$data['selected_type'] = $mfc;

		$data['manufacturer_list'] = $this -> manufacturer_model -> getlist();
		$data['category_list'] = $this -> category_model -> getlist();
		$data['featured_list'] = array();

		foreach (array('sale', 'paket', 'promotion', 'clearance', 'new') AS $key => $val) {
			$feat = new stdClass();
			$feat -> alias = $val;
			$feat -> title = ucwords($val);
			$feat -> id = '';
			array_push($data['featured_list'], $feat);
		}
		$this -> load -> view('products.php', $data);
	}

	public function page_detail() {

		$type = $this -> uri -> segment(2);
		$mfc = $this -> uri -> segment(3);
		$prod = $this -> uri -> segment(4);

		if ($type == 'manufacturer')
			if (!$mfc_detail = $this -> manufacturer_model -> view($mfc))
				redirect();

		if ($type == 'category')
			if (!$mfc_detail = $this -> category_model -> view($mfc))
				redirect();

		if ($type == 'featured') {
			if (!in_array($mfc, array('sale', 'paket', 'promotion', 'clearance', 'new')))
				redirect();
		}

		if (!$product = $this -> product_model -> getDetail($prod))
			redirect();
		else {
			$data['page'] = 'product';
			$data['page_detail'] = '';
			$data['breadcrumb'] = array( array("url" => base_url(), "label" => "HOME"), array("url" => base_url('product'), "label" => "Product"), array("url" => base_url($type), "label" => ucwords($type)), array("url" => base_url($mfc), "label" => ucwords($mfc)), array("url" => base_url($product -> alias), "label" => ucwords($product -> name)));
			$data['product'] = $product;
			$data['product_thumb'] = $this -> product_model -> pic($product -> id_product, 4);
			$data['related_product'] = $this -> product_model -> getRelated($product -> id_cat, $product -> id_product);
		}

		$this -> load -> view('product_detail.php', $data);
	}

}
