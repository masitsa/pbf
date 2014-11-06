<?php

class Grades_model extends CI_Model 
{	
	/*
	*	Retrieve all active grades
	*
	*/
	public function all_active_grades()
	{
		$this->db->where('grade_status = 1');
		$query = $this->db->get('grade');
		
		return $query;
	}
	/*
	*	Retrieve all active packages
	*
	*/
	public function all_active_packages()
	{
		$this->db->where('package_status = 1');
		$query = $this->db->get('package');
		
		return $query;
	}
	
	/*
	*	Retrieve latest grade
	*
	*/
	public function latest_grade()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('grade');
		
		return $query;
	}
	
	/*
	*	Retrieve all grades
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_grades($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('grade_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new grade
	*	@param string $image_name
	*
	*/
	public function add_grade($image_name)
	{
		$data = array(
				'grade_name'=>ucwords(strtolower($this->input->post('grade_name'))),
				'grade_status'=>$this->input->post('grade_status'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id'),
				'grade_image_name'=>$image_name
			);
			
		if($this->db->insert('grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing grade
	*	@param string $image_name
	*	@param int $grade_id
	*
	*/
	public function update_grade($image_name, $grade_id)
	{
		$data = array(
				'grade_name'=>ucwords(strtolower($this->input->post('grade_name'))),
				'grade_status'=>$this->input->post('grade_status'),
				'modified_by'=>$this->session->userdata('user_id'),
				'grade_image_name'=>$image_name
			);
			
		$this->db->where('grade_id', $grade_id);
		if($this->db->update('grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a package of grades
	*	@param int $package_id
	*
	*/
	public function get_package($package_id)
	{
		//retrieve all users
		$this->db->from('grade, package_item');
		$this->db->select('grade.grade_name');
		$this->db->where('grade.grade_id = package_item.grade_id AND package_item.package_id = '.$package_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single grade's details
	*	@param int $grade_id
	*
	*/
	public function get_grade($grade_id)
	{
		//retrieve all users
		$this->db->from('grade');
		$this->db->select('*');
		$this->db->where('grade_id = '.$grade_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single grade's details
	*	@param int $grade_id
	*
	*/
	public function get_grade_by_name($grade_id)
	{
		//retrieve all users
		$this->db->from('grade');
		$this->db->select('*');
		$this->db->where('grade_name = \'Grade '.$grade_id.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing grade
	*	@param int $grade_id
	*
	*/
	public function delete_grade($grade_id)
	{
		if($this->db->delete('grade', array('grade_id' => $grade_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated grade
	*	@param int $grade_id
	*
	*/
	public function activate_grade($grade_id)
	{
		$data = array(
				'grade_status' => 1
			);
		$this->db->where('grade_id', $grade_id);
		
		if($this->db->update('grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated grade
	*	@param int $grade_id
	*
	*/
	public function deactivate_grade($grade_id)
	{
		$data = array(
				'grade_status' => 0
			);
		$this->db->where('grade_id', $grade_id);
		
		if($this->db->update('grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>