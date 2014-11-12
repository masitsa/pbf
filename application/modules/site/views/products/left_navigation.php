<style type="text/css">
	div.brand-checkbox input[type="checkbox"] {
		display: none;
		margin: 4px 0 0 -20px;
	}
</style>
	<!--left column-->
    <div class="col-sm-3 col-md-3">
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
                            <tr>
                                <td>
                                    <a href="#">Air Canada</a>
                                    <span class="badge">3</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">China Air</a>
                                    <span class="badge">9</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Emirates</a>
                                    <span class="badge">6</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">KLM</a>
                                    <span class="badge">1</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Quantas</a>
                                    <span class="badge">2</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Swiss Air</a>
                                    <span class="badge">6</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Turkish Airlines</a>
                                    <span class="badge">2</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">United Airlines</a>
                                    <span class="badge">7</span>
                                </td>
                            </tr>
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
                            <tr>
                                <td>
                                    <a href="#">Nairobi</a>
                                    <span class="badge">7</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Mara</a>
                                    <span class="badge">3</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Mombasa</a>
                                    <span class="badge">2</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">Serengeti</a>
                                    <span class="badge">3</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        </span>Other</a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                          <input type="text" name="search" class="form-control col-md-8" placeholder="Search">
                          <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
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
                        <form action="<?php echo site_url().'products/price_range';?>" id="filter_price">
                            <?php echo $price_range;?>
                            <button type="submit" class="btn btn-default">Filter Price</button>
                        </form>
                        <hr>
                        <p>Enter a Price range </p>
                        <form class="form-inline price_range" role="form" action="<?php echo site_url().'products/price_range';?>" id="filter_custom_price">
                            <div class="form-group">
                                <input type="text" class="form-control" name="start_price" placeholder="2000">
                            </div>
                            <div class="form-group sp"> - </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="end_price" placeholder="3000">
                            </div>
                            <button type="submit" class="btn btn-default pull-right">Filter</button>
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
	
	window.location.href = '<?php echo site_url();?>products/price-range/'+range;
});

//Sort by custom price range
$(document).on("submit","form#filter_custom_price",function(e)
{
	e.preventDefault();
	
	var start = $('input[name="start_price"]').val();
	var end = $('input[name="end_price"]').val();
	
	window.location.href = '<?php echo site_url();?>products/price-range/'+start+'-'+end;
});
</script>