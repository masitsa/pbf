<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airline extends MX_Controller 
{
	var $airlines_path;
	var $airlines_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('airline_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->airlines_path = realpath(APPPATH . '../assets/images/airlines');
		$this->airlines_location = base_url().'assets/images/airlines/';
	}
    
	/*
	*
	*	Airline Signup 1
	*
	*/
	public function airline_signup1() 
	{
		//initialize required variables
		$v_data['airline_logo_location'] = 'http://placehold.it/300x300';
		$v_data['airline_name_error'] = '';
		$v_data['airline_phone_error'] = '';
		$v_data['airline_email_error'] = '';
		$v_data['airline_summary_error'] = '';
		$v_data['airline_logo_error'] = '';
		$v_data['air_operator_certificate_error'] = '';
		//upload image if it has been selected
		if($this->airline_model->upload_airline_image($this->airlines_path))
		{
			$v_data['airline_logo_location'] = $this->airlines_location.$this->session->userdata('airline_logo_file_name');
		}
		
		//case of upload error
		else
		{
			$v_data['airline_logo_error'] = $this->session->userdata('airline_logo_error_message');
		}
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('airline_name', 'Airline', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airline_phone', 'Phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airline_email', 'Email', 'trim|valid_email|is_unique[airline.airline_email]|required|xss_clean');
		$this->form_validation->set_rules('airline_summary', 'Summary', 'trim|required|xss_clean');
		$this->form_validation->set_rules('air_operator_certificate', 'Summary', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->airline_model->register_airline_details())
			{
				redirect('airline/sign-up/user-details');
			}
			
			else
			{
				$this->session->set_userdata('airline_signup1_error_message', 'Unable to add airline details. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['airline_name_error'] = form_error('airline_name');
				$v_data['airline_phone_error'] = form_error('airline_phone');
				$v_data['airline_email_error'] = form_error('airline_email');
				$v_data['airline_summary_error'] = form_error('airline_summary');
				$v_data['air_operator_certificate_error'] = form_error('air_operator_certificate');
				
				//repopulate fields
				$v_data['airline_name'] = set_value('airline_name');
				$v_data['airline_phone'] = set_value('airline_phone');
				$v_data['airline_email'] = set_value('airline_email');
				$v_data['airline_summary'] = set_value('airline_summary');
				$v_data['air_operator_certificate'] = set_value('air_operator_certificate');
			}
			
			//populate form data on initial load of page
			else
			{
				$airline_name = $this->session->userdata('airline_name');
				
				//If session data already exists
				if(!empty($airline_name))
				{
					$v_data['airline_name'] = $airline_name;
					$v_data['airline_phone'] = $this->session->userdata('airline_phone');
					$v_data['airline_email'] = $this->session->userdata('airline_email');
					$v_data['airline_summary'] = $this->session->userdata('airline_summary');
					$v_data['air_operator_certificate'] = $this->session->userdata('air_operator_certificate');
					$v_data['airline_logo_location'] = $this->airlines_location.$this->session->userdata('airline_logo_file_name');
				}
				
				else
				{
					$v_data['airline_name'] = '';
					$v_data['airline_phone'] = '';
					$v_data['airline_email'] = '';
					$v_data['airline_summary'] = '';
					$v_data['air_operator_certificate'] = '';
				}
			}
		}
		
		$data['content'] = $this->load->view('airline_signup1', $v_data, true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Airline Signup 2
	*
	*/
	public function airline_signup2() 
	{
		//initialize required variables
		$v_data['airline_user_first_name_error'] = '';
		$v_data['airline_user_last_name_error'] = '';
		$v_data['airline_user_email_error'] = '';
		$v_data['airline_user_phone_error'] = '';
		$v_data['airline_user_password_error'] = '';
		$v_data['confirm_password_error'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('airline_user_first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airline_user_last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airline_user_email', 'Email', 'trim|valid_email|is_unique[airline.airline_user_email]|required|xss_clean');
		$this->form_validation->set_rules('airline_user_phone', 'Phone', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airline_user_password', 'Password', 'trim|required|matches[confirm_password]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->airline_model->register_user_details())
			{
				redirect('airline/sign-up/review');
			}
			
			else
			{
				$this->session->set_userdata('airline_signup2_error_message', 'Unable to add user details. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['airline_user_first_name_error'] = form_error('airline_user_first_name');
				$v_data['airline_user_last_name_error'] = form_error('airline_user_last_name');
				$v_data['airline_user_email_error'] = form_error('airline_user_email');
				$v_data['airline_user_phone_error'] = form_error('airline_user_phone');
				$v_data['airline_user_password_error'] = form_error('airline_user_password');
				$v_data['confirm_password_error'] = form_error('confirm_password');
				
				//repopulate fields
				$v_data['airline_user_first_name'] = set_value('airline_user_first_name');
				$v_data['airline_user_last_name'] = set_value('airline_user_last_name');
				$v_data['airline_user_email'] = set_value('airline_user_email');
				$v_data['airline_user_phone'] = set_value('airline_user_phone');
				$v_data['airline_user_password'] = set_value('airline_user_password');
				$v_data['confirm_password'] = set_value('confirm_password');
			}
			
			//populate form data on initial load of page
			else
			{
				$airline_user_first_name = $this->session->userdata('airline_user_first_name');
				
				//If session data already exists
				if(!empty($airline_user_first_name))
				{
					$v_data['airline_user_first_name'] = $airline_user_first_name;
					$v_data['airline_user_last_name'] = $this->session->userdata('airline_user_last_name');
					$v_data['airline_user_email'] = $this->session->userdata('airline_user_email');
					$v_data['airline_user_phone'] = $this->session->userdata('airline_user_phone');
					$v_data['airline_user_password'] = $this->session->userdata('airline_user_password');
					$v_data['confirm_password'] = $this->session->userdata('airline_user_password');
				}
				
				else
				{
					$v_data['airline_user_first_name'] = '';
					$v_data['airline_user_last_name'] = '';
					$v_data['airline_user_email'] = '';
					$v_data['airline_user_phone'] = '';
					$v_data['airline_user_password'] = '';
					$v_data['confirm_password'] = '';
				}
			}
		}
		
		$data['content'] = $this->load->view('airline_signup2', $v_data, true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
	}
    
	/*
	*
	*	Airline Signup 3
	*
	*/
	public function airline_signup3() 
	{
		$v_data['airline_name'] = $this->session->userdata('airline_name');
		$v_data['airline_phone'] = $this->session->userdata('airline_phone');
		$v_data['airline_email'] = $this->session->userdata('airline_email');
		$v_data['airline_summary'] = $this->session->userdata('airline_summary');
		$v_data['airline_logo_location'] = $this->airlines_location.$this->session->userdata('airline_logo_file_name');
		$v_data['airline_user_first_name'] = $this->session->userdata('airline_user_first_name');
		$v_data['airline_user_last_name'] = $this->session->userdata('airline_user_last_name');
		$v_data['airline_user_email'] = $this->session->userdata('airline_user_email');
		$v_data['airline_user_phone'] = $this->session->userdata('airline_user_phone');
		
		$data['content'] = $this->load->view('airline_signup3', $v_data, true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function register()
	{
		if($airline_id = $this->airline_model->register_airline())
		{
			//new session array
			$newdata = array(
				   'login_status'   => TRUE,
				   'first_name'     => $this->session->userdata('airline_user_first_name'),
				   'airline_name'     => $this->session->userdata('airline_name'),
				   'email'     		=> $this->session->userdata('airline_user_email'),
				   'user_id' 		=> $airline_id,
				   'user_type_id'  	=> 2
			   );
			
			//unset sign up session
			$this->session->sess_destroy();
			
			//create user session
			$this->session->set_userdata($newdata);
			
			//update user's last login date time
			$this->airline_model->update_airline_login($airline_id);
			redirect('airline/account');
		}
		
		else
		{
			$this->session->set_userdata('airline_signup3_error_message', 'Unable to add user details. Please try again');
			redirect('airline/sign-up/review');
		}
	}
}
?>