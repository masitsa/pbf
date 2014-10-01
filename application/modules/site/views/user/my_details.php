<?php
	$user = $user_details->row();
	?>

    <div class="row">
		<?php 
        if($this->session->userdata('user_level_id') == 1)
        {
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3><span><i class="glyphicon glyphicon-user"></i>School Information </span></h3>
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                	<p>My School</p>
                    <table class="table table-hover table-condensed table-striped">
                        <tr>
                            <th>School Name</th>
                            <td><?php echo $user->school_name;?></td>
                        </tr>
                        <tr>
                            <th>School District</th>
                            <td><?php echo $user->school_district;?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?php 
							
							$this->db->where('state_id', $user->state_id);
							$query = $this->db->get('state');
							$row = $query->row();
							echo $row->state_name;?></td>
                        </tr>
                        <tr>
                            <th>Official Email</th>
                            <td><?php echo $user->email;?></td>
                        </tr>
                    </table>
				</div>
                
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                	<p>Update School Password</p>
					<form action="<?php echo site_url().'account/update-password';?>" method="POST" role="form">
						<div class="form-group required">
							<label for="current_password"> Password <sup> * </sup> </label>
							<input type="password" value="" name="current_password" class="form-control" required>
							<input type="hidden" value="<?php echo $user->password;?>" name="slug">
						</div>
						<div class="form-group required">
							<label for="new_password"> New Password <sup> * </sup></label>
							<input type="password"  name="new_password" class="form-control" required>
						</div>
						<div class="form-group required">
							<label for="confirm_password"> Confirm Password <sup> * </sup></label>
							<input type="password"  name="confirm_password" class="form-control" required>
						</div>
						<div style="margin-left:35%;">
							<button type="submit" class="btn btn-primary" style=" margin-top:0;"><i class="fa fa-save"></i> &nbsp; Change Password </button>
						</div>
					</form>
                </div>
			</div>
		</div>
        <?php }?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3><span><i class="glyphicon glyphicon-user"></i> My personal information </span></h3>
            <div class="row userInfo">
				
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                	<p>Update your details</p>
					<form action="<?php echo site_url().'account/update-details';?>" method="POST" role="form">
						<div class="form-group required">
							<label for="first_name">First Name <sup>*</sup> </label>
							<input required  type="text" class="form-control" name="first_name" value="<?php echo $user->user_fname;?>" required>
						</div>
						<div class="form-group required">
							<label for="last_name">Last Name <sup>*</sup> </label>
							<input required type="text" class="form-control" name="last_name" value="<?php echo $user->user_oname;?>" required>
						</div>
						<div class="form-group">
							<label for="email"> Email </label>
							<input type="email" class="form-control" name="email" value="<?php echo $user->email;?>" readonly>
						</div>
						<div class="form-group">
							<label for="email">  </label>
							<button type="submit" class="btn   btn-primary"><i class="fa fa-save"></i> &nbsp; Update Account </button>
						</div>
					</form>
				</div>
                
                <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                <?php 
				if($this->session->userdata('user_level_id') == 1)
				{
					?>
                    <p>Update Secondary Password</p>
					<form action="<?php echo site_url().'account/update-school-password';?>" method="POST" role="form">
                    <input type="hidden" value="<?php echo $user->school_password;?>" name="slug">
					<?php
				}
				
				else
				{
					?>
                    <p>Update Password</p>
					<form action="<?php echo site_url().'account/update-password';?>" method="POST" role="form">
                    <input type="hidden" value="<?php echo $user->password;?>" name="slug">
					<?php
				}
				?>
                	
					
						<div class="form-group required">
							<label for="current_password"> Password <sup> * </sup> </label>
							<input type="password" value="" name="current_password" class="form-control" required>
						</div>
						<div class="form-group required">
							<label for="new_password"> New Password <sup> * </sup></label>
							<input type="password"  name="new_password" class="form-control" required>
						</div>
						<div class="form-group required">
							<label for="confirm_password"> Confirm Password <sup> * </sup></label>
							<input type="password"  name="confirm_password" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="confirm_password"></label>
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Update Password </button>
						</div>
						<div class="col-lg-12">
						</div>
					</form>
                </div>
			</div>
		</div>
		<!--/row end--> 
    </div>
    <!--/row-->