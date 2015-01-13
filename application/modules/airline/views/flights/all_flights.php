
<div class="col-lg-12" style="margin-bottom:5px;">
    <a href="<?php echo site_url()?>airline/add-flight" class="btn btn-primary pull-right">Add a new Flight</a>
</div>

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
									  <th>Date</th>
									  <th>Departure Time</th>
									  <!--<th>Arrival Time</th>
									  <th>Flight Type</th>
									  <th>Airplane Type</th>-->
									  <th>Seats</th>
									  <th>Passengers</th>
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
								$flight_seats = $row->flight_seats;
								$source = $row->source;
								$destination = $row->destination;
								$airplane_type_name = $row->airplane_type_name;
								$flight_status = $row->flight_status;
								$created = $row->created;
								$last_modified = $row->last_modified;
								
								//get passengers
								$passengers_query = $this->flights_model->get_flight_passengers($flight_id);
								$total_passengers = $passengers_query->num_rows();
								$passengers = '';
								
								if(empty($total_passengers))
								{
									$total_passengers = 0;
								}
								
								else
								{
									foreach($passengers_query->result() as $pas_res)
									{
										$passenger_fname = $pas_res->booking_passenger_first_name;
										$passenger_lname = $pas_res->booking_passenger_last_name;
										$passenger_passport = $pas_res->booking_passenger_passport;
										$passenger_nationality = $pas_res->booking_passenger_nationality;
										
										$passengers .= '
											<tr>
												<td>'.$passenger_fname.'</td>
												<td>'.$passenger_lname.'</td>
												<td>'.$passenger_passport.'</td>
												<td>'.$passenger_nationality.'</td>
											</tr>
										';
									}
								}
								
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
									$status = '<span class="label label-danger">Deactivated</span>';
									$button = '<a class="btn btn-sm btn-info" href="'.site_url().'airline/activate-flight/'.$flight_id.'/'.$page.'" onclick="return confirm(\'Do you want to activate ?\');">Activate</a>';
								}
								//create activated status display
								else if($flight_status == 1)
								{
									$status = '<span class="label label-success">Active</span>';
									$button = '<a class="btn btn-sm btn-default" href="'.site_url().'airline/deactivate-flight/'.$flight_id.'/'.$page.'" onclick="return confirm(\'Do you want to deactivate ?\');">Deactivate</a>';
								}
								
								$count++;
								$result .= 
								'
									<tr>
										<td>'.$count.'</td>
										<td>'.date('jS M Y',strtotime($flight_date)).'</td>
										<td>'.date('H:i',strtotime($flight_departure_time)).'</td>
										<!--<td>'.$flight_arrival_time.'</td>
										<td>'.$flight_type_name.'</td>
										<td>'.$airplane_type_name.'</td>
										<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
										<td>'.date('jS M Y H:i a',strtotime($last_modified)).'</td>-->
										<td>'.$flight_seats.'</td>
										<td>'.$total_passengers.'</td>
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
										<td>
											<a class="btn btn-sm btn-warning" href="#passengers'.$flight_id.'" title="View Passengers" data-toggle="modal">Passengers</a>
											
											<!-- Modal -->
											<div id="passengers'.$flight_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Flight Detail</h4>
														</div>
														
														<div class="modal-body">
															<table class="table table-stripped table-condensed table-hover">
																<tr>
																	<th>First Name</th>
																	<th>Last Name</th>
																	<th>Passport No.</th>
																	<th>Nationality</th>
																</tr>
																'.$passengers.'
															</table>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
															<a href="'.site_url().'airline/export-passengers/'.$flight_id.'" class="btn btn-sm btn-success">Export</a>
														</div>
													</div>
												</div>
											</div>
										</td>
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
