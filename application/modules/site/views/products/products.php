<!-- View Switch -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/view_mode_switch/css/component.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/themes/view_mode_switch/js/modernizr.custom.js"></script>
        
<!-- Join  -->
<div class="grey-background div-head">
    <div class="container">
      <!--   <div class="divider-line"></div>
        <h1 class="center-align">All Flights</h1>
        <div class="divider-line" style="margin-bottom:2%;"></div> -->
  
  <div class="row" style="margin:0;">
  
  	<?php echo $this->load->view('products/left_navigation');?>
    
    <!--right column-->
    <div class="col-xs-9 col-md-9 col-sm-9">
    	<?php echo $this->load->view('products/breadcrumbs');?>
       <div class="main">
            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-list">
                <div class="row" style="border-bottom: 3px solid #e7302a; background-color:#F5F5F5; margin:0;">
                	<p class="col-md-4" style="padding-top: 2%;"> Showing <strong><?php echo $last;?></strong> flights </p>
                    <div class="col-md-4" style="padding-top: 1%;">
                        <select id="" class="form-control">
                            <option>Default Sorting (Newness)</option>
                            <option>Destination</option>
                            <option>Oldest - Newest</option>
                            <option value="price">Sort by Price: low to high</option>
                            <option value="price_desc">Sort by Price: high to low</option>
                        </select>
                    </div>
                    <div class="col-md-4 cbp-vm-options">
                        <a href="#" class="cbp-vm-icon cbp-vm-grid" data-view="cbp-vm-view-grid">Grid View</a>
                        <a href="#" class="cbp-vm-icon cbp-vm-list cbp-vm-selected" data-view="cbp-vm-view-list">List View</a>
                    </div>
                </div>
                <div class="row">
	                <ul style="padding-left:25px; padding-right:25px;">
	                    <li class="list-title">
	                    
	                        <h3 class="title">Airline</h3>
	                    
	                        <h3 class="price">Price</h3>
	                    
	                        <h3 class="depature">Departure</h3>
	                    
	                        <h3 class="arrival">Arrival</h3>
	                    
	                        <h3 class="seats">Seats Available</h3>
	                    </li>
	                    <div class="clear-both"></div>
					<?php
						if($products->num_rows() > 0)
						{
							$product = $products->result();
							
							foreach($product as $row)
							{
								$flight_id = $row->flight_id;
								$flight_date = $row->flight_date;
								$flight_price = $row->flight_price;
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
								$flight_date = $row->flight_date;
								$flight_departure_time = $row->flight_departure_time;
								$flight_arrival_time = $row->flight_arrival_time;
								$airplane_type_thumb3 = $row->airplane_type_thumb3;
								$month = date('M',strtotime($flight_date));
								$day = date('jS',strtotime($flight_date));
								$flight_departure_time = date('H:i',strtotime($flight_departure_time));
								$flight_arrival_time = date('H:i',strtotime($flight_arrival_time));
								
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
									<li>
									
										<a class="cbp-vm-image airline-logo" href="#"><img src="'.$airplane_types_image_path.$airplane_type_thumb3.'"><div class="clear-both"></div><h3 class="cbp-vm-title">'.$airline_name.'</h3></a>
										
										<div class="cbp-vm-price">$'.$price.'</div>
										<div class="cbp-vm-details">
											<div class="divider-line"></div>
											<div class="flight_departure">
												<h3 class="cbp-vm-title">
													<div class="full-width grid-title">Departure</div>
													<div class="flight-airport">'.$source.'</div>
													<div class="flight-date">on '.$day.' '.$month.'</div>
													<div class="flight-time">at '.$flight_departure_time.'</div>
												</h3>
											</div>
											<div class="divider-line"></div>
											<div class="flight_departure">
												<h3 class="cbp-vm-title">
													<div class="full-width grid-title">Arrival</div>
													<div class="flight-airport">'.$destination.'</div>
													<div class="flight-date">on '.$day.' '.$month.'</div>
													<div class="flight-time">at '.$flight_arrival_time.'</div>
												</h3>
											</div>
											<div class="divider-line"></div>
											<div class="cbp-vm-seats">'.$flight_seats.' <div class="grid-title">seats available</div></div>
										</div>
										<a class="cbp-vm-icon cbp-vm-add" href="'.site_url().'flights/book-flight/'.$flight_id.'" class="btn btn-sm btn-danger">Book Now</a>
									</li>
								';
							}
						}
					?>
					</ul>
				</div>
				<div class="row">
		            <nav class="col-md-6">
		                <?php if(isset($links)){echo $links;}?>
		            </nav>
		            <p class="col-md-6">Showing <?php echo $first;?>–<?php echo $last;?> of <?php echo $total;?> results</p>
		        </div>
               </div>
            </div><!-- /main -->
        </div>
            <!-- End: List -->
            
            
        </div>
    </div>
</div>
<!-- End Join -->

<script type="text/javascript">
//Sort Products
$(document).on("change","select#sort_products",function()
{
	var order_by = $('#sort_products :selected').val();
	
	window.location.href = '<?php echo site_url();?>products/sort-by/'+order_by;
});
</script>
<!-- View Switch --> 
<script type="text/javascript" src="<?php echo base_url();?>assets/themes/view_mode_switch/js/classie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/themes/view_mode_switch/js/cbpViewModeSwitch.js"></script>
