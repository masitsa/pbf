<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-top">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 navbar-left">
                    <ul class="nav navbar-nav">
                        <li><a href="mailto:animations@awesomemath.net" class="hide-help">Help</a></li>
                        <li><a href="mailto:animations@awesomemath.net" class="mail"><span class="glyphicon glyphicon-envelope"></span> animations@awesomemath.net</a></li>
                    </ul>
                </div>
            	<div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                    <ul class="nav navbar-nav navbar-right">
                    	<?php
						//user has logged in
						if($this->login_model->check_frontend_login())
						{
							?>
                            <li><a href="<?php echo site_url().'account';?>">My Account</a></li>
                            <?php
						}
						
						//user has not logged in
						else
						{
							?>
                            <li><a href="<?php echo site_url().'sign-in';?>">Sign In</a></li>
                        	<li><a href="<?php echo site_url().'membership';?>" data-scroll="">Sign Up</a></li>
                            <?php
						}
						?>
                    </ul>
                </div>
            </div>
          
       </div>
    </div>
    
    <div class="container navbar-bottom">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url().'home';?>"><img src="<?php echo base_url().'assets/images/logo_white.png';?>" class="img-responsive"/></a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-collapse collapse navbar-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" id="nav">
            <li><a href="<?php echo site_url().'home';?>">Home</a></li>
            <!--<li><a href="#grades">Grades</a></li>
            <li><a href="#why">Why</a></li> -->
            <li><a href="<?php echo site_url().'membership';?>">Membership</a></li>
            <li><a href="<?php echo site_url().'home';?>#contact">Contact</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>