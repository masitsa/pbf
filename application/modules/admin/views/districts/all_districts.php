<?php
		
		$result = '<a href="'.site_url().'add-district" class="btn btn-success pull-right">Add district</a>';
		
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
					  <th>Schools</th>
					  <th>Status</th>
					  <th colspan="3">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$district_id = $row->district_id;
				$district_name = $row->district_name;
				$district_status = $row->district_status;
				$status = $row->user_status_name;
				$state_name = $row->state_name;
				$schools = $this->users_model->count_items('school', 'district_id = '.$district_id);
				
				//create deactivated status display
				if($district_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-district/'.$district_id.'" onclick="return confirm(\'Do you want to activate '.$district_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($district_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-district/'.$district_id.'" onclick="return confirm(\'Do you want to deactivate '.$district_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$state_name.'</td>
						<td>'.$district_name.'</td>
						<td>'.$schools.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-district/'.$district_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-district/'.$district_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$district_name.'?\');">Delete</a></td>
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
			$result .= "There are no districts";
		}
		
		echo $result;
?>