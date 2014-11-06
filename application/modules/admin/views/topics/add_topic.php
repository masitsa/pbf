          <link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- Grade -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Grade</label>
                <div class="col-lg-4">
                	<select name="grade_id" class="form-control" required>
                    	<?php
						if($all_grades->num_rows() > 0)
						{
							$result = $all_grades->result();
							
							foreach($result as $res)
							{
								if($res->grade_id == set_value('grade_id'))
								{
									echo '<option value="'.$res->grade_id.'" selected>'.$res->grade_name.'</option>';
								}
								else
								{
									echo '<option value="'.$res->grade_id.'">'.$res->grade_name.'</option>';
								}
							}
						}
						?>
                    </select>
                </div>
            </div>
            <!-- Topic Parent -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Topic Parent</label>
                <div class="col-lg-4">
                	<select name="topic_parent" class="form-control" required>
                    	<?php
						echo '<option value="0">No Parent</option>';
						if($all_topics->num_rows() > 0)
						{
							$result = $all_topics->result();
							
							foreach($result as $res)
							{
								if($res->topic_id == set_value('topic_parent'))
								{
									echo '<option value="'.$res->topic_id.'" selected>'.$res->topic_name.'</option>';
								}
								else
								{
									echo '<option value="'.$res->topic_id.'">'.$res->topic_name.'</option>';
								}
							}
						}
						?>
                    </select>
                </div>
            </div>
            <!-- Topic Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Topic Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="topic_name" placeholder="Topic Name" value="<?php echo set_value('topic_name');?>" required>
                </div>
            </div>
            <!-- Topic Number -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Topic Number</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="topic_number" placeholder="Topic Number" value="<?php echo set_value('topic_number');?>" required>
                </div>
            </div>
            <!-- Image -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Topic Image</label>
                <div class="col-lg-4">
                    
                    <div class="row">
                    
                    	<div class="col-md-4 col-sm-4 col-xs-4">
                        	<div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                    <img src="http://placehold.it/200x200">
                                </div>
                                <div>
                                    <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="topic_image"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate Topic?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" checked value="1" name="topic_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" value="0" name="topic_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add Topic
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>