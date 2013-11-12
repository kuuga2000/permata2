<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix_page {

	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		if(! $this->CI->session->userdata('shopping_cart'))
			$this->CI->session->set_userdata('shopping_cart', array());
			
		if(! $this->CI->session->userdata('voucher'))
			$this->CI->session->set_userdata('voucher', '');
			
		if(! $this->CI->session->userdata('address'))
			$this->CI->session->set_userdata('address', '');
			
		if(! $this->CI->session->userdata('sort'))
			$this->CI->session->set_userdata('sort', 'name');
	}

	public function view($navigation = '')
	{
		return $this->CI->page_model->view($navigation);
	}

	public function category()
	{
		return $this->CI->product_model->category();
	}

	public function manufacturer()
	{
		return $this->CI->product_model->manufacturer();
	}

	public function featured()
	{
		return $this->CI->gallery_model->viewByPost('home-slider');
	}
}
