<?php
		
		$result = '<a href="'.site_url().'add-grade" class="btn btn-success pull-right">Add grade</a>';
		
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
					  <th>Image</th>
					  <th>grade Name</th>
					  <th>Date Created</th>
					  <th>Last Modified</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
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
				$grade_id = $row->grade_id;
				$grade_name = $row->grade_name;
				$grade_status = $row->grade_status;
				$status = $row->user_status_name;
				$image = $row->grade_image_name;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$created = $row->created;
				$modified = $row->modified;
				
				//create deactivated status display
				if($grade_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-grade/'.$grade_id.'" onclick="return confirm(\'Do you want to activate '.$grade_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($grade_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-grade/'.$grade_id.'" onclick="return confirm(\'Do you want to deactivate '.$grade_name.'?\');">Deactivate</a>';
				}
				
				//creators & editors
				if($admins != NULL)
				{
					foreach($admins as $adm)
					{
						$user_id = $adm->user_id;
						
						if($user_id == $created_by)
						{
							$created_by = $adm->user_fname;
						}
						
						if($user_id == $modified_by)
						{
							$modified_by = $adm->user_fname;
						}
					}
				}
				
				else
				{
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td><img src="'.base_url()."assets/images/grades/thumbnail_".$image.'"></td>
						<td>'.$grade_name.'</td>
						<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
						<td>'.date('jS M Y H:i a',strtotime($modified)).'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'edit-grade/'.$grade_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-grade/'.$grade_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$grade_name.'?\');">Delete</a></td>
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
			$result .= "There are no grades";
		}
		
		echo $result;
?>