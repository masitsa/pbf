<?php
	$options = '';
	if($active_airports->num_rows() > 0)
	{
		foreach($active_airports->result() as $res)
		{
			$options .= '<option value="'.$res->airport_id.'">'.$res->airport_name.'</option>';
		}
	}
	
	$airplane_options = '';
	if($airplane_types->num_rows() > 0)
	{
		foreach($airplane_types->result() as $res)
		{
			$airplane_options .= '<option value="'.$res->airplane_type_id.'">'.$res->airplane_type_name.'</option>';
		}
	}
	
	$airline_options = '';
	$our_airlines = '';
	if($active_airlines->num_rows() > 0)
	{
		foreach($active_airlines->result() as $res)
		{
			$airline_options .= '<option value="'.$res->airline_id.'">'.$res->airline_name.'</option>';
			
			$our_airlines .= '
				<a href="#" class="airline-logo">
					<img src="'.$airline_logo_location.$res->airline_thumb.'" alt="'.$res->airline_name.'">
					<div class="caption">
						<h6>'.$res->airline_name.'</h6>
					</div>
				</a>
			';
		}
	}
	
	$flight_type_options = '';
	if($active_flight_types->num_rows() > 0)
	{
		foreach($active_flight_types->result() as $res)
		{
			$flight_type_options .= '<li><a href="'.site_url().'flights/'.$res->flight_type_name.'/'.$res->flight_type_id.'">'.$res->flight_type_name.'</a></li>';
		}
	}
	
	$trip_type_options = '';
	if($active_trip_types->num_rows() > 0)
	{
		foreach($active_trip_types->result() as $res)
		{
			$trip_type_options .= '<option value="'.$res->trip_type_id.'">'.$res->trip_type_name.'</option>';
		}
	}
