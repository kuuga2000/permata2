<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';

$route['signout'] = 'login/destroy';

$route['users/(:any)/update'] = 'users/update';
$route['users/(:any)'] = 'users/detail';

