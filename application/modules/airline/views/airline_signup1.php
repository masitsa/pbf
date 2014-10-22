		
        <script type="text/javascript" src="<?php echo base_url();?>assets/jasny/jasny-bootstrap.js"></script> 
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
                                <button type="button" class="btn btn-circle-active btn-circle">1</button>
                                <p>Airline</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle">2</button>
                                <p>About You</p>
                            </div>
                            <div class="stepwizard-step">
                                <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
                                <p>Review</p>
                            </div> 
                        </div>
                    </div>
                    <!-- End: Steps -->
                    
                	<form action="#" class="form-horizontal" role="form">
                    	<div class="row">
                        	<div class="col-md-6 first">
                            	<div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Airline <span class="info">*</span></label>
                                    <div class="col-sm-9">
                                    	<input type="text" class="form-control" id="inputEmail3" placeholder="Airline">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Phone <span class="info">*</span></label>
                                    <div class="col-sm-9">
                                    	<input type="text" class="form-control" id="inputPassword3" placeholder="Phone">
                                        <span class="info">This will be displayed to visitors of your page</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Email <span class="info">*</span></label>
                                    <div class="col-sm-9">
                                    	<input type="email" class="form-control" id="inputPassword3" placeholder="Email">
                                        <span class="info">This will be displayed to visitors of your page</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Summary
                                        <span class="info">*</span></label>
                                    <div class="col-sm-9">
                                    	<textarea class="form-control" id="inputPassword3" placeholder="Summary"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Logo</label>
                                    <div class="col-sm-9">
                                    	<div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="">
                                                <img src="http://placehold.it/300x300">
                                            </div>
                                            <div>
                                                <span class="btn btn-file btn-grey"><span class="fileinput-new">Default Image</span><span class="fileinput-exists">Change</span><input type="file" name="product_image" required></span>
                                                <a href="#" class="btn btn-grey fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-red">Continue</button>
                                <p>already have an account?</p>
                                <a href="#">Sign In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Join -->