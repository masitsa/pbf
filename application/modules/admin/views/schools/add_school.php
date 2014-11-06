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
            
            <?php  echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- State -->
            <div class="form-group">
                <label class="col-lg-4 control-label">District</label>
                <div class="col-lg-7">
                    <select name="district_id" id="district_id" class="form-control" required>
                        <?php
                        if($all_districts->num_rows() > 0)
                        {
                            $result = $all_districts->result();
                            
                            foreach($result as $res)
                            {
                                if($res->district_id == set_value('district_id'))
                                {
                                    echo '<option value="'.$res->district_id.'" selected>'.$res->district_name.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->district_id.'">'.$res->district_name.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <!-- school Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">School Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="school_name" placeholder="School Name" value="<?php echo set_value('school_name');?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate school?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" checked value="1" name="school_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" value="0" name="school_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add school
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>