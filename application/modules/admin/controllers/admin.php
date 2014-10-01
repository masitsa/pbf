<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login/login_model');
		$this->load->model('reports_model');
		$this->load->model('users_model');
		
		//user has logged in
		if($this->login_model->check_login())
		{
		}
		
		//user has not logged in
		else
		{
			redirect('login-admin');
		}
	}
    
	/*
	*
	*	Default action is to show the dashboard
	*
	*/
	public function index() 
	{
		//echo "here";
		redirect('all-subscriptions');
	}
    
	/*
	*
	*	Login an administrator
	*
	*/
	public function admin_login() 
	{
		redirect('login/login_admin');
	}
    
	/*
	*
	*	Login an administrator
	*
	*/
	public function send_mail() 
	{
		$this->load->model('site/email_model');
		///form validation rules
		$this->form_validation->set_rules('emails', 'Email', 'required|xss_clean');
		$this->form_validation->set_rules('subject', 'Message', 'required|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
		
		$data2['success2'] = '';
		//if form has been submitted
		if ($this->form_validation->run())
		{
			
			$emails = explode(",",$_POST['emails']);
			$total = count($emails);
			
			for($r = 0; $r < $total; $r++)
			{
				$address = $emails[$r];
				//$data2['success'] .= $address.'<br/>';
				$receiver['email'] = $address;
				$receiver['name'] = 'Awesome Math';
				$sender['email'] = 'animations@awesomemath.net';//$this->input->post('email');
				$sender['name'] = 'awesomemath.NET';
				$message['subject'] = $this->input->post('subject');
				$message['text'] = $this->input->post('message');
				//check if user has valid login credentials
				if($this->email_model->send_mail($receiver, $sender, $message))
				{
					$data2['success'] = 'Your email has been successfully sent. We will get back to you as soon as possible';
					//echo 'Your email has been successfully sent. We will get back to you as soon as possible';
				}
				
				else
				{
					$data2['error'] = 'Your email could not be sent. Please try again';
					//echo 'Your email could not be sent. Please try again';
					break;
				}
			}
		}
		
		else
		{
			$data['error'] = validation_errors();
		}
		
		//open the add new grade
		$data['title'] = 'Send Email';
		$data['content'] = $this->load->view('send_mail', $data2, true);
		$this->load->view('templates/general_admin', $data);
	}
}
?>