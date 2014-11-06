<?php

class Subscriptions_model extends CI_Model 
{
	/*
	*	Retrieve all user_grade
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_subscriptions($table, $where, $per_page, $page)
	{
		//retrieve all user_grade
		$this->db->from($table);
		$this->db->select('user_grade.*, user.user_fname, user.user_oname, package.package_name AS grade_name, user_type.user_type_name, user_type.user_type_cost, user_status.user_status_name');
		$this->db->where($where);
		$this->db->order_by('created, subscription_number');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all user_grade of a user
	*
	*/
	public function get_user_subscriptions($user_id)
	{
		$this->db->where('user_id = '.$user_id);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('user_grade');
		
		return $query;
	}
	
	/*
	*	Retrieve an subscription
	*
	*/
	public function get_subscription($user_grade_id)
	{
		$this->db->select('*');
		$this->db->where('user_grade.user_grade_id = '.$user_grade_id);
		$query = $this->db->get('user_grade');
		
		return $query;
	}
	
	/*
	*	Retrieve all subscription items of an subscription
	*
	*/
	public function get_subscription_items($subscription_id)
	{
		$this->db->select('product.product_name, product.product_thumb_name, subscription_item.*');
		$this->db->where('product.product_id = subscription_item.product_id AND subscription_item.subscription_id = '.$subscription_id);
		$query = $this->db->get('subscription_item, product');
		
		return $query;
	}
	
	/*
	*	Create subscription number
	*
	*/
	public function create_subscription_number()
	{
		//select product code
		$this->db->from('user_grade');
		$this->db->select('MAX(subscription_number) AS number');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number
			
			if($number == 1){
				$number = "ORD".date('y')."/001";
			}
		}
		else{//start generating receipt numbers
			$number = "ORD".date('y')."/001";
		}
		
		return $number;
	}
	
	/*
	*	Create the total cost of an subscription
	*	@param int subscription_id
	*
	*/
	public function calculate_subscription_cost($subscription_id)
	{
		//select product code
		$this->db->from('subscription_item');
		$this->db->where('subscription_id = '.$subscription_id);
		$this->db->select('SUM(price * quantity) AS total_cost');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$total_cost =  $result[0]->total_cost;
		}
		
		else
		{
			$total_cost = 0;
		}
		
		return $total_cost;
	}
	
	/*
	*	Add a new subscription
	*
	*/
	public function add_subscription()
	{
		$subscription_number = $this->create_subscription_number();
		
		$data = array(
				'subscription_number'=>$subscription_number,
				'user_id'=>$this->input->post('user_id'),
				'package_id'=>$this->input->post('package_id'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('user_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
			
		if($this->db->insert('user_grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new subscription
	*
	*/
	public function add_payment($user_grade_id, $amount, $tx, $sig, $user_id, $error = 0)
	{
		$data = array(
				'user_grade_id'=>$user_grade_id,
				'payment_amount'=>$amount,
				'tx'=>$tx,
				'sig'=>$sig,
				'error'=>$error,
				'payment_date'=>date('Y-m-d H:i:s')
			);
			
		if($this->db->insert('payment', $data))
		{
			$data2['activation_status'] = 1;
			$this->db->where('user_id', $user_id);
			$this->db->update('user', $data2); 
			$this->session->set_userdata('activation_status', 1);
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new user grade
	*
	*/
	public function add_user_grade($user_id, $package_id)
	{
		$subscription_number = $this->create_subscription_number();
		
		$data = array(
				'subscription_number'=>$subscription_number,
				'user_id'=>$user_id,
				'package_id'=>$package_id,
				'subscription_status'=>1,
				'created'=>date('Y-m-d H:i:s')
			);
			
		if($this->db->insert('user_grade', $data))
		{
			$this->session->set_userdata('user_grade_id', $this->db->insert_id());
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an subscription
	*	@param int $subscription_id
	*
	*/
	public function update_subscription($user_grade_id)
	{
		$subscription_number = $this->create_subscription_number();
		
		$data = array(
				'user_id'=>$this->input->post('user_id'),
				'grade_id'=>$this->input->post('grade_id'),
				'modified_by'=>$this->session->userdata('user_id')
			);
		
		$this->db->where('user_grade_id', $user_grade_id);
		if($this->db->update('user_grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
	*	Retrieve all user_grade
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_payment_methods()
	{
		//retrieve all user_grade
		$this->db->from('payment_method');
		$this->db->select('*');
		$this->db->order_by('payment_method_name');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing subscription item
	*	@param int $product_id
	*
	*/
	public function delete_subscription($user_grade_id)
	{
		if($this->db->delete('user_grade', array('user_grade_id' => $user_grade_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated subscription
	*	@param int $user_grade_id
	*
	*/
	public function activate_subscription($user_grade_id)
	{
		$data = array(
				'subscription_status' => 1
			);
		$this->db->where('user_grade_id', $user_grade_id);
		
		if($this->db->update('user_grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated subscription
	*	@param int $user_grade_id
	*
	*/
	public function deactivate_subscription($user_grade_id)
	{
		$data = array(
				'subscription_status' => 0
			);
		$this->db->where('user_grade_id', $user_grade_id);
		
		if($this->db->update('user_grade', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}