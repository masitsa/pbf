<?php
		
		$result = '<a href="'.site_url().'airline/add-airport" class="btn btn-success">Add Airport</a>';
            
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
				<table class="table table-striped table-bordered table-hover table-condensed">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Airport Name</th>
					  <th>Airport Location</th>
					  <th>Created</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$airport_id = $row->airport_id;
				$airport_name = $row->airport_name;
				$location_name = $row->location_name;
				$airport_status = $row->airport_status;
				$created = $row->created;
				$created_by = $row->created_by;
				$user_type_id = $row->user_type_id;
				
				//status
				if($airport_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
				
				//create deactivated status display
				if($airport_status == 0)
				{
					$status = '<span class="label label-danger">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'airline/activate-airport/'.$airport_id.'/'.$page.'" onclick="return confirm(\'Do you want to activate '.$airport_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($airport_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'airline/deactivate-airport/'.$airport_id.'/'.$page.'" onclick="return confirm(\'Do you want to deactivate '.$airport_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				
				$current_user = $this->session->userdata('user_id');
				
				if($created_by == $current_user)
				{
					$actions = '
						<td><a href="'.site_url().'airline/edit-airport/'.$airport_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'airline/delete-airport/'.$airport_id.'/'.$page.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$airport_name.'?\');">Delete</a></td>
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
						<td>'.$airport_name.'</td>
						<td>'.$location_name.'</td>
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
			$result .= "There are no airports";
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