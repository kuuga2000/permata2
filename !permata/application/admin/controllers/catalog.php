<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Catalog extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this -> auth -> signed_in())
			redirect();
		$this -> load -> model(array('pages_model', 'lib', 'product_m'));
		$this -> load -> library('breadcrumb');
	}

	// **** display data list **** //

	public function index() {
		$this -> load -> library('pagination');
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$table = 'product';
		if ($this -> input -> post("search")) {
			$data['title'] = 'Product Search';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			$data['data_all'] = $this -> product_m -> search($this -> input -> post("search"));
		} else {
			$data['title'] = 'Product';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			$data['base_url'] = base_url() . 'catalog/product';
			$data['total_rows'] = $this -> lib -> count_all($table);
			$data['per_page'] = 20;
			$this -> pagination -> initialize($data);
			$data['data_all'] = $this -> product_m -> all();
		}
		$this -> load -> view('product_.php', $data);
	}

	function product() {
		$this -> load -> library('pagination');
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$table = 'product';
		if ($this -> input -> post("search")) {
			$data['title'] = 'Product Search';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			$data['data_all'] = $this -> product_m -> search($this -> input -> post("search"));
		} else {
			$data['title'] = 'Product';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			$data['base_url'] = base_url() . 'catalog/product';
			$data['total_rows'] = $this -> lib -> count_all($table);
			$data['per_page'] = 20;
			$this -> pagination -> initialize($data);
			$data['data_all'] = $this -> product_m -> all();
		}

		$this -> load -> view('product_.php', $data);
	}

	function category() {
		$this -> load -> model('category_m');
		$data['title'] = 'Product Category';
		$data['breadc'] = $this -> breadcrumb -> show($data['title']);
		$data['page'] = 'catalog';
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		$data['catlist'] = $this -> category_m -> category_list();

		$this -> load -> view('category_.php', $data);
	}

	function brand() {
		$this -> load -> model('manufacturer_m');
		$this -> load -> library('pagination');
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		$data['page'] = 'catalog';
		$data['subpage'] = 'brand';
		$table = 'manufacturer';
		if ($this -> input -> post("search")) {
			$data['title'] = 'Manufacturer Search';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			$data['data_all'] = $this -> manufacturer_m -> search_lib($this -> input -> post("search"));
		} else {
			$data['title'] = 'Manufacturer';
			$data['breadc'] = $this -> breadcrumb -> show($data['title']);
			/* $data['base_url'] = base_url().'catalog/brand';
			 $data['total_rows'] = $this->lib->count_all($table);
			 $data['per_page'] = 6;
			 $this->pagination->initialize($data);  */
			$data['data_all'] = $this -> manufacturer_m -> get_all($table);
		}

		$this -> load -> view('brand_.php', $data);
	}

	function attribute() {
		$data['breadc'] = $this -> pages_model -> breadcrumb();
		$data['dattr'] = '';
		$this -> load -> model('attribute_m');
		$data['title'] = 'Attribute Product';
		$data['page'] = 'catalog';
		$data['subpage'] = 'attribute';
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu();
		$data['subpages'] = $this -> pages_model -> submenu2();

		$data['primattr'] = $this -> attribute_m -> get_all();
		if ($this -> uri -> segment(3)) {
			$data['primattr_sel'] = $this -> attribute_m -> get_sub_all();
			$data['dattr'] = $this -> uri -> segment(3);
		}
		$this -> load -> view('attribute_', $data);
	}

	function tag() {
		$data['breadc'] = $this -> pages_model -> breadcrumb();
		$data['dattr'] = '';
		$this -> load -> model('product_m');
		$data['title'] = 'Tag';
		$data['page'] = 'catalog';
		$data['subpage'] = 'tag';
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();

		$data['tag_all'] = $this -> product_m -> get_tag_all();
		if ($this -> uri -> segment(3)) {
			$data['dattr'] = $this -> uri -> segment(3);
		}
		$this -> load -> view('tag_', $data);
	}

}
