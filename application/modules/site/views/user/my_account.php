
<div class="subscribe">

	<div class="container">
            
            <div class="row">
                Hi <?php echo $this->session->userdata('first_name');?>
                <a href="<?php echo site_url().'sign-out';?>" class="btn btn-info float-right">
                	<span class="glyphicon glyphicon-log-out"></span> Sign Out
                </a>
            </div>
            
            <p>Welcome to your account. Here you can manage all of your personal information and view the presentations.</p>
            
            <div class="center-align">
    			<?php
                $error = $this->session->userdata('front_error_message');
				$success = $this->session->userdata('front_success_message');
				if(!empty($error))
				{
					?>
						<div class="alert alert-danger">
							<p>
								<?php 
									echo $error;
									$this->session->unset_userdata('front_error_message');
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
									$this->session->unset_userdata('front_success_message');
								?>
							</p>
						</div>
					<?php
				}
				?>
                <div class="row account-buttons">
                <?php
				if(!$this->session->userdata('second_platform'))
				{
				?>
                    <div class="col-sm-6 col-md-4">
                    	<button type="button" class="btn btn-blue btn-lg" data-toggle="modal" data-target="#my_purchases">
                        	<span class="glyphicon glyphicon-calendar"></span> My Purchases
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="my_purchases" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header btn-blue">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">My Subscriptions</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                    	<?php echo $this->load->view('user/orders_list', '', TRUE);?>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                    	<button type="button" class="btn btn-red btn-lg" data-toggle="modal" data-target="#my_details">
                        	<span class="glyphicon glyphicon-user"></span> My Details
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="my_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header btn-red">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">About Me</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                    	<?php echo $this->load->view('user/my_details', '', TRUE);?>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
				}
					?>
                    <div class="col-sm-6 col-md-4">
                    	<a href="<?php echo site_url().'grades/6';?>">
                            <button type="button" class="btn btn-green btn-lg">
                                <span class="glyphicon glyphicon-book"></span> My Grades
                            </button>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
</div>