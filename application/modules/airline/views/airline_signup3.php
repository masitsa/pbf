		<!-- Join  -->
        <div class="grey-background">
        	<div class="container">
        		<div class="search-flights">
                	<div class="divider-line"></div>
                	<h1 class="center-align">Airline Sign Up</h1>
                	<div class="divider-line" style="margin-bottom:2%;"></div>
                    
                    <!-- Steps -->
                    <div class="stepwizard">
                        <div class="stepwizard-row">
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle">1</button>
                                <p>Airline</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle">2</button>
                                <p>About You</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-circle-active btn-circle" disabled="disabled">3</button>
                                <p>Review</p>
                            </div> 
                        </div>
                    </div>
                    <!-- End: Steps -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Airline Details</legend>
                    
                                <div class="row">
                                    <div class="col-md-6">
                                
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Airline</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_name;?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Phone</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_phone;?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_email;?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Summary</label>
                                            <div class="col-sm-9 review-text">
                                                <p><?php echo $airline_summary;?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Logo</label>
                                            <div class="col-sm-9 review-text">
                                                <img src="<?php echo $airline_logo_location;?>" class="img-responsive" alt="<?php echo $airline_name;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        
                        <div class="col-md-12">
                            <fieldset>
                                <legend>About You</legend>
                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_user_first_name;?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Last Name</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_user_last_name;?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_user_phone;?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="inputPassword3" class="col-sm-3 control-label">Phone</label>
                                            <div class="col-sm-9 review-text">
                                                <?php echo $airline_user_email;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        	</fieldset>
                        </div>
                                
                    </div>
                        
                    <div class="row center-align">
                        <div class="col-sm-12">
                            <span class="go-back"><a href="<?php echo site_url().'airline/sign-up/user-details'?>">Go Back</a></span>
                           	<a href="<?php echo site_url().'airline/register'?>" class="btn btn-red">Register</a>
                            <p>already have an account?</p>
                            <a href="<?php echo site_url('airline/sign-in');?>">Sign In</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End Join -->