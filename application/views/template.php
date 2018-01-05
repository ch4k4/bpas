<!DOCTYPE html>
<html lang="en">
<head>
	<!-- <link rel="icon" href="../../favicon.ico"> 
	
	<Script type="text/javascript" src="<?php echo base_url();?>assets/menu/menu.js"></Script>
	
	-->
	<!-- Bootstrap core CSS --> 
	<link type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url();?>assets/menu/menu.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url()?>assets/css/global.css" rel="stylesheet">
		
	<!-- easyui CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/easy/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/easy/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/easy/themes/color.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/easy/demo/demo.css">
	
	<!-- set javascript base_url -->
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.js"></script>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/easy/jquery.easyui.min.js"></script>
	
<title>Template</title>
</head>
<body>
    <div id="masthead">
    	<?php $this->load->view('masthead'); ?>
    </div>
    <div id="navigation">
    	<?php $this->load->view('navigation'); ?>
    </div>
    
    <div id="main">
    	<?php $this->load->view($main_view); ?>
    </div>        
    
    <div id="footer" class="navbar-fixed-bottom">        
        <?php $this->load->view('footer'); ?>        
    </div>
</body>
</html>