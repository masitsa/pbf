
<div class="subscribe">

	<div class="container center-align">
    	<div class="row">
        	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            	<iframe class="cover-slide" src="<?php echo base_url().'media/promotions/cover.swf';?>" frameborder="0" allowfullscreen></iframe>
            </div>
        	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 center-align">
                <h3>School Membership</h3>
                <p>@ $100.00 p.a.</p>
                <div style="margin-bottom:3%;">
        		<!-- School subscription @ $100.00 p.a. -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="KVSRWFL6KYF8Y">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>


                </div>
        <!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_SbyPP_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark"></a></td></tr></table><!-- PayPal Logo -->
        
                <?php
                
                    if($this->session->userdata('user_id') == 108)
                    {
                        echo
                        '
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="36M5Z4Y2Q3244">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        
                        ';
                    }
                ?>
        	</div>
	</div>
</div>
</div>