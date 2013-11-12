<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model'));
		$this->load->library('breadcrumb');
	}

	public function index()
	{
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'settings';
		$data['subpage'] = 'settings';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		if($this->input->post("search"))
		{
			$data['title'] = 'Search Email';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['data_all'] = $this->settings_model->search_newsletter($this->input->post("search"));
		}
		else
		{
			$data['title'] = 'Newsletter';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['base_url'] = base_url().'settings/newsletter';
			$data['total_rows'] = $this->settings_model->count_all();
			$data['per_page'] = 6; 
			$data['data_all'] = $this->settings_model->get_newsletter();
			$this->pagination->initialize($data); 
			$config['uri_segment'] = 3;
		}
		$this->load->view('setting_.php', $data);
	}
	function newsletter(){
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'settings';
		$data['subpage'] = 'settings';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		if($this->input->post("search"))
		{
			$data['title'] = 'Search Email';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['data_all'] = $this->settings_model->search_newsletter($this->input->post("search"));
		}
		else
		{
			$data['title'] = 'Newsletter';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['base_url'] = base_url().'settings/newsletter';
			$data['total_rows'] = $this->settings_model->count_all();
			$data['per_page'] = 6; 
			$data['data_all'] = $this->settings_model->get_newsletter();
			$this->pagination->initialize($data); 
			$config['uri_segment'] = 3;
		}
		$this->load->view('setting_.php', $data);
	}
	public function newsletter_add()
	{
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'settings';
		$data['subpage'] = 'settings';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['title'] = 'Send Newsletter';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$this->load->view('newsletter_add.php', $data);
	}
	function enable(){
		$this->load->model('settings_Model');
		$this->settings_model->newsletter_enable();
		redirect('settings','refresh');
	}
	function notifications(){
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'settings';
		$data['subpage'] = 'notifications';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		if($this->input->post("search"))
		{
			$data['title'] = 'Notifications Email';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['data_all'] = $this->settings_model->search_newsletter($this->input->post("search"));
		}
		else
		{
			$data['title'] = 'Notifications';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['base_url'] = base_url().'settings/notifications';
			$data['total_rows'] = $this->settings_model->count_notification();
			$data['per_page'] = 5; 
			$data['data_all'] = $this->settings_model->get_notifications();
			$this->pagination->initialize($data); 
			$config['uri_segment'] = 3;
		}
		$this->load->view('notifications_.php', $data);
	}
	function notification_send(){
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
	
		
		$notif_list = $this->email_m->get_notification_list($uname);
		foreach($notif_list as $nl)
		{
			$this->email->clear();
			$this->email->set_mailtype("html");
			$this->email->to($nl->email);
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
