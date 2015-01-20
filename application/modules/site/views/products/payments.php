<?php
	$options = '';
	if($traveller_types->num_rows() > 0)
	{
		foreach($traveller_types->result() as $res)
		{
			$options .= '<option value="'.$res->traveller_type_id.'">'.$res->traveller_type_name.'</option>';
		}
	}
?>
<!-- Join  -->
<div class="grey-background div-head">
    <div class="container">
        <!--<div class="divider-line"></div>
        <h1 class="center-align">Book Flight</h1>
        <div class="divider-line" style="margin-bottom:2%;"></div>-->
        
		<?php echo $this->load->view('products/breadcrumbs');?>
		<?php
            
            if(!empty($payments_error))
            {
                echo '<div class="alert alert-danger center-align">'.$payments_error.'</div>';
            }
            
            if(!empty($iframe))
            {
                ?>
                <iframe src="<?php echo $iframe;?>" width="100%" height="700px"  scrolling="no" frameBorder="0">
                    <p>Browser unable to load iFrame</p>
                </iframe>
                <?php
            }
            
            else
            {
                //echo form_hidden('reference', '001');
                $flight_data = $flight->row();
                $source = $flight_data->source;
                $destination = $flight_data->destination;
                $flight_date = $flight_data->flight_date;
                $airline_id = $flight_data->airline_id;
                $flight_departure_time = $flight_data->flight_departure_time;
                $flight_arrival_time = $flight_data->flight_arrival_time;

                $airplane_type_image = $flight_data->airplane_type_image;
                $airplane_type_image2 = $flight_data->airplane_type_image2;
                $airplane_type_thumb = $flight_data->airplane_type_thumb;
                $airplane_type_image3 = $flight_data->airplane_type_image3;
                $airplane_type_thumb2 = $flight_data->airplane_type_thumb2;
                $airplane_type_image4 = $flight_data->airplane_type_image4;
                $airplane_type_thumb3 = $flight_data->airplane_type_thumb3;
                $airplane_type_thumb4 = $flight_data->airplane_type_thumb4;
                $airplane_type_name = $flight_data->airplane_type_name;


                $year = date('Y',strtotime($flight_date));
                $month = date('M',strtotime($flight_date));
                $day = date('jS',strtotime($flight_date));
                $flight_departure_time = date('H:i a',strtotime($flight_departure_time));
                $flight_arrival_time = date('H:i a',strtotime($flight_arrival_time));
                
                //get source & destination names
                if($airports_query->num_rows() > 0)
                {
                    foreach($airports_query->result() as $res)
                    {
                        $airport_id = $res->airport_id;
                        
                        if($airport_id == $source)
                        {
                            $source = $res->airport_name;
                        }
                        
                        if($airport_id == $destination)
                        {
                            $destination = $res->airport_name;
                        }
                    }
                }
                echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form'));
                echo form_hidden('type', 'MERCHANT');
                echo form_hidden('amount', $flight_data->flight_price);
                echo form_hidden('traveller_type_id', 2);
                echo form_hidden('description', 'Flight from '.$source.' '.$flight_departure_time.' to '.$destination.' '.$flight_arrival_time.' on '.$day.' '.$month.' '.$year);
        ?>
          <div class="row transitionfx">
              <div class="product-info">
               <!-- left column -->
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="product-images">
                            <div class="box">
                                <div id="main">
                                    <div id="gallery">
                                        <div id="slides">
                                            <div class="slide"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image;?>" width="920" height="400" /></div>
                                            
                                            <div class="slide"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image2;?>" width="920" height="400" /></div>
                                            
                                            <div class="slide"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image3;?>" width="920" height="400" /></div>
                                            
                                            <div class="slide"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image4;?>" width="920" height="400" /></div>
                                        </div>
                                        <div id="menu">
                                            <ul>
                                                <li class="fbar">&nbsp;</li>
                                                
                                                 <li class="menuItem"><a href="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image;?>"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image;?>" class="img-responsive" alt="img"/></a></li>
                                                
                                                 <li class="menuItem"><a href="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image2;?>"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image2;?>" class="img-responsive" alt="img"/></a></li>
                                                
                                                 <li class="menuItem"><a href="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image3;?>"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image3;?>" class="img-responsive" alt="img"/></a></li>
                                                
                                                 <li class="menuItem"><a href="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image4;?>"><img src="<?php echo base_url()?>assets/images/airplane_types/<?php echo $airplane_type_image4;?>" class="img-responsive" alt="img"/></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="social">
                                    <div id="sharrre">
                                        <div class="facebook sharrre"><button class="btn btn-mini btn-facebook"><i  class="fa fa-facebook"></i></button></div>
                                        <div class="twitter sharrre"><button class="btn btn-mini btn-twitter"><i  class="fa fa-twitter"></i></button></div>
                                        <div class="googleplus sharrre"><button class="btn btn-mini btn-twitter"><i  class="fa fa-google-plus"></i> </button></div>                                                   
                                        <div class="pinterest sharrre"><button class="btn btn-mini btn-pinterest"><i  class="fa fa-pinterest"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!--/ left column end -->
                
                
                
                
                <!-- right column -->
                <div class="col-lg-8 col-md-8 col-sm-8">
            
                    <div class="product-content">
                        <div class="box">
            
                            <!-- Tab panels' navigation -->
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#about-flight" data-toggle="tab">
                                        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                        <span class="hidden-phone">About Flight</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#about-airline" data-toggle="tab">
                                   
                                         <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                                       
                                        <span class="hidden-phone">About Airline</span>
                                    </a>
                                </li>
            
                                <li class="">
                                    <a href="#book-flight" data-toggle="tab">
                                  
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                        
                                        <span class="hidden-phone">Book Flight</span>
                                    </a>
                                </li>
            
                                <!--<li class="">
                                    <a href="#returns" data-toggle="tab">
                                        <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                                        <span class="hidden-phone">Returns</span>
                                    </a>
                                </li>
            
                                <li class="">
                                    <a href="#ratings" data-toggle="tab">
                                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                        <span class="hidden-phone">Ratings</span>
                                    </a>
                                </li>-->
                            </ul>
                            <!-- End Tab panels' navigation -->
                            
            
                            <!-- Tab panels container -->
                            
                            <div class="tab-content">
                                
                                <!-- Product tab -->
                                <div class="tab-pane active" id="about-flight">
                                    <table class="table table-condensed table-striped">
                                        <tr>
                                            <th>Source:</th>
                                            <td><?php echo $source;?></td>
                                        </tr>
                                        <tr>
                                            <th>Destination:</th>
                                            <td><?php echo $destination;?></td>
                                        </tr>
                                        <tr>
                                            <th>Departure Time:</th>
                                            <td><?php echo $day;?> <?php echo $month;?> at <?php echo $flight_departure_time;?></td>
                                        </tr>
                                        <tr>
                                            <th>Arrival Time:</th>
                                            <td><?php echo $day;?> <?php echo $month;?> at <?php echo $flight_arrival_time;?></td>
                                        </tr>
                                        <tr>
                                            <th>Available Seats:</th>
                                            <td><?php echo $available_seats;?></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- End id="product" -->
            
                                <!-- Shipping tab -->
                                <div class="tab-pane" id="about-airline">
                                    <img src="<?php echo $airline_logo_location.$flight_data->airline_thumb;?>" style="float:left; margin:0 5px 0 0;">
                                    <p style="text-align:justify;"><?php echo $flight_data->airline_summary;?></p>
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="fa fa-envelope"></i> <?php echo $flight_data->airline_email;?>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <i class="fa fa-phone"></i> <?php echo $flight_data->airline_phone;?>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="center-align">
                                        <h4>Contact <?php echo $flight_data->airline_name;?></h4>
                                    </div>
                                    <?php 
                                    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                                    echo form_open('contact-airline/'.$flight_id, $attributes);
                                        $errors = $this->session->userdata('contact_error');
                                        if(!empty($errors))
                                        {
                                            echo '
                                            <div class="alert alert-danger">
                                                '.$errors.'
                                            </div>
                                            ';
                                            $this->session->unset_userdata('contact_error');
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="sender_name" class="col-sm-4 control-label">Your Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="sender_name" placeholder="Name">
                                            <div id="name_error"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sender_email" class="col-sm-4 control-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="sender_email" placeholder="Email">
                                            <div id="email_error"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sender_phone" class="col-sm-4 control-label">Phone</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="sender_phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="airline_contact_message" class="col-sm-4 control-label">Message</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="airline_contact_message" placeholder="Message"></textarea>
                                            <div id="message_error"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="button" class="btn btn-primary contact_airline">Send</button>
                                        </div>
                                    </div>
                                    <?php echo form_close();?> -->					
                                </div>
                                <!-- End id="shipping" -->
            
                                <!-- Returns tab -->
                                <div class="tab-pane" id="book-flight">
                                   
                                   <div class="row">
                                        <div class="center-align">
                                            <h4>Please fill in your details to complete your payment</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="col-sm-4 control-label">First Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name');?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name');?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-4 control-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number" class="col-sm-4 control-label">Phone</label>
                                                <div class="col-sm-8">
                                                <input type="text" class="form-control" name="phone_number" placeholder="Phone" value="<?php echo set_value('phone_number');?>">
                                                </div>
                                            </div>
                                            <!--<div class="form-group">
                                                <label for="source" class="col-sm-4 control-label">Traveller Type</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="traveller_type_id">
                                                        <option value="">----Select Traveller Type----</option>
                                                        <?php echo $options;?>
                                                    </select>
                                                </div>
                                            </div>-->
                                            
                                            <div class="form-group">
                                                <label for="seats" class="col-sm-4 control-label">Book</label>
                                                <div class="col-sm-8">
                                                    <input id="book_seats" type="radio" value="1" name="booking_type" checked="checked"/> Seats
                                                    <input id="charter_plane" type="radio" value="2" name="booking_type"/> Charter Plane
                                                </div>
                                            </div>
                                            
                                            <div class="form-group book_seats">
                                                <label for="seats" class="col-sm-4 control-label">Seats</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="seats" name="seats" placeholder="Seats" value="1" value="<?php echo set_value('seats');?>">
                                                    <span class="info">You can book up to <?php echo $available_seats;?> seats</span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group charter_plane">
                                                <label for="seats" class="col-sm-4 control-label">Seats</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" id="seats" name="seats" placeholder="Seats" value="<?php echo $available_seats;?>">
                                                    <span class="info">You will book <?php echo $available_seats;?> seats</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="additional_info" class="col-lg-2 control-label">Additional Information</label>
                                                <div class="col-lg-10">
                                                    <textarea class="form-control" rows="5" name="additional_info" placeholder="Additional Information"><?php echo set_value('additional_info');?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="center-align">
                                        <h4>Please enter the details of the passengers</h4>
                                    </div>
                                    
                                    <div id="passengers">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                 <div class="form-group">
                                                    <label for="first_name" class="col-sm-12 control-label">First Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="passenger_first_name[]" placeholder="First Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                 <div class="form-group">
                                                    <label for="last_name" class="col-sm-12 control-label">Last Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="passenger_last_name[]" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                 <div class="form-group">
                                                    <label for="nationality" class="col-sm-12 control-label">Nationality</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="passenger_nationality[]" placeholder="Nationality">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                 <div class="form-group">
                                                    <label for="passport_no" class="col-sm-12 control-label">Passport/ ID No.</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="passenger_passport_no[]" placeholder="Passport/ ID No.">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                    </div>
                                     
                                    <div class="center-align">
                                        <input type="checkbox" name="terms_agree" value="1"/> I agree to the <a href="<?php echo site_url().'terms';?>" target="_blank">Terms & Conditions</a> specified by Private Bush Flights
                                    </div>
                                     
                                    <div class="center-align" style="margin-top:10px;">
                                        <button class="btn btn-primary" type="submit">Confirm Booking</button>
                                    </div>
                                    <?php echo form_close();?>
                                                
                                </div>
                                <!-- End id="returns" -->
                                
                            </div>                                            
                            <!-- End tab panels container -->
                            
                        </div>
                        
                    </div>
                  
                </div>
                <!--end of right column-->
                
              </div>
  		</div>
		<?php 
            }
        ?>
    </div>
