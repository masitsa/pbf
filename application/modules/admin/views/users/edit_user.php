          <div class="padd">
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			$first_name = $users[0]->user_fname;
			$other_names = $users[0]->user_oname;
			$email = $users[0]->email;
			$password = $users[0]->password;
			$user_type_id = $users[0]->user_type_id;
			$school_id = $users[0]->school_id;
			$activated = $users[0]->user_status_id;
			$user_id = $users[0]->user_id;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
				$first_name = set_value('first_name');
				$other_names = set_value('other_names');
				$email = set_value('email');
				$password = set_value('password');
				$user_type_id = set_value('user_type_id');
				$school_id = set_value('school_id');
				$activated = set_value('activated');
            }
            ?>
            
            <?php echo form_open('edit-user/'.$user_id, array("class" => "form-horizontal", "role" => "form"));?>
            <!-- First Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">First Name</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name;?>">
                </div>
            </div>
            <!-- Other Names -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Other Names</label>
                <div class="col-lg-4">
                	<input type="text" class="form-control" name="other_names" placeholder="Other Names" value="<?php echo $other_names;?>">
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Email</label>
                <div class="col-lg-4">
                	<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>">
                </div>
            </div>
            <?php if(isset($admin_user)){ ?>
            <!-- Password -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Current Password</label>
                <div class="col-lg-4">
                	<input type="hidden" class="form-control" name="admin_user" value="<?php echo $admin_user;?>">
                	<input type="hidden" class="form-control" name="old_password" value="<?php echo $password;?>">
                	<input type="password" class="form-control" name="current_password" placeholder="Password">
                </div>                
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">New Password</label>
                <div class="col-lg-4">
                	<input type="password" class="form-control" name="new_password" placeholder="Password">
                </div>                
            </div>
            <?php } ?>
            
            <!-- State -->
            <div class="form-group">
                <label class="col-lg-4 control-label">School</label>
                <div class="col-lg-4">
                    <select name="school_id" id="school_id" class="form-control" required>
                        <?php
                        if($schools->num_rows() > 0)
                        {
                            $result = $schools->result();
                            
                            foreach($result as $res)
                            {
                                if($res->school_id == $school_id)
                                {
                                    echo '<option value="'.$res->school_id.'" selected>'.$res->school_name.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->school_id.'">'.$res->school_name.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div> 
            <!-- User Level -->
            <div class="form-group">
                <label class="col-lg-4 control-label">User Type</label>
                <div class="col-lg-4">
                    <select name="user_type_id" class="form-control">
                        <option value="0">Administrator</option>
						<?php
                        if($user_types->num_rows() > 0)
                        {
                            $result = $user_types->result();
                            
                            foreach($result as $res)
                            {
                                if($res->user_type_id == $user_type_id)
                                {
                                    echo '<option value="'.$res->user_type_id.'" selected>'.$res->user_type_name.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$res->user_type_id.'">'.$res->user_type_name.'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Activate checkbox -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Activate User?</label>
                <div class="col-lg-4">
                    <div class="radio">
                        <label>
                        	<?php
                            if($activated == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="activated">';}
							else{echo '<input id="optionsRadios1" type="radio" value="1" name="activated">';}
							?>
                            Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<?php
                            if($activated == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="activated">';}
							else{echo '<input id="optionsRadios1" type="radio" value="0" name="activated">';}
							?>
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit User
                </button>
            </div>
            <br />
            <?php echo form_close();?>
		</div>