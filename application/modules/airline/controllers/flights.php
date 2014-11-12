<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/airline/controllers/account.php";

class Flights extends account 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('admin/flights_model');
		$this->load->model('admin/airplane_types_model');
		$this->load->model('admin/flight_types_model');
		$this->load->model('admin/airports_model');
	}
    
	/*
	*
	*	Default action is to show all the registered flights
	*
	*/
	public function index() 
	{
		$where = 'flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id';
		$table = 'flight, airline, flight_type, airplane_type';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'airline/all-flights';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->flights_model->get_all_flights($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['title'] = 'All Flights';
			$v_data['airports_query'] = $this->airports_model->all_airports();
			$data['content'] = $this->load->view('flights/all_flights', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'There are no flights';
		}
		$data['title'] = 'All Flight Types';
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Add a new flight
	*
	*/
	public function add_flight() 
	{
		//form validation rules
		$this->form_validation->set_rules('flight_date', 'Departure Date', 'required|xss_clean');
		$this->form_validation->set_rules('flight_departure_time', 'Departure Time', 'required|xss_clean');
		$this->form_validation->set_rules('flight_arrival_time', 'Arrival Time', 'required|xss_clean');
		$this->form_validation->set_rules('flight_type_id', 'Flight Type', 'required|xss_clean');
		$this->form_validation->set_rules('source', 'Source', 'required|xss_clean');
		$this->form_validation->set_rules('destination', 'Destination', 'required|xss_clean');
		$this->form_validation->set_rules('airplane_type_id', 'Airplane Type', 'required|xss_clean');
		$this->form_validation->set_rules('flight_status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('trip_type', 'Trip Type', 'required|xss_clean');
		$this->form_validation->set_rules('flight_price', 'Flight Price', 'required|xss_clean');
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->flights_model->add_flight())
			{
				$this->session->set_userdata('success_message', 'Flight added successfully');
				redirect('airline/add-flight');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add flight. Please try again');
			}
		}
		
		//open the add new flight
		$data['title'] = 'Add New Flight';
		$v_data['title'] = 'Add New Flight';
		$v_data['airports_query'] = $this->airports_model->all_active_airports();
		$v_data['trip_type_query'] = $this->airports_model->all_trip_type_query();
		$v_data['flight_type_query'] = $this->flight_types_model->all_active_flight_types();
		$v_data['airplane_type_query'] = $this->airplane_types_model->all_active_airplane_types();
		$data['content'] = $this->load->view('flights/add_flight', $v_data, true);
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Edit an existing flight
	*	@param int $flight_id
	*
	*/
	public function edit_flight($flight_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('flight_date', 'Departure Date', 'required|xss_clean');
		$this->form_validation->set_rules('flight_departure_time', 'Departure Time', 'required|xss_clean');
		$this->form_validation->set_rules('flight_arrival_time', 'Arrival Time', 'required|xss_clean');
		$this->form_validation->set_rules('flight_type_id', 'Flight Type', 'required|xss_clean');
		$this->form_validation->set_rules('source', 'Source', 'required|xss_clean');
		$this->form_validation->set_rules('destination', 'Destination', 'required|xss_clean');
		$this->form_validation->set_rules('airplane_type_id', 'Airplane Type', 'required|xss_clean');
		$this->form_validation->set_rules('flight_status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('trip_type', 'Trip Type', 'required|xss_clean');
		$this->form_validation->set_rules('flight_price', 'Flight Price', 'required|xss_clean');
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update flight
			if($this->flights_model->update_flight($flight_id))
			{
				$this->session->set_userdata('success_message', 'Flight type edited successfully');
				redirect('airline/edit-flight/'.$flight_id);
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not edit flight. Please try again');
			}
		}
		
		//open the add new flight
		$data['title'] = 'Edit Flight Type';
		
		//select the flight from the database
		$query = $this->flights_model->get_flight($flight_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['flight'] = $query->result();

			$data['title'] = 'Add New Flight';
			$v_data['title'] = 'Add New Flight';
			$v_data['airports_query'] = $this->airports_model->all_active_airports();
			$v_data['trip_type_query'] = $this->airports_model->all_trip_type_query();
			$v_data['flight_type_query'] = $this->flight_types_model->all_active_flight_types();
			$v_data['airplane_type_query'] = $this->airplane_types_model->all_active_airplane_types();
			
			$data['content'] = $this->load->view('flights/edit_flight', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Flight type does not exist';
		}
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Delete an existing flight
	*	@param int $flight_id
	*
	*/
	public function delete_flight($flight_id, $page)
	{
		if($this->flights_model->delete_flight($flight_id))
		{
			$this->session->set_userdata('success_message', 'Flight Type has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Flight Type could not be deleted');
		}
		redirect('airline/all-flights/'.$page);
	}
    
	/*
	*
	*	Activate an existing flight
	*	@param int $flight_id
	*
	*/
	public function activate_flight($flight_id, $page)
	{
		if($this->flights_model->activate_flight($flight_id))
		{
			$this->session->set_userdata('success_message', 'Flight Type has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Flight Type could not be activated');
		}
		redirect('airline/all-flights/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing flight
	*	@param int $flight_id
	*
	*/
	public function deactivate_flight($flight_id, $page)
	{
		if($this->flights_model->deactivate_flight($flight_id))
		{
			$this->session->set_userdata('success_message', 'Flight Type has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Flight Type could not be disabled');
		}
		redirect('airline/all-flights/'.$page);
	}
}
?>