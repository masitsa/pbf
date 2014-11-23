<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/airline/controllers/account.php";

class Bookings extends account {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/airline_model');
		$this->load->model('booking_model');
		$this->load->model('admin/file_model');
		$this->load->model('admin/flights_model');
		$this->load->model('admin/airplane_types_model');
		$this->load->model('admin/flight_types_model');
		$this->load->model('admin/airports_model');
		$this->load->model('admin/users_model');
	}
	
	public function index()
	{
		$where = 'booking.flight_id = flight.flight_id AND booking.visitor_id = visitor.visitor_id AND flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND airline.airline_id = '.$this->session->userdata('airline_id');
		$table = 'flight, airline, flight_type, airplane_type, booking, visitor';
		$segment = 3;
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'airline/bookings';
		$config['total_rows'] = 0;//$this->users_model->count_items($table, $where);
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
		$query = $this->booking_model->get_all_bookings($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$v_data['title'] = 'All Bookings';
			$v_data['airports_query'] = $this->airports_model->all_airports();
			$data['content'] = $this->load->view('bookings/all_bookings', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'There are no bookings';
		}
		$data['title'] = 'All Bookings';
		
		$this->load->view('account_template', $data);
	}
}
?>