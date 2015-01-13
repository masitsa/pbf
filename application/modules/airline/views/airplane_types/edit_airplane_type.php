<link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/><div class="row">
<div class="col-lg-12" style="margin-bottom:5px;">
    <a href="<?php echo site_url()?>airline/all-airplane-types" class="btn btn-primary pull-right">Back to Airplane Types</a>
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
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            
            if(isset($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$validation_errors.' </div>';
				
				$airplane_type_name = set_value('airplane_type_name');
				$airplane_type_status = set_value('airplane_type_status');
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
            
            <?php 
				echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));
				echo form_hidden('current_image', $airplane_type->airplane_type_image);
				echo form_hidden('current_image2', $airplane_type->airplane_type_image2);
				echo form_hidden('current_image3', $airplane_type->airplane_type_image3);
				echo form_hidden('current_image4', $airplane_type->airplane_type_image4);
			?>
            
            <!-- airplane_type Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Airplane Type</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="airplane_type_name" placeholder="Airplane Type" value="<?php echo $airplane_type_name;?>">
                </div>
            </div>
            
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Airplane Type?</label>
                <div class="col-lg-4">
                    
                	<?php
                    	if($airplane_type_status == '1')
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
                            <input id="optionsRadios1" type="radio" <?php echo $yes;?> value="1" name="airplane_type_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" <?php echo $no;?> value="0" name="airplane_type_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-lg-6 control-label">Interior First Image</label>
                            <div class="col-lg-6">
                                
                                <div class="row">
                                
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                                <img src="<?php echo $airplane_type_image;?>">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-warning"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="airplane_type_image"></span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-lg-6 control-label">Interior Second Image</label>
                            <div class="col-lg-6">
                                
                                <div class="row">
                                
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                                <img src="<?php echo $airplane_type_image2;?>">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-warning"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="airplane_type_image2"></span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                </div>

            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-lg-6 control-label">Exterior First Image (Main)</label>
                            <div class="col-lg-6">
                                
                                <div class="row">
                                
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                                <img src="<?php echo $airplane_type_image3;?>">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-warning"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="airplane_type_image3"></span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-lg-6 control-label">Exterior Second Image</label>
                            <div class="col-lg-6">
                                
                                <div class="row">
                                
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                                <img src="<?php echo $airplane_type_image4;?>">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-warning"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="airplane_type_image4"></span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit Airplane Type
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

<script src="<?php echo base_url()."assets/themes/jasny/js/jasny-bootstrap.js"?>" type="text/javascript"></script>