<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "account.php";

class Grades extends account {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/grades_model');
		
		//user has logged in
		if($this->login_model->check_frontend_login())
		{
		}
		
		//user has not logged in
		else
		{
			$this->session->set_userdata('front_error_message', 'Please sign up/in to continue');
				
			redirect('sign-in');
		}
	}
    
	/*
	*
	*	Open the account page
	*
	*/
	public function grade($grade_id)
	{
		if($this->session->userdata('activation_status') == 0)
		{
			if($this->session->userdata('user_level_id') == 1)
			{
				redirect('subscribe/school');
			}
			if($this->session->userdata('user_level_id') == 2)
			{
				redirect('subscribe/premier');
			}
		}
		
		else
		{
			$grade_details = $this->grades_model->get_grade_by_name($grade_id);
			$data['grade_details'] = $grade_details->row();
			
			$this->load->view('templates/grade', $data);
		}
	}
}