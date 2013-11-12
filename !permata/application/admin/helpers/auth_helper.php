<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('signed_in')) {
	function signed_in() {
		$ci = &get_instance();
		return $ci->auth->signed_in();
	}
}

if (!function_exists('current_user')) {
	function current_user() {
		$ci = &get_instance();
		return $ci->auth->current_user();
	}
}

if (!function_exists('priv_page')) {
	function priv_page($page) {
		$ci = &get_instance();
		return $ci->auth->priv_page($page);
	}
}

if (!function_exists('sign_in_url')) {
	function sign_in_url() {
		return "sessions/create";
	}
}

if (!function_exists('sign_out_url')) {
	function sign_out_url() {
		return "sessions/destroy";
	}
}

if (!function_exists('new_user_url')) {
	function new_user_url() {
		return "users/create";
	}
}

if (!function_exists('forgot_password_url')) {
	function forgot_password_url() {
		return "users/forgot";
	}
}

if (!function_exists('users_account_url')) {
	function users_account_url() {
		return "users/account";
	}
}
