<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		/*$this->load->model('admin/products_model');
		$this->load->model('admin/categories_model');
		$this->load->model('admin/features_model');
		$this->load->model('admin/brands_model');
		$this->load->model('admin/users_model');
		$this->load->model('cart_model');*/
		$this->load->model('admin/users_model');
		$this->load->model('site_model');
		$this->load->model('login/login_model');
		
		$this->load->library('cart');
		$this->load->library('email');
		$this->load->model('email_model');
	}
    
	/*
	*
	*	Default action is to go to the home page
	*
	*/
	public function index() 
	{
		redirect('home');
	}
    
	/*
	*
	*	Home Page
	*
	*/
	public function home_page() 
	{
		//get page data
		/*$v_data['latest'] = $this->products_model->get_latest_products();
		$v_data['featured'] = $this->products_model->get_featured_products();
		$v_data['brands'] = $this->brands_model->all_active_brands();
		$v_data['all_children'] = $this->categories_model->all_child_categories();
		$v_data['parent_categories'] = $this->categories_model->all_parent_categories();*/
		$data['content'] = $this->load->view('home/home', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function membership()
	{
		$data['content'] = $this->load->view('membership', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function sign_in()
	{
		$data['content'] = $this->load->view('membership', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Login a user
	*
	*/
	public function login_user() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_frontend_user())
			{
				if($this->session->userdata('activation_status') == 0)
				{
					if($this->session->userdata('user_level_id') == 1)
					{
						redirect('subscribe/school');
					}
					if($this->session->userdata('user_level_id') == 2)
					{
						redirect('subscribe/teacher');
					}
					if($this->session->userdata('user_level_id') == 3)
					{
						redirect('subscribe/student');
					}
				}
				
				else
				{
					redirect('grades/6');
				}
			}
			
			else
			{
				$data['error'] = $this->session->userdata('login_error');
				$this->session->unset_userdata('login_error');
				$data['content'] = $this->load->view('login/user_login', $data, true);
			}
		}
		
		else
		{
			$data['content'] = $this->load->view('login/user_login', '', true);
		}
		
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('site/templates/general_page', $data);
	}
	
	public function thankyou()
	{
		$this->load->model('admin/subscriptions_model');
		$user_id = $this->session->userdata('user_id');
		if($this->subscriptions_model->add_user_grade($user_id, 1))
		{
			$user_grade_id = $this->session->userdata('user_grade_id');
			$payment_data = $this->input->get();
			
			if($payment_data['st'] == 'Completed')
			{
				$this->subscriptions_model->add_payment($user_grade_id, $payment_data['amt'], $payment_data['tx'], $payment_data['sig'], $user_id);
				redirect('purchase/success');
			}
			
			else
			{
				$this->subscriptions_model->add_payment($user_grade_id, $payment_data['st'], $payment_data['tx'], $payment_data['sig'], $user_id, $error = 1);
				redirect('purchase/failure');
			}
			
			$this->session->unset_userdata('user_grade_id');
		}
	}
	
	public function thank()
	{
		$data['content'] = $this->load->view('thankyou', '', true);
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function warn()
	{
		$data['content'] = $this->load->view('payment_error', '', true);
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new teacher user
	*
	*/
	public function register_teacher() 
	{
		//form validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('other_names', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->users_model->add_regular_user())
			{
				$this->login_user();
			}
			
			else
			{
				$data['error'] = 'Unable to create account. Please try again';
				$data['content'] = $this->load->view('login/regular_signup', $data, true);
			}
		}
		
		else
		{
			//open the add new user page
			$data['content'] = $this->load->view('login/teacher_signup', '', true);
		}
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new school
	*
	*/
	public function register_school() 
	{
		$states_details = $this->db->get('state');
		$data2['states'] = $states_details->result();
		
		//form validation rules
		$this->form_validation->set_rules('school_name', 'School Name', 'required|xss_clean');
		$this->form_validation->set_rules('state_id', 'State', 'greater_than[0]|required|xss_clean');
		$this->form_validation->set_rules('school_district', 'School District', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Official Email', 'required|valid_email|xss_clean|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'School Password', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('other_names', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('uname', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('school_password', 'Password', 'required|xss_clean');
		
		$this->form_validation->set_message('greater_than', 'Please select a state');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$this->db->where('username', $this->input->post('uname'));
			$query = $this->db->get('user');
			
			if ($query->num_rows() > 0)
			{
				$data2['error'] = 'The Username field must contain a unique value';
				$data['content'] = $this->load->view('login/school_signup', $data2, true);
			}
			
			else
			{
				//check if user has valid login credentials
				if($this->users_model->add_school_user())
				{
					$this->login_user();
				}
				
				else
				{
					$data2['error'] = 'Unable to create account. Please try again';
					$data['content'] = $this->load->view('login/school_signup', $data2, true);
				}
			}
		}
		
		else
		{
			//open the add new user page
			$data['content'] = $this->load->view('login/school_signup', $data2, true);
		}
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function marketing($presentation)
	{
		$presentation_path = realpath(APPPATH . '../media/promotions');
		$filename = $presentation_path."\\".$presentation.'.swf';

		if (file_exists($filename)) 
		{
			$data2['presentation'] = $presentation;
			$data['content'] = $this->load->view('marketing', $data2, TRUE);
			
			$data['title'] = $this->site_model->display_page_title();
		} 
		else 
		{
			$data['content'] = $this->load->view('not_found', '', TRUE);
			
			$data['title'] = 'Awesomath | Not Found';
		}
		$this->load->view('templates/general_page', $data);
	}
	
	public function contact()
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$validation_errors = validation_errors();
			$this->session->set_userdata('message_error', $validation_errors);
		}
		
		else
		{
			$receiver['email'] = 'animations@awesomemath.net';
			$receiver['name'] = 'awesomemath.NET';
			$sender['email'] = $this->input->post('email');
			$sender['name'] = $this->input->post('first_name');
			$message['subject'] = $this->input->post('enquiry');
			$message['text'] = $this->input->post('message');
			//check if user has valid login credentials
			if($this->email_model->send_mail($receiver, $sender, $message))
			{
				$this->session->set_userdata('message_success', 'Your email has been successfully sent. We will get back to you as soon as possible');
			}
			
			else
			{
				$this->session->set_userdata('message_error', 'Your email could not be sent. Please try again');
			}
		}
		redirect('home#contact');
	}
    
	/*
	*
	*	Action of a forgotten password
	*
	*/
	public function forgot_password()
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[user.email]');
		$this->form_validation->set_message('exists', 'That email does not exist. Are you trying to sign up?');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$this->load->model('email_model');
			
			//reset password
			if($this->users_model->reset_password($this->input->post('email')))
			{
				$this->session->set_userdata('front_success_message', 'Your password has been reset and mailed to '.$this->input->post('email').'. Please use that password to sign in here');
				
				redirect('sign-in');
			}
			
			else
			{
				$this->session->set_userdata('front_error_message', 'Could not reset your password. Please try again.');
			}
		}
		
		else
		{
			$this->session->set_userdata('front_error_message', validation_errors());
		}
		
		//page datea
		$data['content'] = $this->load->view('reset_password', '', true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
	
	public function mailing()
	{
		$this->load->library('email');
		$this->email->initialize(array(
		 'mailtype' => 'html',
		 'validate' => TRUE,
		));
	
		$this->email->from('amasitsa@live.com', 'Alvaro');
		$this->email->to('alvaromasitsa104@gmail.com');
		$this->email->subject('ServerManager Registration');
		$this->email->message('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl elit, blandit id scelerisque a, commodo vitae turpis. Suspendisse pulvinar, urna et consectetur vestibulum, arcu velit tristique enim, non pharetra nisi urna porta massa. Maecenas luctus sodales purus ac convallis. Donec id massa tincidunt, rutrum felis id, cursus sem. Sed venenatis nisl at porttitor pretium. Curabitur condimentum magna et adipiscing venenatis. Pellentesque ac tellus interdum, tempus elit at, viverra augue. Donec ultrices tempor lectus quis iaculis. Vivamus eu diam id tellus elementum lobortis. Donec mi tellus, congue at arcu at, scelerisque aliquam diam. Aenean quis dapibus nibh. Cras at bibendum neque, in elementum nibh. Mauris varius eu lorem sit amet aliquam. Mauris sollicitudin mollis eros');
		if ($this->email->send()) {
			// This becomes triggered when sending
			echo("Mail Sent");
		}else{
			echo($this->email->print_debugger()); //Display errors if any
		}
	}
}
?>