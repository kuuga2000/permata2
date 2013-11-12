<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumb {

	private $CI;
	private $current_user = null;

	public function __construct()
	{
		$this->CI = &get_instance();
		//$this->CI->load->model('page_model');
	}
	
	function show($title){
		//$this->CI->load->model('page_model');
		$breadcrumb_data = $this->CI->pages_model->breadcrumb();
		if($breadcrumb_data)
		{
			foreach($breadcrumb_data as $bc)
			{
				@$cru2 = strtolower($bc->cru2);
				if($bc->level == 1)
				{ @$data = anchor($bc->cru1,$bc->cru1).' > '.anchor($bc->cru1.'/'.$cru2,$bc->cru2).' > '.$title;  }
				else if( $bc->level == 0)
				{ $data = anchor($bc->cru1,$bc->cru1).' > '.$title;  }
				else
				{ $data = $this->uri->segment(1); }
			}
		}
		else
		{	$data = $title;	}
		return $data;
	}

}
