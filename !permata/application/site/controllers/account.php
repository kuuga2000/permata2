<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		return $this->personal_information();
	}
	
	public function newsletter()
	{
		if(! $_POST)
			redirect();
			
		$email = trim($this->input->post('newsletter-email'));
		if ( ! $email) {
			$this->session->set_flashdata('newsletter_subscribe', "Please fill email field");
			redirect();
		}
		
		if(! $this->email_valid($email) ) {
			$this->session->set_flashdata('newsletter_subscribe', "Please fill valid email");
			redirect();
		}
		
		if ($this->account_model->find_newsletter($email)) {
			$this->session->set_flashdata('newsletter_subscribe', "This email has been registered before");
			redirect();
		}
		
		if($this->account_model->new_newsletter(array('email' => $email))) {
			$this->session->set_flashdata('newsletter_subscribe', "Thank You, your email has been subscribed");
			redirect();
		}
	}
	
	public function notifyme()
	{
		if(! $_POST)
			redirect();
		
		$id_product = $this->input->post('id_product');
		$alias 			= $this->input->post('alias');
		$email 			= trim($this->input->post('email'));
		
		$this->load->model('product_model');
		$manufacturer_alias = $this->product_model->getManufacturerAlias($id_product)->alias;
		
		if ( !$email) { 
			$this->session->set_flashdata('notify_msg', "Please fill email field");
			redirect('product/manufacturer/'.$manufacturer_alias.'/'.$alias);
		}
		
		if(! $this->email_valid($email) ) {
			$this->session->set_flashdata('notify_msg', "Please fill valid email");
			redirect('product/manufacturer/'.$manufacturer_alias.'/'.$alias);
		}
		
		if ($this->account_model->find_notify($id_product, $email)) {
			$this->session->set_flashdata('notify_msg', "This email has been registered before");
			redirect('product/manufacturer/'.$manufacturer_alias.'/'.$alias);
		}
		
		if( $this->account_model->new_notify( array('id_product' => $id_product, 'email' => $email, 'date' => date('Y-m-d')) ) ) {
			$this->session->set_flashdata('notify_msg', "Thank You, your email has been subscribed for this product");
			redirect('product/manufacturer/'.$manufacturer_alias.'/'.$alias);
		}
	}
	
	public function order_detail() {
		$data['page'] = '';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		$this->load->model('order_model');
		$this->load->model('voucher_model');
		$invoice_number = $this->uri->segment(3);
		
		$data['order'] = $this->order_model->find($invoice_number);
		$data['product'] = $this->order_model->getDetailList($invoice_number);
		$this->load->view('order_detail', $data);
	}
	
	public function sign_in()
	{
		if ( ! $_POST)
			redirect('checkout/account');
		
		$fail = false;
		$email = trim($this->input->post('email'));
		$pass = $this->input->post('password');
		
		if ( ! $email AND ! $pass)
			$fail = 'Please fill all required fields.';
		
		else if ( ! $this->email_valid($email))
			$fail = 'Please input a valid email address.';
		
		if ( ! $fail )
		{
			if ($data['account'] = $this->account_model->find_email($email))
			{
				if (sha1($pass) == $data['account']->passwd)
				{
					$this->session->set_userdata('sess_account', $email);
					if (count($this->session->userdata('shopping_cart')) > 0)
						redirect('checkout/delivery');
					
					redirect('account/personal_information');
				}
				else
					$fail = 'Invalid email / password.';
			}
			else
				$fail = 'Invalid email / password.';
		}
		
		if ($fail)
		{
			$this->session->set_flashdata('signin_fail', $fail);
			redirect('checkout/account');
		}
	}
	
	public function confirm_submit()
	{
		$data['page'] = 'order_confirm_2';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		$this->load->model('order_model');
		
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		if(! $_POST)
			redirect('account/order_history');
		
		$invoice_number 	= $this->input->post('invoice_number');
		$name_account 	= $this->input->post('name_account');
		$id_account 	= $this->input->post('id_account');
		$bank_account 	= $this->input->post('bank_account');
		$payment_value 	= $this->input->post('payment_value');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$date = $this->input->post('date');
		$payment_date 	= $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
		
		if ( !$name_account OR ! $id_account OR ! $bank_account OR ! $payment_value OR ! $year OR ! $month OR ! $date) {
			$fail = 'Please fill all fields.';
			$this->session->set_flashdata('confirm_fail', $fail);
			redirect('account/confirm2/'.$invoice_number);
		}
			
		$data_update = array(
			"name_account" => $name_account,
			"id_account" => $id_account,
			"bank_account" => $bank_account,
			"payment_value" => $payment_value,
			"payment_date" => $payment_date,
			"waiting" => '1');
		
		$this->order_model->confirm_payment($invoice_number, $data_update);
		$data['status'] = "success";
		
		$this->load->view('order_confirm_2', $data);
	}
	
	public function confirm2()
	{
		$data['page'] = 'order_confirm_2';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		$this->load->model('order_model');
		$invoice_number = $this->uri->segment(3);
		
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		$data['order'] = $this->order_model->find($invoice_number);
		$data['status'] = "";
		$this->load->model('bank_model');
		$data['bank'] = $this->bank_model->all();
		
		$this->load->view('order_confirm_2', $data);
	}
	
	public function confirm()
	{
		$data['page'] = 'order_confirm';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		$this->load->model('order_model');
		$this->load->model('voucher_model');
		$invoice_number = $this->uri->segment(3);
		
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		$data['order'] = $this->order_model->find($invoice_number);
		$data['delivery'] = $this->account_model->find_address($data['order']->id_address, $data['order']->id_customer);
		$data['product'] = $this->order_model->getDetailList($invoice_number);
		
		$this->load->view('order_confirm', $data);
	}
	
	public function order_history()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		$data['page'] = 'order_history';
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		$this->load->model('order_model');
		$data['order'] = $this->order_model->getList($data['account']->id_customer);
		
		$this->load->view('order_history', $data);
	}

	public function personal_information()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		$data['page'] = 'personal_information';
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		$this->load->view('personal_information', $data);
	}
	
	public function vouchers()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		$data['page'] = 'vouchers';
		if ( ! $data['account'] = $this->account_model->find_email($this->session->userdata('sess_account')))
			redirect('checkout/account');
		
		if ($this->uri->segment(3) == 'validate')
		{
			if ( ! $_POST)
				redirect('account/vouchers');
			
			$code = $this->input->post('code');
			$this->load->model('reward_model');
			if ($reward = $this->reward_model->find_code($code))
			{
				$data = array(
					'account_balance' => $reward->value + $data['account']->account_balance
				);
				if ($this->reward_model->add_balance($reward->id, $data, $this->session->userdata('sess_account')))
					$this->session->set_flashdata('valid', 'Your credit balance successfully updated.');
			}
			else
				$this->session->set_flashdata('fail', 'Invalid voucher code.');
			
			redirect('account/vouchers');
		}
		
		$this->load->view('vouchers', $data);
	}
	
	public function register()
	{
		if ( ! $_POST)
			redirect('account/personal_information');
		
		$fail = false;
		$email = trim($this->input->post('email'));
		$pass = $this->input->post('password');
		$passconf = $this->input->post('passwordconf');
		
		$newsletter = $this->input->post('newsletter');

		if ( ! $email AND ! $pass AND ! $passconf)
			$fail = 'Please fill all required fields.';
		
		else if ( ! $this->email_valid($email))
			$fail = 'Please input a valid email address.';

		else if ($this->account_model->find_email($email))
			$fail = 'Email address is already registered.';

		else if ($pass != $passconf)
			$fail = 'Invalid confirmation password.';

		if ( ! $fail)
		{
			$data = array(
				'email' => $email,
				'passwd' => sha1($pass)
			);
			if ($this->account_model->new_account($data))
			{
				if ($newsletter)
				{
					if ( ! $this->account_model->find_newsletter($email))
						$this->account_model->new_newsletter(array('email' => $email));
				}
				
				$this->session->set_userdata('sess_account', $email);
								
				redirect('account/personal_information');
			}
			else
				$fail = 'An error occured, please contact administrator.';
		}
		
		if ($fail)
		{
			$this->session->set_flashdata('reg_fail', $fail);
			redirect('checkout/account');
		}
	}
	
	public function update()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		if ( ! $_POST)
			redirect('account/personal_information');
		
		$fail = false;
		$fname = trim($this->input->post('fname'));
		$lname = trim($this->input->post('lname'));
		$address = trim($this->input->post('address'));
		$phone = trim($this->input->post('phone'));
		$city = trim($this->input->post('city'));
		$postcode = trim($this->input->post('postcode'));

		$data = array(
			'firstname' => $fname,
			'lastname' => $lname,
			'address' => $address,
			'phone' => $phone,
			'city' => $city,
			'postcode' => $postcode
		);
		if ($this->account_model->update_account($data, $this->session->userdata('sess_account')))
			$this->session->set_flashdata('valid', 'Your information successfully updated.');
		else
			$fail = 'An error occured, please contact administrator.';
		
		if ($fail)
			$this->session->set_flashdata('fail', $fail);
		
		redirect('account/personal_information');
	}
	
	public function change_password()
	{
		if ( ! $this->session->userdata('sess_account'))
			redirect('checkout/account');
		
		if ( ! $_POST)
			redirect('account/personal_information');
		
		$fail = false;
		$pass = $this->input->post('pass');
		$passconf = $this->input->post('passconf');

		if ( ! $pass AND ! $passconf)
			$fail = 'Please fill all required fields.';
		
		else if ($pass != $passconf)
			$fail = 'Invalid confirmation password.';
		
		if ( ! $fail)
		{
			$data = array(
				'passwd' => sha1($pass)
			);
			if ($this->account_model->update_account($data, $this->session->userdata('sess_account')))
				$this->session->set_flashdata('validpass', 'Your password successfully updated.');
			else
				$fail = 'An error occured, please contact administrator.';
		}
		
		if ($fail)
			$this->session->set_flashdata('failpass', $fail);
		
		redirect('account/personal_information');
	}
	
	public function reset_password()
	{
		if ( ! $_POST)
			redirect('checkout/account');
		
		$fail = false;
		$email = trim($this->input->post('email'));
		
		if ( ! $this->email_valid($email))
			$fail = 'Invalid email address.';
		
		else if ( ! $this->account_model->find_email($email))
			$fail = 'Invalid email address.';
		
		if ( ! $fail)
		{
			$pass = $this->generate_random();
			$data = array(
				'passwd' => sha1($pass)
			);
			if ($this->account_model->update_account($data, $email))
			{
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				
				$this->email->from('no-reply@permata.co.id');
				$this->email->to('andy@pixaal.com');
				$this->email->subject('Permata - Account - Reset Passwrd');
				$this->email->message('New password: '.$pass);
				if ($this->email->send())
					$this->session->set_flashdata('reset_valid', 'Your new password has been emailed to you.');
				else
					$fail = 'Failed to send mail. Please try again later.';
			}
			else
				$fail = 'An error occured, please contact administrator.';
		}
		
		if ($fail)
			$this->session->set_flashdata('reset_fail', $fail);
		
		redirect('checkout/account');
	}
	
	public function add_address()
	{
		if ( ! $_POST)
			redirect('checkout/delivery/add');
		
		$fail = false;
		$fname = trim($this->input->post('firstname'));
		$lname = trim($this->input->post('lastname'));
		$phone = trim($this->input->post('phone'));
		$address = trim($this->input->post('address'));
		$city = trim($this->input->post('city'));
		$country = trim($this->input->post('country'));
		$postcode = trim($this->input->post('postcode'));
		
		if ( ! $fname AND ! $lname AND ! $phone AND ! $address AND ! $city AND ! $country AND ! $postcode)
			$fail = 'Please fill all required fields.';
		
		if ( ! $fail)
		{
			$data = array(
				'id_customer' => $this->account_model->find_email($this->session->userdata('sess_account'))->id_customer,
				'fname' => $fname,
				'lname' => $lname,
				'phone' => $phone,
				'address' => $address,
				'city' => $city,
				'country' => $country,
				'postcode' => $postcode
			);
			if ($this->account_model->new_address($data))
				redirect('checkout/delivery');
			else
				$fail = 'An error occured, please contact administrator.';
		}
		
		if ($fail)
		{
			$this->session->set_flashdata('addr_fail', $fail);
			redirect('checkout/delivery/add');
		}
	}
	
	public function sign_out()
	{
		$this->session->unset_userdata('sess_account');
		redirect();
	}
	
	private function email_valid($email)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}
	
	private function generate_random()
	{
		$this->load->helper('string');
		return random_string('alnum', 6);
	}
}
