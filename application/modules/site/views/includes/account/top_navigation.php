<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav <?php echo $grade_details->grade_style;?>_border" role="banner">

<div class="containerk <?php echo $grade_details->grade_style;?>">
<!-- Menu button for smallar screens -->
<div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a href="<?php echo site_url();?>" class="navbar-brand">awesomemath.<span class="bold">net</span></a>
</div>
<!-- Site name for smallar screens -->

<!-- Navigation starts -->
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

    <!-- Notifications -->
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a class="project-switcher-btn dropdown-toggle"  href="#">
                <i class="icon-folder-open"></i>
                <span>Grades</span>
            </a>
        </li>
        
        <li>
            <a class=""  href="<?php echo site_url()."account";?>">
                <i class="icon-th"></i>
                <span>My Account</span>
            </a>
        </li>
        
        <!-- Profile Links -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="icon-male"></i>
                <span class="username"><?php echo $this->session->userdata('first_name');?></span>
                <b class="caret"></b>
            </a>
            <!-- Dropdown menu -->
            <ul class="dropdown-menu">
                <li><a href="<?php echo site_url()."sign-out";?>"><i class="icon-off"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
	
    <div class="center-align"><h4><?php echo $grade_details->grade_name;?></h4></div>
</nav>

</div>

<!-- Projects Drop Down -->
<div class="pdd">
    <ul id="horiz_container_outer" class="container" >
        <li id="horiz_container_inner">
            <ul id="horiz_container" style="width: 100%;">
                <li>
                    <a href="<?php echo base_url('grades/6');?>">
                                <span class="image">
                                   <i class="icon-desktop"></i>
                                </span>
                        <span class="title">Grade 6</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('grades/7');?>">
                                <span class="image">
                                 <i class="icon-compass"></i>
                                </span>
                        <span class="title">Grade 7</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('grades/8');?>">
                                <span class="image">
                                 <i class="icon-beaker"></i>
                                </span>
                        <span class="title">Grade 8</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div id="scrollbar" class="container">
        <div id="track">
            <div id="dragBar"></div>
        </div>
    </div>
</div>
<!-- End Grades Dropdown -->
</div>
