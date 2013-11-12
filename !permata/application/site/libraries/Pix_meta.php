<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix_meta {

	private $CI;
	public $tags = '';
	public $page = '';
	public $post = '';

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->model('meta_model');
	}

	public function get_meta_tags($tags, $page, $post)
	{
		if ($page AND $post)
		{
			$page_tags = $this->CI->meta_model->get_meta_tags_page($tags, $page);
			$post_tags = $this->CI->meta_model->get_meta_tags_post($tags, $post);
			if ($tags == 'meta_title')
				return $post_tags ? $post_tags.' - '.$page_tags : $page_tags;

			return $post_tags;
		}

		if ($page)
			return $this->CI->meta_model->get_meta_tags_page($tags, $page);

		return false;
	}
}
