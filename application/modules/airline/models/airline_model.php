<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airline_model extends CI_Model 
{	
	public function upload_airline_image($airlines_path)
	{
		//upload product's gallery images
		$resize['width'] = 300;
		$resize['height'] = 300;
		
		if(isset($_FILES['airline_logo']['tmp_name']))
		{
			if(is_uploaded_file($_FILES['airline_logo']['tmp_name']))
			{
				$logo = $this->session->userdata('airline_logo_file_name');

				if(!empty($logo))
				{
					//delete any other uploaded image
					$this->file_model->delete_file($airlines_path."\\".$this->session->userdata('airline_logo_file_name'));
					
					//delete any other uploaded thumbnail
					$this->file_model->delete_file($airlines_path."\\thumbnail_".$this->session->userdata('airline_logo_file_name'));
				}
				//Upload image
				$response = $this->file_model->upload_file($airlines_path, 'airline_logo', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
					
					//Set sessions for the image details
					$this->session->set_userdata('airline_logo_file_name', $file_name);
					$this->session->set_userdata('airline_logo_thumb_name', $thumb_name);
					
					return TRUE;
				}
			
				else
				{
					$this->session->set_userdata('airline_logo_error_message', $response['error']);
					
					return FALSE;
				}
			}
			
			else{
				$this->session->set_userdata('airline_logo_error_message', '');
				return FALSE;
			}
		}
		
		else
		{
			$this->session->set_userdata('airline_logo_error_message', '');
			return FALSE;
		}
	}
	
	public function register_airline_details()
	{
		$data = array( 
				'airline_name' => $this->input->post('airline_name'),
				'airline_phone' => $this->input->post('airline_phone'),
				'airline_email' => $this->input->post('airline_email'),
				'airline_summary' => $this->input->post('airline_summary'),
				'country_id' => $this->input->post('country_id'),
				'air_operator_certificate' => $this->input->post('air_operator_certificate')
				
		);
		
		$this->session->set_userdata($data);
		
		return TRUE;
	}
	
	public function register_user_details()
	{
		$data = array( 
				'airline_user_first_name' => $this->input->post('airline_user_first_name'),
				'airline_user_last_name' => $this->input->post('airline_user_last_name'),
				'airline_user_email' => $this->input->post('airline_user_email'),
				'airline_user_phone' => $this->input->post('airline_user_phone'),
				'airline_user_password' => $this->input->post('airline_user_password')
		);
		
		$this->session->set_userdata($data);
		
		return TRUE;
	}
	
	public function register_airline()
	{
		$data = array( 
				'airline_name' => $this->session->userdata('airline_name'),
				'airline_phone' => $this->session->userdata('airline_phone'),
				'airline_email' => $this->session->userdata('airline_email'),
				'airline_summary' => $this->session->userdata('airline_summary'),
				'airline_user_first_name' => $this->session->userdata('airline_user_first_name'),
				'airline_user_last_name' => $this->session->userdata('airline_user_last_name'),
				'airline_user_email' => $this->session->userdata('airline_user_email'),
				'airline_user_phone' => $this->session->userdata('airline_user_phone'),
				'aoc_number' => $this->session->userdata('air_operator_certificate'),
				'airline_user_password' => md5($this->session->userdata('airline_user_password')),
				'airline_logo' => $this->session->userdata('airline_logo_file_name'),
				'airline_thumb' => $this->session->userdata('airline_logo_thumb_name')
		);
		
		if($this->db->insert('airline', $data))
		{
			return $this->db->insert_id();
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update airline's last login date
	*
	*/
	public function update_airline_login($airline_id)
	{
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('airline_id', $airline_id);
		$this->db->update('airline', $data); 
	}
	
	/*
	*	Retrieve all flights
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_charter_quotes($table, $where, $per_page, $page, $limit = NULL, $order_by = NULL, $order_method = NULL)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		
		if(($order_by != NULL) && ($order_method != NULL))
		{
			$this->db->order_by($order_by, $order_method);
		}
		
		if(isset($limit))
		{
			$query = $this->db->get('', $limit);
		}
		
		else
		{
			$query = $this->db->get('', $per_page, $page);
		}
		
		return $query;
	}
	public function get_active_countries()
	{
		$this->db->where('country_status = 1');
		$this->db->order_by('country_id');
		$query = $this->db->get('country');
		
		return $query;
	}
}