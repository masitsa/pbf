<<<<<<< HEAD

=======
<?php
	$airlines = $this->login_model->get_total_airlines();
	$visitors = $this->login_model->get_total_visitors();
?>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <!-- Breadcrumb -->
            <div class="bread-crumb">
<<<<<<< HEAD
                <a href="index.html"><i class="icon-home"></i> Home</a>
                <!-- Divider -->
                <span class="divider">></span>
                <a href="#" class="bread-current">Tables</a>
=======
                <a href="#"><i class="icon-home"></i> Summary</a>
                <!-- Divider 
                <span class="divider">></span>
                <a href="#" class="bread-current">Tables</a>-->
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
            </div>

            <ul class="crumb-buttons">
                <li class="first">
<<<<<<< HEAD
                    <a title="" href="charts.html">
                        <i class="icon-signal"></i>
                        <span>Statistics</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" title="" href="#">
                        <i class="icon-tasks"></i>
                            <span>
                                Users <strong>(+3)</strong>
=======
                    <a title="" href="#">
                        <i class="icon-signal"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!--<li class="dropdown">
                    <a data-toggle="dropdown" title="" href="#">
                        <i class="icon-tasks"></i>
                            <span>
                                Airlines <strong>(<?php echo $airlines?>)</strong>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                            </span>
                        <i class="icon-angle-down left-padding"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a title="" href="form_components.html">
                                <i class="icon-plus"></i>
                                Add new User
                            </a>
                        </li>
                        <li>
                            <a title="" href="tables_dynamic.html">
                                <i class="icon-reorder"></i>
                                Overview
                            </a>
                        </li>
                    </ul>
<<<<<<< HEAD
=======
                </li> -->
                <li class="range">
                    <a href="#">
                        <i class="icon-tasks"></i>
                        <span>
                            Airlines <strong>(<?php echo $airlines?>)</strong>
                        </span>
                    </a>
                </li>
                <li class="range">
                    <a href="#">
                        <i class="icon-signal"></i>
                        <span>
                            Visitors <strong>(<?php echo $visitors?>)</strong>
                        </span>
                    </a>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
                </li>
                <li class="range">
                    <a href="#">
                        <i class="icon-calendar"></i>
                        <span><?php echo date('F d, Y');?></span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->
