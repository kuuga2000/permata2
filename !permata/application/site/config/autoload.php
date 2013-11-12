<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'database', 'user_agent', 'pix_setting', 'pix_meta', 'pix_page', 'pix_mail_tpl', 'pix_social','currency');
$autoload['helper'] = array('url', 'form', 'language', 'pix_setting');
$autoload['config'] = array();
$autoload['language'] = array("global");
$autoload['model'] = array('setting_model', 'page_model', 'post_model', 'product_model', 'gallery_model', 'account_model');