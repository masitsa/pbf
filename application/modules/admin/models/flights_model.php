<?php

class Flights_model extends CI_Model 
{	
	/*
	*	Retrieve all active traveller types
	*
	*/
	public function get_traveller_types()
	{
		$this->db->order_by('traveller_type_name');
		$query = $this->db->get('traveller_type');
		
		return $query;
	}
	/*
	*	Retrieve all active flights
	*
	*/
	public function all_active_flights()
	{
		$this->db->where('flight_status = 1');
		$this->db->order_by('flight_date');
		$query = $this->db->get('flight');
		
		return $query;
	}
	/*
	*	Retrieve all latest flights
	*
	*/
	public function all_latest_flights()
	{
		$this->db->select('flight.*, flight_type.flight_type_name, airline.airline_name, airline.airline_thumb, airplane_type.airplane_type_name');
		$this->db->from('flight, airline, flight_type, airplane_type');
		$this->db->where('flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND flight.flight_status = 1');
		$this->db->order_by('created', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve latest flight
	*
	*/
	public function latest_flight()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('flight');
		
		return $query;
	}
	
	/*
	*	Retrieve all flights
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_flights($table, $where, $per_page, $page, $limit = NULL, $order_by = NULL, $order_method = NULL)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('flight.*, flight_type.flight_type_name, airplane_type.airplane_type_thumb3, airline.airline_name, airline.airline_thumb, airplane_type.airplane_type_name');
		$this->db->where($where);
		
		if(($order_by != NULL) && ($order_method != NULL))
		{
			$this->db->order_by($order_by, $order_method);
		}
		
		if(isset($limit))
		{
			$query = $this->db->get('', $limit);
		}
		
		else
		{
			$query = $this->db->get('', $per_page, $page);
		}
		
		return $query;
	}
	
	/*
	*	Add a new flight
	*	@param string $image_name
	*
	*/
	public function add_flight()
	{
		$data = array(
				'flight_date'=> date('Y-m-d', strtotime($this->input->post('flight_date'))),
				'flight_departure_time'=>date('H:i', strtotime($this->input->post('flight_departure_time'))),
				'flight_arrival_time'=>date('H:i', strtotime($this->input->post('flight_arrival_time'))),
				'source'=>$this->input->post('source'),
				'destination'=>$this->input->post('destination'),
				'airline_id'=>$this->session->userdata('airline_id'),
				'airplane_type_id'=>$this->input->post('airplane_type_id'),
				'flight_status'=>$this->input->post('flight_status'),
				'flight_type_id'=>$this->input->post('flight_type_id'),
				'trip_type_id'=>$this->input->post('trip_type'),
				'flight_seats'=>$this->input->post('flight_seats'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('airline_id'),
				'user_type_id'=>$this->session->userdata('user_type_id'),
				'flight_price'=>$this->input->post('flight_price'),
				'charter_plane_price'=>$this->input->post('charter_price'),
				'modified_by'=>$this->session->userdata('airline_id')
			);
		if($this->db->insert('flight', $data))
		{
			$flight_id = $this->db->insert_id();
			
			//check for charter quote email alerts
			$this->db->where('email_alert = 1 AND destination = '.$this->input->post('destination'));
			$query = $this->db->get('charter_quote');
			
			if($query->num_rows() > 0)
			{
				//get destination name
				$this->db->where('airport_id = '.$this->input->post('destination'));
				$query2 = $this->db->get('airport');
				$row = $query2->row();
				$destination = $row->airport_name;
				
				//get airline name
				$this->db->where('airline_id = '.$this->session->userdata('airline_id'));
				$query2 = $this->db->get('airline');
				$row = $query2->row();
				$airline = $row->airline_name;
				$airline_email = $row->airline_email;
				
				//send email
				$this->load->model('site/email_model');
				foreach($query->result() as $res)
				{
					$email = $res->sender_email;
					$name = $res->sender_name;
					$subject = 'Flight Alert';
					$message = '<p>You had created an alert on Private Bush Flights for flights to '.$destination.'</p>
					<p>Recently there has been a booking by '.$airline.' to this destination. Please view more details about this flight by clicking here:</p>';
					$button = '<p><a class="mcnButton " title="View flight" href="'.site_url().'flights/book-flight/'.$flight_id.'" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">View Flight</a></p>';
					$shopping = '<p>If you have any queries do not hesitate to get in touch with '.$airline.' at <a href="mailto:'.$airline_email.'">'.$airline_email.'</a> </p>';
					$sender_email = 'info@privatebushflights.com';
					$from = 'Private Bush Flights';
				
					$response = $this->email_model->send_mandrill_mail($email, $name, $subject, $message, $sender_email, $shopping, $from, $button);
					
					//var_dump($response); die();
				}
			}
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing flight
	*	@param string $image_name
	*	@param int $flight_id
	*
	*/
	public function update_flight($flight_id)
	{
		$data = array(
				'flight_date'=> date('Y-m-d', strtotime($this->input->post('flight_date'))),
				'flight_departure_time'=>date('H:i', strtotime($this->input->post('flight_departure_time'))),
				'flight_arrival_time'=>date('H:i', strtotime($this->input->post('flight_arrival_time'))),
				'source'=>$this->input->post('source'),
				'destination'=>$this->input->post('destination'),
				'airline_id'=>$this->session->userdata('airline_id'),
				'airplane_type_id'=>$this->input->post('airplane_type_id'),
				'flight_status'=>$this->input->post('flight_status'),
				'flight_type_id'=>$this->input->post('flight_type_id'),
				'trip_type_id'=>$this->input->post('trip_type'),
				'flight_seats'=>$this->input->post('flight_seats'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('airline_id'),
				'user_type_id'=>$this->session->userdata('user_type_id'),
				'flight_price'=>$this->input->post('flight_price'),
				'charter_plane_price'=>$this->input->post('charter_price'),
				'modified_by'=>$this->session->userdata('airline_id')
			);
			
		$this->db->where('flight_id', $flight_id);
		if($this->db->update('flight', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single flight's details
	*	@param int $flight_id
	*
	*/
	public function get_flight($flight_id)
	{
		//retrieve all users
		$this->db->from('flight');
		$this->db->select('*');
		$this->db->where('flight_id = '.$flight_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all flights
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_flight_details($flight_id)
	{
		$where = 'flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND flight.flight_status = 1 AND flight.flight_id = '.$flight_id;
		$table = 'flight, airline, flight_type, airplane_type';
		
		//retrieve all users
		$this->db->from($table);
		$this->db->select('flight.*, flight_type.flight_type_name, airline.airline_name, airline.airline_phone, airline.airline_email, airline.airline_summary, airline.airline_thumb, airplane_type.airplane_type_name');
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing flight
	*	@param int $flight_id
	*
	*/
	public function delete_flight($flight_id)
	{
		if($this->db->delete('flight', array('flight_id' => $flight_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated flight
	*	@param int $flight_id
	*
	*/
	public function activate_flight($flight_id)
	{
		$data = array(
				'flight_status' => 1
			);
		$this->db->where('flight_id', $flight_id);
		
		if($this->db->update('flight', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated flight
	*	@param int $flight_id
	*
	*/
	public function deactivate_flight($flight_id)
	{
		$data = array(
				'flight_status' => 0
			);
		$this->db->where('flight_id', $flight_id);
		
		if($this->db->update('flight', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get all flight types
	*
	*/
	public function get_flight_types()
	{
		//retrieve all users
		$this->db->from('get_flight_type');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_max_flight_price()
	{
		//retrieve all users
		$this->db->from('flight');
		$this->db->select('MAX(flight_price) AS max_price');
		$query = $this->db->get();
		
		$max_price = 0;
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$max_price = $row->max_price;
		}
		
		return $max_price;
	}
	
	public function get_flight_passengers($flight_id)
	{
		$this->db->select('booking_passenger.*');
		$this->db->where('booking.booking_id = booking_passenger.booking_id AND booking.flight_id = flight.flight_id AND flight.flight_id = '.$flight_id);
		$query = $this->db->get('flight, booking, booking_passenger');
		
		return $query;
	}
	
	public function export_passengers($flight_id)
	{
		$this->load->library('excel');
		
		//get flight data
		$flight_data = $this->get_flight($flight_id);
		
		$flight = $flight_data->row();
		$title = date('jS M Y',strtotime($flight->flight_date)).' Passengers';
		
		//get passengers
		$passengers_query = $this->get_flight_passengers($flight_id);
		$total_passengers = $passengers_query->num_rows();
		$passengers = '';
		
		$airports_query = $this->airports_model->all_airports();
		//get source & destination names
		if($airports_query->num_rows() > 0)
		{
			foreach($airports_query->result() as $res)
			{
				$airport_id = $res->airport_id;
				
				if($airport_id == $flight->source)
				{
					$source = $res->airport_name;
				}
				
				if($airport_id == $flight->destination)
				{
					$destination = $res->airport_name;
				}
			}
		}
		
		$count = 0;
		$row_count = 0;
		$report[$row_count][0] = 'Flight Date';
		$report[$row_count][1] = date('jS M Y',strtotime($flight->flight_date));
		$report[$row_count][4] = 'Source';
		$report[$row_count][5] = $source;
		$row_count = 1;
		$report[$row_count][0] = 'Departs at';
		$report[$row_count][1] = date('H:i',strtotime($flight->flight_departure_time));
		$report[$row_count][4] = 'Destination';
		$report[$row_count][5] = $destination;
		$row_count = 2;
		$report[$row_count][0] = 'Arrives at';
		$report[$row_count][1] = date('H:i',strtotime($flight->flight_arrival_time));
		$report[$row_count][4] = 'Total Passengers';
		$report[$row_count][5] = $flight_data->num_rows();
		$row_count = 5;
		$report[$row_count][0] = '#';
		$report[$row_count][1] = 'First Name';
		$report[$row_count][2] = 'Last Name';
		$report[$row_count][3] = 'Passport';
		$report[$row_count][4] = 'Nationality';
		
		if(empty($total_passengers))
		{
			$total_passengers = 0;
		}
		
		else
		{
			foreach($passengers_query->result() as $pas_res)
			{
				$row_count++;
				$count++;
				$passenger_fname = $pas_res->booking_passenger_first_name;
				$passenger_lname = $pas_res->booking_passenger_last_name;
				$passenger_passport = $pas_res->booking_passenger_passport;
				$passenger_nationality = $pas_res->booking_passenger_nationality;
				
				$report[$row_count][0] = $count;
				$report[$row_count][1] = $passenger_lname;
				$report[$row_count][2] = $passenger_lname;
				$report[$row_count][3] = $passenger_passport;
				$report[$row_count][4] = $passenger_nationality;
			}
		}
		
		//create the excel document
		$this->excel->addArray ($report);
		$this->excel->generateXML ($title);
	}
}
?>