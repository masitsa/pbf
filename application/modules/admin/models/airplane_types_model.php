<?php

class Airplane_types_model extends CI_Model 
{	
	/*
	*	Retrieve all active airplane_types
	*
	*/
	public function all_active_airplane_types()
	{
		$this->db->where('airplane_type_status = 1');
		$this->db->order_by('airplane_type_name');
		$query = $this->db->get('airplane_type');
		
		return $query;
	}
	
	/*
	*	Retrieve latest airplane_type
	*
	*/
	public function latest_airplane_type()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('airplane_type');
		
		return $query;
	}
	
	/*
	*	Retrieve all airplane_types
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_airplane_types($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('airplane_type_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new airplane_type
	*	@param string $image_name
	*
	*/
	public function add_airplane_type($airplane_type_image, $airplane_type_thumb)
	{
		$data = array(
				'airplane_type_name'=>$this->input->post('airplane_type_name'),
				'airplane_type_image'=>$airplane_type_image,
				'airplane_type_thumb'=>$airplane_type_thumb,
				'airplane_type_status'=>$this->input->post('airplane_type_status'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'user_type_id'=>$this->session->userdata('user_type_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('airplane_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing airplane_type
	*	@param string $image_name
	*	@param int $airplane_type_id
	*
	*/
	public function update_airplane_type($airplane_type_image, $airplane_type_thumb, $airplane_type_id)
	{
		$data = array(
				'airplane_type_name'=>$this->input->post('airplane_type_name'),
				'airplane_type_image'=>$airplane_type_image,
				'airplane_type_thumb'=>$airplane_type_thumb,
				'airplane_type_status'=>$this->input->post('airplane_type_status'),
				'user_type_id'=>$this->session->userdata('user_type_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		$this->db->where('airplane_type_id', $airplane_type_id);
		if($this->db->update('airplane_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single airplane_type's details
	*	@param int $airplane_type_id
	*
	*/
	public function get_airplane_type($airplane_type_id)
	{
		//retrieve all users
		$this->db->from('airplane_type');
		$this->db->select('*');
		$this->db->where('airplane_type_id = '.$airplane_type_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function delete_airplane_type($airplane_type_id)
	{
		if($this->db->delete('airplane_type', array('airplane_type_id' => $airplane_type_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function activate_airplane_type($airplane_type_id)
	{
		$data = array(
				'airplane_type_status' => 1
			);
		$this->db->where('airplane_type_id', $airplane_type_id);
		
		if($this->db->update('airplane_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function deactivate_airplane_type($airplane_type_id)
	{
		$data = array(
				'airplane_type_status' => 0
			);
		$this->db->where('airplane_type_id', $airplane_type_id);
		
		if($this->db->update('airplane_type', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get all airplane_type types
	*
	*/
	public function get_airplane_type_types()
	{
		//retrieve all users
		$this->db->from('get_airplane_type_type');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	public function upload_airplane_type_image($airplane_types_path)
	{
		//upload product's gallery images
		$resize['width'] = 600;
		$resize['height'] = 800;
		
		if(isset($_FILES['airplane_type_image']['tmp_name']))
		{
			if(is_uploaded_file($_FILES['airplane_type_image']['tmp_name']))
			{
				$image = $this->session->userdata('airplane_type_image_file_name');
			
				if(!empty($image))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($airplane_types_path."\\".$this->session->userdata('airplane_type_image_file_name'));
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($airplane_types_path."\\thumbnail_".$this->session->userdata('airplane_type_image_file_name'));
				}
				
				//Upload image
				$response = $this->file_model->upload_file($airplane_types_path, 'airplane_type_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
					
					//Set sessions for the image details
					$this->session->set_userdata('airplane_type_image_file_name', $file_name);
					$this->session->set_userdata('airplane_type_image_thumb_name', $thumb_name);
					
					return TRUE;
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					return FALSE;
				}
			}
			
			else{
				$this->session->set_userdata('error_message', '');
				return FALSE;
			}
		}
		
		else
		{
			$this->session->set_userdata('airplane_type_image_error_message', '');
			return FALSE;
		}
	}
}
?>