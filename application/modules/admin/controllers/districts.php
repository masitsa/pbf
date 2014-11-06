<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Districts extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('districts_model');
	}
    
	/*
	*
	*	Default action is to show all the districts
	*
	*/
	public function index() 
	{
		$where = 'district.district_status = user_status.user_status_id AND district.state_id = state.state_id';
		$table = 'district, user_status, state';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-districts';
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
		$query = $this->districts_model->get_all_districts($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('districts/all_districts', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-district" class="btn btn-success pull-right">Add district</a>There are no districts';
		}
		$data['title'] = 'All districts';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new district
	*
	*/
	public function add_district() 
	{
		//form validation rules
		$this->form_validation->set_rules('state_id', 'State', 'required|xss_clean');
		$this->form_validation->set_rules('district_name', 'District Name', 'required|xss_clean');
		$this->form_validation->set_rules('district_status', 'District Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->districts_model->add_district())
			{
				$this->session->set_userdata('success_message', 'District added successfully');
				redirect('all-districts');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add district. Please try again');
			}
		}
		
		//open the add new district
		$data['title'] = 'Add New district';
		$v_data['all_states'] = $this->districts_model->get_all_states();
		$data['content'] = $this->load->view('districts/add_district', $v_data, true);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing district
	*	@param int $district_id
	*
	*/
	public function edit_district($district_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('state_id', 'State', 'required|xss_clean');
		$this->form_validation->set_rules('district_name', 'District Name', 'required|xss_clean');
		$this->form_validation->set_rules('district_status', 'District Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update district
			if($this->districts_model->update_district($district_id))
			{
				$this->session->set_userdata('success_message', 'District updated successfully');
				redirect('all-districts');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update district. Please try again');
			}
		}
		
		//open the add new district
		$data['title'] = 'Edit district';
		
		//select the district from the database
		$query = $this->districts_model->get_district($district_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['district'] = $query->result();
			$v_data['all_states'] = $this->districts_model->get_all_states();
			
			$data['content'] = $this->load->view('districts/edit_district', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'District does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing district
	*	@param int $district_id
	*
	*/
	public function delete_district($district_id)
	{
		$this->districts_model->delete_district($district_id);
		$this->session->set_userdata('success_message', 'District has been deleted');
		redirect('all-districts');
	}
    
	/*
	*
	*	Activate an existing district
	*	@param int $district_id
	*
	*/
	public function activate_district($district_id)
	{
		$this->districts_model->activate_district($district_id);
		$this->session->set_userdata('success_message', 'District activated successfully');
		redirect('all-districts');
	}
    
	/*
	*
	*	Deactivate an existing district
	*	@param int $district_id
	*
	*/
	public function deactivate_district($district_id)
	{
		$this->districts_model->deactivate_district($district_id);
		$this->session->set_userdata('success_message', 'District disabled successfully');
		redirect('all-districts');
	}
}
?>