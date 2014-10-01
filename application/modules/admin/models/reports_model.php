<?php

class Reports_model extends CI_Model 
{
	
	/*
	*	Retrieve all user's grades
	*	@param string $user_id
	*
	*/
	public function get_user_unpaid_grades($user_id)
	{
		//retrieve all users
		$this->db->from('user_grade, package');
		$this->db->select('package.package_name AS grade_name, user_grade.created');
		$this->db->where('user_grade.package_id = package.package_id AND user_grade.user_id = '.$user_id);
		$this->db->order_by('grade_name, created');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all user's grades
	*	@param string $user_id
	*
	*/
	public function get_user_paid_grades($user_id)
	{
		//retrieve all users
		$this->db->from('user_grade, package, payment');
		$this->db->select('DATE_ADD(payment.payment_date,INTERVAL 1 YEAR) AS next_payment, user_grade.created, payment.payment_date, payment.payment_amount, user_grade.subscription_number, package.package_name, package.package_id', FALSE);
		$this->db->where('payment.user_grade_id = user_grade.user_grade_id AND user_grade.package_id = package.package_id AND user_grade.user_id = '.$user_id);
		$this->db->order_by('payment_date', 'DESC');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve total users
	*
	*/
	public function get_total_users()
	{
		$this->db->select('COUNT(user_id) AS total_users');
		$this->db->where('user_status_id = 1');
		$query = $this->db->get('user');
		
		$result = $query->row();
		
		return $result->total_users;
	}
	
	/*
	*	Retrieve total payments
	*
	*/
	public function get_balance()
	{
		//select the user by email from the database
		$this->db->select('SUM(payment_amount) AS total_payment');
		$this->db->from('payment');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_payment;
	}
	
	/*
	*	Retrieve all payments of a subscription
	*	@param string $user_grade_id
	*
	*/
	public function get_subscription_payments($user_grade_id)
	{
		//retrieve all users
		$this->db->from('user_grade, payment, grade, package, package_item');
		$this->db->select('grade.grade_name, user_grade.created, payment.payment_date, payment.payment_amount');
		$this->db->where('payment.user_grade_id = user_grade.user_grade_id AND user_grade.package_id = package.package_id AND package_item.package_id = package.package_id AND package_item.grade_id = grade.grade_id AND user_grade.user_grade_id = '.$user_grade_id);
		$this->db->order_by('grade_name, created, payment_date');
		$query = $this->db->get();
		
		return $query;
	}
}