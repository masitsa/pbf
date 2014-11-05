<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="<?php echo base_url()."assets/themes/bluish/";?>style/bootstrap.css" rel="stylesheet">
<<<<<<< HEAD
  <link rel="stylesheet" href="<?php echo base_url()."assets/themes/bluish/";?>style/font-awesome.css">
  <link href="<?php echo base_url()."assets/themes/bluish/";?>style/style.css" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url()."assets/images/";?>favicon.png">
=======
  <link rel="<?php echo base_url()."assets/themes/bluish/";?>stylesheet" href="style/font-awesome.css">
  <link href="<?php echo base_url()."assets/themes/bluish/";?>style/style.css" rel="stylesheet">
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
  
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

</head>

<<<<<<< HEAD
<body class="login math">
=======
<body class="login">
>>>>>>> 440b632956276893c42653c41e62545e66db29dd

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
<<<<<<< HEAD
            <div class="logo"><a href="<?php echo site_url();?>" class="navbar-brand">awesomemath.<span class="bold">net</span></a></div>
=======
            <div class="logo"><a href="<?php echo site_url();?>" class="navbar-brand"><span class="bold">P</span>BF <span class="bold">A</span>DMINISTRATION</a></div>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
            <div class="widget">
              <!-- Widget head -->
              <div class="widget-head">
                  Sign In to your Account
              </div>
<<<<<<< HEAD
              
              <div style="text-align:center; margin-bottom:20px;">
              	Don't have an account?<br/>
                <a href="<?php echo site_url().'home#membership';?>">Sign Up</a>
              </div>

              <div class="widget-content">
                <div class="padd">
					<?php
                    $error2 = $this->session->userdata('error_message');
                    $success = $this->session->userdata('success_message');
                    if(!empty($error2))
                    {
                        ?>
                            <div class="alert alert-danger">
                                <p>
                                    <?php 
                                        echo $error2;
                                        $this->session->unset_userdata('error_message');
                                    ?>
                                </p>
                            </div>
                        <?php
                    }
                    
                    if(!empty($success))
                    {
                        ?>
                            <div class="alert alert-success">
                                <p>
                                    <?php 
                                        echo $success;
                                        $this->session->unset_userdata('success_message');
                                    ?>
                                </p>
                            </div>
                        <?php
                    }
                    ?>
                    
                	<!-- Login Errors -->
                    <?php
					$validation_errors = validation_errors();
                    if(!empty($validation_errors)){
                        echo '<div class="alert alert-danger">'.$validation_errors.'</div>';
                    }
					if(isset($error)){
                    	echo '<div class="alert alert-danger">'.$error.'</div>';
=======

              <div class="widget-content">
                <div class="padd">
                	<!-- Login Errors -->
                    <?php
					if(isset($error)){
                    	echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
					}
					?>
                  <!-- Login form -->
                  <?php 
				  echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
				  ?>
                    <!-- Email -->
                    <div class="form-group">
<<<<<<< HEAD
                        <i class="icon-envelope"></i>
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
=======
                        <i class="icon-user"></i>
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <i class="icon-lock"></i>
<<<<<<< HEAD
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
=======
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                      <div class="form-actions">
                          <label class="checkbox pull-left">
                              <div class="checker">
                                <span>
                                 <input class="uniform" type="checkbox" name="remember">
                                </span>
                              </div>
                              Remember me
                          </label>
                          <button class="submit btn btn-primary pull-right" type="submit">
                              Sign In
                              <i class="icon-angle-right"></i>
                          </button>
                      </div>
                    <br />
                  <?php echo form_close();?>
				  
				</div>
                </div>
              
                <div class="widget-foot">
                  Forgot Password? <a href="#" class="reset_password">Click here to reset</a>
<<<<<<< HEAD
                  <form class="form-horizontal hide_section" action="<?php echo site_url()."reset-password";?>" id="forgot_password" method="POST">
                    <!-- Email -->
                    <div class="form-group">
                        <i class="icon-user"></i>
                        <input type="text" class="form-control" id="inputEmail" name="admin_email" placeholder="Email">
=======
                  <form class="form-horizontal hide_section" action="<?php echo site_url()."login/forgot_password/1";?>" id="forgot_password">
                    <!-- Email -->
                    <div class="form-group">
                        <i class="icon-user"></i>
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                      <div class="form-actions">
                          <button class="submit btn btn-primary pull-right" type="submit">
                              Reset Password
                              <i class="icon-angle-right"></i>
                          </button>
                      </div>
                    <br />
                  </form>
                </div>
            </div>
<<<<<<< HEAD
              
                <div class="horizontal-links" style="text-align:center;">
                    <a href="<?php echo site_url();?>">Home</a> | <a href="<?php echo site_url().'#grades';?>">Grades</a> | <a href="<?php echo site_url().'#membership';?>">Membership</a> | <a href="<?php echo site_url().'#contact';?>">Contact Us</a>
                </div>
=======
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
      </div>
    </div>
  </div> 
</div>
	
		

<!-- JS -->
<script src="<?php echo base_url()."assets/themes/bluish/";?>js/jquery.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish/";?>js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).on("click","a.reset_password",function(){
		
		$( "#forgot_password" ).removeClass( "hide_section" );
		$( "#forgot_password" ).addClass( "show_section" );
	});
</script>
</body>
</html>