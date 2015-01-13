<?php

class Site_model extends CI_Model 
{
	public function display_page_title()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$page_url = ucwords(strtolower($page[0]));
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.str_replace('%20', ' ', $sub_page[$r]);
			}
			$page_url .= ' | '.ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$page_url .= ' | '.ucwords(strtolower($category_name));
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$page_url .= ' | '.ucwords(strtolower($brand_name));
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$page_url .= ' | '.ucwords(strtolower($product_name));
			}
		}
		
		return $page_url;
	}
	
	public function get_crumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$crumb[0]['name'] = ucwords(strtolower($page[0]));
		$crumb[0]['link'] = $page[0];
		
		if($total > 1)
		{
			$sub_page = explode("-",$page[1]);
			$total_sub = count($sub_page);
			$page_name = '';
			
			for($r = 0; $r < $total_sub; $r++)
			{
				$page_name .= ' '.str_replace('%20', ' ', $sub_page[$r]);
			}
			$crumb[1]['name'] = ucwords(strtolower($page_name));
			
			if($page[1] == 'category')
			{
				$category_id = $page[2];
				$category_details = $this->categories_model->get_category($category_id);
				
				if($category_details->num_rows() > 0)
				{
					$category = $category_details->row();
					$category_name = $category->category_name;
				}
				
				else
				{
					$category_name = 'No Category';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($category_name));
				$crumb[2]['link'] = 'products/category/'.$category_id;
			}
			
			else if($page[1] == 'brand')
			{
				$brand_id = $page[2];
				$brand_details = $this->brands_model->get_brand($brand_id);
				
				if($brand_details->num_rows() > 0)
				{
					$brand = $brand_details->row();
					$brand_name = $brand->brand_name;
				}
				
				else
				{
					$brand_name = 'No Brand';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($brand_name));
				$crumb[2]['link'] = 'products/brand/'.$brand_id;
			}
			
			else if($page[1] == 'view-product')
			{
				$product_id = $page[2];
				$product_details = $this->products_model->get_product($product_id);
				
				if($product_details->num_rows() > 0)
				{
					$product = $product_details->row();
					$product_name = $product->product_name;
				}
				
				else
				{
					$product_name = 'No Product';
				}
				
				$crumb[1]['link'] = 'products/all-products/';
				$crumb[2]['name'] = ucwords(strtolower($product_name));
				$crumb[2]['link'] = 'products/view-product/'.$product_id;
			}
			
			else
			{
				$crumb[1]['link'] = '#';
			}
		}
		
		return $crumb;
	}
	
	function generate_price_range()
	{
		$max_price = $this->flights_model->get_max_flight_price();
		//$min_price = $this->products_model->get_min_product_price();
		
		$interval = $max_price/5;
		
		$range = '';
		$start = 0;
		$end = 0;
		
		for($r = 0; $r < 5; $r++)
		{
			$end = $start + $interval;
			$value = '$'.number_format(($start+1), 2, '.', ',').' - $'.number_format($end, 2, '.', ',');
			$range .= '<label> <input type="radio" name="agree" value="'.$start.'-'.$end.'"  /> '.$value.'</label> <br>';
			
			$start = $end;
		}
		
		return $range;
	}
	
	public function get_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = ucwords(strtolower($page[0]));
		
		$home = '';
		$flights = '';
		$airlines = '';
		$charter = '';
		$contact = '';
		$about = '';
		
		if($name == 'Home')
		{
			$home = 'active';
		}
		
		if($name == 'Flights')
		{
			$flights = 'active';
		}
		
		if($name == 'Airlines')
		{
			$airlines = 'active';
		}
		
		if($name == 'Charter')
		{
			$charter = 'active';
		}
		
		if($name == 'Contact')
		{
			$contact = 'active';
		}
		
		if($name == 'About')
		{
			$about = 'active';
		}
		
		$navigation = 
		'
			<li class="'.$home.'"><a href="'.site_url().'home'.'">Home</a></li>
			<li class="'.$flights.'"><a href="'.site_url().'flights'.'">Flights</a></li>
			<!--<li class="'.$airlines.'"><a href="'.site_url().'airlines'.'">Airlines</a></li>-->
			<li class="'.$charter.'"><a href="'.site_url().'charter'.'">Charter Quotes</a></li>
			<li class="'.$contact.'"><a href="'.site_url().'contact'.'">Contact</a></li>
			<li class="'.$about.'"><a href="'.site_url().'about'.'">About</a></li>
		';
		
		return $navigation;
	}
	
	public function update_booking($transaction_tracking_id, $booking_id)
	{
		$data = array
		(
			"booking_status" => 1,
			"transaction_tracking_id" => $transaction_tracking_id
		);
		
		$this->db->where('booking_id', $booking_id);
		
		if($this->db->update('booking', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
    
	/*
	*
	*	Send airline contact Email
	*
	*/
	public function send_account_verification_email($receiver_email, $receiver_name, $cc) 
	{
		$this->load->library('Mandrill', 'yPN5McI91NQbs7spbOUpPA');
		$this->load->model('site/email_model');
		
		$subject = "Thanks for registering your shop";
		$message = '
				<p>Thank you for registering at In Store Look.</p> <p>Please activate your account here</p>
				';
		$sender_email = "info@instorelook.com.au";
		$shopping = "";
		$from = "In Store Look";
		$encrypted_email = $this->encrypt_vendor_email($receiver_email);
		
		$button = '<a class="mcnButton " title="Confirm Account" href="'.site_url().'confirm-account/'.$encrypted_email.'" target="_blank" style="font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Confirm My Account</a>';
		$response = $this->email_model->send_mandrill_mail($receiver_email, "Hi ".$receiver_name, $subject, $message, $sender_email, $shopping, $from, $button, $cc);
		
		//echo var_dump($response);
		
		return $response;
	}
	
	public function calculate_seats_sold($flight_id)
	{
		$this->db->select('SUM(booking_units) AS total_bookings');
		$this->db->where('booking.flight_id = '.$flight_id);
		$query = $this->db->get('booking');
		
		if($query->num_rows > 0)
		{
			$row = $query->row();
			
			$total = $row->total_bookings;
		}
		
		else
		{
			$total = 0;
		}
		
		return $total;
	}
	
	public function save_charter_quote()
	{
		$source = $this->input->post('source');
		$destination = $this->input->post('destination');
		$airline_id = $this->input->post('airline_id');
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
		$trip_type_id = $this->input->post('trip_type_id');
		$sender_name = $this->input->post('sender_name');
		$sender_email = $this->input->post('sender_email');
		$sender_phone = $this->input->post('sender_phone');
		$description = $this->input->post('description');
		$email_alert = $this->input->post('email_alert');
		
		$data = array(
			'source' => $source,
			'destination' => $destination,
			'airline_id' => $airline_id,
			'date_from' => $date_from,
			'date_to' => $date_to,
			'trip_type_id' => $trip_type_id,
			'sender_name' => $sender_name,
			'sender_email' => $sender_email,
			'sender_phone' => $sender_phone,
			'description' => $description,
			'email_alert' => $email_alert,
			'charter_quote_date' => date('Y-m-d H:i:s')
		);
		
		if($this->db->insert('charter_quote', $data))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
}

?>