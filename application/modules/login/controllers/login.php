<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login_model');
		$this->load->model('site/site_model');
		$this->load->model('admin/users_model');
	}
    
	/*
	*
	*	Login an admin
	*
	*/
	public function login_admin() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_user())
			{
				redirect('admin');
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
		redirect('sign-in');
	}
    
	/*
	*
	*	Action of a forgotten password
	*
	*/
	public function forgot_password()
	{
		//form validation rules
		$this->form_validation->set_rules('admin_email', 'Email', 'required|xss_clean|exists[user.email]');
		$this->form_validation->set_message('exists', 'That email does not exist. Are you trying to sign up?');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$this->load->model('site/email_model');
			
			//reset password
			if($this->users_model->reset_password($this->input->post('admin_email')))
			{
				$this->session->set_userdata('success_message', 'Your password has been reset and mailed to '.$this->input->post('admin_email').'. Please use that password to sign in here');
				
				redirect('login-admin');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not reset your password. Please try again.');
				
				redirect('login-admin');
			}
		}
		
		else
		{
			$this->session->set_userdata('error_message', validation_errors());
				
			redirect('login-admin');
		}
		
		$this->load->view('admin_login');
	}
}
?>