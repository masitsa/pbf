<?php
		$result = '<a href="'.site_url().'add-subscription" class="btn btn-success pull-right">Add Subscription</a>';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>Date Created</th>
					  <th>Subscription Number</th>
					  <th>Customer</th>
					  <th>Subscription Type</th>
					  <th>Grade</th>
					  <th>Cost</th>
					  <th>Status</th>
					  <th colspan="4">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			//get all administrators
			$administrators = $this->users_model->get_all_administrators();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$created_by = $row->created_by;
				$created = $row->created;
				$modified_by = $row->modified_by;
				$last_modified = $row->modified;
				$user_grade_id = $row->user_grade_id;
				$subscription_number = $row->subscription_number;
				$user = $row->user_fname.' '.$row->user_oname;
				$user_type_name = $row->user_type_name;
				$user_type_cost = $row->user_type_cost;
				$subscription_status = $row->subscription_status;
				$grade_name = $row->grade_name;
				
				//get paid grades
				$grades = $this->reports_model->get_subscription_payments($user_grade_id);
				$user_grades = '';
				
				if($grades->num_rows() > 0)
				{
					$grade_result = $grades->result();
					
					foreach($grade_result as $gr)
					{
						$grade_name = $gr->grade_name;
						$subscription_date = $gr->created;
						$payment_date = $gr->payment_date;
						$payment_amount = $gr->payment_amount;
						
						$user_grades.=
						'
							<tr>
								<td>'.$grade_name.'</td>
								<td>'.$subscription_date.'</td>
								<td>'.$payment_date.'</td>
								<td>'.$payment_amount.'</td>
							</tr>
						';
					}
				}
				
				else
				{
					$user_grades = 'This subscription has no payments yet';
				}
				
				//creators & editors
				if($admins != NULL)
				{
					foreach($admins as $adm)
					{
						$user_id = $adm->user_id;
						
						if($user_id == $modified_by)
						{
							$modified_by = $adm->user_fname;
						}
					}
				}
				
				else
				{
					$modified_by = '-- Not modified --';
				}
				
				$items = '
					
					<table class="table table-striped table-condensed">
					<tr>
						<th>Item</th>
						<td></td>
					</tr>';
				
				//create deactivated status display
				if($subscription_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-subscription/'.$user_grade_id.'" onclick="return confirm(\'Do you want to deactivate '.$subscription_number.'?\');">Disable</a>';
				}
				//create activated status display
				else if($subscription_status == 0)
				{
					$status = '<span class="label label-danger">Disabled</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-subscription/'.$user_grade_id.'" onclick="return confirm(\'Do you want to activate '.$subscription_number.'?\');">Activate</a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
						<td>'.$subscription_number.'</td>
						<td>'.$user.'</td>
						<td>'.$user_type_name.'</td>
						<td>'.$grade_name.'</td>
						<td>'.number_format($user_type_cost, 2, '.', ',').'</td>
						<td>'.$status.'</td><td>
							
							<!-- Button to trigger modal -->
							<a href="#user'.$user_grade_id.'" class="btn btn-primary" data-toggle="modal">Payments</a>
							
							<!-- Modal -->
							<div id="user'.$user_grade_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$subscription_number.'</h4>
										</div>
										
										<div class="modal-body">
											<table class="table table-stripped table-condensed table-hover">
												'.$user_grades.'
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
										</div>
									</div>
								</div>
							</div>
						
						</td>
						<td><a href="'.site_url().'edit-subscription/'.$user_grade_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-subscription/'.$user_grade_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete subscription '.$subscription_number.'?\');">Delete</a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no subscriptions";
		}
		
		echo $result;
?>