<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->authorize();
		$this->load->library('breadcrumb');
	}

	public function index()
	{
		$data['page'] = 'users';
		$data['list'] = $this->auth->all();

		if ( ! $data['list'])
			redirect();

		$this->load->view('users.php', $data);
	}

	public function detail()
	{
		$this->load->model(array('users_group_model','pages_model'));
		$data['title'] = 'Edit Profile';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$username = $this->uri->segment(2);
		if ( ! $username)
			redirect('users');

		$data['page'] = 'users';
		$data['users_group'] = $this->users_group_model->all();
		$data['user'] = $this->auth->find($username);

		if ( ! $data['users_group'] AND ! $data['user'])
			redirect('users');
		$data['mainmenu'] = $this->pages_model->menu();
		$this->load->view('users.detail.php', $data);
	}

	/* public function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run()) {
			
			$user = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			);
			
			if($this->auth->new_user($user)) {
				// Sign the user in
				$this->auth->sign_in($user['username'], $user['password']);
				
				redirect('welcome/index');
			}
		}

		$this->load->view('users/create', $this->data);
	} */
	
	/* public function forgot() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if ($this->form_validation->run()) {
			$email =  $this->input->post('email');
			
			$user = $this->user_model->find(array('email' => $email));
			
			if($user->num_rows() > 0) {
				$this->auth->send_reset($user->row());
				
				redirect('users/forgot_sent');
			}
			else {
				$this->data['error'] = "Email not found";
			}
		}
		
		$this->load->view('users/forgot', $this->data);
	}
	
	public function forgot_sent() {
		$this->load->view('users/forgot_sent', $this->data);		
	}
	
	public function recover($token) {
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('token', 'Token', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required');
		
		$this->data['token'] = $token;
		
		if($this->form_validation->run()) {
			if($user = $this->auth->recover($token, $this->input->post('password'))) {
				
				// Sign user in
				$this->auth->sign_in($user->username, $this->input->post('password'));
				
				redirect('welcome/index');	
			}
			else {
				$this->data['error'] = "Password could not be reset. Token may be invalid.";
			}
		}
		
		$this->load->view('users/recover', $this->data);
	} */

	public function update()
	{
		$fromuser = $this->uri->segment(2);

		$role = $this->input->post('role');
		$username = trim($this->input->post('username'));
		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));
		$confirm_password = trim($this->input->post('confirm_password'));

		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$gender = trim($this->input->post('gender'));
		$address = trim($this->input->post('address'));
		$phone = trim($this->input->post('phone'));
		$note = trim($this->input->post('note'));

		if ($role == 'super admin')
		{
			$privileges = 'all';
			$pages = 'all';
		}
		else
		{
			if ($this->input->post('add'))
				$privileges = '1,';
			else
				$privileges = '0,';

			if ($this->input->post('edit'))
				$privileges .= '1,';
			else
				$privileges .= '0,';

			if ($this->input->post('delete'))
				$privileges .= '1,';
			else
				$privileges .= '0,';

			if ($this->input->post('approval'))
				$privileges .= '1';
			else
				$privileges .= '0';

			$pages = '';
			if ($this->input->post('pages'))
			{
				$n = 1;
				foreach ($this->input->post('pages') as $p)
				{
					$pages .= $p.',';
				}
			}
		}

		$fd = array(
			'user_group' => $role,
			'username' => $username,
			'email' => $email,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'gender' => $gender,
			'address' => $address,
			'phone' => $phone,
			//'privileges' => $privileges,
			//'pages' => $pages,
			'note' => $note
		);

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//if ($this->current_user()->username != $username)
			//$this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		//if ($this->current_user()->email != $email)
			//$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');

		if ($this->form_validation->run())
		{
			if ( ! $this->auth->valid_username($username))
			{
				$this->session->set_flashdata($fd);
				redirect('users/'.$this->current_user()->username);
			}

			$this->users_model->update($fromuser, $fd);			
			redirect('users/'.$username);
		}
		else
		{
			$this->session->set_flashdata($fd);
			echo 'gagal';
		}

		/* $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		// Validate username
		$this->form_validation->set_rules('username', 'Username', 'required');
		if($this->current_user()->username != $this->input->post('username'))
			$this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
			
		// Validate email
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if($this->current_user()->email != $this->input->post('email'))
			$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
			
		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		
		if ($this->form_validation->run()) {
			
			$current_password = $this->auth->hash_password(
				$this->input->post('current_password'), 
				$this->current_user()->salt
			);
			
			if($current_password == $this->current_user()->password) {
				
				$data = array(
					'name' => $this->input->post('name'),
					'location' => $this->input->post('location'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email')
				);
				
				$password = $this->input->post('password');
				if($password && trim($password) != '') {
					$data['password'] = $this->auth->hash_password($password, $this->current_user()->salt);
				}
				
				// Update rows
				$this->user_model->update($this->current_user()->id, $data);
				
				redirect('welcome/index');
			}
			else {
				$this->data['error'] = 'Your current password was incorrect.';
			}
		}
		
		$this->load->view('users/account', $this->data); */
	}
}
