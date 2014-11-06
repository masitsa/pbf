<?php

class Login_model extends CI_Model 
{
	/*
	*	Check if user has logged in
	*
	*/
	public function check_login()
	{
		if($this->session->userdata('login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
<<<<<<< HEAD
	/*
	*	Check if user has logged in
	*
	*/
	public function check_frontend_login()
	{
		if($this->session->userdata('front_login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
=======
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
	
	/*
	*	Validate a user's login request
	*
	*/
	public function validate_user()
	{
		//select the user by email from the database
		$this->db->select('*');
<<<<<<< HEAD
		$this->db->where(array('email' => $this->input->post('email'), 'user_status_id' => 1, 'user_type_id' => 0, 'password' => md5($this->input->post('password'))));
		$query = $this->db->get('user');
		
		//if user exists
=======
		$this->db->where(array('email' => $this->input->post('email'), 'activated' => 1, 'password' => md5($this->input->post('password'))));
		$query = $this->db->get('users');
		
		//if users exists
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			//create user's login session
			$newdata = array(
                   'login_status'     => TRUE,
<<<<<<< HEAD
                   'first_name'     => $result[0]->user_fname,
                   'email'     => $result[0]->email,
                   'user_id'  => $result[0]->user_id,
                   'user_level_id'  => $result[0]->user_type_id
=======
                   'first_name'     => $result[0]->first_name,
                   'email'     => $result[0]->email,
                   'user_id'  => $result[0]->user_id,
                   'user_type_id'  => 3
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
               );

			$this->session->set_userdata($newdata);
			
			//update user's last login date time
			$this->update_user_login($result[0]->user_id);
			return TRUE;
		}
		
		//if user doesn't exist
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update user's last login date
	*
	*/
	private function update_user_login($user_id)
	{
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('user_id', $user_id);
<<<<<<< HEAD
		$this->db->update('user', $data); 
=======
		$this->db->update('users', $data); 
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
	}
	
	/*
	*	Reset a user's password
	*
	*/
	public function reset_password($user_id)
	{
		$new_password = substr(md5(date('Y-m-d H:i:s')), 0, 6);
		
		$data['password'] = md5($new_password);
		$this->db->where('user_id', $user_id);
<<<<<<< HEAD
		$this->db->update('user', $data); 
=======
		$this->db->update('users', $data); 
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
		
		return $new_password;
	}
	
<<<<<<< HEAD
	/*
	*	Validate a user's login request
	*
	*/
	public function validate_frontend_user()
	{
		//select the user by email from the database
		$this->db->select('*');
		$this->db->where(array('email' => $this->input->post('email'), 'user_status_id' => 1, 'user_type_id > ' => 0, 'password' => md5($this->input->post('password'))));
		$query = $this->db->get('user');
		
		//if user exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
			$user_id = $result[0]->user_id;
			
			//validate session
			if(!$this->validate_single_session($user_id))
			{
				//update db session with user_id
				$data = array(
					   'user_id'     => $user_id
				   );
				$this->db->where('session_id', $this->session->userdata('session_id'));
				$this->db->update('ci_sessions', $data);
				
				//create user's login session
				$newdata = array(
					   'front_login_status'     => TRUE,
					   'second_platform'     => FALSE,
					   'first_name'     => $result[0]->user_fname,
					   'email'     => $result[0]->email,
					   'user_id'  => $result[0]->user_id,
					   'activation_status'  => $result[0]->activation_status,
					   'user_level_id'  => $result[0]->user_type_id
				   );
	
				$this->session->set_userdata($newdata);
				
				//update user's last login date time
				$this->update_user_login($result[0]->user_id);
				return TRUE;
			}
			
			else
			{
				$this->session->set_userdata('login_error', 'This email has already signed in. Please use a different email or sign up');
				return FALSE;
			}
		}
		
		//if user doesn't exist
		else
		{
			//could be request for secondary platform
			$this->db->select('*');
			$this->db->where(array('username' => $this->input->post('email'), 'user_status_id' => 1, 'user_type_id' => 1, 'password' => md5($this->input->post('password'))));
			$query = $this->db->get('user');
			
			//if user exists
			if ($query->num_rows() > 0)
			{
				$result = $query->result();
				
				$user_id = $result[0]->user_id;
				
				//update db session with user_id
				$data = array(
					   'user_id'     => $user_id
				   );
				$this->db->where('session_id', $this->session->userdata('session_id'));
				$this->db->update('ci_sessions', $data);
				
				//create user's login session
				$newdata = array(
					   'front_login_status'     => TRUE,
					   'second_platform'     => TRUE,
					   'first_name'     => $result[0]->user_fname,
					   'email'     => $result[0]->email,
					   'user_id'  => $result[0]->user_id,
					   'activation_status'  => $result[0]->activation_status,
					   'user_level_id'  => $result[0]->user_type_id
				   );
	
				$this->session->set_userdata($newdata);
				
				//update user's last login date time
				$this->update_user_login($result[0]->user_id);
				return TRUE;
			}
			
			else
			{
				$this->session->set_userdata('login_error', 'Your email or password is incorrect. Please try again');
				return FALSE;
			}
		}
	}
	
	public function validate_single_session($user_id)
	{
		if(!$this->session->userdata('front_login_status'))
		{
			//select session of user
			$this->db->select('last_activity, ip_address');
			$this->db->where(array('user_id' => $user_id));
			$query = $this->db->get('ci_sessions');
			
			//if session exists
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				
				$last_activity = $row->last_activity;
				$ip_address = $row->ip_address;
				$timeout = $this->config->item('sess_expiration');
				
				$difference = $this->time_difference($last_activity);
				
				//same user on the same IP
				if(($difference <= $timeout) && ($ip_address == $this->input->ip_address()))
				{
					return FALSE;
				}
				
				//user on a different IP
				else if(($difference <= $timeout) && ($ip_address != $this->input->ip_address()))
				{
					return TRUE;
				}
				
				else
				{
					return FALSE;
				}
			}
			
			else
			{
				return FALSE;
			}
		}
		
		else
		{
			return FALSE;
		}
	}
	
	function time_difference($unix_timestamp)
	{
		$current_time = time();
		
		$difference = $current_time - $unix_timestamp;
		
		return $difference;
	}
	
	/*
	*	Validate a user's login request
	*
	*/
	public function validate_school_user()
	{
		//select the user by email from the database
		$this->db->select('*');
		$this->db->where(array('school_email' => $this->input->post('school_email'), 'user_status_id' => 1, 'user_type_id ' => 1, 'password' => md5($this->input->post('password'))));
		$query = $this->db->get('user');
		
		//if user exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
			$user_id = $result[0]->user_id;
			
			//validate session
			if(!$this->validate_single_session($user_id))
			{
				//update db session with user_id
				$data = array(
					   'user_id'     => $user_id
				   );
				$this->db->where('session_id', $this->session->userdata('session_id'));
				$this->db->update('ci_sessions', $data);
				
				//create user's login session
				$newdata = array(
					   'front_login_status'     => TRUE,
					   'first_name'     => $result[0]->school_name,
					   'email'     => $result[0]->school_email,
					   'user_id'  => $result[0]->user_id,
					   'activation_status'  => $result[0]->activation_status,
					   'user_level_id'  => $result[0]->user_type_id
				   );
	
				$this->session->set_userdata($newdata);
				
				//update user's last login date time
				$this->update_user_login($result[0]->user_id);
				return TRUE;
			}
			
			else
			{
				$this->session->set_userdata('login_error', 'This email has already signed in. Please use a different email or sign up');
				return FALSE;
			}
		}
		
		//if user doesn't exist
		else
		{
			$this->session->set_userdata('login_error', 'Your email or password is incorrect. Please try again');
			return FALSE;
		}
=======
	public function get_active_flights()
	{
		$this->db->select('COUNT(flight_id) AS total_flights');
		$this->db->where('flight_status = 1');
		$query = $this->db->get('flight');
		
		$result = $query->row();
		
		return $result->total_flights;
	}
	
	public function get_total_payments()
	{
		//select the user by email from the database
		$this->db->select('SUM(payment_amount*payment_quantity) AS total_payments');
		$this->db->where('payment_status = 1');
		$this->db->from('payment');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_payments;
	}
	
	public function get_total_airlines()
	{
		$this->db->select('COUNT(airline_id) AS total_airlines');
		$this->db->where('airline_status = 1');
		$query = $this->db->get('airline');
		
		$result = $query->row();
		
		return $result->total_airlines;
	}
	
	public function get_total_visitors()
	{
		$this->db->select('COUNT(visitor_id) AS total_visitors');
		$this->db->where('visitor_status = 1');
		$query = $this->db->get('visitor');
		
		$result = $query->row();
		
		return $result->total_visitors;
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
	}
}