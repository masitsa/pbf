<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller 
{
	var $airlines_location;
	var $airplane_types_image_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('admin/airports_model');
		$this->load->model('admin/flights_model');
		$this->load->model('admin/flight_types_model');
		$this->load->model('admin/airlines_model');
		$this->load->model('admin/airplane_types_model');
		$this->load->model('site_model');
		
		$this->load->library('cart');
		$this->airlines_location = base_url().'assets/images/airlines/';
		$this->airplane_types_image_path = base_url().'/assets/images/airplane_types/';
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		redirect('home');
	}
	public function left_navigation() 
	{
		$this->load->view('products/left_navigation');
	}
    
	/*
	*
	*	Home Page
	*
	*/
	public function home_page() 
	{
		//get page data
		$v_data['airplane_types'] = $this->airplane_types_model->all_active_airplane_types();
		$v_data['active_airports'] = $this->airports_model->all_active_airports();
		$v_data['active_airlines'] = $this->airlines_model->all_active_airlines();
		$v_data['active_flight_types'] = $this->flight_types_model->all_active_flight_types();
		$v_data['active_trip_types'] = $this->flight_types_model->all_active_trip_types();
		$v_data['latest_flights'] = $this->flights_model->all_latest_flights();
		$v_data['airline_logo_location'] = $this->airlines_location;
		$v_data['airports_query'] = $this->airports_model->all_active_airports();
		
		$data['content'] = $this->load->view('home/home', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Filter products by brand
	*
	*/
	public function filter_brands()
	{
		$total_brands = sizeof($_POST['brand']);
		
		//check if any checkboxes have been ticked
		if($total_brands > 0)
		{
			$brands = '';
			
			for($r = 0; $r < $total_brands; $r++){
				
				$brand = $_POST['brand'];
				$brand_id = $brand[$r]; 
				
				if($r == 0)
				{
					$brands .= $brand_id;
				}
				
				else
				{
					$brands .= '-'.$brand_id;
				}
			}
			redirect('products/filter-brands/'.$brands);
		}
		
		else
		{
			redirect('products/all-products');
		}
	}
    
	/*
	*
	*	Flights Page
	*
	*/
	public function flights($search = '__', $airline_id = 0, $airport_id = 0, $order_by = 'created', $price_range = '__') 
	{
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		$v_data['price_range'] = $this->site_model->generate_price_range();
		
		//$where = 'flight.flight_date > \''.date('Y-m-d').'\' AND flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND flight.flight_status = 1';
		$where = 'flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND flight.flight_status = 1';
		$table = 'flight, airline, flight_type, airplane_type';
		
		$limit = NULL;
		$order = '';
		
		//ordering products
		switch ($order_by)
		{
			case 'created':
				$order_method = 'DESC';
				$order = 'flight_date, source, destination, flight_departure_time, flight_arrival_time';
			break;
			
			case 'price':
				$order_method = 'ASC';
				$order = 'flight_price, flight_date, source, destination, flight_departure_time, flight_arrival_time';
			break;
			
			case 'price_desc':
				$order_method = 'DESC';
				$order = 'flight_price, flight_date, source, destination, flight_departure_time, flight_arrival_time';
			break;
		}
		
		//case of price_range
		if($price_range != '__')
		{
			$range = explode("-", $price_range);
			$total = count($range);
			
			if($total == 2)
			{
				$start = $range[0];
				$end = $range[1];
				$where .= " AND (flight.flight_price BETWEEN ".$start." AND ".$end.")";
			}
		}
		
		//case of search
		if($search != '__')
		{
			//$table .= ', airport';
			//$where .= " AND flight.destination = airport.airport_id AND (airport.airport_name LIKE '%".$search."%' OR airline.airline_name LIKE '%".$search."%')";
			$where .= $search;
		}
		
		//case of airline
		if($airline_id > 0)
		{
			$where .= ' AND (airline.airline_id = '.$airline_id.')';
		}
		
		//case of airport
		if($airport_id > 0)
		{
			$where .= ' AND flight.destination = '.$airport_id;
		}
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'flights';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = 5;
		$config['per_page'] = 21;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		if($limit == NULL)
		{
        	$v_data["links"] = $this->pagination->create_links();
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			
			if($v_data["total"] < $config["per_page"])
			{
				$v_data["last"] = $page + $v_data["total"];
			}
			
			else
			{
				$v_data["last"] = $page + $config["per_page"];
			}
		}
		
		else
		{
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			$v_data["last"] = $config['total_rows'];
		}
		$v_data['products'] = $this->flights_model->get_all_flights($table, $where, $config["per_page"], $page, $limit, $order, $order_method);
		$v_data['airports_query'] = $this->airports_model->all_active_airports();
		$v_data['airplane_types_image_path'] = $this->airplane_types_image_path;
		$v_data['airline_logo_location'] = $this->airlines_location;
		
		$data['content'] = $this->load->view('products/products', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Search for a flight
	*
	*/
	public function search()
	{
		$this->form_validation->set_rules('search_item', 'Search Criteria', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->flights();
		}
		
		else
		{
			$search = $this->input->post('search_item');
			
			redirect('flights/search/'.$search);
		}
	}
    
	/*
	*
	*	Search for a flight from home page
	*
	*/
	public function search_flights()
	{
		$source = $this->input->post('source');
		$destination = $this->input->post('destination');
		$airline_id = $this->input->post('airline_id');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$trip_type_id = $this->input->post('trip_type_id');
		$sort_by = $this->input->post('sort_by');
		
		//flight date range
		if(!empty($date_from) && !empty($date_to))
		{
			$date = ' AND flight.flight_date BETWEEN \''.date('Y-m-d', strtotime($date_from)).'\' AND \''.date('Y-m-d', strtotime($date_to)).'\'';
		}
		
		else if(!empty($date_from))
		{
			$date = ' AND flight.flight_date = \''.date('Y-m-d', strtotime($date_from)).'\'';
		}
		
		else if(!empty($date_to))
		{
			$date = ' AND flight.flight_date = \''.date('Y-m-d', strtotime($date_to)).'\'';
		}
		
		else
		{
			$date = '';
		}
		
		//source
		if(!empty($source))
		{
			$source = ' AND flight.source = '.$source;
		}
		
		//destination
		if(!empty($destination))
		{
			$destination = ' AND flight.destination = '.$destination;
		}
		
		//airline
		if(!empty($airline_id))
		{
			$airline_id = ' AND flight.airline_id = '.$airline_id;
		}
		
		//trip type
		if(!empty($trip_type_id))
		{
			$trip_type_id = ' AND flight.trip_type_id = '.$trip_type_id;
		}
		
		$search = $date.$source.$destination.$airline_id.$trip_type_id;
		
		$this->flights($search, 0, 0, $sort_by);
	}
	
	public function search_flight_types($flight_type_id)
	{
		$flight_type_id = ' AND flight.flight_type_id = '.$flight_type_id;
		
		$search = $flight_type_id;
		
		$this->flights($search);
	}
    
	/*
	*
	*	Booking Page
	*
	*/
	public function book_flight($flight_id)
	{
		$v_data['traveller_types'] = $this->flights_model->get_traveller_types();
		$v_data['flight'] = $this->flights_model->get_flight_details($flight_id);
		$v_data['airports_query'] = $this->airports_model->all_active_airports();
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		$v_data['price_range'] = $this->site_model->generate_price_range();
		$v_data['flight_id'] = $flight_id;
		$v_data['airline_logo_location'] = $this->airlines_location;
		$v_data['payments_error'] = '';
		$flight_data = $v_data['flight']->row();
		$seats_sold = $this->site_model->calculate_seats_sold($flight_id);
		$available_seats = ($flight_data->flight_seats - $seats_sold);
		$v_data['available_seats'] = $available_seats;
		
		$v_data['iframe'] = '';
		
		//form validation rules
		$this->form_validation->set_rules('amount', 'Amount', 'required|xss_clean');
		$this->form_validation->set_rules('type', 'Type', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
		$this->form_validation->set_rules('traveller_type_id', 'Traveller Type', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|xss_clean');
		$this->form_validation->set_rules('seats', 'Seat', 'less_than_equal['.$available_seats.']|required|xss_clean');
		$this->form_validation->set_rules('additional_info', 'Additional Information', 'required|xss_clean');
		$this->form_validation->set_rules('terms_agree', 'Terms & Conditions', 'required');
		$this->form_validation->set_message('less_than_equal', 'Must contain not more than '.$available_seats.' seats');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$this->load->model('payments_model');
			if ($_POST['seats'] == 0)
			{
				$v_data['payments_error'] = "there are no seats available";
			}else
			{
				$iframe = $this->payments_model->make_pesapal_payment($flight_id);
				$v_data['iframe'] = $iframe;
			}
			
			
		}
		
		else
		{
			$v_data['payments_error'] = validation_errors();
		}
		
		$data['content'] = $this->load->view('products/payments', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Payment success Page
	*
	*/
	public function payment()
	{
		//mark booking as paid in the database
		$payment_data = $this->input->get();
		$transaction_tracking_id = $payment_data['pesapal_transaction_tracking_id'];
		$booking_id = $payment_data['pesapal_merchant_reference'];
		
		if($this->site_model->update_booking($transaction_tracking_id, $booking_id))
		{
			redirect('flight/payment');
		}
	}
	
	public function payment_success()
	{
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		$v_data['price_range'] = $this->site_model->generate_price_range();
		
		$data['content'] = $this->load->view('products/payment_success', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function terms()
	{
		
		$data['content'] = $this->load->view('terms', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function about()
	{
		
		$data['content'] = $this->load->view('about', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function faqs()
	{
		
		$data['content'] = $this->load->view('faqs', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function send_comment($airline_id)
	{
		$message = $this->input->post('message');
		
		$response = $this->vendor_model->send_account_verification_email($this->session->userdata('vendor_email'), $this->session->userdata('vendor_first_name'), $this->session->userdata('vendor_store_email'));
	}
    
	/*
	*
	*	Booking Page
	*
	*/
	public function contact_airline($flight_id)
	{	
		//form validation rules
		$this->form_validation->set_rules('sender_name', 'Your Name', 'required|xss_clean');
		$this->form_validation->set_rules('sender_email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('sender_phone', 'phone', 'xss_clean');
		$this->form_validation->set_rules('airline_message', 'Message', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$message = $this->input->post('message');
			
			$response = $this->vendor_model->send_account_verification_email($this->input->post('vendor_email'), $this->input->post('vendor_first_name'), $this->input->post('vendor_store_email'));
		}
		
		else
		{
			$this->session->set_userdata('contact_error', validation_errors());
			
			redirect('flights/book-flight/'.$flight_id);
		}
	}
	
	public function set_passengers($seats, $available_seats)
	{
		$data['seats'] = $seats;
		$data['available_seats'] = $available_seats;
		echo $this->load->view('products/passengers', $data, TRUE);
	}
	
	public function charter_quote() 
	{
		$v_data['airplane_types'] = $this->airplane_types_model->all_active_airplane_types();
		$v_data['active_airports'] = $this->airports_model->all_active_airports();
		$v_data['active_airlines'] = $this->airlines_model->all_active_airlines();
		$v_data['active_flight_types'] = $this->flight_types_model->all_active_flight_types();
		$v_data['active_trip_types'] = $this->flight_types_model->all_active_trip_types();
		$v_data['latest_flights'] = $this->flights_model->all_latest_flights();
		
		//initialize required variables
		$v_data['destination'] = '';
		$v_data['source'] = '';
		$v_data['date_from'] = '';
		$v_data['passengers'] = '';
		$v_data['airplane_type_id'] = '';
		$v_data['date_to'] = '';
		$v_data['trip_type_id'] = '';
		$v_data['sender_name'] = '';
		$v_data['sender_email'] = '';
		$v_data['sender_phone'] = '';
		$v_data['description'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('destination', 'Destination', 'trim|required|xss_clean');
		$this->form_validation->set_rules('source', 'Source', 'trim|xss_clean');
		//$this->form_validation->set_rules('airline_id', 'Airline', 'trim|xss_clean');
		$this->form_validation->set_rules('date_from', 'Departure Date', 'trim|xss_clean');
		$this->form_validation->set_rules('date_to', 'Arrival Date', 'trim|xss_clean');
		$this->form_validation->set_rules('trip_type_id', 'Trip Type', 'trim|xss_clean');
		$this->form_validation->set_rules('airplane_type_id', 'Plane Type', 'trim|numeric|xss_clean');
		$this->form_validation->set_rules('passengers', 'Passengers', 'trim|numeric|xss_clean');
		
		$this->form_validation->set_rules('sender_name', 'Your Name', 'required|xss_clean');
		$this->form_validation->set_rules('sender_email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('sender_phone', 'phone', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->site_model->save_charter_quote())
			{
				$this->session->set_userdata('charter_quote_success_message', 'Your  charter quote has been sent. We will get back to you in no more than 3 hours');
			}
			
			else
			{
				$this->session->set_userdata('charter_quote_error_message', 'Unable to add airline details. Please try again');
			}
			
			redirect('charter');
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['destination_error'] = form_error('destination');
				$v_data['sender_name_error'] = form_error('sender_name');
				$v_data['sender_email_error'] = form_error('sender_email');
				$v_data['sender_phone_error'] = form_error('sender_phone');
				$v_data['description_error'] = form_error('description');
				
				//repopulate fields
				$v_data['destination'] = set_value('destination');
				$v_data['source'] = set_value('source');
				$v_data['airplane_type_id'] = set_value('airplane_type_id');
				$v_data['trip_type_id'] = set_value('trip_type_id');
				$v_data['date_from'] = set_value('date_from');
				$v_data['date_to'] = set_value('date_to');
				$v_data['trip_type_id'] = set_value('trip_type_id');
				$v_data['sender_name'] = set_value('sender_name');
				$v_data['sender_email'] = set_value('sender_email');
				$v_data['sender_phone'] = set_value('sender_phone');
				$v_data['description'] = set_value('description');
			}
		}
		
		$data['content'] = $this->load->view('charter_quote', $v_data, true);
		
		$data['title'] = 'Charter Quotes';
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function charter_quote2() 
	{
		$v_data['airplane_types'] = $this->airplane_types_model->all_active_airplane_types();
		$v_data['active_airports'] = $this->airports_model->all_active_airports();
		$v_data['active_airlines'] = $this->airlines_model->all_active_airlines();
		$v_data['active_flight_types'] = $this->flight_types_model->all_active_flight_types();
		$v_data['active_trip_types'] = $this->flight_types_model->all_active_trip_types();
		$v_data['latest_flights'] = $this->flights_model->all_latest_flights();
		
		//initialize required variables
		$v_data['destination'] = $this->input->post('destination');
		$v_data['source'] = $this->input->post('source');
		//$v_data['airline_id'] = $this->input->post('destination');
		$v_data['date_from'] = $this->input->post('date_from');
		$v_data['date_to'] = '';
		$v_data['passengers'] = $this->input->post('passengers');
		$v_data['airplane_type_id'] = $this->input->post('airplane_type_id');
		$v_data['trip_type_id'] = $this->input->post('trip_type_id');
		$v_data['sender_name'] = '';
		$v_data['sender_email'] = '';
		$v_data['sender_phone'] = '';
		$v_data['description'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('destination', 'Destination', 'trim|required|xss_clean');
		$this->form_validation->set_rules('source', 'Source', 'trim|xss_clean');
		//$this->form_validation->set_rules('airline_id', 'Airline', 'trim|xss_clean');
		$this->form_validation->set_rules('date_from', 'Departure Date', 'trim|xss_clean');
		$this->form_validation->set_rules('date_to', 'Arrival Date', 'trim|xss_clean');
		$this->form_validation->set_rules('trip_type_id', 'Trip Type', 'trim|xss_clean');
		$this->form_validation->set_rules('airplane_type_id', 'Plane Type', 'trim|numeric|xss_clean');
		$this->form_validation->set_rules('passengers', 'Passengers', 'trim|numeric|xss_clean');
		
		$this->form_validation->set_rules('sender_name', 'Your Name', 'required|xss_clean');
		$this->form_validation->set_rules('sender_email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('sender_phone', 'phone', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->site_model->save_charter_quote())
			{
				$this->session->set_userdata('charter_quote_success_message', 'Your  charter quote has been sent. We will get back to you in no more than 3 hours');
			}
			
			else
			{
				$this->session->set_userdata('charter_quote_error_message', 'Unable to add airline details. Please try again');
			}
			
			redirect('charter');
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['destination_error'] = form_error('destination');
				$v_data['sender_name_error'] = form_error('sender_name');
				$v_data['sender_email_error'] = form_error('sender_email');
				$v_data['sender_phone_error'] = form_error('sender_phone');
				$v_data['description_error'] = form_error('description');
				
				//repopulate fields
				$v_data['destination'] = set_value('destination');
				$v_data['source'] = set_value('source');
				$v_data['airplane_type_id'] = set_value('airplane_type_id');
				$v_data['passengers'] = set_value('passengers');
				$v_data['date_from'] = set_value('date_from');
				$v_data['date_to'] = set_value('date_to');
				$v_data['trip_type_id'] = set_value('trip_type_id');
				$v_data['sender_name'] = set_value('sender_name');
				$v_data['sender_email'] = set_value('sender_email');
				$v_data['sender_phone'] = set_value('sender_phone');
				$v_data['description'] = set_value('description');
			}
		}
		
		$data['content'] = $this->load->view('charter_quote', $v_data, true);
		
		$data['title'] = 'Charter Quotes';
		$this->load->view('site/templates/general_page', $data);
	}
	public function contact() 
	{
		
		$data['content'] = $this->load->view('contact_us', '' , true);
		
		$data['title'] = 'Contact Us';
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function forgot_password()
	{
		$this->form_validation->set_rules('your_email', 'Email', 'required|valid_email|exists[airline.airline_user_email]|xss_clean');
		$this->form_validation->set_message('exists', 'This email has not been registered. Please <a href="'.site_url().'airline/sign-up/airline-details">Sign up</a>');
		    
		if($this->form_validation->run())
		{
			$result = md5(date("Y-m-d H:i:s"));
			$pwd2 = substr($result, 0, 6);
			
			$pwd = md5($pwd2);
		}
		
		else
		{
		}
	}
}
?>