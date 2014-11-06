<?php

class Topics_model extends CI_Model 
{	
	/*
	*	Retrieve all topics
	*
	*/
	public function all_topics()
	{
		$this->db->where('topic_status = 1');
		$query = $this->db->get('topic');
		
		return $query;
	}
	/*
	*	Retrieve latest topic
	*
	*/
	public function latest_topic()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('topic');
		
		return $query;
	}
	/*
	*	Retrieve all parent topics
	*
	*/
	public function all_parent_topics()
	{
		$this->db->where('topic_status = 1 AND topic_parent = 0');
		$this->db->order_by('topic_name', 'ASC');
		$query = $this->db->get('topic');
		
		return $query;
	}
	/*
	*	Retrieve all children topics
	*
	*/
	public function all_child_topics()
	{
		$this->db->where('topic_status = 1 AND topic_parent > 0');
		$this->db->order_by('topic_name', 'ASC');
		$query = $this->db->get('topic');
		
		return $query;
	}
	
	/*
	*	Retrieve all topics
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_topics($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('topic.*, grade.grade_name, user_status.user_status_name');
		$this->db->where($where);
		$this->db->order_by('topic_number, topic_name, topic_parent');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new topic
	*	@param string $image_name
	*
	*/
	public function add_topic($image_name)
	{
		$data = array(
				'topic_name'=>ucwords(strtolower($this->input->post('topic_name'))),
				'topic_number'=>$this->input->post('topic_number'),
				'grade_id'=>$this->input->post('grade_id'),
				'topic_parent'=>$this->input->post('topic_parent'),
				'topic_status'=>$this->input->post('topic_status'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id'),
				'topic_image_name'=>$image_name
			);
			
		if($this->db->insert('topic', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing topic
	*	@param string $image_name
	*	@param int $topic_id
	*
	*/
	public function update_topic($image_name, $topic_id)
	{
		$data = array(
				'topic_name'=>ucwords(strtolower($this->input->post('topic_name'))),
				'topic_number'=>$this->input->post('topic_number'),
				'grade_id'=>$this->input->post('grade_id'),
				'topic_parent'=>$this->input->post('topic_parent'),
				'topic_status'=>$this->input->post('topic_status'),
				'modified_by'=>$this->session->userdata('user_id'),
				'topic_image_name'=>$image_name
			);
			
		$this->db->where('topic_id', $topic_id);
		if($this->db->update('topic', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single topic's children
	*	@param int $topic_id
	*
	*/
	public function get_sub_topics($topic_id)
	{
		//retrieve all users
		$this->db->from('topic');
		$this->db->select('*');
		$this->db->where('topic_parent = '.$topic_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single topic's details
	*	@param int $topic_id
	*
	*/
	public function get_topic($topic_id)
	{
		//retrieve all users
		$this->db->from('topic');
		$this->db->select('*');
		$this->db->where('topic_id = '.$topic_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing topic
	*	@param int $topic_id
	*
	*/
	public function delete_topic($topic_id)
	{
		if($this->db->delete('topic', array('topic_parent' => $topic_id)))
		{
			if($this->db->delete('topic', array('topic_id' => $topic_id)))
			{
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated topic
	*	@param int $topic_id
	*
	*/
	public function activate_topic($topic_id)
	{
		$data = array(
				'topic_status' => 1
			);
		$this->db->where('topic_id', $topic_id);
		
		if($this->db->update('topic', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated topic
	*	@param int $topic_id
	*
	*/
	public function deactivate_topic($topic_id)
	{
		$data = array(
				'topic_status' => 0
			);
		$this->db->where('topic_id', $topic_id);
		
		if($this->db->update('topic', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>