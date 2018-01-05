<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="../../favicon.ico">
	<link type="text/css" href="<?php echo base_url()?>assets/css/global.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url()?>assets/css/login2.css" rel="stylesheet">
	
<title>Template</title>
</head>
<body>

<div id="masthead">
	<?php $this->load->view('masthead'); ?>
</div>

<div id="main">	
        	<div class="col-md-12">        	
            	<div class="wrap">
                    <p class="form-title">Balai Peristirahatan Arga Sonya</p>                    
                    <div id="infoMessage"><?php echo $message;?></div>
                	<?php echo form_open('auth/login','class="login"');?>
                    <input name="identity" id="identity" type="text" placeholder="Username" />
					<input name="password" id="password" type="password" placeholder="Password" pattern=".{6,}" title="Six or more characters"/>
                    <input name="submit" type="submit" value="Sign In" class="btn btn-success btn-sm" />					
                    <?php echo form_close();?>				    
            </div>
        </div>    
</div>

</body>
</html>