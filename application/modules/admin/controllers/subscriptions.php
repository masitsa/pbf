<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Subscriptions extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('subscriptions_model');
		$this->load->model('topics_model');
		$this->load->model('grades_model');
	}
    
	/*
	*
	*	Default action is to show all the user_grade
	*
	*/
	public function index() 
	{
		$where = 'user.user_id = user_grade.user_id AND user_grade.package_id = package.package_id AND user.user_type_id = user_type.user_type_id AND user_grade.subscription_status = user_status.user_status_id';
		$table = 'user_grade, user, package, user_type, user_status';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-subscriptions';
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
		$query = $this->subscriptions_model->get_all_subscriptions($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('subscriptions/all_subscriptions', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-subscription" class="btn btn-success pull-right">Add Subscription</a>There are no subscriptions';
		}
		$data['title'] = 'All Subscriptions';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new subscription
	*
	*/
	public function add_subscription() 
	{
		//form validation rules
		$this->form_validation->set_rules('user_id', 'Customer', 'required|xss_clean');
		$this->form_validation->set_rules('package_id', 'Package', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->subscriptions_model->add_subscription())
			{
				$this->session->set_userdata('success_message', 'Subscription added successfully');
				redirect('all-subscriptions');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add the subscription. Please try again');
			}
		}
		
		//open the add new subscription
		$data['title'] = 'Add Subscription';
		
		$v_data['all_users'] = $this->users_model->get_all_front_end_users();
		$v_data['all_grades'] = $this->grades_model->all_active_packages();
		
		$data['content'] = $this->load->view('subscriptions/add_subscription', $v_data, true);
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing subscription
	*	@param int $subscription_id
	*
	*/
	public function edit_subscription($subscription_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('user_id', 'Customer', 'required|xss_clean');
		$this->form_validation->set_rules('grade_id', 'Grade', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update subscription
			if($this->subscriptions_model->update_subscription($subscription_id))
			{
				$this->session->set_userdata('success_message', 'Subscription updated successfully');
				redirect('all-subscriptions');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update subscription. Please try again');
			}
		}
		
		//open the add new subscription
		$data['title'] = 'Edit Subscription';
		
		//select the subscription from the database
		$query = $this->subscriptions_model->get_subscription($subscription_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['subscription'] = $query->row();
			$v_data['all_users'] = $this->users_model->get_all_front_end_users();
			$v_data['all_grades'] = $this->grades_model->all_active_grades();
			
			$data['content'] = $this->load->view('subscriptions/edit_subscription', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Subscription does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing subscription
	*	@param int $subscription_id
	*
	*/
	public function delete_subscription($subscription_id)
	{
		$this->subscriptions_model->delete_subscription($subscription_id);
		$this->session->set_userdata('success_message', 'Subscription has been deleted');
		redirect('all-subscriptions');
	}
    
	/*
	*
	*	Deactivate a subscription
	*	@param int $subscription_id
	*
	*/
	public function deactivate_subscription($subscription_id)
	{
		$this->subscriptions_model->deactivate_subscription($subscription_id);
		$this->session->set_userdata('success_message', 'Subscription has been disabled');
		redirect('all-subscriptions');
	}
    
	/*
	*
	*	Aactivate a subscription
	*	@param int $subscription_id
	*
	*/
	public function activate_subscription($subscription_id)
	{
		$this->subscriptions_model->activate_subscription($subscription_id);
		$this->session->set_userdata('success_message', 'Subscription has been activated');
		redirect('all-subscriptions');
	}
}
?>