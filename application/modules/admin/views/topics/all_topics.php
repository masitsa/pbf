<?php
		
		$result = '<a href="'.site_url().'add-topic" class="btn btn-success pull-right">Add Topic</a>';
		
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
					  <th>Grade</th>
					  <th>Topic Number</th>
					  <th>Topic Name</th>
					  <th>Topic Parent</th>
					  <th>Sub Topics</th>
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
				$topic_id = $row->topic_id;
				$topic_name = $row->topic_name;
				$grade_name = $row->grade_name;
				$topic_number = $row->topic_number;
				$topic_parent = $row->topic_parent;
				$topic_status = $row->topic_status;
				$image = $row->topic_image_name;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$created = $row->created;
				$modified = $row->modified;
				$status = $row->user_status_name;
				
				//subtopics
				$subs = '';
				$total_subs = 0;
				
				$subtopics = $this->topics_model->get_sub_topics($topic_id);
				
				if($subtopics->num_rows() > 0)
				{
					$sub_details = $subtopics->result();
					
					foreach($sub_details as $sub)
					{
						$sub_id = $sub->topic_id;
						$sub_name = $sub->topic_name;
						$sub_number = $sub->topic_number;
						$sub_image = $sub->topic_image_name;
						$sub_status = $sub->topic_status;
						
						if($sub_status == 0)
						{
							$status2 = '<span class="label label-important">Deactivated</span>';
							$button2 = '<a class="btn btn-info" href="'.site_url().'activate-topic/'.$sub_id.'" onclick="return confirm(\'Do you want to activate '.$sub_name.'?\');">Activate</a>';
						}
						//create activated status display
						else if($sub_status == 1)
						{
							$status2 = '<span class="label label-success">Active</span>';
							$button2 = '<a class="btn btn-default" href="'.site_url().'deactivate-topic/'.$sub_id.'" onclick="return confirm(\'Do you want to deactivate '.$sub_name.'?\');">Deactivate</a>';
						}
						$total_subs++;
						
						$subs .= 
						'
						<tr>
							<td><img src="'.base_url()."assets/images/topics/thumbnail_".$sub_image.'"></td>
							<td>'.$sub_number.'</td>
							<td>'.$sub_name.'</td>
							<td>'.$status2.'</td>
							<td><a href="'.site_url().'edit-topic/'.$sub_id.'" class="btn btn-sm btn-success">Edit</a></td>
							<td>'.$button2.'</td>
							<td><a href="'.site_url().'delete-topic/'.$sub_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$sub_name.'? This will delete all sub topics of it as well if it has any.\');">Delete</a></td>
						</tr>
						';
					}
				}
				
				else
				{
					$subs = '
						<tr colspan="2">
							<td>There are no sub topics here</td>
						</tr>';
				}
				
				//topic parent
				foreach($query->result() as $row2)
				{
					$topic_id2 = $row->topic_id;
					if($topic_parent == $topic_id2)
					{
						$topic_parent = $row->topic_name;
					}
					else
					{
						$topic_parent = '-';
					}
				}
				
				//create deactivated status display
				if($topic_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'activate-topic/'.$topic_id.'" onclick="return confirm(\'Do you want to activate '.$topic_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($topic_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'deactivate-topic/'.$topic_id.'" onclick="return confirm(\'Do you want to deactivate '.$topic_name.'?\');">Deactivate</a>';
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
						<td><img src="'.base_url()."assets/images/topics/thumbnail_".$image.'"></td>
						<td>'.$grade_name.'</td>
						<td>'.$topic_number.'</td>
						<td>'.$topic_name.'</td>
						<td>'.$topic_parent.'</td>
						<td>'.$total_subs.'</td>
						<td>'.date('jS M Y H:i a',strtotime($modified)).'</td>
						<td>'.$status.'</td>
						<td>
							
							<!-- Button to trigger modal -->
							<a href="#user'.$topic_id.'" class="btn btn-primary" data-toggle="modal">View</a>
							
							<!-- Modal -->
							<div id="user'.$topic_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$topic_name.'</h4>
										</div>
										
										<div class="modal-body">
											<table class="table table-stripped table-condensed table-hover">
												<tr>
													<th>Image</th>
													<th>Sub Topic Number</th>
													<th>Sub Topic Name</th>
													<th>Status</th>
													<th colspan="3">Actions</th>
												</tr>
												'.$subs.'
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
										</div>
									</div>
								</div>
							</div>
						
						</td>
						<td><a href="'.site_url().'edit-topic/'.$topic_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'delete-topic/'.$topic_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$topic_name.'? This will delete all sub topics of it as well if it has any.\');">Delete</a></td>
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
			$result .= "There are no topics";
		}
		
		echo $result;
?>