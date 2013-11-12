<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	private $CI;
	private $current_user = null;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->model('users_model');
	}

	public function all()
	{
		$list = $this->CI->users_model->all();
		if ($list)
			return $list;

		return false;
	}

	public function find($username)
	{
		$find = $this->CI->users_model->find($username);
		if ($find)
			return $find;
		return false;
	}

	public function priv_page($page)
	{
		$this->CI->load->model('pages_model');
		$username = $this->CI->session->userdata('sess_username');
		if ($username)
		{
			$user = $this->CI->users_model->find($username);
			$userpage = explode(',', $user->pages);
			if ($user->pages == 'all' OR in_array($page, $userpage))
				return true;
		}
		return false;
	}

	/* public function new_user($data) {		
		$salt = $this->generate_random();
		
		// Store the salt
		$data['salt'] = $salt;
		
		// Hash user password
		$password = $data['password'];
		$data['password'] = $this->hash_password($password, $salt);		
		
		return $this->CI->user_model->insert($data);
	} */
	
	public function sign_in($username, $password)
	{
		$user = $this->CI->users_model->find($username);
		if ($user)
		{
			$hashed = $this->password_salt($password, $user->salt);
			if($user->password == $hashed AND $user->status == '1')
			{
				$datauser =  array(
				"sess_username"	=> $user->username,
				"sesfirstname"	=> $user->firstname,
				"seslastname"	=> $user->lastname
				);
				$this->CI->session->set_userdata($datauser);
				return true;
			}
		}
		return false;
	}

	public function sign_out()
	{
		$this->current_user = null;
		$this->CI->session->unset_userdata('sess_username');
	}

	public function current_user()
	{
		if ($this->current_user !== null)
			return $this->current_user;
		else
		{
			$user = false;
			$username = $this->CI->session->userdata('sess_username');
			if ($username)
				$user = $this->CI->users_model->find($username);

			if ($user)
			{
				$this->current_user = $user;
				return $user;
			}
		}
		return null;
	}

	public function signed_in()
	{
		return is_object($this->current_user());
	}

	/* public function send_reset($user) {
		// Generate reset code
		$reset_token = $this->generate_random();
		
		// Store token with user
		$this->CI->user_model->set_reset_token($user->id, $reset_token);
		
		// Send email
		$this->CI->load->library('email', array('mailtype' => 'html'));

		$this->CI->email->from('reset@site.com', 'SiteName');
		$this->CI->email->to($user->email);
		$this->CI->email->subject('Reset password');
		$this->CI->email->message($this->CI->load->view('users/forgot_email', array('user' => $user, 'token' => $reset_token), true));

		$this->CI->email->send();
	}
	
	public function recover($token, $password) {
		// Check user exists
		$query = $this->CI->user_model->find(array('reset_token' => $token));
		
		if($query->num_rows() > 0) {
			$user = $query->row();
			
			// Update password
			$this->change_password($user->id, $password);
			
			return $user;			
		}
		
		return false;
	} */
			
	public function change_password($username, $password)
	{
		$salt = $this->generate_random();
		$password = $this->hash_password($password, $salt);

		$this->CI->user_model->update($username, array(
			'salt' => $salt,
			'password' => $password
		));
	}

	public function password_salt($password, $salt)
	{
		return sha1($salt.$password);
	}

	public function generate_random()
	{
		$this->CI->load->helper('string');
		return random_string('alnum', 16);
	}

	public function valid_username($str)
	{
		return ( ! preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $str)) ? FALSE : TRUE;
	}
}
