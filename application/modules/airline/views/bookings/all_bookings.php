
  <div class="col-lg-12">
        
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php echo $title;?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
<?php
		$result ='';
		// $result = '<a href="'.site_url().'airline/add-flight" class="btn btn-success pull-right">Add Flight</a>';
            
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
									  <th>Visitor</th>
									  <th>Date</th>
									  <th>Departure Day</th>
									  <th>Departure Time</th>
									  <th>Seats</th>
									  <th>Unit Cost</th>
									  <th>Total Cost</th>
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
								$booking_amount = $row->booking_amount;
								$booking_units = $row->booking_units;
								$visitor_first_name = $row->visitor_first_name;
								$visitor_last_name = $row->visitor_last_name;
								$booking_status = $row->booking_status;
								
								//get source & destination names
								/*if($airports_query->num_rows() > 0)
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
								}*/
								
								//create deactivated status display
								if($flight_status == 0)
								{
									$status = '<span class="label label-danger">Unpaid</span>';
								}
								//create activated status display
								else if($flight_status == 1)
								{
									$status = '<span class="label label-success">Paid</span>';
								}
								
								$count++;
								$result .= 
								'
									<tr>
										<td>'.$count.'</td>
										<td>'.$visitor_first_name.' '.$visitor_last_name.'</td>
										<td>'.date('jS M Y H:i a',strtotime($flight_date)).'</td>
										<td>'.$flight_departure_time.'</td>
										<td>'.$booking_units.'</td>
										<td>'.$booking_amount.'</td>
										<td>'.($booking_amount * $booking_units).'</td>
										<td>'.$status.'</td>
										<td>
											
											<!-- Button to trigger modal -->
											<a href="#user'.$flight_id.'" class="btn btn-sm btn-primary" data-toggle="modal">View</a>
											
											<!-- Modal -->
											<div id="user'.$flight_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Flight Detail</h4>
														</div>
														
														<div class="modal-body">
															<table class="table table-stripped table-condensed table-hover">
																<tr>
																	<td>Source</td>
																	<td>'.$source.'</td>
																</tr>
																<tr>
																	<td>Destination</td>
																	<td>'.$destination.'</td>
																</tr>
																<tr >
																	<td>Departure Time</td>
																	<td>'.$flight_departure_time .'</td>
																</tr>
																<tr>
																	<td>Arrival Time</td>
																	<td>'.$flight_arrival_time.'</td>
																</tr>
																<tr>
																	<td>Status</td>
																	<td>'.$status.'</td>
																</tr>
																
																
																
															</table>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
															<a href="'.site_url().'airline/edit-flight/'.$flight_id.'" class="btn btn-sm btn-success">Edit</a>
															'.$button.'
															
														</div>
													</div>
												</div>
											</div>
										
										</td>
										<td><a href="'.site_url().'airline/edit-flight/'.$flight_id.'" class="btn btn-sm btn-success">Edit</a></td>
										<td>'.$button.'</td>
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
</div>
</div>
</div>
