<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Topics extends admin {
	var $topics_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('topics_model');
		$this->load->model('grades_model');
		
		//path to image directory
		$this->topics_path = realpath(APPPATH . '../assets/images/topics');
	}
	
	function _update_subtopic_data()
	{
		$query = $this->db->get('sub_topic');
		
		$result = $query->result();
		
		foreach($result as $res)
		{
			$name = $res->sub_topic_name;
			$topic = $res->topic_id;
			$sub_topic_id = $res->sub_topic_id;
			
			if(!empty($name))
			{
				$this->db->where('topic_id = '.$topic);
				$this->db->select('grade_id');
				$query = $this->db->get('topic');
				$row = $query->row();
				$grade = $row->grade_id;
				
				$data = array(
					'topic_name'=>ucwords(strtolower($name)),
					'topic_parent'=>$topic,
					'grade_id'=>$grade,
					'topic_status'=>1,
					'created'=>date('Y-m-d H:i:s'),
					'created_by'=>$this->session->userdata('user_id'),
					'modified_by'=>$this->session->userdata('user_id')
				);
				
				$this->db->insert('topic', $data);
			}
			$this->db->delete('sub_topic', array('sub_topic_id' => $sub_topic_id));
		}
	}
    
	/*
	*
	*	Default action is to show all the topics
	*
	*/
	public function index() 
	{
		$where = 'topic.grade_id = grade.grade_id AND topic.topic_status = user_status.user_status_id AND topic.topic_parent = 0';
		$table = 'topic, grade, user_status';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-topics';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 2;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href = "#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->topics_model->get_all_topics($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('topics/all_topics', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-topic" class="btn btn-success pull-right">Add Topic</a>There are no topics';
		}
		$data['title'] = 'All Topics';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new topic
	*
	*/
	public function add_topic() 
	{
		//form validation rules
		$this->form_validation->set_rules('topic_number', 'Topic Number', 'required|xss_clean');
		$this->form_validation->set_rules('grade_id', 'Grade', 'required|xss_clean');
		$this->form_validation->set_rules('topic_name', 'Topic Name', 'required|xss_clean');
		$this->form_validation->set_rules('topic_status', 'Topic Status', 'required|xss_clean');
		$this->form_validation->set_rules('topic_parent', 'Topic Parent', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if(is_uploaded_file($_FILES['topic_image']['tmp_name']))
			{
				$resize['width'] = 600;
				$resize['height'] = 800;
			
				$this->load->model('file_model');
				$this->load->library('image_lib');
				
				$topics_path = $this->topics_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($topics_path, 'topic_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					//open the add new topic
					$data['title'] = 'Add New Topic';
					$v_data['all_topics'] = $this->topics_model->all_parent_topics();
					$v_data['all_grades'] = $this->grades_model->all_active_grades();
					$data['content'] = $this->load->view('topics/add_topic', $v_data, true);
					$this->load->view('templates/general_admin', $data);
				}
			}
			
			else{
				$file_name = '';
			}
			
			if($this->topics_model->add_topic($file_name))
			{
				$this->session->set_userdata('success_message', 'Topic added successfully');
				redirect('all-topics');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add topic. Please try again');
			}
		}
		
		//open the add new topic
		$data['title'] = 'Add New Topic';
		$v_data['all_topics'] = $this->topics_model->all_parent_topics();
		$v_data['all_grades'] = $this->grades_model->all_active_grades();
		$data['content'] = $this->load->view('topics/add_topic', $v_data, true);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing topic
	*	@param int $topic_id
	*
	*/
	public function edit_topic($topic_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('topic_number', 'Topic Number', 'required|xss_clean');
		$this->form_validation->set_rules('grade_id', 'Grade', 'required|xss_clean');
		$this->form_validation->set_rules('topic_name', 'Topic Name', 'required|xss_clean');
		$this->form_validation->set_rules('topic_status', 'Topic Status', 'required|xss_clean');
		$this->form_validation->set_rules('topic_parent', 'Topic Parent', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['topic_image']['tmp_name']))
			{
				$this->load->model('file_model');
				$this->load->library('image_lib');
				
				$topics_path = $this->topics_path;
				
				$image = $this->input->post('current_image');
				$thumbnail = 'thumbnail_'.$image;
				//delete original image
				$this->file_model->delete_file($topics_path."\\".$image);
				
				//delete original thumbnail
				$this->file_model->delete_file($topics_path."\\".$thumbnail);
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($topics_path, 'topic_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Edit Topic';
		
					//select the topic from the database
					$query = $this->topics_model->get_topic($topic_id);
					
					if ($query->num_rows() > 0)
					{
						$v_data['topic'] = $query->result();
						$v_data['all_topics'] = $this->topics_model->all_parent_topics();
						$v_data['all_grades'] = $this->grades_model->all_active_grades();
						
						$data['content'] = $this->load->view('topics/edit_topic', $v_data, true);
					}
					
					else
					{
						$data['content'] = 'Topic does not exist';
					}
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
			}
			//update topic
			if($this->topics_model->update_topic($file_name, $topic_id))
			{
				$this->session->set_userdata('success_message', 'Topic updated successfully');
				redirect('all-topics');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update topic. Please try again');
			}
		}
		
		//open the add new topic
		$data['title'] = 'Edit Topic';
		
		//select the topic from the database
		$query = $this->topics_model->get_topic($topic_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['topic'] = $query->result();
			$v_data['all_topics'] = $this->topics_model->all_parent_topics();
			$v_data['all_grades'] = $this->grades_model->all_active_grades();
			
			$data['content'] = $this->load->view('topics/edit_topic', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Topic does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing topic
	*	@param int $topic_id
	*
	*/
	public function delete_topic($topic_id)
	{
		//delete topic image
		$query = $this->topics_model->get_topic($topic_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->topic_image_name;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->topics_path.'\\'.$image);
			//delete thumbnail
			$this->file_model->delete_file($this->topics_path."\\".$image);
		}
		$this->topics_model->delete_topic($topic_id);
		$this->session->set_userdata('success_message', 'Topic has been deleted');
		redirect('all-topics');
	}
    
	/*
	*
	*	Activate an existing topic
	*	@param int $topic_id
	*
	*/
	public function activate_topic($topic_id)
	{
		$this->topics_model->activate_topic($topic_id);
		$this->session->set_userdata('success_message', 'Topic activated successfully');
		redirect('all-topics');
	}
    
	/*
	*
	*	Deactivate an existing topic
	*	@param int $topic_id
	*
	*/
	public function deactivate_topic($topic_id)
	{
		$this->topics_model->deactivate_topic($topic_id);
		$this->session->set_userdata('success_message', 'Topic disabled successfully');
		redirect('all-topics');
	}
}
?>