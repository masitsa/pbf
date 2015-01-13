
<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <?php echo $title;?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Adding Errors -->
            <?php
            echo '<div class="center-align">'.$ask_bank.'</div>';
            
            $success = $this->session->userdata('bank_success_message');
            
            if(!empty($success))
            {
                echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
				$this->session->unset_userdata('bank_success_message');
            }
            
            $error = $this->session->userdata('bank_error_message');
            
            if(!empty($error))
            {
                echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
				$this->session->unset_userdata('bank_error_message');
            }
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
            	<div class="col-md-6">
                    <!-- Bank Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Bank Name</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($bank_name_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="bank_name" placeholder="<?php echo $bank_name_error;?>" onFocus="this.value = '<?php echo $bank_name;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo $bank_name;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- airport Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Account Name</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($account_name_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="account_name" placeholder="<?php echo $account_name_error;?>" onFocus="this.value = '<?php echo $account_name;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="account_name" placeholder="Account Name" value="<?php echo $account_name;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- airport Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Account Number</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($account_number_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="account_number" placeholder="<?php echo $account_number_error;?>" onFocus="this.value = '<?php echo $account_number;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="account_number" placeholder="Account Number" value="<?php echo $account_number;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <!-- airport Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Branch City</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($bank_city_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="bank_city" placeholder="<?php echo $bank_city_error;?>" onFocus="this.value = '<?php echo $bank_city;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="bank_city" placeholder="Branch City" value="<?php echo $bank_city;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- airport Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Branch Country</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($bank_country_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="bank_country" placeholder="<?php echo $bank_country_error;?>" onFocus="this.value = '<?php echo $bank_country;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="bank_country" placeholder="Branch Country" value="<?php echo $bank_country;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <!-- airport Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Swift Code</label>
                        <div class="col-lg-8">
                            <?php
                                //case of an input error
                                if(!empty($swift_code_error))
                                {
                                    ?>
                                    <input type="text" class="form-control alert-danger" name="swift_code" placeholder="<?php echo $swift_code_error;?>" onFocus="this.value = '<?php echo $swift_code;?>';">
                                    <?php
                                }
                                
                                else
                                {
                                    ?>
                                    <input type="text" class="form-control" name="swift_code" placeholder="Swift Code" value="<?php echo $swift_code;?>">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions center-align">
                <button class="submit btn btn-success" type="submit">
                    Update
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                            
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->