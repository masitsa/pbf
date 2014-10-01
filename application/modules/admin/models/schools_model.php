<?php

class Schools_model extends CI_Model 
{	
	/*
	*	Retrieve all active schools
	*
	*/
	public function all_active_schools()
	{
		$this->db->where('school_status = 1');
		$query = $this->db->get('school');
		
		return $query;
	}
	
	/*
	*	Retrieve latest school
	*
	*/
	public function get_all_states()
	{
		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get('state');
		
		return $query;
	}
	
	/*
	*	Retrieve all schools
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_schools($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('state.state_name, district.district_name, user_status.user_status_name, school.*');
		$this->db->where($where);
		$this->db->order_by('state_name, district_name, school_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new school
	*
	*/
	public function add_school()
	{
		$data = array(
				'school_name'=>ucwords(strtolower($this->input->post('school_name'))),
				'school_status'=>$this->input->post('school_status'),
				'district_id'=>$this->input->post('district_id'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id'),
			);
			
		if($this->db->insert('school', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing school
	*	@param string $image_name
	*	@param int $school_id
	*
	*/
	public function update_school($school_id)
	{
		$data = array(
				'school_name'=>ucwords(strtolower($this->input->post('school_name'))),
				'school_status'=>$this->input->post('school_status'),
				'district_id'=>$this->input->post('district_id'),
				'modified_by'=>$this->session->userdata('user_id'),
			);
			
		$this->db->where('school_id', $school_id);
		if($this->db->update('school', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single school's details
	*	@param int $school_id
	*
	*/
	public function get_school($school_id)
	{
		//retrieve all users
		$this->db->from('school');
		$this->db->select('*');
		$this->db->where('school_id = '.$school_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing school
	*	@param int $school_id
	*
	*/
	public function delete_school($school_id)
	{
		if($this->db->delete('school', array('school_id' => $school_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated school
	*	@param int $school_id
	*
	*/
	public function activate_school($school_id)
	{
		$data = array(
				'school_status' => 1
			);
		$this->db->where('school_id', $school_id);
		
		if($this->db->update('school', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated school
	*	@param int $school_id
	*
	*/
	public function deactivate_school($school_id)
	{
		$data = array(
				'school_status' => 0
			);
		$this->db->where('school_id', $school_id);
		
		if($this->db->update('school', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>