<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Grades extends admin {
	var $grades_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('grades_model');
		
		//path to image directory
		$this->grades_path = realpath(APPPATH . '../assets/images/grades');
	}
    
	/*
	*
	*	Default action is to show all the grades
	*
	*/
	public function index() 
	{
		$where = 'grade.grade_status = user_status.user_status_id';
		$table = 'grade, user_status';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-grades';
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
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->grades_model->get_all_grades($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('grades/all_grades', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-grade" class="btn btn-success pull-right">Add grade</a>There are no grades';
		}
		$data['title'] = 'All grades';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new grade
	*
	*/
	public function add_grade() 
	{
		//form validation rules
		$this->form_validation->set_rules('grade_name', 'grade Name', 'required|xss_clean');
		$this->form_validation->set_rules('grade_status', 'grade Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['grade_image']['tmp_name']))
			{
				$this->load->model('file_model');
				$this->load->library('image_lib');
				
				$grades_path = $this->grades_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($grades_path, 'grade_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Add New grade';
					$data['content'] = $this->load->view('grades/add_grade', '', true);
					$this->load->view('templates/general_admin', $data);
				}
			}
			
			else{
				$file_name = '';
			}
			
			if($this->grades_model->add_grade($file_name))
			{
				$this->session->set_userdata('success_message', 'Grade added successfully');
				redirect('all-grades');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add grade. Please try again');
			}
		}
		
		//open the add new grade
		$data['title'] = 'Add New grade';
		$data['content'] = $this->load->view('grades/add_grade', '', true);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing grade
	*	@param int $grade_id
	*
	*/
	public function edit_grade($grade_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('grade_name', 'grade Name', 'required|xss_clean');
		$this->form_validation->set_rules('grade_status', 'grade Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if(is_uploaded_file($_FILES['grade_image']['tmp_name']))
			{
				$this->load->model('file_model');
				$this->load->library('image_lib');
				
				$grades_path = $this->grades_path;
				
				$image = $this->input->post('current_image');
				$thumbnail = 'thumbnail_'.$image;
				//delete original image
				$this->file_model->delete_file($grades_path."\\".$image);
				
				//delete original thumbnail
				$this->file_model->delete_file($grades_path."\\".$thumbnail);
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($grades_path, 'grade_image', $resize);
				
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					$data['title'] = 'Edit grade';
		
					//select the grade from the database
					$query = $this->grades_model->get_grade($grade_id);
					
					if ($query->num_rows() > 0)
					{
						$v_data['grade'] = $query->result();
						//$v_data['all_grades'] = $this->grades_model->all_grades();
						
						$data['content'] = $this->load->view('grades/edit_grade', $v_data, true);
					}
					
					else
					{
						$data['content'] = 'Grade does not exist';
					}
					$this->load->view('templates/general_admin', $data);
					break;
				}
			}
			
			else{
				$file_name = $this->input->post('current_image');
			}
			//update grade
			if($this->grades_model->update_grade($file_name, $grade_id))
			{
				$this->session->set_userdata('success_message', 'Grade updated successfully');
				redirect('all-grades');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update grade. Please try again');
			}
		}
		
		//open the add new grade
		$data['title'] = 'Edit grade';
		
		//select the grade from the database
		$query = $this->grades_model->get_grade($grade_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['grade'] = $query->result();
			//$v_data['all_grades'] = $this->grades_model->all_grades();
			
			$data['content'] = $this->load->view('grades/edit_grade', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Grade does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing grade
	*	@param int $grade_id
	*
	*/
	public function delete_grade($grade_id)
	{
		//delete grade image
		$query = $this->grades_model->get_grade($grade_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->grade_image_name;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->grades_path."/images/".$image);
			//delete thumbnail
			$this->file_model->delete_file($this->grades_path."/thumbs/".$image);
		}
		$this->grades_model->delete_grade($grade_id);
		$this->session->set_userdata('success_message', 'Grade has been deleted');
		redirect('all-grades');
	}
    
	/*
	*
	*	Activate an existing grade
	*	@param int $grade_id
	*
	*/
	public function activate_grade($grade_id)
	{
		$this->grades_model->activate_grade($grade_id);
		$this->session->set_userdata('success_message', 'Grade activated successfully');
		redirect('all-grades');
	}
    
	/*
	*
	*	Deactivate an existing grade
	*	@param int $grade_id
	*
	*/
	public function deactivate_grade($grade_id)
	{
		$this->grades_model->deactivate_grade($grade_id);
		$this->session->set_userdata('success_message', 'Grade disabled successfully');
		redirect('all-grades');
	}
}
?>