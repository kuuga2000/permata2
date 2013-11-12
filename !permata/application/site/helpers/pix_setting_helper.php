<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('meta_tags'))
{
	function meta_tags($tags = 'meta_title', $page = '', $post = '')
	{
		$CI = &get_instance();
		if ($page OR $post)
		{
			if ($tags == 'meta_title')
				return $CI->pix_meta->get_meta_tags($tags, $page, $post).' - '.$CI->pix_setting->get_value('meta_title');

			return $CI->pix_meta->get_meta_tags($tags, $page, $post);
		}

		return false;
	}
}

if ( ! function_exists('page_active'))
{
	function page_active($page, $current)
	{
		if ($page AND $current)
		{
			if ($page == $current)
				return 'active';
		}

		return false;
	}
}

if ( ! function_exists('limiter'))
{
	function limiter($str, $n = 125, $end_char = '&#8230;')
	{
		$str = strip_tags($str);
		if (strlen($str) < $n)
		{
			return $str;
		}

		return substr($str, 0, $n).$end_char;
	}
}
