<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
			<link rel="icon" href="<?php echo base_url('assets/img/merk/icon-lpi.png');?>">
			<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/icon-lpi.png');?>" >
			<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/icon-lpi.png');?>" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> Fixing 
	<?php if(isset($page_title))
	{echo $page_title." - ";}
	?>Karisma 
	<?php if(uri_string()== "psep_sekolah/login"){
			echo "Sekolah / Guru";
		}else{
			echo "Admin";
		}

		?>
	 Dashboard</title>

	 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />


		<!-- Bootstrap core CSS     -->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/css/bootstrap.min.css');?>" rel="stylesheet" />

		<!-- Animation library for notifications   -->
		<link href="<?php echo base_url('assets/plugins/animate/animate.min.css');?>" rel="stylesheet"/>

		<!--  Light Bootstrap Table core CSS    -->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/plugins/light-bootstrap-dashboard/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>

		
		<!--  CSS for Karisma PG_Admin  -->
		<link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />
		
		<link href="<?php echo base_url('assets/plugins/jquery/jquery-ui/jquery-ui.css" rel="stylesheet');?>" />


		<!--     Fonts and icons     -->
		<link href="<?php echo base_url('assets/plugins/fontawesome-5.6.3/css/all.min.css');?>" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url('assets/plugins/pe-icon-7/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

		<!-- ADDITIONAL -->
		<!--  Chosen Select Box Plugin CSS    -->
		<link href="<?php echo base_url('assets/plugins/jquery/jquery-chosen/css/chosen.css');?>" rel="stylesheet"/>
		
		<!--  Awseomplate Plugin CSS  -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/awesomplete/awesomplete.css');?>" />
		
		<!--  Datatables (Bootstrap) Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/dataTables.bootstrap.min.css');?>" rel="stylesheet"/>
		
		<!--  Nestable (JQuery) Plugin CSS    -->
		<link href="<?php echo base_url('assets/plugins/nestable/css/nestable.css');?>" rel="stylesheet"/>
		
		<!--  Bootstrap Switch Plugin CSS    -->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-switch/bootstrap-switch.min.css');?>" rel="stylesheet"/>
		
		<!-- Progress -->
		<link href="<?php echo base_url('assets/plugins/nprogress/css/nprogress.css'); ?>" rel='stylesheet' />
		<!-- BS 4 Margin -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-4/css/bs-4-margin.css'); ?>">

		<!--   Core JS Files   -->
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
		
		<script src="<?php echo base_url('assets/plugins/jquery/jquery-ui/jquery-ui.js');?>"></script>
</head>
<body>