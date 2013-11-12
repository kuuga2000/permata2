<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Brand extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this -> auth -> signed_in())
			redirect();
		$this -> load -> model(array('pages_model', 'manufacturer_m'));
		$this -> load -> library('breadcrumb');
	}

	function information() {
		$data['title'] = 'Manufacturer Information';
		$data['breadc'] = $this -> breadcrumb -> show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'brand';
		$table = 'manufacturer';
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		//jangan diutak atik
		//$data['product_detail'] = $this->product_m->product_detail();
		$data['manuf'] = $this -> manufacturer_m -> get_manuf();

		$this -> load -> view('brand_info.php', $data);
	}

	function add() {
		$data['title'] = 'Manufacturer Information';
		$data['breadc'] = $this -> breadcrumb -> show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'brand';
		$table = 'manufacturer';
		$data['mainmenu'] = $this -> pages_model -> menu();
		$data['subpages'] = $this -> pages_model -> submenu2();
		//jangan diutak atik
		//$data['product_detail'] = $this->product_m->product_detail();

		$this -> load -> view('brand_add.php', $data);
	}

	function manufaktur_save() {
		$this -> load -> library('image_lib');
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$config['upload_path'] = './../assets/upload/manufacturer/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$this -> load -> library('upload', $config);

		if (!$this -> upload -> do_upload("img")) {
			$error = array('error' => $this -> upload -> display_errors());

			if (@$nFile == '') {	$hasil = 1;
			} else {	$hasil = 0;
			}
		} else {	$hasil = 1;
		}

		if ($hasil == 1) {
			$aFile = $this -> upload -> data();
			$nFile = $aFile['file_name'];
			$nFile_explode = explode('.', $aFile['file_name']);

			$this -> manufacturer_m -> manufaktur_save($nFile);
		} else {
			print_r($error);
		}
		if ($this -> input -> post('id_manufacturer')) {
			redirect('catalog/brand', 'refresh');
		} else {
			if ($this -> input -> post('name')) {
				redirect('catalog/brand', 'refresh');
			} else {
				redirect('brand/add', 'refresh');
			}
		}
	}

	function delete() {
		$this -> manufacturer_m -> manuf_delete();
		redirect('catalog/brand', 'refresh');
	}

}
