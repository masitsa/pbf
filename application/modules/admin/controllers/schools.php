<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Schools extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('schools_model');
		$this->load->model('districts_model');
	}
    
	/*
	*
	*	Default action is to show all the schools
	*
	*/
	public function index() 
	{
		$where = 'school.school_status = user_status.user_status_id AND school.district_id = district.district_id AND district.state_id = state.state_id';
		$table = 'school, user_status, district, state';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-schools';
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
		$query = $this->schools_model->get_all_schools($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('schools/all_schools', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-school" class="btn btn-success pull-right">Add school</a>There are no schools';
		}
		$data['title'] = 'All schools';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new school
	*
	*/
	public function add_school() 
	{
		//form validation rules
		$this->form_validation->set_rules('district_id', 'District', 'required|xss_clean');
		$this->form_validation->set_rules('school_name', 'School Name', 'required|xss_clean');
		$this->form_validation->set_rules('school_status', 'School Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->schools_model->add_school())
			{
				$this->session->set_userdata('success_message', 'School added successfully');
				redirect('all-schools');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add school. Please try again');
			}
		}
		
		//open the add new school
		$data['title'] = 'Add New School';
		$v_data['all_districts'] = $this->districts_model->all_active_districts();
		$data['content'] = $this->load->view('schools/add_school', $v_data, true);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing school
	*	@param int $school_id
	*
	*/
	public function edit_school($school_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('district_id', 'District', 'required|xss_clean');
		$this->form_validation->set_rules('school_name', 'School Name', 'required|xss_clean');
		$this->form_validation->set_rules('school_status', 'School Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update school
			if($this->schools_model->update_school($school_id))
			{
				$this->session->set_userdata('success_message', 'School updated successfully');
				redirect('all-schools');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update school. Please try again');
			}
		}
		
		//open the add new school
		$data['title'] = 'Edit School';
		
		//select the school from the database
		$query = $this->schools_model->get_school($school_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['school'] = $query->result();
			$v_data['all_districts'] = $this->districts_model->all_active_districts();
			
			$data['content'] = $this->load->view('schools/edit_school', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'School does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing school
	*	@param int $school_id
	*
	*/
	public function delete_school($school_id)
	{
		$this->schools_model->delete_school($school_id);
		$this->session->set_userdata('success_message', 'School has been deleted');
		redirect('all-schools');
	}
    
	/*
	*
	*	Activate an existing school
	*	@param int $school_id
	*
	*/
	public function activate_school($school_id)
	{
		$this->schools_model->activate_school($school_id);
		$this->session->set_userdata('success_message', 'School activated successfully');
		redirect('all-schools');
	}
    
	/*
	*
	*	Deactivate an existing school
	*	@param int $school_id
	*
	*/
	public function deactivate_school($school_id)
	{
		$this->schools_model->deactivate_school($school_id);
		$this->session->set_userdata('success_message', 'School disabled successfully');
		redirect('all-schools');
	}
}
?>