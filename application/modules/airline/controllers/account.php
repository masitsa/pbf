<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once "./application/modules/auth/controllers/auth.php";

class Account extends auth 
{
	var $airlines_path;
	var $airlines_location;
	var $airline_id;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('airline_model');
		$this->load->model('account_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->airlines_path = realpath(APPPATH . '../assets/images/airlines');
		$this->airlines_location = base_url().'assets/images/airlines/';
		$this->airline_id = $this->session->userdata('airline_id');
	}
    
	/*
	*
	*	Airline Dashboard
	*
	*/
	public function index() 
	{
		$v_data['recent_bookings'] = $this->account_model->get_recent_bookings($this->airline_id);
		
		$data['content'] = $this->load->view('dashboard', $v_data, true);
		
		$data['title'] = 'My Account';
		$this->load->view('account_template', $data);
	}
	
	public function get_bookings_in_month($month, $airline_id)
	{
		$result['pending_bookings'] = $this->account_model->get_bookings_in_month($month, $airline_id, 0);
		$result['approved_bookings'] = $this->account_model->get_bookings_in_month($month, $airline_id, 1);
		$result['disapproved_bookings'] = $this->account_model->get_bookings_in_month($month, $airline_id, 2);
		
		echo json_encode($result);
	}
	
	public function get_payments_in_month($month, $airline_id)
	{
		$result['pending_payments'] = $this->account_model->get_payments_in_month($month, $airline_id, 0);
		$result['received_payments'] = $this->account_model->get_payments_in_month($month, $airline_id, 1);
		
		echo json_encode($result);
	}
	
	public function get_flight_type_totals($airline_id)
	{
		$result['empty_leg'] = $this->account_model->get_flight_type_totals($airline_id, 1);
		$result['exclusive_charter'] = $this->account_model->get_flight_type_totals($airline_id, 3);
		$result['private_plane'] = $this->account_model->get_flight_type_totals($airline_id, 4);
		
		echo json_encode($result);
	}
}