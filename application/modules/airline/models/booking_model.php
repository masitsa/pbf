<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model 
{
	/*
	*	Retrieve all airlines
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_bookings($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('booking.*, flight.source, flight.destination, flight.flight_seats, flight.flight_date, flight.flight_departure_time, flight.*, flight_type.flight_type_name, airline.airline_name, airline.airline_thumb, airplane_type.airplane_type_name, visitor.visitor_first_name, visitor.visitor_last_name, visitor.visitor_email, visitor.visitor_phone');
		$this->db->where($where);
		$this->db->order_by('booking_date', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	public function get_booking_payment($booking_id)
	{
		//retrieve all users
		$this->db->from('payment');
		$this->db->select('*');
		$this->db->where('booking_id = '.$booking_id);
		$this->db->order_by('booking_date', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
}