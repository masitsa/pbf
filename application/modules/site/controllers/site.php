<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MX_Controller 
{
	var $airlines_location;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('admin/airports_model');
		$this->load->model('admin/flights_model');
		$this->load->model('admin/airlines_model');
		$this->load->model('site_model');
		
		$this->load->library('cart');
		$this->airlines_location = base_url().'assets/images/airlines/';
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
	public function left_navigation() 
	{
		$this->load->view('products/left_navigation');
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
    
	/*
	*
	*	Filter products by brand
	*
	*/
	public function filter_brands()
	{
		$total_brands = sizeof($_POST['brand']);
		
		//check if any checkboxes have been ticked
		if($total_brands > 0)
		{
			$brands = '';
			
			for($r = 0; $r < $total_brands; $r++){
				
				$brand = $_POST['brand'];
				$brand_id = $brand[$r]; 
				
				if($r == 0)
				{
					$brands .= $brand_id;
				}
				
				else
				{
					$brands .= '-'.$brand_id;
				}
			}
			redirect('products/filter-brands/'.$brands);
		}
		
		else
		{
			redirect('products/all-products');
		}
	}
    
	/*
	*
	*	Flights Page
	*
	*/
	public function flights($search = '__', $airline_id = 0, $airport_id = 0, $order_by = 'created', $price_range = '__') 
	{
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		$v_data['price_range'] = $this->site_model->generate_price_range();
		
		$where = 'flight.airline_id = airline.airline_id AND flight.flight_type_id = flight_type.flight_type_id AND flight.airplane_type_id = airplane_type.airplane_type_id AND flight.flight_status = 1';
		$table = 'flight, airline, flight_type, airplane_type';
		
		$limit = NULL;
		
		//ordering products
		switch ($order_by)
		{
			case 'created':
				$order_method = 'DESC';
			break;
			
			case 'price':
				$order_method = 'ASC';
			break;
			
			case 'price_desc':
				$order_method = 'DESC';
			break;
		}
		
		//case of price_range
		if($price_range != '__')
		{
			$range = explode("-", $price_range);
			$total = count($range);
			
			if($total == 2)
			{
				$start = $range[0];
				$end = $range[1];
				$where .= " AND (flight.flight_price BETWEEN ".$start." AND ".$end.")";
			}
		}
		
		//case of search
		if($search != '__')
		{
			$table .= ', airport';
			$where .= " AND flight.destination = airport.airport_id AND (airport.airport_name LIKE '%".$search."%' OR airline.airline_name LIKE '%".$search."%')";
		}
		
		//case of airline
		if($airline_id > 0)
		{
			$where .= ' AND (airline.airline_id = '.$airline_id.')';
		}
		
		//case of airport
		if($airport_id > 0)
		{
			$where .= ' AND flight.destination = '.$airport_id;
		}
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'flights';
		$config['total_rows'] = $this->users_model->count_items($table, $where, $limit);
		$config['uri_segment'] = 5;
		$config['per_page'] = 21;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		if($limit == NULL)
		{
        	$v_data["links"] = $this->pagination->create_links();
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			
			if($v_data["total"] < $config["per_page"])
			{
				$v_data["last"] = $page + $v_data["total"];
			}
			
			else
			{
				$v_data["last"] = $page + $config["per_page"];
			}
		}
		
		else
		{
			$v_data["first"] = $page + 1;
			$v_data["total"] = $config['total_rows'];
			$v_data["last"] = $config['total_rows'];
		}
		$v_data['products'] = $this->flights_model->get_all_flights($table, $where, $config["per_page"], $page, $limit, $order_by, $order_method);
		$v_data['airports_query'] = $this->airports_model->all_active_airports();
		$v_data['airline_logo_location'] = $this->airlines_location;
		
		$data['content'] = $this->load->view('products/products', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
    
	/*
	*
	*	Search for a product
	*
	*/
	public function search()
	{
		$this->form_validation->set_rules('search_item', 'Search Criteria', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run() == FALSE)
		{
			$this->flights();
		}
		
		else
		{
			$search = $this->input->post('search_item');
			
			redirect('flights/search/'.$search);
		}
	}
    
	/*
	*
	*	Products Page
	*
	*/
	public function view_product($product_id)
	{
		$this->products_model->update_clicks($product_id);
		//Required general page data
		$v_data['all_children'] = $this->categories_model->all_child_categories();
		$v_data['parent_categories'] = $this->categories_model->all_parent_categories();
		$v_data['crumbs'] = $this->site_model->get_crumbs();
		
		//get page data
		$v_data['all_features'] = $this->features_model->all_features();
		$v_data['similar_products'] = $this->products_model->get_similar_products($product_id);
		$v_data['product_details'] = $this->products_model->get_product($product_id);
		$v_data['product_images'] = $this->products_model->get_gallery_images($product_id);
		$v_data['product_features'] = $this->products_model->get_features($product_id);
		$data['content'] = $this->load->view('products/view_product', $v_data, true);
		
		$data['title'] = $this->site_model->display_page_title();
		$this->load->view('templates/general_page', $data);
	}
}
?>