</div>
<!-- End Join -->
<script type="text/javascript">
	
	$(document).ready(function(){
    /* This code is executed after the DOM has been completely loaded */

    var totWidth=0;
    var positions = new Array();

    $('#slides .slide').each(function(i){
        /* Loop through all the slides and store their accumulative widths in totWidth */
        positions[i]= totWidth;
        totWidth += $(this).width();

        /* The positions array contains each slide's commulutative offset from the left part of the container */

        if(!$(this).width())
        {
            alert("Please, fill in width & height for all your images!");
            return false;
        }
    });

    $('#slides').width(totWidth);

    /* Change the cotnainer div's width to the exact width of all the slides combined */

    $('#menu ul li a').click(function(e){

        /* On a thumbnail click */
        $('li.menuItem').removeClass('act').addClass('inact');
        $(this).parent().addClass('act');

        var pos = $(this).parent().prevAll('.menuItem').length;

        $('#slides').stop().animate({marginLeft:-positions[pos]+'px'},450);
        /* Start the sliding animation */

        e.preventDefault();
        /* Prevent the default action of the link */
    });

    $('#menu ul li.menuItem:first').addClass('act').siblings().addClass('inact');
    /* On page load, mark the first thumbnail as active */
});

	//Activate merchant
	var config_url = '<?php echo site_url();?>';
	$(document).on("click","button.send_message",function()
	{
		var airline_message = $('#airline_message').val();
		var airline_id = '<?php echo $airline_id;?>';
		
		if (airline_message != '') 
		{
			var data_url = config_url+'site/send_comment/'+airline_id;
			
			$.ajax({
				type:'POST',
				url: data_url,
				dataType: 'text',
				data: { message: airline_message },
				success:function(data)
				{
					//on success
					if(data == 'true')
					{
						$('#merchant'+retail_store_id).removeClass("danger");
						$('#merchant'+retail_store_id).addClass("success");
						$('#span'+retail_store_id).removeClass("glyphicon-thumbs-up");
						$('#span'+retail_store_id).addClass("glyphicon-thumbs-down");
					}
					
					else
					{
						alert(data);
					}
				},
				error: function(xhr, status, error) {
					//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
					alert(error);
				}
			});
		}
		
		else
		{
			$('#error').html("<div class='alert alert-danger'>Please compose a message before sending</div>");
		}
		
		return false;
	});
	
	$(document).on("click","button.contact_airline",function()
	{
		var sender_name = $('#sender_name').val();
		var sender_email = $('#sender_email').val();
		var sender_phone = $('#sender_phone').val();
		var airline_message = $('#airline_contact_message').val();
		
		var airline_id = '<?php echo $airline_id;?>';
		
		if (sender_name != '') 
		{
			if (sender_email != '') 
			{
				if (airline_message != '') 
				{
					var data_url = config_url+'site/contact_airline/'+airline_id;
					
					$.ajax({
						type:'POST',
						url: data_url,
						dataType: 'text',
						data: { name: sender_name, email: sender_email, phone: sender_phone, message: airline_message},
						success:function(data)
						{
							//on success
							if(data == 'true')
							{
								$('#merchant'+retail_store_id).removeClass("danger");
								$('#merchant'+retail_store_id).addClass("success");
								$('#span'+retail_store_id).removeClass("glyphicon-thumbs-up");
								$('#span'+retail_store_id).addClass("glyphicon-thumbs-down");
							}
							
							else
							{
								alert(data);
							}
						},
						error: function(xhr, status, error) {
							//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
							alert(error);
						}
					});
					$('#email_error').html("");
				}
				
				else
				{
					$('#message_error').html("<div class='alert alert-danger'>Please compose a message before sending</div>");
				}
				$('#name_error').html("");
			}
			
			else
			{
				$('#email_error').html("<div class='alert alert-danger'>Please enter your email address</div>");
			}
		}
		
		else
		{
			$('#name_error').html("<div class='alert alert-danger'>Please enter your name</div>");
		}
		
		return false;
	});
	
	$("input#book_seats").click(function() {
		$('.charter_plane').fadeOut("slow").css('display', 'none');
		$('.book_seats').fadeIn("slow").css('display', 'block');
		
		var booked_seats = $('#seats').val();
		change_passengers(booked_seats);
	});
	
	$("input#charter_plane").click(function() {
		$('.book_seats').fadeOut("slow").css('display', 'none');
		$('.charter_plane').fadeIn("slow").css('display', 'block');
		var seats = '<?php echo $available_seats;?>';
		change_passengers(seats);
	});
	
	$("input#seats").change(function() {
		var booked_seats = $('#seats').val();
		change_passengers(booked_seats);
	});
	
	function change_passengers(seats)
	{
		var booked_seats = seats;
		var available_seats = '<?php echo $available_seats;?>';
		
		var data_url = config_url+'site/set_passengers/'+booked_seats+'/'+available_seats;
					
		$.ajax({
			type:'POST',
			url: data_url,
			dataType: 'text',
			data: { seats: booked_seats},
			success:function(data)
			{
				//on success
				$('#passengers').fadeIn("slow").html(data);
			},
			error: function(xhr, status, error) {
				//alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
				$('#passengers').fadeIn("slow").html(error);
			}
		});
	}


</script>