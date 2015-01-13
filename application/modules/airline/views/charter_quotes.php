
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
									  <th>Date Placed</th>
									  <th>Requested By</th>
									  <th>Email</th>
									  <th>Phone</th>
									  <th colspan="5">Actions</th>
									</tr>
								  </thead>
								  <tbody>
							';
							
							foreach ($query->result() as $row)
							{
								$charter_quote_id = $row->charter_quote_id;
								$charter_quote_date = $row->charter_quote_date;
								$source = $row->source;
								$destination = $row->destination;
								$airline_id = $row->airline_id;
								$date_from = $row->date_from;
								$date_to = $row->date_to;
								$trip_type_id = $row->trip_type_id;
								$sender_name = $row->sender_name;
								$sender_email = $row->sender_email;
								$sender_phone = $row->sender_phone;
								$description = $row->description;
								
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
								
								if($source == 0)
								{
									$source = 'Not specified';
								}
								
								if($date_from == '0000-00-00')
								{
									$date_from = 'Not specified';
								}
								
								if($date_to == '0000-00-00')
								{
									$date_to = 'Not specified';
								}
								
								$count++;
								$result .= 
								'
									<tr>
										<td>'.$count.'</td>
										<td>'.date('jS M Y H:i',strtotime($charter_quote_date)).'</td>
										<td>'.$sender_name.'</td>
										<td>'.$sender_email.'</td>
										<td>'.$sender_phone.'</td>
										<td>
											<!-- Button to trigger modal -->
											<a href="#user'.$charter_quote_id.'" class="btn btn-sm btn-primary" data-toggle="modal">View</a>
											
											<!-- Modal -->
											<div id="user'.$charter_quote_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h4 class="modal-title">Charter Quote Details</h4>
														</div>
														
														<div class="modal-body">
															<table class="table table-stripped table-condensed table-hover">
																<tr>
																	<td>Placed on</td>
																	<td>'.$charter_quote_date.'</td>
																</tr>
																<tr >
																	<td>Placed by</td>
																	<td>'.$sender_name.'</td>
																</tr>
																<tr>
																	<td>Email</td>
																	<td>'.$sender_email.'</td>
																</tr>
																<tr>
																	<td>Phone</td>
																	<td>'.$sender_phone.'</td>
																</tr>
																<tr>
																	<td>Destination</td>
																	<td>'.$destination.'</td>
																</tr>
																<tr>
																	<td>Source</td>
																	<td>'.$source.'</td>
																</tr>
																<tr >
																	<td>Departure</td>
																	<td>'.$date_from .'</td>
																</tr>
																<tr>
																	<td>Arrival</td>
																	<td>'.$date_to.'</td>
																</tr>
																<tr>
																	<td>Description</td>
																	<td>'.$description.'</td>
																</tr>
															</table>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
														</div>
													</div>
												</div>
											</div>
										
										</td>
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
