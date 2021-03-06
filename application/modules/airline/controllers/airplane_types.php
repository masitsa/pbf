<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/airline/controllers/account.php";

class Airplane_types extends account 
{
	var $airplane_types_path;
	var $airplane_types_image_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('admin/airplane_types_model');
		$this->load->model('admin/file_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->airplane_types_path = realpath(APPPATH . '../assets/images/airplane_types');
		$this->airplane_types_image_path = base_url().'/assets/images/airplane_types/';
	}
    
	/*
	*
	*	Default action is to show all the registered airplane_types
	*
	*/
	public function index() 
	{
		$where = 'airplane_type_id > 0';
		$table = 'airplane_type';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$this->load->model('admin/airplane_types_model');
		$config['base_url'] = base_url().'airplane_type/all-airplane-types';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
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
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->airplane_types_model->get_all_airplane_types($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['title'] = 'Airplane Types';
			$v_data['airplane_types_image_path'] = $this->airplane_types_image_path;
			$data['content'] = $this->load->view('airplane_types/list_types', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'airplane_type/add-airplane-type" class="btn btn-success pull-right">Add Airplane Type</a>There are no airplane types';
		}
		$data['title'] = 'All Airplane Types';
		
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Add a new airplane_type
	*
	*/
	public function add_airplane_type() 
	{
		$v_data['airplane_type_image'] = 'http://placehold.it/300x300';
		$v_data['airplane_type_image2'] = 'http://placehold.it/300x300';
		$v_data['airplane_type_image3'] = 'http://placehold.it/300x300';
		$v_data['airplane_type_image4'] = 'http://placehold.it/300x300';
		$v_data['airplane_type_name_error'] = '';
		$v_data['airplane_type_status_error'] = '';


		
		//upload image if exists
		if($this->airplane_types_model->upload_airplane_type_image($this->airplane_types_path))
		{
			$image = $this->session->userdata('airplane_type_image_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image2_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image2'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image3_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image3'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image4_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image4'] = $this->airplane_types_image_path.$image;
			}
		}
		
		//form validation rules
		$this->form_validation->set_rules('airplane_type_name', 'Airplane Type', 'required|is_unique[airplane_type.airplane_type_name]|xss_clean');
		$this->form_validation->set_rules('airplane_type_image', 'Airplane Type Image', 'xss_clean');
		$this->form_validation->set_rules('airplane_type_image2', 'Airplane Type Image', 'xss_clean');
		$this->form_validation->set_rules('airplane_type_image3', 'Airplane Type Image', 'xss_clean');
		$this->form_validation->set_rules('airplane_type_image4', 'Airplane Type Image', 'xss_clean');
		$this->form_validation->set_rules('airplane_type_status', 'Airplane Type Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$file_name = $this->session->userdata('airplane_type_image_file_name');
			$thumb_name = $this->session->userdata('airplane_type_image_thumb_name');

			// second
			$file_name2 = $this->session->userdata('airplane_type_image2_file_name');
			$thumb_name2 = $this->session->userdata('airplane_type_image2_thumb_name');

			// third
			$file_name3 = $this->session->userdata('airplane_type_image3_file_name');
			$thumb_name3 = $this->session->userdata('airplane_type_image3_thumb_name');

			// fourth
			$file_name4 = $this->session->userdata('airplane_type_image4_file_name');
			$thumb_name4 = $this->session->userdata('airplane_type_image4_thumb_name');

			
			if($this->airplane_types_model->add_airplane_type($file_name, $thumb_name,$file_name2, $thumb_name2,$file_name3, $thumb_name3,$file_name4, $thumb_name4))
			{
				$this->session->unset_userdata('airplane_type_image_file_name');
				$this->session->unset_userdata('airplane_type_image_thumb_name');
				$this->session->unset_userdata('airplane_type_image2_file_name');
				$this->session->unset_userdata('airplane_type_image2_thumb_name');
				$this->session->unset_userdata('airplane_type_image3_file_name');
				$this->session->unset_userdata('airplane_type_image3_thumb_name');
				$this->session->unset_userdata('airplane_type_image4_file_name');
				$this->session->unset_userdata('airplane_type_image4_thumb_name');
				
				$this->session->set_userdata('success_message', 'Airplane type added successfully');
				redirect('airline/all-airplane-types');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add airplane type. Please try again');
			}
		}
		else
		{
			$image = $this->session->userdata('airplane_type_image_file_name');
			$image2 = $this->session->userdata('airplane_type_image2_file_name');
			$image3 = $this->session->userdata('airplane_type_image3_file_name');
			$image4 = $this->session->userdata('airplane_type_image4_file_name');
			
			if(!empty($image))
			{
				$v_data['airplane_type_image'] = $this->airplane_types_image_path.$image;
				$v_data['airplane_type_image2'] = $this->airplane_types_image_path.$image2;
				$v_data['airplane_type_image3'] = $this->airplane_types_image_path.$image3;
				$v_data['airplane_type_image4'] = $this->airplane_types_image_path.$image4;
			}
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['airplane_type_name_error'] = form_error('airplane_type_name');
				$v_data['airplane_type_status_error'] = form_error('airplane_type_status');
				
				//repopulate fields
				$v_data['airplane_type_name'] = set_value('airplane_type_name');
				$v_data['airplane_type_status'] = set_value('airplane_type_status');
			}
			
			//populate form data on initial load of page
			else
			{
				$v_data['airplane_type_name'] = '';
				$v_data['airplane_type_status'] = '';
			}
		}
		
		//open the add new airplane_type
		$data['title'] = 'Add New Airplane Type';
		$v_data['title'] = 'Add New Airplane Type';
		$data['content'] = $this->load->view('airplane_types/add_airplane_type', $v_data, true);
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Edit an existing airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function edit_airplane_type($airplane_type_id) 
	{
		//select the airplane_type from the database
		$query = $this->airplane_types_model->get_airplane_type($airplane_type_id);
		$airplane_type = $query->row();
		
		$v_data['airplane_type'] = $airplane_type;
		$v_data['airplane_type_image'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image;
		$v_data['airplane_type_image2'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image2;
		$v_data['airplane_type_image3'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image3;
		$v_data['airplane_type_image4'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image4;
		$v_data['airplane_type_name_error'] = '';
		$v_data['airplane_type_status_error'] = '';
		
		//upload image if exists
		if($this->airplane_types_model->upload_airplane_type_image($this->airplane_types_path))
		{
			$image = $this->session->userdata('airplane_type_image_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image2_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image2'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image3_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image3'] = $this->airplane_types_image_path.$image;
			}
			
			$image = $this->session->userdata('airplane_type_image4_file_name');
			if(!empty($image))
			{
				$v_data['airplane_type_image4'] = $this->airplane_types_image_path.$image;
			}
			/*var_dump($v_data);
			die();*/
		}
		
		//form validation rules
		$this->form_validation->set_rules('airplane_type_name', 'Airplane Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('airplane_type_image', 'Airplane Type Image', 'xss_clean');
		$this->form_validation->set_rules('airplane_type_status', 'Airplane Type Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$image = $this->session->userdata('airplane_type_image_file_name');
			
			if(!empty($image))
			{
				$file_name = $image;
				$thumb_name = $this->session->userdata('airplane_type_image_thumb_name');
			}
			else
			{
				$file_name = $this->input->post('current_image');
				$thumb_name = 'thumbnail_'.$this->input->post('current_image');
			}

			// second
			$image = $this->session->userdata('airplane_type_image2_file_name');
			
			if(!empty($image))
			{
				$file_name2 = $image;
				$thumb_name2 = $this->session->userdata('airplane_type_image2_thumb_name');
			}
			else
			{
				$file_name2 = $this->input->post('current_image2');
				$thumb_name2 = 'thumbnail_'.$this->input->post('current_image2');
			}

			// third
			$image = $this->session->userdata('airplane_type_image3_file_name');
			
			if(!empty($image))
			{
				$file_name3 = $image;
				$thumb_name3 = $this->session->userdata('airplane_type_image3_thumb_name');
			}
			else
			{
				$file_name3 = $this->input->post('current_image3');
				$thumb_name3 = 'thumbnail_'.$this->input->post('current_image3');
			}

			// fourth
			$image = $this->session->userdata('airplane_type_image4_file_name');
			
			if(!empty($image))
			{
				$file_name4 = $image;
				$thumb_name4 = $this->session->userdata('airplane_type_image4_thumb_name');
			}
			else
			{
				$file_name4 = $this->input->post('current_image4');
				$thumb_name4 = 'thumbnail_'.$this->input->post('current_image4');
			}

			
			if($this->airplane_types_model->update_airplane_type($file_name, $thumb_name,$file_name2, $thumb_name2,$file_name3, $thumb_name3,$file_name4, $thumb_name4, $airplane_type_id))
			{
				$this->session->unset_userdata('airplane_type_image_file_name');
				$this->session->unset_userdata('airplane_type_image_thumb_name');
				$this->session->unset_userdata('airplane_type_image2_file_name');
				$this->session->unset_userdata('airplane_type_image2_thumb_name');
				$this->session->unset_userdata('airplane_type_image3_file_name');
				$this->session->unset_userdata('airplane_type_image3_thumb_name');
				$this->session->unset_userdata('airplane_type_image4_file_name');
				$this->session->unset_userdata('airplane_type_image4_thumb_name');
				
				$this->session->set_userdata('success_message', 'Airplane type updated successfully');
				redirect('airline/all-airplane-types');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update airplane type. Please try again');
			}
		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				//create errors
				$v_data['airplane_type_name_error'] = form_error('airplane_type_name');
				$v_data['airplane_type_status_error'] = form_error('airplane_type_status');
				
				//repopulate fields
				$v_data['airplane_type_name'] = set_value('airplane_type_name');
				$v_data['airplane_type_status'] = set_value('airplane_type_status');
				
				if ($query->num_rows() > 0)
				{	
					$image = $this->session->userdata('airplane_type_image_file_name');
					
					if(!empty($image))
					{
						$v_data['airplane_type_image'] = $this->airplane_types_image_path.$image;
						$v_data['image'] = $airplane_type->airplane_type_image;
					}
					else
					{
						$v_data['airplane_type_image'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image;
						$v_data['image'] = $airplane_type->airplane_type_image;
					}
				}
			}
			
			//populate form data on initial load of page
			else
			{
				if ($query->num_rows() > 0)
				{
					$airplane_type = $query->row();
					$v_data['airplane_type_name'] = $airplane_type->airplane_type_name;
					$v_data['airplane_type_status'] = $airplane_type->airplane_type_status;
					
					$image = $this->session->userdata('airplane_type_image_file_name');
					
					if(!empty($image))
					{
						$v_data['airplane_type_image'] = $this->airplane_types_image_path.$image;
						$v_data['image'] = $airplane_type->airplane_type_image;
					}
					else
					{
						$v_data['airplane_type_image'] = $this->airplane_types_image_path.$airplane_type->airplane_type_image;
						$v_data['image'] = $airplane_type->airplane_type_image;
					}
				}
				
				else
				{
					$data['content'] = 'Airplane Type does not exist';
				}
			}
		}
		
		//open the add new airplane_type
		$data['title'] = 'Edit Airplane Type';
		$v_data['title'] = 'Edit Airplane Type';
		$data['content'] = $this->load->view('airplane_types/edit_airplane_type', $v_data, true);
		$this->load->view('account_template', $data);
	}
    
	/*
	*
	*	Delete an existing airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function delete_airplane_type($airplane_type_id, $page)
	{
		//delete airplane_type image
		$query = $this->airplane_types_model->get_airplane_type($airplane_type_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$image = $result[0]->airplane_type_image;
			$thumb = $result[0]->airplane_type_thumb;
			$image2 = $result[0]->airplane_type_image2;
			$thumb2 = $result[0]->airplane_type_thumb2;
			$image3 = $result[0]->airplane_type_image3;
			$thumb3 = $result[0]->airplane_type_thumb3;
			$image4 = $result[0]->airplane_type_image4;
			$thumb4 = $result[0]->airplane_type_thumb4;
			
			$this->load->model('file_model');
			//delete image
			$this->file_model->delete_file($this->airplane_types_path."\\".$image);
			$this->file_model->delete_file($this->airplane_types_path."\\".$image2);
			$this->file_model->delete_file($this->airplane_types_path."\\".$image3);
			$this->file_model->delete_file($this->airplane_types_path."\\".$image4);
				
			//delete original thumbnail
			$this->file_model->delete_file($this->airplane_types_path."\\".$thumb);
			$this->file_model->delete_file($this->airplane_types_path."\\".$thumb2);
			$this->file_model->delete_file($this->airplane_types_path."\\".$thumb3);
			$this->file_model->delete_file($this->airplane_types_path."\\".$thumb4);
		}
		
		if($this->airplane_types_model->delete_airplane_type($airplane_type_id))
		{
			$this->session->set_userdata('success_message', 'Airplane Type has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Airplane Type could not be deleted');
		}
		redirect('airline/all-airplane-types/'.$page);
	}
    
	/*
	*
	*	Activate an existing airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function activate_airplane_type($airplane_type_id, $page)
	{
		if($this->airplane_types_model->activate_airplane_type($airplane_type_id))
		{
			$this->session->set_userdata('success_message', 'Airplane Type has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Airplane Type could not be activated');
		}
		redirect('airline/all-airplane-types/'.$page);
	}
    
	/*
	*
	*	Deactivate an existing airplane_type
	*	@param int $airplane_type_id
	*
	*/
	public function deactivate_airplane_type($airplane_type_id, $page)
	{
		if($this->airplane_types_model->deactivate_airplane_type($airplane_type_id))
		{
			$this->session->set_userdata('success_message', 'Airplane Type has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Airplane Type could not be disabled');
		}
		redirect('airline/all-airplane-types/'.$page);
	}
}
?>