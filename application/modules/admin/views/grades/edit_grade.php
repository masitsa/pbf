          <link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			
			//the grade details
			$grade_id = $grade[0]->grade_id;
			$grade_name = $grade[0]->grade_name;
			$grade_status = $grade[0]->grade_status;
			$image = $grade[0]->grade_image_name;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$grade_name = set_value('grade_name');
				$grade_status = set_value('grade_status');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- grade Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Grade Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="grade_name" placeholder="grade Name" value="<?php echo $grade_name;?>" required>
                </div>
            </div>
            <!-- Image -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Grade Image</label>
                <input type="hidden" value="<?php echo $image;?>" name="current_image"/>
                <div class="col-lg-4">
                    
                    <div class="row">
                    
                    	<div class="col-md-4 col-sm-4 col-xs-4">
                        	<div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                    <img src="<?php echo base_url()."assets/images/grades/".$image;?>">
                                </div>
                                <div>
                                    <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="grade_image"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate grade?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                        	<?php
                            if($grade_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="grade_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="1" name="grade_status">';}
							?>
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<?php
                            if($grade_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="grade_status">';}
							else{echo '<input id="optionsRadios1" type="radio" value="0" name="grade_status">';}
							?>
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit grade
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>