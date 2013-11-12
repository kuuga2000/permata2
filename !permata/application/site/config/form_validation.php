<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'contact' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		),
		array(
			'field' => 'company',
			'label' => 'Company',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'subject',
			'label' => 'Subject',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'trim|required'
		)
	),

	'career' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		),
		array(
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'trim|required'
		)
	)
);