?>
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.date.css" id="theme_date">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.time.css" id="theme_time">
        
    	<!-- Search  -->
        <div class="header">
        
        	<div class="container header-tabs">
                <div role="tabpanel">
                
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#empty_leg" aria-controls="empty_leg" role="tab" data-toggle="tab">Empty Leg</a></li>
                        <li role="presentation"><a href="#exclusive_charter" aria-controls="exclusive_charter" role="tab" data-toggle="tab">Exclusive Charter</a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="empty_leg">
                        	
                        	<?php
								echo form_open('flights/advanced-search', array('class' => 'form-horizontal', 'role' => 'form'));
							?>
								<div class="row">
									<div class="col-md-5">
                                    	<div class="row">
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <select class="form-control" name="source">
                                                                <option value="">- From -</option>
                                                                <?php echo $options;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <select class="form-control" name="destination">
                                                                <option value="">- To -</option>
                                                                <?php echo $options;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</div>
									
									<div class="col-md-5">
										<div class="form-group">
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control fieldset__input js__datepicker" name="date_from" placeholder="Departure Date">
                                                </div>
											</div>
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control fieldset__input js__datepicker" name="date_to" placeholder="Arrival Date">
                                                </div>
											</div>
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                                                    </span>
                                                    <select class="form-control" name="trip_type_id">
                                                        <option value="">-Type-</option>
                                                        <?php echo $trip_type_options;?>
                                                    </select>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row center-align">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-red">Check Availability</button> or <a href="<?php echo site_url().'flights';?>">View All Flights</a>
									</div>
								</div>
							<?php echo form_close();?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="exclusive_charter">
                        	
                        	<?php
								echo form_open('charter/get-quote', array('class' => 'form-horizontal', 'role' => 'form'));
							?>
								<div class="row">
									<div class="col-md-4">
                                    	<div class="row">
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <input type="text" class="form-control" name="source" placeholder="From">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <input type="text" class="form-control" name="destination" placeholder="To">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control fieldset__input js__datepicker" name="date_from" placeholder="Date">
                                                </div>
											</div>
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                                                    </span>
                                                    <select class="form-control" name="airplane_type_id">
                                                        <option value="">-Plane-</option>
                                                        <?php echo $airplane_options;?>
                                                    </select>
                                                </div>
											</div>
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-sort" aria-hidden="true"></span>
                                                    </span>
                                                    <select class="form-control" name="trip_type_id">
                                                        <option value="">-Type-</option>
                                                        <?php echo $trip_type_options;?>
                                                    </select>
                                                </div>
											</div>
										</div>
									</div>
                                    
                                    <div class="col-md-2">
										<div class="form-group">
											<div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control" name="passengers" placeholder="Passengers">
                                                </div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row center-align">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-red">Get Quote</button> or <a href="<?php echo site_url().'flights';?>">View All Flights</a>
									</div>
								</div>
							<?php echo form_close();?>
                        </div>
                    </div>
                
                </div>
        		<!--<div class="search-flights">
                	<div class="divider-line"></div>
                	<h1 class="center-align">Search Flights</h1>
                	<div class="divider-line" style="margin-bottom:2%;"></div>
                    
                	<?php
                    	echo form_open('flights/advanced-search', array('class' => 'form-horizontal', 'role' => 'form'));
					?>
                    	<div class="row">
                        	<div class="col-md-6 first">
                            	<div class="form-group">
                                    <label for="source" class="col-sm-4 control-label">From</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="source">
                                        	<option value="">-Select Source-</option>
                                        	<?php echo $options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="destination" class="col-sm-4 control-label">Destination</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="destination">
                                        	<option value="">-Select Destination-</option>
                                        	<?php echo $options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Airline</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="airline_id">
                                        	<option value="">-Select Airline-</option>
                                        	<?php echo $airline_options;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="col-sm-4 control-label">Departure Date</label>
                                    <div class="col-sm-4">
                                    	<input type="text" class="form-control fieldset__input js__datepicker" name="date_from" placeholder="From">
                                    </div>
                                    <div class="col-sm-4">
                                    	<input type="text" class="form-control fieldset__input js__datepicker" name="date_to" placeholder="To">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="trip_type_id" class="col-sm-4 control-label">Trip Type</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="trip_type_id">
                                        	<option value="">-Select Trip Type-</option>
                                        	<?php echo $trip_type_options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Sort by</label>
                                    <div class="col-sm-3">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="sort_by" id="optionsRadios1" value="price" checked>
                                                Price
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="sort_by" id="optionsRadios2" value="created" checked>
                                                Schedule
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-red">Check Availability</button>
                                <p>or</p>
                                <a href="<?php echo site_url().'flights';?>">View All Flights</a>
                            </div>
                        </div>
                    </form>
                </div>-->
                
        		<!--<div class="flight-types">
                	<ul>
                        <?php echo $flight_type_options;?>
                    </ul>
                </div>-->
            </div>
        </div>
        <!-- End Search -->
        
        <!-- Flights -->
        <div class="section carousel grey-background div-head">
            <div class="container">
                
                <div class="divider-line"></div>
                <div class="center-align">
                   <h3>Latest Flights</h3>
                </div>
                <div class="divider-line"></div>
                <div class="owl-carousel" id="owl-carousel">
                	<?php
                    	if($latest_flights->num_rows() > 0)
						{
							foreach($latest_flights->result() as $row)
							{
								$flight_id = $row->flight_id;
								$flight_date = $row->flight_date;
								$flight_price = $row->flight_price;
								$flight_departure_time = $row->flight_departure_time;
								$flight_arrival_time = $row->flight_arrival_time;
								$flight_type_name = $row->flight_type_name;
								$flight_seats = $row->flight_seats;
								$source = $row->source;
								$destination = $row->destination;
								$airplane_type_name = $row->airplane_type_name;
								$flight_status = $row->flight_status;
								$created = $row->created;
								$last_modified = $row->last_modified;
								$airline_thumb = $row->airline_thumb;
								$airline_logo = $row->airline_logo;
								$airline_name = $row->airline_name;
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
								//$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
								$price = number_format($flight_price, 2, '.', ',');
								echo
								'
								
                                <div class="item">
                                    <div class="product">
                                        <div class="image"> <a href="'.site_url().'flights/book-flight/'.$flight_id.'"><img src="'.$airline_logo_location.$airline_logo.'" alt="'.$airline_name.'" class="img-responsive"></a>
                                        </div>
                                        
                                        <div class="description">
                                            <h4><a href="'.site_url().'flights/book-flight/'.$flight_id.'">'.$airline_name.'</a></h4>
                                            <h6><a href="'.site_url().'flights/book-flight/'.$flight_id.'">'.$month.' '.$day.'</a></h6>
											<p>
												Fly from <span class="blue">'.$source.'</span> to <span class="red">'.$destination.'</span>
											</p>
                                        </div>
                                        
                                        <div class="price-details row">
                                            
                                            <div class="col-md-3 price-number">
                                                <p>
                                                    <span class="rupees">$'.$price.'</span>
                                                </p>
                                            </div>
                                            <div class="col-md-9 add-cart">
                                                <h4>
                                                    <!--<a class="add_to_cart" href="'.$flight_id.'"><i class="glyphicon glyphicon-shopping-cart"> </i></a>-->
                                                    <a class="product_details" href="'.site_url().'flights/book-flight/'.$flight_id.'">Details >></a>
                                                </h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div><!--/.item-->
								';
								?>
                                	<!--<div class="thumbnail">
                                        <img src="<?php echo $airline_logo_location.$airline_thumb?>" alt="<?php echo $airline_name;?>">
                                        <div class="caption">
                                            <p><?php echo $airline_name;?></p>
                                            <h6><?php echo $month.' '.$day;?></h6>
                                            <p><?php echo $source;?><br/> to<br/> <?php echo $destination;?></p>
                                            <h6>$<?php echo $price;?></h6>
                                        </div>
                                        <a href="<?php echo site_url().'flights/book-flight/'.$flight_id;?>" class="btn btn-red">Book</a>
                                    </div>-->
                                <?php
							}
						}
					?>
                    
                </div>
                <div class="center-align navigation-links">
                    <a class="prev">PREV</a>
                    <a class="next">NEXT</a>
                </div>
                
                <div class="center-align" style="padding-top:2%;"><a href="<?php echo site_url().'flights';?>" style="font-size:1.5em;">View All Flights</a></div>
            </div>
        </div>
        <!-- End Flights -->
        
        <!-- Why Us -->
        <div class="section blue-background">
            <div class="container">
            
                <div class="divider-line"></div>
                <div class="center-align">
                    <h3>About Us?</h3>
                </div>
                <div class="divider-line"></div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="list2" class="wow bounceInLeft">
                            <ol>
                                <li><p><em>About Privatebushflights</em> Privatebushflights is a web based, service that connects you with hundreds of empty local charter flights available throughout Africa at a fraction of the regular charter price.</p></li>
                                
                                <li><p><em>What is an 'Empty Leg', and how does the process work?</em> An aircraft which is positioning to an airport /Airstrip / destination to perform a charter, or is returning to base having completed a charter will usually operate these sectors empty. These are known as empty legs, and these empty jets can be made available to clients at a fraction of the normal cost of chartering an aircraft.</p></li>
                                
                                <li><p><em>About Exclusive Charters</em> We’ve taken on the world of private flight charters to make comparing, booking and managing flights simpler and faster than ever before. Whether you are looking for a bush taxi for safaris, a helicopter to an out of town remote or off-shore business location, Privatebushflights is the right place to begin your journey.</p></li>
                                
                                <li><p><em>Seats on Private planes</em> At times a charterer of a plane will wish to sell up a few seats that would otherwise have been flown empty. In this way we are able to extend extremely discounted rates on this seats. This type of booking will be a shared flight and not exclusive.</p></li>
                            </ol>
                        </div>
                    </div>
                    
                    <!--<div class="col-md-4">
                        <img src="assets/images/plane_savannah.jpg" alt="Teacher" class="img-responsive wow bounceInRight" height="300px"/>
                    </div>-->
                </div>
                
                <div class="center-align">
                	<a href="<?php echo site_url().'about';?>" class="btn btn-danger">Read More</a>
                </div>
            </div>
        </div>
        <!-- End Why Us -->
        
        <!-- Airlines -->
        <div class="section carousel grey-background">
            <div class="container">
                
                <div class="divider-line"></div>
                <div class="center-align">
                    <h3>Our Airlines</h3>
                </div>
                <div class="divider-line"></div>
                <div class="owl-carousel" id="owl-carousel2">
                    <?php echo $our_airlines;?>
                    
                </div>
                <div class="center-align navigation-links">
                    <a class="prev2">PREV</a>
                    <a class="next2">NEXT</a>
                </div>
            </div>
        </div>
        <!-- End Airlines -->
        
        <!-- Airlines Join -->
        <div class="section carousel airline-join">
            <div class="container">
                
                <div class="divider-line"></div>
                <div class="center-align">
                    <h3>Are you an Airline?</h3>
                </div>
                <div class="divider-line"></div>
                
                <a href="<?php echo site_url().'airline/sign-up/airline-details';?>" class="btn btn-airline-join">Join Here</a>
            </div>
        </div>
        <!-- End Airlines Join -->

<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.date.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.time.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>demo/scripts/demo.js"></script>