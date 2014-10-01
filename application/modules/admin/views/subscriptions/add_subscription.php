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
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- Customer -->
            <div class="form-group col-lg-4">
                <label class="col-lg-4 control-label">Customer</label>
                <div class="col-lg-7">
                    <select name="user_id" id="user_id" class="form-control" required>
                        <?php
                        if($all_users->num_rows() > 0)
                        {
                            $result = $all_users->result();
                            
                            foreach($result as $res)
                            {
                                if($res->user_id == set_value('user_id'))
                                {
                                    echo '<option value="'.$res->user_id.'" selected>'.$res->user_fname.' '.$res->user_oname.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->user_id.'">'.$res->user_fname.' '.$res->user_oname.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <div class="form-group col-lg-4">
                <label class="col-lg-4 control-label">Package</label>
                <div class="col-lg-7">
                    <select name="package_id" class="form-control" required>
                        <?php
                        if($all_grades->num_rows() > 0)
                        {
                            $result = $all_grades->result();
                            
                            foreach($result as $res)
                            {
                                if($res->package_id == set_value('package_id'))
                                {
                                    echo '<option value="'.$res->package_id.'" selected>'.$res->package_name.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->package_id.'">'.$res->package_name.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Create New Subscription
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>