<?php

class Reports_model extends CI_Model 
{
<<<<<<< HEAD
	
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
=======
	public function get_queue_total($date = NULL, $where = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		if($where == NULL)
		{
			$where = 'close_card = 0 AND visit_date = \''.$date.'\'';
		}
		
		else
		{
			$where .= ' AND close_card = 0 AND visit_date = \''.$date.'\' ';
		}
		
		$this->db->select('COUNT(visit_id) AS queue_total');
		$this->db->where($where);
		$query = $this->db->get('visit');
		
		$result = $query->row();
		
		return $result->queue_total;
	}
	
	public function get_daily_balance($date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		//select the user by email from the database
		$this->db->select('SUM(visit_charge_units*visit_charge_amount) AS total_amount');
		$this->db->where('visit_charge_timestamp LIKE \''.$date.'%\'');
		$this->db->from('visit_charge');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_amount;
	}
	
	public function get_patients_total($date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		$this->db->select('COUNT(visit_id) AS patients_total');
		$this->db->where('visit_date = \''.$date.'\'');
		$query = $this->db->get('visit');
		
		$result = $query->row();
		
		return $result->patients_total;
	}
	
	public function get_all_payment_methods()
	{
		$this->db->select('*');
		$query = $this->db->get('payment_method');
		
		return $query;
	}
	
	public function get_payment_method_total($payment_method_id, $date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		$this->db->select('SUM(amount_paid) AS total_paid');
		$this->db->where('payments.visit_id = visit.visit_id AND payment_method_id = '.$payment_method_id.' AND visit_date = \''.$date.'\'');
		$query = $this->db->get('payments, visit');
		
		$result = $query->row();
		
		return $result->total_paid;
	}
	
	public function get_all_order_types()
	{
		$this->db->select('*');
		$query = $this->db->get('order_status');
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
		
		return $query;
	}
	
<<<<<<< HEAD
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
=======
	public function get_orders_total($order_status_id, $date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		$where = 'created LIKE \''.$date.'%\' AND order_status = '.$order_status_id;
		
		$this->db->select('COUNT(order_id) AS total');
		$this->db->where($where);
		$query = $this->db->get('orders');
		
		$result = $query->row();
		
		return $result->total;
	}
	
	public function get_products_total($category_id)
	{
		$where = 'product.category_id = category.category_id AND product.product_id = order_item.product_id AND (category.category_id = '.$category_id.' OR category.category_parent = '.$category_id.') AND orders.order_status = 2 AND orders.order_id = order_item.order_id';
		
		$this->db->select('SUM(quantity*price) AS total');
		$this->db->where($where);
		$query = $this->db->get('product, category, order_item, orders');
		
		$result = $query->row();
		$total = $result->total;;
		
		if($total == NULL)
		{
			$total = 0;
		}
		
		return $total;
	}
	
	public function get_all_appointments($date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		$where = 'visit.visit_type = visit_type.visit_type_id AND visit.appointment_id = 1 AND visit.visit_date >= \''.$date.'\'';
		
		$this->db->select('visit_date, time_start, time_end, visit_type_name');
		$this->db->where($where);
		$query = $this->db->get('visit, visit_type');
		
		return $query;
	}
	
	public function get_all_sessions($date = NULL)
	{
		if($date == NULL)
		{
			$date = date('Y-m-d');
		}
		$where = 'personnel.personnel_id = session.personnel_id AND session.session_name_id = session_name.session_name_id AND session_time LIKE \''.$date.'%\'';
		
		$this->db->select('session_name_name, session_time, personnel_fname, personnel_onames');
		$this->db->where($where);
		$this->db->order_by('session_time', 'DESC');
		$query = $this->db->get('session, session_name, personnel');
		
		return $query;
	}
	
	public function get_usage_total()
	{
		$this->db->select('SUM(clicks) AS total');
		$query = $this->db->get('product');	
		
		$result = $query->row();
		
		return $result->total;
	}
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
}