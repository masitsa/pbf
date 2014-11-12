<?php

class Flights_model extends CI_Model 
{	
	/*
	*	Retrieve all active flights
	*
	*/
	public function all_active_flights()
	{
		$this->db->where('flight_status = 1');
		$query = $this->db->get('flight');
		
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
	public function get_all_flights($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('flight.*, flight_type.flight_type_name, airline.airline_name, airplane_type.airplane_type_name');
		$this->db->where($where);
		$this->db->order_by('flight_date, source, destination, flight_departure_time, flight_arrival_time');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new flight
	*	@param string $image_name
	*
	*/
	public function add_flight($flight_logo, $flight_thumb)
	{
		$data = array(
				'flight_date'=>$this->input->post('flight_date'),
				'flight_departure_time'=>$this->input->post('flight_departure_time'),
				'flight_arrival_time'=>$this->input->post('flight_arrival_time'),
				'source'=>$this->input->post('source'),
				'destination'=>$this->input->post('destination'),
				'airplane_type_id'=>$this->input->post('airplane_type_id'),
				'flight_status'=>$this->input->post('flight_status'),
				'flight_type_id'=>$this->input->post('flight_type_id'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'user_type_id'=>$this->session->userdata('user_type_id'),
				'modified_by'=>$this->session->userdata('user_id')
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
				'flight_first_name'=>ucwords(strtolower($this->input->post('flight_first_name'))),
				'flight_last_name'=>ucwords(strtolower($this->input->post('flight_last_name'))),
				'flight_phone'=>$this->input->post('flight_phone'),
				'flight_email'=>$this->input->post('flight_email'),
				'flight_status'=>$this->input->post('flight_status'),
				'flight_type_id'=>$this->input->post('flight_type_id')
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