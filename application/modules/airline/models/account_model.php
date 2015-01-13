<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model 
{	
	public function get_accouns_receivable($airlines_id)
	{
		$where = 'booking.flight_id = flight.flight_id AND booking.booking_status = 1 AND flight.airline_id = '.$airlines_id;
		$this->db->where($where);
		$this->db->select('SUM(booking_units * booking_amount) AS accounts_receivable');
		$query = $this->db->get('booking, flight');
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$accounts_receivable = $row->accounts_receivable;
			
			if(empty($accounts_receivable))
			{
				$accounts_receivable = 0;
			}
		}
		
		else
		{
			$accounts_receivable = 0;
		}
		
		return $accounts_receivable;
	}
	
	public function get_income($airlines_id)
	{
		$where = 'booking.flight_id = flight.flight_id AND booking.booking_status = 2 AND flight.airline_id = '.$airlines_id;
		$this->db->where($where);
		$this->db->select('SUM(booking_units * booking_amount) AS accounts_receivable');
		$query = $this->db->get('booking, flight');
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$accounts_receivable = $row->accounts_receivable;
			
			if(empty($accounts_receivable))
			{
				$accounts_receivable = 0;
			}
		}
		
		else
		{
			$accounts_receivable = 0;
		}
		
		return $accounts_receivable;
	}
	
	public function get_bookings($airlines_id)
	{
		$where = 'booking.flight_id = flight.flight_id AND flight.airline_id = '.$airlines_id;
		$this->db->where($where);
		$this->db->select('COUNT(booking_id) AS bookings');
		$query = $this->db->get('booking, flight');
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$bookings = $row->bookings;
			
			if(empty($bookings))
			{
				$bookings = 0;
			}
		}
		
		else
		{
			$bookings = 0;
		}
		
		return $bookings;
	}
	
	public function get_bookings_in_month($month, $airline_id, $status)
	{
		$this->db->where("MONTH(booking.booking_date) = '".$month."' AND booking.flight_id = flight.flight_id AND flight.airline_id = ".$airline_id." AND booking.booking_status = ".$status);
		return $this->db->count_all_results('booking, flight');
	}
	
	public function get_payments_in_month($month, $airline_id, $status)
	{
		$this->db->where("MONTH(booking.booking_date) = '".$month."' AND booking.flight_id = flight.flight_id AND flight.airline_id = ".$airline_id." AND booking.paid_airline = ".$status);
		
		$this->db->select('SUM(booking.booking_units * booking.booking_amount) AS total');
		$query = $this->db->get('booking, flight');
		
		$row = $query->row();
		
		return $row->total;
	}
	
	public function get_recent_bookings($airline_id)
	{
		$this->db->where("booking.visitor_id = visitor.visitor_id AND booking.flight_id = flight.flight_id AND flight.airline_id = ".$airline_id);
		$this->db->select('visitor.*, booking.booking_date, flight.flight_date, flight.flight_departure_time');
		$query = $this->db->get('booking, flight, visitor');
		
		if($query->num_rows() > 0)
		{
			$count = 0;
			$return = '<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Booking Date</th>
					<th>Flight Date</th>
					<th>Customer</th>
					<th>Phone</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>';
			
			foreach($query->result() as $res)
			{
				$count++;
				$booking_date = date('jS M Y',strtotime($res->booking_date));
				$visitor_first_name = $res->visitor_first_name;
				$visitor_last_name = $res->visitor_last_name;
				$visitor_email = $res->visitor_email;
				$visitor_phone = $res->visitor_phone;
				$flight_departure_time = date('H:i',strtotime($res->flight_departure_time));
				$flight_date = date('jS M Y',strtotime($res->flight_date));
				
				$return .= '<tr>
								<td>'.$count.'</td>
								<td>'.$booking_date.'</td>
								<td>'.$flight_date.' '.$flight_departure_time.'</td>
								<td>'.$visitor_first_name.' '.$visitor_last_name.'</td>
								<td>'.$visitor_phone.'</td>
								<td>'.$visitor_email.'</td>
							</tr>';
			}
			
			$return .= '</tbody></table>';
		}
		
		else
		{
			$return = 'There are no recent bookings';
		}
		
		return $return;
	}
	
	public function get_flight_type_totals($airline_id, $flight_type_id)
	{
		$this->db->where("flight.flight_type_id = '".$flight_type_id."' AND booking.flight_id = flight.flight_id AND flight.airline_id = ".$airline_id);
		return $this->db->count_all_results('booking, flight');
	}
	
	public function get_bank_details($airline_id)
	{
		$this->db->select('bank_name, account_name, account_number, bank_city, bank_country, swift_code');
		$this->db->where('airline_id', $airline_id);
		return $this->db->get('airline');
	}
	
	public function update_airline_bank_details($airline_id)
	{
		$data = array
		(
			'bank_name' => $this->input->post('bank_name'),
			'account_name' => $this->input->post('account_name'),
			'account_number' => $this->input->post('account_number'),
			'bank_city' => $this->input->post('bank_city'),
			'bank_country' => $this->input->post('bank_country'),
			'swift_code' => $this->input->post('swift_code'),
		);
		
		$this->db->where('airline_id', $airline_id);
		
		if($this->db->update('airline', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
}