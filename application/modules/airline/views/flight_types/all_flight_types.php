<?php
		
		$result = '<a href="'.site_url().'airline/add-flight-type" class="btn btn-success">Add Flight Type</a>';
            
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
					  <th>Flight Type Name</th>
					  <th>Created</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$flight_type_id = $row->flight_type_id;
				$flight_type_name = $row->flight_type_name;
				$flight_type_status = $row->flight_type_status;
				$created = $row->created;
				$created_by = $row->created_by;
				$user_type_id = $row->user_type_id;
				
				//status
				if($flight_type_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
				
				//create deactivated status display
				if($flight_type_status == 0)
				{
					$status = '<span class="label label-danger">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'airline/activate-flight-type/'.$flight_type_id.'/'.$page.'" onclick="return confirm(\'Do you want to activate '.$flight_type_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($flight_type_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'airline/deactivate-flight-type/'.$flight_type_id.'/'.$page.'" onclick="return confirm(\'Do you want to deactivate '.$flight_type_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				
				$current_user = $this->session->userdata('user_id');
				
				if($created_by == $current_user)
				{
					$actions = '
						<td><a href="'.site_url().'airline/edit-flight-type/'.$flight_type_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'airline/delete-flight-type/'.$flight_type_id.'/'.$page.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$flight_type_name.'?\');">Delete</a></td>
					';
				}
				
				else
				{
					$actions = '
						<td></td>
						<td></td>
						<td></td>
					';
				}
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$flight_type_name.'</td>
						<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
						<td>'.$status.'</td>
						'.$actions.'
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
			$result .= "There are no flight types";
		}
?>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $title;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            	<!-- Displaying Errors -->
								<?php
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
                                ?>
                                <?php echo $result;?>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->