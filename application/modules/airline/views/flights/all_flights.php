<?php
		
		$result = '<a href="'.site_url().'airline/add-flight" class="btn btn-success pull-right">Add Flight</a>';
            
		$success = $this->session->userdata('success_message');
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		
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
					  <th>Date</th>
					  <th>Departure Time</th>
					  <th>Arrival Time</th>
					  <th>Source</th>
					  <th>Destination</th>
					  <th>Flight Type</th>
					  <th>Airplane Type</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$flight_id = $row->flight_id;
				$flight_date = $row->flight_date;
				$flight_departure_time = $row->flight_departure_time;
				$flight_arrival_time = $row->flight_arrival_time;
				$flight_type_name = $row->flight_type_name;
				$source = $row->source;
				$destination = $row->destination;
				$airplane_type_name = $row->airplane_type_name;
				$flight_status = $row->flight_status;
				$created = $row->created;
				$last_modified = $row->last_modified;
				
				//get source & destination names
				if($airports_query->num_rows() > 0)
				{
					foreach($airports_query->result() as $res)
					{
						$airport_id = $res->airport_id;
						
						if($airport_id == $source)
						{
							$source = $res->airport_name;
						}
						
						if($airport_id == $destination)
						{
							$destination = $res->airport_name;
						}
					}
				}
				
				//status
				if($flight_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
				
				//create deactivated status display
				if($flight_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'airline/activate-flight/'.$flight_id.'" onclick="return confirm(\'Do you want to activate '.$flight_first_name.' '.$flight_last_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($flight_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'airline/deactivate-flight/'.$flight_id.'" onclick="return confirm(\'Do you want to deactivate '.$flight_first_name.' '.$flight_last_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.date('jS M Y H:i a',strtotime($flight_date)).'</td>
						<td>'.$flight_departure_time.'</td>
						<td>'.$flight_arrival_time.'</td>
						<td>'.$source.'</td>
						<td>'.$destination.'</td>
						<td>'.$flight_type_name.'</td>
						<td>'.$airplane_type_name.'</td>
						<!--<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
						<td>'.date('jS M Y H:i a',strtotime($last_modified)).'</td>-->
						<td>'.$status.'</td>
						<td>
							
							<!-- Button to trigger modal -->
							<a href="#user'.$flight_id.'" class="btn btn-primary" data-toggle="modal">View</a>
							
							<!-- Modal -->
							<div id="user'.$flight_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$flight_first_name.' '.$flight_last_name.'</h4>
										</div>
										
										<div class="modal-body">
											<table class="table table-stripped table-condensed table-hover">
												<tr>
													<th>First Name</th>
													<td>'.$flight_first_name.'</td>
												</tr>
												<tr>
													<th>Last Name</th>
													<td>'.$flight_last_name.'</td>
												</tr>
												<tr>
													<th>Phone</th>
													<td>'.$flight_phone.'</td>
												</tr>
												<tr>
													<th>Email</th>
													<td>'.$flight_email.'</td>
												</tr>
												<tr>
													<th>flight Type</th>
													<td>'.$flight_type_name.'</td>
												</tr>
												<tr>
													<th>Status</th>
													<td>'.$status.'</td>
												</tr>
												<tr>
													<th>Date Created</th>
													<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
												</tr>
												<tr>
													<th>Last Login</th>
													<td>'.date('jS M Y H:i a',strtotime($last_login)).'</td>
												</tr>
												<tr>
													<th>Last Modified</th>
													<td>'.date('jS M Y H:i a',strtotime($row->last_modified)).'</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
											<a href="'.site_url().'airline/edit-flight/'.$flight_id.'" class="btn btn-sm btn-success">Edit</a>
											'.$button.'
											<a href="'.site_url().'airline/delete-flight/'.$flight_id.'/'.$page.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$flight_first_name.' '.$flight_last_name.'?\');">Delete</a>
										</div>
									</div>
								</div>
							</div>
						
						</td>
						<td><a href="'.site_url().'airline/edit-flight/'.$flight_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'airline/delete-flight/'.$flight_id.'/'.$page.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$flight_first_name.' '.$flight_last_name.'?\');">Delete</a></td>
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
			$result .= "There are no flights";
		}
		
		echo $result;
?>