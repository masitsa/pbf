<div class="col-lg-12" style="margin-bottom:5px;">
    <a href="<?php echo site_url()?>airline/add-airplane-type" class="btn btn-primary pull-right">Add Airplane Type</a>
</div>
<?php
		
		$result = '';
            
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
							<th>Image</th>
							<th>Type</th>
							<th>Created</th>
							<th>Status</th>
							<th colspan="5">Actions</th>
						</tr>
					</thead>
				<tbody>
			';
			
			foreach ($query->result() as $row)
			{
				$airplane_type_id = $row->airplane_type_id;
				$airplane_type_name = $row->airplane_type_name;
				$airplane_type_status = $row->airplane_type_status;
				$thumb = $row->airplane_type_thumb;
				$created = $row->created;
				$created_by = $row->created_by;
				$user_type_id = $row->user_type_id;
				
				//status
				if($airplane_type_status == 1)
				{
					$status = 'Active';
				}
				else
				{
					$status = 'Disabled';
				}
			
				//get creator
				if($user_type_id == 3)
				{
					$creators = $this->users_model->get_user($created_by);
				}
				
				//create deactivated status display
				if($airplane_type_status == 0)
				{
					$status = '<span class="label label-danger">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'airline/activate-airplane-type/'.$airplane_type_id.'/'.$page.'" onclick="return confirm(\'Do you want to activate '.$airplane_type_name.'?\');">Activate</a>';
				}
				//create activated status display
				else if($airplane_type_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'airline/deactivate-airplane-type/'.$airplane_type_id.'/'.$page.'" onclick="return confirm(\'Do you want to deactivate '.$airplane_type_name.'?\');">Deactivate</a>';
				}
				
				$count++;
				if(($count % 2) == 0)
				{
					$sign = 'even gradeA';
				}
				else
				{
					$sign = 'odd gradeA';
				}
				
				$current_user = $this->session->userdata('user_id');
				
				if($created_by == $current_user)
				{
					$actions = '
						<td><a href="'.site_url().'airline/edit-airplane-type/'.$airplane_type_id.'" class="btn btn-sm btn-success">Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'airline/delete-airplane-type/'.$airplane_type_id.'/'.$page.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$airplane_type_name.'?\');">Delete</a></td>
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
					<tr class="'.$sign.'">
						<td>'.$count.'</td>
						<td><img src="'.$airplane_types_image_path.$thumb.'"></td>
						<td>'.$airplane_type_name.'</td>
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
			$result .= "There are no airplane_types";
		}
?>
                <div class="col-lg-12">
                    <div class="panel panel-primary">
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
         
            <!-- /.row -->
            