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
	
	public function bank_details()
	{
		$v_data['bank_name_error'] = '';
		$v_data['account_name_error'] = '';
		$v_data['account_number_error'] = '';
		$v_data['bank_city_error'] = '';
		$v_data['bank_country_error'] = '';
		$v_data['swift_code_error'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('account_name', 'Account Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('account_number', 'Account Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bank_city', 'Branch City', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bank_country', 'Branch Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('swift_code', 'Swift Code', 'trim|xss_clean');
		
		//if form conatins valid data
		if ($this->form_validation->run())
		{
			if($this->account_model->update_airline_bank_details($this->airline_id))
			{
				$this->session->set_userdata('bank_success_message', 'Your bank details have been successfully updated');
				redirect('airline/my-bank');
			}
			
			else
			{
				$this->session->set_userdata('bank_error_message', 'Unable to add airline details. Please try again');
			}
		}
		
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['bank_name_error'] = form_error('bank_name');
				$v_data['account_name_error'] = form_error('account_name');
				$v_data['account_number_error'] = form_error('account_number');
				$v_data['bank_city_error'] = form_error('bank_city');
				$v_data['bank_country_error'] = form_error('bank_country');
				$v_data['swift_code_error'] = form_error('swift_code');
				
				//repopulate fields
				$v_data['bank_name'] = set_value('bank_name');
				$v_data['account_name'] = set_value('account_name');
				$v_data['account_number'] = set_value('account_number');
				$v_data['bank_city'] = set_value('bank_city');
				$v_data['bank_country'] = set_value('bank_country');
				$v_data['swift_code'] = set_value('swift_code');
					
				$v_data['ask_bank'] = '
					<div class="alert alert-danger">
						Please fill in the correct details
					</div>
				';
			}
			
			//populate form data on initial load of page
			else
			{
				$bank_details = $this->account_model->get_bank_details($this->airline_id);
				
				if($bank_details->num_rows() > 0)
				{
					$row = $bank_details->row();
					
					$v_data['bank_name'] = $row->bank_name;
					$v_data['account_name'] = $row->account_name;
					$v_data['account_number'] = $row->account_number;
					$v_data['bank_city'] = $row->bank_city;
					$v_data['bank_country'] = $row->bank_country;
					$v_data['swift_code'] = $row->swift_code;
					
					if(!empty($v_data['bank_name']))
					{
						$v_data['ask_bank'] = '
							<div class="alert alert-success">
								You can update your bank details
							</div>
						';
					}
					
					else
					{
						$v_data['ask_bank'] = '
							<div class="alert alert-danger">
								Please enter your bank details
							</div>
						';
					}
				}
				
				else
				{
					$v_data['bank_name'] = '';
					$v_data['account_name'] = '';
					$v_data['account_number'] = '';
					$v_data['bank_city'] = '';
					$v_data['bank_country'] = '';
					$v_data['swift_code'] = '';
				}
			}
		}
		
		$data['title'] = 'Bank Details';
		$v_data['title'] = 'Bank Details';
		$data['content'] = $this->load->view('payments/bank_details', $v_data, true);
		
		$this->load->view('account_template', $data);
	}
	
	public function payments()
	{
		$result['empty_leg'] = $this->account_model->get_flight_type_totals($airline_id, 1);
		$result['exclusive_charter'] = $this->account_model->get_flight_type_totals($airline_id, 3);
		$result['private_plane'] = $this->account_model->get_flight_type_totals($airline_id, 4);
		
		echo json_encode($result);
	}
}