<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airline extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('airline_model');
		$this->load->model('visitor_model');
		$this->load->library('session');
	}
    
	/*
	*
	*	Airline Signup 1
	*
	*/
	public function airline_signup1() 
	{
		
		$data['content'] = $this->load->view('airline_signup1', '', true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
		$this->load->helper('url','file','form');
		
		public function add_airline()
		{
			$this->load->model('airline_model');	
				$this->form_validation->set_rules('airline_email', 'Airline', 'required');
				$this->form_validation->set_rules('airline_phone', 'Phone', 'required');
				$this->form_validation->set_rules('airline_email', 'Email', 'required');
				$this->form_validation->set_rules('airline_summary', 'Summary', 'required');
				if ($this->form_validation->run() == FALSE)
				{
					$this->register();
				}
			else
				{
					$this->studentmodel->retrieve();
					$this->load->view('formsuccess');
					
				
				}

		}
		
	}
    
	/*
	*
	*	Airline Signup 2
	*
	*/
	public function airline_signup2() 
	{
		
		$data['content'] = $this->load->view('airline_signup2', '', true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
		$this->load->helper('url','file','form');
		
		public function add_visitor()
		{
			$this->load->model('visitor_model');	
				$this->form_validation->set_rules('visitor_first_name', 'First Name', 'required');
				$this->form_validation->set_rules('visitor_last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('visitor_email', 'Email', 'required');
				$this->form_validation->set_rules('visitor_phone', 'Phone', 'required');
				$this->form_validation->set_rules('visitor_password', 'Password', 'required');
				$this->form_validation->set_rules('visitor_password', 'Confirm Password', 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->register();
				}
			else
				{
					$this->studentmodel->retrieve();
					$this->load->view('formsuccess');
					
				
				}

		}

		
	}
    
	/*
	*
	*	Airline Signup 3
	*
	*/
	public function airline_signup3() 
	{
		
		$data['content'] = $this->load->view('airline_signup3', '', true);
		
		$data['title'] = 'Sign Up';
		$this->load->view('site/templates/general_page', $data);
		$this->load->helper('url','file','form');
	}
    
	/*
	*
	*	Airline Dashboard
	*
	*/
	public function airline_dashboard() 
	{
		
		$data['content'] = $this->load->view('dashboard', '', true);
		
		$data['title'] = 'My Account';
		$this->load->view('account_template', $data);
	}
}
?>