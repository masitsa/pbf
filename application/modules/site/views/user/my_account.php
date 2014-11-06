<<<<<<< HEAD

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
=======
<?php
	$user = $user_details->row();
	$fname = $user->first_name;
?>
<div class="container main-container headerOffset">
  
  <?php echo $this->load->view('products/breadcrumbs');?>
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
        	<p>Hi <?php echo $fname;?></p>
          <h2 class="block-title-2"><span>Welcome to your account. Here you can manage all of your personal information and orders.</span></h2>
          <ul class="myAccountList row">
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="Orders" href="<?php echo site_url().'account/orders-list';?>"><i class="fa fa-calendar"></i> Order history </a> </div>
            </li>
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="Personal information" href="<?php echo site_url().'account/my-details';?>"><i class="fa fa-cog"></i> Personal information</a> </div>
            </li>
            <!--<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight"> <a title="My wishlists" href="<?php echo site_url().'account/wishlist';?>"><i class="fa fa-heart"></i> My wishlists </a> </div>
            </li>-->
          </ul>
          <div class="clear clearfix"> </div>
        </div>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
      <h4 class="caps"><a href="<?php echo site_url().'account/sign-out';?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Sign Out </a></h4>
    </div>
  </div>
  <!--/row-->
  
  <div style="clear:both"></div>
</div>
<!-- /wrapper -->
<div class="gap"> </div>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
