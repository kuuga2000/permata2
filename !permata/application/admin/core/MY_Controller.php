<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $data = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function current_user()
	{
		return $this->auth->current_user();
	}

	public function signed_in()
	{
		return $this->auth->signed_in();
	}

	public function authorize()
	{
		if ( ! $this->signed_in())
			redirect();
	}
	
	public function replaceForprice($price){
		return str_replace(array('.',','), '', $price);
	}
}
