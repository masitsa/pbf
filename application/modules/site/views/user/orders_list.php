<<<<<<< HEAD

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2><span><i class="glyphicon glyphicon-calendar"></i> My subscription history </span></h2>
            <div class="row userInfo">
				
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	<?php
                    	if($purchase_details->num_rows() > 0)
						{
							?>
                            <table class="table table-striped table-condensed table-hover">
                            	<tr>
                                	<th>Payment Date</th>
                                	<th>Subscription Number</th>
                                	<th>Amount Paid</th>
                                	<th>Package Name</th>
                                	<th>Next Payment</th>
                                </tr>
                            <?php
							foreach ($purchase_details->result() as $row)
							{
								$subscription_number = $row->subscription_number;
								$payment_date = $row->payment_date;
								$payment_amount = $row->payment_amount;
								$package_name = $row->package_name;
								$package_id = $row->package_id;
								$next_payment = $row->next_payment;
								
								//grades
								$query = $this->grades_model->get_package($package_id);
								$grades = '';
								
								if($query->num_rows() > 0)
								{
									foreach($query->result() as $res)
									{
										$grade_name = $res->grade_name;
										$grades .= '<li>'.$grade_name.'</li>';
									}
								}
								
								echo
								'
									<tr>
										<td>'.date('jS M Y',strtotime($payment_date)).'</td>
										<td>'.$subscription_number.'</td>
										<td>$'.number_format($payment_amount, 2, '.', ',').'</td>
										<td>'.$package_name.'<ul>'.$grades.'</ul></td>
										<td>'.date('jS M Y',strtotime($next_payment)).'</td>
									</tr>
								';
							}
							
							?>
							</table>
							<?php
						}
						
						else
						{
							if($this->session->userdata('user_level_id') == 1)
							{
								$link = 'subscribe/school';
							}
							if($this->session->userdata('user_level_id') == 2)
							{
								$link = 'subscribe/premier';
							}
							echo 'You have not made any subscriptions yet. Please subscribe <a href="'.site_url().$link.'">here</a>';
						}
					?>
				</div>
			</div>
		</div>
		<!--/row end--> 
    </div>
    <!--/row-->
=======
<!-- styles needed by footable  -->
<link href="<?php echo base_url().'assets/themes/tshop/';?>css/footable-0.1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/themes/tshop/';?>css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />

<div class="container main-container headerOffset">
  
  <?php echo $this->load->view('products/breadcrumbs');?>
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order List </span></h1>
      <div class="row userInfo">
        <div class="col-lg-12">
          <h2 class="block-title-2"> Your Order List  </h2>
        </div>
        
        <div class="col-xs-12 col-sm-12">
        	<?php
            	if($all_orders->num_rows() > 0)
				{
					$orders = $all_orders->result();
			?>
          <table class="footable">
            <thead>
              <tr>
                <th data-class="expand" data-sort-initial="true"> <span title="table sorted by this column on load">Order ID</span> </th>
                <th data-hide="phone,tablet" data-sort-ignore="true">No. of items</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">Items</th>
                <th data-hide="phone,tablet" data-sort-ignore="true">instructions</th>
                <th data-hide="default"> Price </th>
                <th data-hide="default"> Payment Method </th>
                <th data-hide="default" data-type="numeric"> Date </th>
                <th data-hide="phone" data-type="numeric"> Status </th>
              </tr>
            </thead>
            <tbody>
            
            <?php
            	foreach($orders as $ord)
				{
					$instructions = $ord->order_instructions;
					$order_number = $ord->order_number;
					$payment_method = $ord->payment_method;
					$created = date('jS M Y H:i a',strtotime($ord->created));
					$status = $ord->order_status;
					$order_id = $ord->order_id;
					$order_items = $this->orders_model->get_order_items($order_id);
					$total_cost = number_format($this->orders_model->calculate_order_cost($order_id), 0, '.', ',');
					$items = '';
					$total_items = 0;
					
					//order items
					if($order_items->num_rows() > 0)
					{
						$order = $order_items->result();
						
						foreach($order as $item)
						{
							$product_name = $item->product_name;
							$quantity = $item->quantity;
							$price = $item->price;
							
							$items .= $quantity.' unit(s) of '.$product_name.' @ '.$price.'<br/>';
							
							$total_items++;
						}
					}
					
					//payment method
					if($payment_method == 1)
					{
						$method = 'Cash on Delivery';
					}
					
					else
					{
						$method = 'MPesa';
					}
					
					//order status
					if($status == 1)
					{
						$order_status = '<span class="label label-primary">Pending</span>';
					}
					
					else if($status == 2)
					{
						$order_status = '<span class="label label-success">Done</span>';
					}
					
					else if($status == 3)
					{
						$order_status = '<span class="label label-danger">Cancelled</span>';
					}
			?>
              <tr>
                <td><?php echo $order_number;?></td>
                <td><?php echo $total_items;?> <small>item(s)</small></td>
                <td><?php echo $items;?></td>
                <td><?php echo $instructions;?></td>
                <td>KES <?php echo $total_cost;?></td>
                <td><?php echo $method;?></td>
                <td data-value="78025368997"><?php echo $created;?></td>
                <td data-value="3"><?php echo $order_status;?></td>
              </tr>
             <?php
				}
			 ?>
            </tbody>
          </table>
		  <?php
				}
			?>
        </div>
        
        <div class="col-lg-12 clearfix">
          <ul class="pager">
            <li class="previous pull-right"><a href="<?php echo site_url().'products/all-products';?>"> <i class="fa fa-home"></i> Go to Shop </a></li>
            <li class="next pull-left"><a href="<?php echo site_url().'account';?>"> &larr; Back to My Account</a></li>
          </ul>
        </div>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5"> </div>
  </div>
  <!--/row-->
  
  <div style="clear:both"></div>
</div>
<!-- /main-container -->

<div class="gap"> </div>
<!-- include footable plugin --> 
<script src="<?php echo base_url().'assets/themes/tshop/';?>js/footable.js" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/themes/tshop/';?>js/footable.sortable.js" type="text/javascript"></script> 
<script type="text/javascript">
    $(function() {
      $('.footable').footable();
    });
  </script> 
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
