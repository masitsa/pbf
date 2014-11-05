<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller 
{
	var $airlines_path;
	var $airlines_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login/login_model');
		
		//user has logged in
		if($this->login_model->check_login())
		{
		}
		
		//user has not logged in
		else
		{
			//redirect('login-airline');
		}
	}
    
	/*
	*
	*	Airline Dashboard
	*
	*/
	public function index() 
	{
		
		$data['content'] = $this->load->view('dashboard', '', true);
		
		$data['title'] = 'My Account';
		$this->load->view('account_template', $data);
	}
}