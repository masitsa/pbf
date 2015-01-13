<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Login extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login_model');
	}
    
	/*
	*
	*	Login a user
	*
	*/
	public function login_admin() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_user())
			{
				//redirect('dashboard');
				redirect('all-users');
			}
			
			else
			{
				$data['error'] = 'The email or password provided is incorrect. Please try again';
				$this->load->view('admin_login', $data);
			}
		}
		
		else
		{
			$this->load->view('admin_login');
		}
	}
	



	public function logout_admin()
	{
		$this->session->sess_destroy();
		redirect('login-admin');
	}
	
	public function logout_user()
	{
		$this->session->sess_destroy();
		$this->session->set_userdata('front_success_message', 'Your have been signed out of your account');
		redirect('checkout');
	}

	// start of the airline login
	public function login_airline() 
	{
		$v_data['error2'] = '';
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[airline.airline_user_email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_message('exists', 'This email has not been registered. Please sign up');
	
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_airline())
			{
				//redirect('dashboard');
				
				redirect('airline/account');
			}
			
			else
			{
				$v_data['error2'] = 'The email or password provided is incorrect. Please try again';
			}
		}
		
		$data['content'] = $this->load->view('airline_login', $v_data, true);
		$data['title'] = 'Sign In';
		$this->load->view('site/templates/general_page', $data);
	}
	public function logout_airline()
	{
		$this->session->sess_destroy();
		redirect('airline-login');
	}
	
	public function reset_airline_password() 
	{
		$v_data['error2'] = '';
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|exists[airline.airline_user_email]|xss_clean');
		$this->form_validation->set_message('exists', 'This email has not been registered. Please <a href="'.site_url().'airline/sign-up/airline-details">Sign up</a>');
		    
		if($this->form_validation->run())
		{
			//reset password
			$new_password = $this->login_model->reset_airline_password();
			if(!empty($new_password))
			{
				$this->load->model('site/email_model');
				
				//get airline
				$this->db->where('airline_user_email = \''.$this->input->post('email').'\'');
				$query = $this->db->get('airline');
				$row = $query->row();
				$airline = $row->airline_name;
				$airline_email = $row->airline_email;
				
				$email = $this->input->post('email');
				$name = $airline;
				$subject = 'You requested a password reset';
				$message = '<p>You have requested your password to be reset. Please find your new password here:</p>
				<p>'.$new_password.'</p>
				<p>You may sign into your account using this link</p>';
				$button = '<p><a class="mcnButton " title="Sign in" href="'.site_url().'airline/sign-in" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Sign in</a></p>';
				$shopping = '<p>If you have any queries or concerns do not hesitate to get in touch with us at <a href="mailto:info@privatebushflights.com">info@privatebushflights.com</a> </p>';
				$sender_email = 'info@privatebushflights.com';
				$from = 'Private Bush Flights';
				$cc = $airline_email;
				
				$response = $this->email_model->send_mandrill_mail($email, $name, $subject, $message, $sender_email, $shopping, $from, $button, $cc);
				
				$this->session->set_userdata('airline_reset_success_message', 'Your password has been reset. Please check your email for your new password');
			}
			
			else
			{
				$v_data['error2'] = 'The email provided is incorrect. Please try again';
			}
			$result = md5(date("Y-m-d H:i:s"));
			$pwd2 = substr($result, 0, 6);
			
			$pwd = md5($pwd2);
		}
		
		$data['content'] = $this->load->view('reset_airline_password', $v_data, true);
		$data['title'] = 'Reset Password';
		$this->load->view('site/templates/general_page', $data);
	}
	
	
	// end of the airline login
}
?>