<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model'));
		$this->load->library('breadcrumb');
	}
	function enable(){
		$this->load->model('settings_Model');
		$this->settings_model->newsletter_enable();
		redirect('settings','refresh');
	}
	function send(){
		$this->load->model('email_m');
		$this->load->library('email');
		$uname = $this->session->userdata('sess_username');
		$usermail = $this->email_m->getuser($uname);
		foreach($usermail as $um)
		{
			$email = $um->email;
			$firstname = $um->firstname;
			$lastname = $um->lastname;
		}
		$config = Array(
		  'mailtype' => 'html',
		  'protocol' => 'sendmail',
		  'mailpath' => '/usr/sbin/sendmail',
		  //'protocol' => 'smtp',
		 // 'smtp_host' => 'ssl://smtp.googlemail.com',
		 // 'smtp_port' => 465,
		  'smtp_user' => 'philip@pixaal.com', // change it to yours
		  //'smtp_pass' => 'flashbang', // change it to yours
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
		$this->email->initialize($config);
	
		
		$news_member = $this->email_m->get_newsletter_member($uname);
		foreach($news_member as $nm)
		{
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->to($nm->email);
			$this->email->from($email, $firstname.' '.$lastname);
			
			//$this->email->cc("testcc@domainname.com");
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('message'));
			$this->email->send();
		}	
		
		if($this->email->send()){						
			$this->session->set_flashdata('success',"Mail successfully send");
		}
		else { $this->session->set_flashdata('alert',"Sorry Unable to send email...");	}

		redirect('settings/newsletter','refresh');
	}
}
