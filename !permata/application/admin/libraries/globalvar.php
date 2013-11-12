<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Globalvar {

	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->model('settings_model');
	}

	public function get_value($name)
	{
		$value = $this->CI->settings_model->get_value($name);
		if ($value)
			return $value->value;
		return false;
	}
}
