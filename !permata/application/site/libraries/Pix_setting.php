<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix_setting {

	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->model('setting_model');
	}

	public function get_value($name)
	{
		$value = $this->CI->setting_model->get_value($name);
		if ($value)
			return $value->value;

		return false;
	}
}
