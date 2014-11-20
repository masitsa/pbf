<?php

class Districts_model extends CI_Model 
{	
	/*
	*	Retrieve all active districts
	*
	*/
	public function all_active_districts()
	{
		$this->db->where('district_status = 1');
		$this->db->order_by('district_name');
		$query = $this->db->get('district');
		
		return $query;
	}
	
	/*
	*	Retrieve latest district
	*
	*/
	public function get_all_states()
	{
		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get('state');
		
		return $query;
	}
	
	/*
	*	Retrieve all districts
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_districts($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('state.state_name, user_status.user_status_name, district.*');
		$this->db->where($where);
		$this->db->order_by('state_name, district_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new district
	*
	*/
	public function add_district()
	{
		$data = array(
				'district_name'=>ucwords(strtolower($this->input->post('district_name'))),
				'district_status'=>$this->input->post('district_status'),
				'state_id'=>$this->input->post('state_id')
			);
			
		if($this->db->insert('district', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing district
	*	@param string $image_name
	*	@param int $district_id
	*
	*/
	public function update_district($district_id)
	{
		$data = array(
				'district_name'=>ucwords(strtolower($this->input->post('district_name'))),
				'district_status'=>$this->input->post('district_status'),
				'state_id'=>$this->input->post('state_id')
			);
			
		$this->db->where('district_id', $district_id);
		if($this->db->update('district', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single district's details
	*	@param int $district_id
	*
	*/
	public function get_district($district_id)
	{
		//retrieve all users
		$this->db->from('district');
		$this->db->select('*');
		$this->db->where('district_id = '.$district_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing district
	*	@param int $district_id
	*
	*/
	public function delete_district($district_id)
	{
		if($this->db->delete('district', array('district_id' => $district_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated district
	*	@param int $district_id
	*
	*/
	public function activate_district($district_id)
	{
		$data = array(
				'district_status' => 1
			);
		$this->db->where('district_id', $district_id);
		
		if($this->db->update('district', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated district
	*	@param int $district_id
	*
	*/
	public function deactivate_district($district_id)
	{
		$data = array(
				'district_status' => 0
			);
		$this->db->where('district_id', $district_id);
		
		if($this->db->update('district', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>