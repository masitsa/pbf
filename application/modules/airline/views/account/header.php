

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PBF | <?php echo $title;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/css/plugins/morris.css" rel="stylesheet">
    
    <!-- Admin Custom -->
    <link href="<?php echo base_url();?>assets/themes/custom/css/admin_style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/themes/sb-admin/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/themes/sb-admin/js/jquery-1.11.0.js"></script>
    <input type="hidden" id="airline_id" value="<?php echo $this->session->userdata('airline_id');?>"/>