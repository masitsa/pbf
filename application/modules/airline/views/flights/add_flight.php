<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.css" id="theme_base">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.date.css" id="theme_date">
<link rel="stylesheet" href="<?php echo base_url().'assets/themes/pickadate/';?>lib/themes/default.time.css" id="theme_time">

<div class="col-lg-12" style="margin-bottom:5px;">
    <a href="<?php echo site_url()?>airline/all-flights" class="btn btn-primary pull-right">Back to Flight List</a>
</div>



<div class="col-lg-12">
    
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php echo $title;?>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Adding Errors -->
        <?php
        if(isset($error)){
            echo '<div class="alert alert-danger">'.$error.'</div>';
        }
        
        $validation_errors = validation_errors();
        
        if(!empty($validation_errors))
        {
            echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$validation_errors.' </div>';
        }
        
        $success = $this->session->userdata('success_message');
        
        if(!empty($success))
        {
            echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
        }
        
        $error = $this->session->userdata('error_message');
        
        if(!empty($error))
        {
            echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
        }
        ?>

        <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
        <div class="row">
            <!-- start of left -->
            <div class="col-lg-6">
                    <!-- flight type -->
                    <div class="form-group">
                        <label class="col-lg-6 control-label">Flight Type</label>
                        <div class="col-lg-6">
                            <select name="flight_type_id" id="flight_type_id" class="form-control" required>
                                <?php
                                if($flight_type_query->num_rows() > 0)
                                {
                                    $result = $flight_type_query->result();
                                    
                                    foreach($result as $res)
                                    {
                                        if($res->flight_type_id == set_value('flight_type_id'))
                                        {
                                            echo '<option value="'.$res->flight_type_id.'" selected="selected">'.$res->flight_type_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$res->flight_type_id.'">'.$res->flight_type_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- airplane type -->
                    <div class="form-group">
                        <label class="col-lg-6 control-label ">Airplane Type</label>
                        <div class="col-lg-6">
                            <select name="airplane_type_id" id="airplane_type_id" class="form-control" required>
                                <?php
                                if($airplane_type_query->num_rows() > 0)
                                {
                                    $result = $airplane_type_query->result();
                                    
                                    foreach($result as $res)
                                    {
                                        if($res->airplane_type_id == set_value('airplane_type_id'))
                                        {
                                            echo '<option value="'.$res->airplane_type_id.'" selected="selected">'.$res->airplane_type_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$res->airplane_type_id.'">'.$res->airplane_type_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- source -->
                    <div class="form-group">
                        <label class="col-lg-6 control-label">Source</label>
                        <div class="col-lg-6">
                        
                            <select name="source" id="source" class="form-control" required>
                                <?php
                                var_dump($airports_query->result());
                                if($airports_query->num_rows() > 0)
                                {
                                     $source_result = $airports_query->result();
                                    
                                    foreach($source_result as $source_res)
                                    {
                                        if($source_res->airport_id == set_value('source'))
                                        {
                                            echo '<option value="'.$source_res->airport_id.'" selected="selected">'.$source_res->airport_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$source_res->airport_id.'">'.$source_res->airport_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- destination -->
                    <div class="form-group">
                        <label class="col-lg-6 control-label">Destination</label>
                        <div class="col-lg-6">
                            <select name="destination" id="destination" class="form-control" required>
                                <?php
                                if($airports_query->num_rows() > 0)
                                {
                                    $result = $airports_query->result();
                                    
                                    foreach($result as $res)
                                    {
                                        if($res->airport_id == set_value('destination'))
                                        {
                                            echo '<option value="'.$res->airport_id.'" selected="selected">'.$res->airport_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$res->airport_id.'">'.$res->airport_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-6 control-label">Trip Type</label>
                        <div class="col-lg-6">
                            <select name="trip_type" class="form-control" required>
                                <?php
                                if($trip_type_query->num_rows() > 0)
                                {
                                    $trip_result = $trip_type_query->result();
                                    
                                    foreach($trip_result as $res)
                                    {
                                        if($res->trip_type_id == set_value('trip_type'))
                                        {
                                            echo '<option value="'.$res->trip_type_id.'" selected="selected">'.$res->trip_type_name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$res->trip_type_id.'">'.$res->trip_type_name.'</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <!-- flight Name -->
                     <div class="form-group">
                    <label class="col-lg-6 control-label">Activate Flight?</label>
                    <div class="col-lg-6">
                        <?php
                            $flight_status = set_value('flight_status');
                            if($flight_status == '1')
                            {
                                $yes = 'checked';
                                $no = '';
                            }
                            
                            else
                            {
                                $yes = '';
                                $no = 'checked';
                            }
                        ?>
                        <div class="radio">
                            <label>
                                <input id="optionsRadios1" type="radio" <?php echo $yes;?> value="1" name="flight_status">
                                Yes
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input id="optionsRadios2" type="radio" <?php echo $no;?> value="0" name="flight_status">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of left -->
            <!-- start of right -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="col-lg-6 control-label">Flight Date</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control fieldset__input js__datepicker" name="flight_date" placeholder="Flight Date" value="<?php echo set_value('flight_date');?>" required>
                    </div>
                </div>
                <!-- flight Name -->
                <div class="form-group">
                    <label class="col-lg-6 control-label">Departure Time</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control fieldset__input js__timepicker" name="flight_departure_time" placeholder="Departure Time" value="<?php echo set_value('flight_departure_time');?>" required>
                    </div>
                </div>
                <!-- flight Name -->
                <div class="form-group">
                    <label class="col-lg-6 control-label">Arrival Time</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control fieldset__input js__timepicker" name="flight_arrival_time" placeholder="Arrival Time" value="<?php echo set_value('flight_arrival_time');?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Charter Plane Price ($)</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="charter_price" placeholder="Flight Price" value="<?php echo set_value('charter_price');?>" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-lg-6 control-label">Flight Price per person ($)</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="flight_price" placeholder="Flight Price" value="<?php echo set_value('flight_price');?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-6 control-label">Seats Available</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="flight_seats" placeholder="Seats Available" value="<?php echo set_value('flight_seats');?>" required>
                    </div>
                </div>
                <!-- Activate checkbox -->
               
            </div>
            <!-- end of right -->
        </div>
        <div class="row">
            <div class="form-actions center-align">
                <button class="submit btn btn-success" type="submit">
                    Add a new Flight
                </button>
            </div>
        </div>
        <br />
        <?php echo form_close();?>
                        
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->

<!-- /.row -->

<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.date.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>lib/picker.time.js"></script>
<script src="<?php echo base_url().'assets/themes/pickadate/';?>demo/scripts/demo.js"></script>
