
<div class="subscribe">

	<div class="container center-align">
    	<div class="row">
        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            	<h2>We couldn't find the page you are looking for :-(</h2>
                
                <p>Sorry the page you requested could not be found. </p>
                <?php
				//check if user has valid login credentials
				if($this->login_model->validate_frontend_user())
				{
					?>
                    <p>Perhaps you could go to you account?</p>
                	<a href="<?php echo site_url().'account';?>" class="btn btn-green">Take me to my account</a>
                    <?php
				}
				
				else
				{
					?>
                    <p>Would you like to sign up/in?</p>
                	<a href="<?php echo site_url().'sign-in';?>" class="btn btn-blue">Sign Me In</a>
                	<a href="<?php echo site_url().'membership';?>" class="btn btn-green">Sign Me Up</a>
                    <?php
				}
				?>
            </div>
        </div>
	</div>
</div>