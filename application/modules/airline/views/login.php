 <!-- Sign In  -->
        <div class="grey-background div-head">
        	<div class="container">
                <div class="divider-line"></div>
                <h1 class="center-align">Sign in to your account</h1>
                <div class="divider-line" style="margin-bottom:2%;"></div>
        		
				<?php
                    $attributes = array(
                                    'class' => 'form-horizontal',
                                    'role' => 'form',
                                );
                    echo form_open($this->uri->uri_string(), $attributes);
                ?>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-3">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Email <span class="info">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputPassword3" placeholder="Email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Password <span class="info">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row center-align">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-red">Sign In</button>
                            <p>Don't have an account?</p>
                            <a href="#">Sign Up</a>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
        <!-- End Sign In -->
        