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
                <label class="col-lg-4 control-label">State</label>
                <div class="col-lg-7">
                    <select name="state_id" id="state_id" class="form-control" required>
                        <?php
                        if($all_states->num_rows() > 0)
                        {
                            $result = $all_states->result();
                            
                            foreach($result as $res)
                            {
                                if($res->state_id == set_value('state_id'))
                                {
                                    echo '<option value="'.$res->state_id.'" selected>'.$res->state_name.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->state_id.'">'.$res->state_name.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <!-- district Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">District Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="district_name" placeholder="District Name" value="<?php echo set_value('district_name');?>" required>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate district?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                            <input id="optionsRadios1" type="radio" checked value="1" name="district_status">
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input id="optionsRadios2" type="radio" value="0" name="district_status">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add district
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>