<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classroom extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('site_model');
		
		$this->load->library('cart');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function account() 
	{
		echo 'here';
	}
}
?>