<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller 
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