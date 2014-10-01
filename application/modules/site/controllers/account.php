<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/site/controllers/site.php";

class Account extends site {
	
	function __construct()
	{
		parent:: __construct();
		
		$this->load->model('admin/grades_model');
		$this->load->model('admin/reports_model');
		$this->load->model('admin/users_model');
		$this->load->model('login/login_model');
		
		//user has logged in
		if($this->login_model->check_frontend_login())
		{
		}
		
		//user has not logged in
		else
		{
			$this->session->set_userdata('front_error_message', 'Please sign up/ in to continue');
				
			redirect('sign-in');
		}
	}
    
	/*
	*
	*	Open the account page
	*
	*/
	public function my_account()
	{
		//open the add new subscription
		$data['title'] = 'My Account';
		$v_data['user_details'] = $this->users_model->get_user($this->session->userdata('user_id'));
		$v_data['purchase_details'] = $this->reports_model->get_user_paid_grades($this->session->userdata('user_id'));
		
		$data['content'] = $this->load->view('user/my_account', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Update a user's account
	*
	*/
	public function update_account()
	{
		//form validation rules
		$this->form_validation->set_rules('last_name', 'Last Names', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('front_error_message', validation_errors());
		}
		
		else
		{
			//check if user has valid login credentials
			if($this->users_model->edit_frontend_user($this->session->userdata('user_id')))
			{
				$this->session->set_userdata('front_success_message', 'Your details have been successfully updated');
			}
			
			else
			{
				$this->session->set_userdata('front_error_message', 'Oops something went wrong and we were unable to update your details. Please try again');
			}
		}
		
		redirect('account');
	}
    
	/*
	*
	*	Update a user's password
	*
	*/
	public function update_password()
	{
		//form validation rules
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|xss_clean');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('front_error_message', validation_errors());
		}
		
		else
		{
			//update password
			$update = $this->users_model->edit_password($this->session->userdata('user_id'));
			if($update['result'])
			{
				$this->session->set_userdata('front_success_message', 'Your password has been successfully updated');
			}
			
			else
			{
				$this->session->set_userdata('front_error_message', $update['message']);
			}
		}
		
		redirect('account');
	}
    
	/*
	*
	*	Update a user's password
	*
	*/
	public function update_school_password()
	{
		//form validation rules
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|xss_clean');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('front_error_message', validation_errors());
		}
		
		else
		{
			//update password
			$update = $this->users_model->edit_school_password($this->session->userdata('user_id'));
			if($update['result'])
			{
				$this->session->set_userdata('front_success_message', 'Your password has been successfully updated');
			}
			
			else
			{
				$this->session->set_userdata('front_error_message', $update['message']);
			}
		}
		
		redirect('account');
	}
	
	public function subscribe_student()
	{
		$data['content'] = $this->load->view('subscription/student', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function subscribe_teacher()
	{
		$data['content'] = $this->load->view('subscription/teacher', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function subscribe_school()
	{
		$data['content'] = $this->load->view('subscription/school', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
}