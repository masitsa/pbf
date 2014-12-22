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
		$this->db->select('flight.*, flight_type.flight_type_name, airline.airline_name, airline.airline_thumb, airplane_type.airplane_type_name');
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
}
?>