
<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">

<div class="containerk">
<!-- Menu button for smallar screens -->
<div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
<<<<<<< HEAD
    <a href="index.html" class="navbar-brand"><span class="bold">C</span>MS</a>
=======
    <a href="<?php echo site_url().'all-users';?>" class="navbar-brand"><span class="bold">PBF</span> CMS</a>
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
</div>
<!-- Site name for smallar screens -->


<!-- Navigation starts -->
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

<!-- Notifications -->
<ul class="nav navbar-nav navbar-right">

    <!-- Profile Links -->
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="icon-male"></i>
            <span class="username"><?php echo $this->session->userdata('first_name');?></span>
            <b class="caret"></b>
        </a>
        <!-- Dropdown menu -->
        <ul class="dropdown-menu">
            <li><a href="<?php echo site_url()."admin-profile/".$this->session->userdata('user_id');?>"><i class="icon-user"></i> Profile</a></li>
<<<<<<< HEAD
            <li><a href="<?php echo site_url()."settings";?>"><i class="icon-cogs"></i> Settings</a></li>
=======
            <!--<li><a href="<?php echo site_url()."settings";?>"><i class="icon-cogs"></i> Settings</a></li>-->
>>>>>>> 440b632956276893c42653c41e62545e66db29dd
            <li class="divider"></li>
            <li><a href="<?php echo site_url()."logout-admin";?>"><i class="icon-off"></i> Logout</a></li>
        </ul>
    </li>
</ul>

</nav>

</div>
</div>
