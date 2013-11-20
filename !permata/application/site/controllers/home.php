<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		
		//$this->output->cache(20);
		if ( ! $page_detail = $this->page_model->find_template('home'))
			redirect();

		$data['page'] = $page_detail->alias;
		$data['page_detail'] 	= $page_detail;
		
		$data['slide_list'] 	= $this->gallery_model->viewByPost('home-slider');
		$data['brand_list'] 	= $this->gallery_model->viewByPost('home-distributor');
		$data['product_featured'] 	= $this->product_model->listByFeatured('hotdeal', $this->session->userdata('sort'));
		$data['product_clearance'] 	= $this->product_model->listByFeatured('clearance', $this->session->userdata('sort'));

		$this->load->view($page_detail->template.'.php', $data);
	}

	public function page() {
		$page = $this->uri->segment(1);

		if ( ! $page_detail = $this->page_model->find($page))
			redirect();
		

		$data['page'] = $page_detail->alias;
		$data['page_detail'] = $page_detail;
		$data['breadcrumb'] = array(
			array("url" => base_url(), "label" => "HOME"),
			array("url" => base_url($page_detail->alias), "label" => $page_detail->title)
		);
		
		$r_product = array('product', 'product_detail');
		if (in_array($page_detail->template, $r_product))
			$data['product'] = $this->post_model->product($page_detail->id);
		
		if ($page_detail->template == 'faq')
			$data['faq_list'] = $this->post_model->faq($page_detail->id);
		 

		$this->load->view($page_detail->template.'.php', $data);
	}
	
	public function send_contact() {
		
		if(! $_POST) {
			$this->session->set_flashdata('contact', "Please fill all field");
			redirect('contact');
		}
		
		$name = $this->input->post('name');
		$email = trim($this->input->post('email'));
		$address = $this->input->post('address');
		$mobilephone = $this->input->post('mobilephone');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		
		if(!$name OR !$email OR !$address OR !$mobilephone OR !$subject OR !$message) {
			$this->session->set_flashdata('contact', "Please fill all field");
			redirect('contact');
		}
		
		/* if(! $this->email_valid($email) ) {
			$this->session->set_flashdata('contact', "Please fill valid email");
			redirect('contact-us');
		} */
		
		$data = array(
			'name' => $name,
			'email' => $email,
			'address' => $address,
			'mobilephone' => $mobilephone,
			'subject' => $subject,
			'message' => $message,
		);
		$data = (object) $data;
		if ( ! $tpl = $this->pix_mail_tpl->contact($data))
			redirect('contact');

		$this->load->library('email');
		
		$this->email->from($email);
		$this->email->to('andi@pixaal.com');
		$this->email->subject('Permata - Contact Us - '.$subject);
		$this->email->message($tpl);
		if ($this->email->send())
			$this->session->set_flashdata('contact', 'Your message has been sent. Thank you.');
		else
			$this->session->set_flashdata('contact', 'Failed to send your message. Please try later.');
		
		redirect('contact');
	}
}
