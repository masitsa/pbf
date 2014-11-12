<!-- View Switch -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/view_mode_switch/css/component.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/themes/view_mode_switch/js/modernizr.custom.js"></script>
        
<!-- Join  -->
<div class="grey-background div-head">
    <div class="container">
        <div class="divider-line"></div>
        <h1 class="center-align">All Flights</h1>
        <div class="divider-line" style="margin-bottom:2%;"></div>
  
  <div class="row">
  
  	<?php echo $this->load->view('products/left_navigation');?>
    
    <!--right column-->
    <div class="col-sm-9 col-md-9">
    	<?php echo $this->load->view('products/breadcrumbs');?>
       <div class="main">
            <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="row cbp-vm-options">
                	<p class="col-md-4"> Showing <strong><?php echo $last;?></strong> flights </p>
                    <div class="col-md-4">
                        <select id="" class="form-control">
                            <option>Default Sorting (Newness)</option>
                            <option>Destination</option>
                            <option>Oldest - Newest</option>
                            <option value="price">Sort by Price: low to high</option>
                            <option value="price_desc">Sort by Price: high to low</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Grid View</a>
                        <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">List View</a>
                    </div>
                </div>
                
                <ul>
				<?php
					if($products->num_rows() > 0)
					{
						$product = $products->result();
						
						foreach($product as $prods)
						{
							$flight_id = $row->flight_id;
							$flight_date = $row->flight_date;
							$flight_price = $row->flight_price;
							$flight_departure_time = $row->flight_departure_time;
							$flight_arrival_time = $row->flight_arrival_time;
							$flight_type_name = $row->flight_type_name;
							$source = $row->source;
							$destination = $row->destination;
							$airplane_type_name = $row->airplane_type_name;
							$flight_status = $row->flight_status;
							$created = $row->created;
							$last_modified = $row->last_modified;
							$airline_thumb = $row->airline_thumb;
							
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
									<a class="cbp-vm-image airline-logo" href="#"><img src="'.$airline_logo_location.$airline_thumb.'"></a>
									<h3 class="cbp-vm-title">'.$source.' - '.$destination.'</h3>
									<div class="cbp-vm-price">$'.$price.'</div>
									<div class="cbp-vm-details">
										<strong>Departure:</strong> '.$flight_departure_time.'<br/>
										<strong>Arrival:</strong> '.$flight_arrival_time.'
									</div>
									<a class="cbp-vm-icon cbp-vm-add" href="#">Book Now</a>
								</li>
							';
						}
					}
				?>
                    </div>
                </div><!-- /main -->
            </div>
            <!-- End: List -->
            
            <div class="row">
                <nav class="col-md-6">
                    <?php if(isset($links)){echo $links;}?>
                </nav>
                <p class="col-md-6">Showing <?php echo $first;?>–<?php echo $last;?> of <?php echo $total;?> results</p>
            </div>
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
