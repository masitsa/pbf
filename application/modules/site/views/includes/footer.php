<div class="footer">
	<div class="container">
    	<div class="contacts row">
            <!-- Contacts -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <h3>Contacts</h3>
                <ul>
                	<li><a href="mailto:animations@awesomemath.net"><span class="glyphicon glyphicon-envelope"></span> animations@awesomemath.net</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-map-marker"></span> 1511 harvest crossing dr<br/>
Wylie, Texas, 75098</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-phone"></span> (214) 616 8896</a></li>
                </ul>
                <div>
                    
                </div>
                <div>
                    
                </div>
            </div><!-- End Contacts -->
        
            <!-- Quick Links -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#contact" data-scroll="">Contact</a></li>
                    <li><a href="#membership" data-scroll="">Membership</a></li>
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
						<li><a href="#membership" data-scroll="">Sign Up</a></li>
						<?php
					}
					?>
                </ul>
            </div><!-- End Quick Links -->
        </div>
        <!-- End Contacts -->
        
        <div class='center-align'>&copy; <?php echo date('Y');?> awesomemath.NET. All Rights Reserved.</div>
        
    </div><!-- End Container -->
</div><!-- End Footer -->
<!-- Load javascript
================================================== --> 

<!-- Jquery  --> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/jquery/";?>jquery-2.1.1.min.js"></script>
<!-- Bootstrap--> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/";?>bootstrap/js/bootstrap.min.js"></script> 
<!-- Single page navigation --> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>jquery.nav.js"></script> 
<!-- Stellar --> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>jquery.stellar.min.js"></script> 
<!-- WOW --> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>wow.min.js"></script> 
<!-- Retina -->
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>retina.min.js"></script>
<!-- Fit Vids -->
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>jquery.fitvids.js"></script>
<!-- Fit Vids -->
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>owl.carousel.min.js"></script>
<!-- Smooth Scroll -->
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>bind-polyfill.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>smooth-scroll.js"></script>
<!-- Custom --> 
<script type="text/javascript" src="<?php echo base_url()."assets/themes/custom/js/";?>custom.js"></script> 

<script type="text/javascript">
	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
  		var msViewportStyle = document.createElement("style")
  			msViewportStyle.appendChild(
    			document.createTextNode(
      				"@-ms-viewport{width:auto!important}"
    			)
  			)
  		document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
	}
</script>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39101445-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- End Google Analytics -->