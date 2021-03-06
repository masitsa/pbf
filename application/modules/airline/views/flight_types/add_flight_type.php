<div class="col-lg-12" style="margin-bottom:5px;">
    <a href="<?php echo site_url()?>airline/all-flight-types" class="btn btn-primary pull-right">Back to Flight Type List</a>
</div>
<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php echo $title;?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$validation_errors.' </div>';
            }
            
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
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- flight_type Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Flight Type Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="flight_type_name" placeholder="Flight Type Name" value="<?php echo set_value('flight_type_name');?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Flight Type?</label>
                <div class="col-lg-4">
                	<?php
						$flight_type_status = set_value('flight_type_status');
                    	if($flight_type_status == '1')
						{
							$yes = 'checked';
							$no = '';
						}
						
						else
						{
							$yes = '';
							$no = 'checked';
						}
					?>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" <?php echo $yes;?> value="1" name="flight_type_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" <?php echo $no;?> value="0" name="flight_type_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add Flight Type
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                            
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->