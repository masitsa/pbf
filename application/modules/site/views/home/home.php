<?php
	$options = '';
	if($active_airports->num_rows() > 0)
	{
		foreach($active_airports->result() as $res)
		{
			$options .= '<option value="'.$res->airport_id.'">'.$res->airport_name.'</option>';
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
        	<div class="container">
        		<div class="search-flights">
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
                                        	<option value="">----Select Source----</option>
                                        	<?php echo $options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="destination" class="col-sm-4 control-label">Destination</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="destination">
                                        	<option value="">----Select Destination----</option>
                                        	<?php echo $options;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Airline</label>
                                    <div class="col-sm-8">
                                    	<select class="form-control" name="airline_id">
                                        	<option value="">----Select Airline----</option>
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
                                        	<option value="">----Select Trip Type----</option>
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
                </div>
                
        		<div class="flight-types">
                	<ul>
                        <?php echo $flight_type_options;?>
                    </ul>
                </div>
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
								
								?>
                                	<div class="thumbnail">
                                        <img src="<?php echo $airline_logo_location.$airline_thumb?>" alt="<?php echo $airline_name;?>">
                                        <div class="caption">
                                            <p><?php echo $airline_name;?></p>
                                            <h6><?php echo $month.' '.$day;?></h6>
                                            <p><?php echo $source;?><br/> to<br/> <?php echo $destination;?></p>
                                            <h6>$<?php echo $price;?></h6>
                                        </div>
                                        <a href="<?php echo site_url().'flights/book-flight/'.$flight_id;?>" class="btn btn-red">Book</a>
                                    </div>
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
                    <h3>Why Us?</h3>
                </div>
                <div class="divider-line"></div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div id="list2" class="wow bounceInLeft">
                            <ol>
                                <li><p><em>Why Title</em> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p></li>
                                <li><p><em>Why Title</em> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p></li>
                                <li><p><em>Why Title</em> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p></li>
                                <li><p><em>Why Title</em> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of</p></li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <img src="assets/images/plane_savannah.jpg" alt="Teacher" class="img-responsive wow bounceInRight" height="300px"/>
                    </div>
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