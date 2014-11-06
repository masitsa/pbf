<?php
		
		$result = '<a href="'.site_url().'add-school" class="btn btn-success pull-right">Add school</a>';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>State</th>
					  <th>District</th>
					  <th>School</th>
					  <th>Users</th>
					  <th>Status</th>
					  <th colspan="3">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$school_id = $row->school_id;
				$school_name = $row->school_name;
				$school_status = $row->school_status;
				$status = $row->user_status_name;
				$state_name = $row->state_name;
				$district_name = $row->district_name;
				$users = $this->users_model->count_items('user', 'school_id = '.$school_id);
				
				//create deactivated status display
				if($school_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-school/'.$school_id.'" onclick="return confirm(\'Do you want to activate '.$school_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($school_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-school/'.$school_id.'" onclick="return confirm(\'Do you want to deactivate '.$school_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$state_name.'</td>
						<td>'.$district_name.'</td>
						<td>'.$school_name.'</td>
						<td>'.$users.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-school/'.$school_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-school/'.$school_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$school_name.'?\');">Delete</a></td>
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
			$result .= "There are no schools";
		}
		
		echo $result;
?>