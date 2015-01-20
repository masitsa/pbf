
                        	<?php
								echo form_open('flights/advanced-search', array('class' => 'form-horizontal', 'role' => 'form'));
							?>
								<div class="row">
									<div class="col-md-5">
                                    	<div class="row">
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <select class="form-control" name="source">
                                                                <option value="">----Departure----</option>
                                                                <?php echo $options;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        	<div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                            </span>
                                                            <select class="form-control" name="destination">
                                                                <option value="">----Arrival----</option>
                                                                <?php echo $options;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
										<!--<div class="form-group">
											<label for="inputPassword3" class="col-sm-4 control-label">Airline</label>
											<div class="col-sm-8">
												<select class="form-control" name="airline_id">
													<option value="">----Select Airline----</option>
													<?php echo $airline_options;?>
												</select>
											</div>
										</div>-->
									</div>
									
									<div class="col-md-5">
										<div class="form-group">
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control fieldset__input js__datepicker" name="date_from" placeholder="Departure Date">
                                                </div>
											</div>
											<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </span>
                                                    <input type="text" class="form-control fieldset__input js__datepicker" name="date_to" placeholder="Arrival Date">
                                                </div>
											</div>
										</div>
										<!--<div class="form-group">
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
										</div> -->
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                                                    </span>
                                                    <select class="form-control" name="trip_type_id">
                                                        <option value="">-Trip Type-</option>
                                                        <?php echo $trip_type_options;?>
                                                    </select>
                                                </div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row center-align">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-red">Check Availability</button> or <a href="<?php echo site_url().'flights';?>">View All Flights</a>
									</div>
								</div>
							<?php echo form_close();?>