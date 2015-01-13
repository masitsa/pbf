<?php
	$this->load->model('site/site_model');
	$navigation = $this->site_model->get_navigation();
?>
<!-- Title -->
        <div class="title">
        	<div class="container">
        		<h1>PRIVATE BUSH FLIGHTS</h1>
            </div>
        </div>
        <!-- End Title -->
        
        <div class="clear-both"></div>
        
        <!-- Navigation -->
        <div class="navigation">
        	<div class="container">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                        </div>
                
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                               <?php echo $navigation;?>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                          <!-- Collect the nav links, forms, and other content for toggling -->
                        <!-- <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown mega-dropdown">
                                    <a id="subscribe-button" href="#" class="dropdown-toggle" data-toggle="dropdown">Subscribe <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
                                    
                                    <ul class="dropdown-menu mega-dropdown-menu row">
                                      <div class="navigation-subscription-bar">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="destination" class="col-sm-4 control-label">First Name <span class="info">*</span></label>
                                                    <div class="col-sm-8">
                                                            <input type="text" class="form-control fieldset__input" name="first_name" placeholder="First Name *">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="airline_name" class="col-sm-4 control-label">Last Name <span class="info">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control fieldset__input" name="last_name" placeholder="Last Name *">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="air_operator_certificate" class="col-sm-4 control-label">Email Address <span class="info">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control fieldset__input" name="date_from" placeholder="Email Address *">
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                    </ul>
                                </li>
                            </ul>
                          
                        </div> --><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div><!-- /.container -->
		</div><!-- /.Navigation -->