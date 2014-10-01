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
	
	/*
	*	Validate a user's login request
	*
	*/
	public function validate_user()
	{
		//select the user by email from the database
		$this->db->select('*');
		$this->db->where(array('email' => $this->input->post('email'), 'user_status_id' => 1, 'user_type_id' => 0, 'password' => md5($this->input->post('password'))));
		$query = $this->db->get('user');
		
		//if user exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			//create user's login session
			$newdata = array(
                   'login_status'     => TRUE,
                   'first_name'     => $result[0]->user_fname,
                   'email'     => $result[0]->email,
                   'user_id'  => $result[0]->user_id,
                   'user_level_id'  => $result[0]->user_type_id
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
		$this->db->update('user', $data); 
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
		$this->db->update('user', $data); 
		
		return $new_password;
	}
	
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
	}
}