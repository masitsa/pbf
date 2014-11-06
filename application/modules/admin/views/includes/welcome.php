<?php
<<<<<<< HEAD
	$users = number_format($this->reports_model->get_total_users(), 0, '.', ',');
	$balance = number_format($this->reports_model->get_balance(), 2, '.', ',');
=======
	$active_flights = $this->login_model->get_active_flights();
	$total_payments = number_format($this->login_model->get_total_payments(), 0, '.', ',');
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
?>
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-title">
<<<<<<< HEAD
                    <h3>AwesomeMath</h3>
=======
                    <h3>PBF</h3>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                    <span>
					<?php 
					//salutation
					if(date('a') == 'am')
					{
						echo 'Good morning, ';
					}
					
					else if((date('H') >= 12) && (date('H') < 17))
					{
						echo 'Good afternoon, ';
					}
					
					else
					{
						echo 'Good evening, ';
					}
					echo $this->session->userdata('first_name');
					?>
                    </span>
                </div>
                <ul class="page-stats">
                    <li>
                        <div class="summary">
<<<<<<< HEAD
                            <span>Total Users</span>
                            <h3><?php echo $users;?></h3>
=======
                            <span>Active Flights</span>
                            <h3><?php echo $active_flights;?></h3>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                        </div>
                        <span id="sparklines1"></span>
                    </li>
                    <li>
                        <div class="summary">
<<<<<<< HEAD
                            <span>My balance</span>
                            <h3>$<?php echo $balance;?></h3>
=======
                            <span>Total Payments</span>
                            <h3>KES <?php echo $total_payments;?></h3>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                        </div>
                        <span id="sparklines2"></span>
                    </li>
                </ul>
            </div>
            <!-- Page header ends -->