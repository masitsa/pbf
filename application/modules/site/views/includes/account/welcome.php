<?php
	//$users = number_format($this->reports_model->get_total_users(), 0, '.', ',');
	//$balance = number_format($this->reports_model->get_balance(), 2, '.', ',');
?>
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-title">
                    <h3>AwesomeMath</h3>
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
                    
                </ul>
            </div>
            <!-- Page header ends -->