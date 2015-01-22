<?php
	//airlines
	$active_airlines = $this->airlines_model->all_active_airlines();
	$active_flights = $this->flights_model->all_active_flights();
	$airlines = '';
	
	if($active_airlines->num_rows() > 0)
	{
		foreach($active_airlines->result() as $airline)
		{
			$airline_id = $airline->airline_id;
			$airline_name = $airline->airline_name;
			
			$flights = 0;
			
			//count flights for airline
			if($active_flights->num_rows() > 0)
			{
				foreach($active_flights->result() as $flight)
				{
					$flight_airline_id = $flight->airline_id;
					
					if($flight_airline_id == $airline_id)
					{
						$flights++;
					}
				}
			}
			
			$airlines .= '<tr>
                                <td>
                                    <a href="'.base_url().'flights/airline/'.$airline_id.'">'.$airline_name.'</a>
                                    <span class="badge">'.$flights.'</span>
                                </td>
                            </tr>';
		}
	}
	
	//destinations
	$active_airlines = $this->airports_model->all_active_airports();
	$active_flights = $this->flights_model->all_active_flights();
	$destinations = '';
	
	if($active_airlines->num_rows() > 0)
	{
		foreach($active_airlines->result() as $destination)
		{
			$airport_id = $destination->airport_id;
			$airport_name = $destination->airport_name;
			
			$flights = 0;
			
			//count flights for airline
			if($active_flights->num_rows() > 0)
			{
				foreach($active_flights->result() as $flight)
				{
					$destination_id = $flight->destination;
					
					if($destination_id == $airport_id)
					{
						$flights++;
					}
				}
			}
			
			$destinations .= '<tr>
                                <td>
                                    <a href="'.base_url().'flights/destination/'.$airport_id.'">'.$airport_name.'</a>
                                    <span class="badge">'.$flights.'</span>
                                </td>
                            </tr>';
		}
	}
?>
<style type="text/css">
	div.brand-checkbox input[type="checkbox"] {
		display: none;
		margin: 4px 0 0 -20px;
	}
</style>
	<!--left column-->
    <div class="col-sm-3 col-md-3">
    	<?php
        	$validation_errors = validation_errors();
			
			if(!empty($validation_errors) && (empty($payments_error)))
			{
				echo
				'
					<div class="alert alert-danger center-align">'.$validation_errors.'</div>
				';
			}
		?>
        <form class="form-inline left-search" role="form" action="<?php echo site_url().'flights/search-flights';?>" method="post">
            <input type="text" class="form-control" placeholder="Search" name="search_item">
            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        </span>Airlines</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <table class="table">
                            <?php echo $airlines;?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        </span>Destinations</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <?php echo $destinations;?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"> 
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapsePrice">
                        </span>Price</a>
                    </h4>
                </div> 
                
                <div id="collapsePrice" class="panel-collapse collapse">
                    <div class="panel-body">
                        <!-- -->
                        <form action="<?php echo site_url().'products/price_range';?>" class="form-horizontal" id="filter_price" method="post">
                            <?php echo $price_range;?>
                            <div class="center-align">
                            	<button type="submit" class="btn btn-primary">Filter Price</button>
                            </div>
                        </form>
                        <hr>
                        <h5>Enter a Price range </h5>
                        <form class="form-inline price_range" role="form" action="<?php echo site_url().'products/price_range';?>" id="filter_custom_price">
                            <input type="text" class="form-control" name="start_price" placeholder="200"> - 
                            <input type="text" class="form-control" name="end_price" placeholder="300">
                            
                            <div class="center-align">
                            	<button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!--/price panel end--> 
        </div>
    </div>
    <!-- End: Left Menu -->
    
<script type="text/javascript">

//Sort by price range
$(document).on("submit","form#filter_price",function(e)
{
	e.preventDefault();
	
	var range = $('input[name="agree"]:checked').val();
	
	window.location.href = '<?php echo site_url();?>flights/price-range/'+range;
});

//Sort by custom price range
$(document).on("submit","form#filter_custom_price",function(e)
{
	e.preventDefault();
	
	var start = $('input[name="start_price"]').val();
	var end = $('input[name="end_price"]').val();
	
	window.location.href = '<?php echo site_url();?>flights/price-range/'+start+'-'+end;
});
</script>