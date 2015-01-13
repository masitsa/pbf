<?php
	if($seats > $available_seats)
	{
		echo '
			<div class="alert alert-danger center-align">
				You can only book a maximum of '.$available_seats.' seats
			</div>
		';
	}
		
	for($r = 0; $r < $seats; $r++)
	{
		if($r == $available_seats)
		{
			break;
		}
		
		else
		{
			echo '
				<div class="row">
					<div class="col-lg-3">
						 <div class="form-group">
							<label for="first_name" class="col-sm-12 control-label">First Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="passenger_first_name[]" placeholder="First Name">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						 <div class="form-group">
							<label for="last_name" class="col-sm-12 control-label">Last Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="passenger_last_name[]" placeholder="Last Name">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						 <div class="form-group">
							<label for="nationality" class="col-sm-12 control-label">Nationality</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="passenger_nationality[]" placeholder="Nationality">
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						 <div class="form-group">
							<label for="passport_no" class="col-sm-12 control-label">Passport/ ID No.</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="passenger_passport_no[]" placeholder="Passport/ ID No.">
							</div>
						</div>
					</div>
				</div>
				<div class="divider"></div>
			';
		}
	}
?>