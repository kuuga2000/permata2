<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('site_name')) {
	function site_name() {
		$ci = &get_instance();
		return $ci->globalvar->get_value('site_name');
	}
}

if (!function_exists('site_year')) {
	function site_year() {
		$ci = &get_instance();
		return $ci->globalvar->get_value('site_year');
	}
}

if (!function_exists('page_active')) {
	function page_active($active, $page) {
		if ($active AND $page)
		{
			if ($active == $page)
				return 'active';
		}
		return false;
	}
}

if (!function_exists('page_line')) {
	function page_line($active, $page) {
		if ($active AND $page)
		{
			if ($active == $page)
				return 'last';
		}
		return false;
	}
}
