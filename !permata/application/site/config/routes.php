<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';

$route['product/(:any)/(:any)/(:any)'] = 'product/page_detail/$1/$2/$3';

$route['products/(:any)/(:any)'] = 'product/page/$1/$2'; 

$route['product/page/(:any)'] = 'product/index/$1'; 
$route['product/page'] = 'product/index'; 

$route['product/search'] = 'product/search';
$route['product'] = 'product';

//$route['product/index'] = 'product/index';

//$route['product/index/(:any)'] = 'product/index/$1';

$route['checkout'] = 'checkout';
$route['checkout/(:any)'] = 'checkout/page/$1';

$route['account'] = 'account/index';
$route['account/(:any)'] = 'account/$1';

$route['contact/send'] = 'home/send_contact';

$route['(:any)/(:any)'] = 'home/page_detail';
$route['(:any)'] = 'home/page';