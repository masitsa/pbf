
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