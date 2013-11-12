<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->auth->signed_in())
		{
		}
		else
			$this->load->view('login.php');
	}

	public function validate()
	{
		if ( ! $this->input->is_ajax_request())
			redirect();

	//	echo "$('.bar').addClass('loading');";
	//	echo "$('.msg').html('');";

		$msg = '';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run())
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->auth->sign_in($username, $password))
			{
				$msg .= "$('.bar').removeClass('loading');";
				$msg .= "window.location='".site_url()."';";
			}
			else
			{
				$msg .= "$('.bar').removeClass('loading');";
				$msg .= "$('.msg').html('Invalid Username / Password');";
			}
		}
		else
		{
			$msg .= "$('.bar').removeClass('loading');";
			$msg .= "$('.msg').html('Please fill all fields');";
		}

		echo $msg;
	}

	public function destroy()
	{
		$this->auth->sign_out();
		redirect();
	}
}
