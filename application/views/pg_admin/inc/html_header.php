<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<!--
		FAVICON
	-->
	<link rel="icon" href="<?php echo base_url('assets/img/merk/favicon.ico');?>">
	<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/favicon.ico');?>" >
	<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/favicon.ico');?>" >

	<title>Ready to Merge 
	<?php if(isset($page_title)){echo $page_title." - ";}?>Karisma 
	<?php 
		if(uri_string()== "psep_sekolah/login"){
			echo "Sekolah / Guru";}else{echo "Admin";
		}
	?> Dashboard</title>

		<!--
			Fonts and icons
		-->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url('assets/plugins/fontawesome-4.7/css/font-awesome.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/plugins/pe-icon-7/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

		<!--
			Plugin
		-->
		<!-- Bootstrap -->
		<!-- Bootstrap 3 CSS-->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/css/bootstrap.min.css');?>" rel="stylesheet" />
		<!--  Light Bootstrap Table core CSS    -->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/plugins/light-bootstrap-dashboard/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>
		<!--  Datatables (Bootstrap) Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/dataTables.bootstrap.min.css');?>" rel="stylesheet"/>
		<!--  Bootstrap Switch Plugin CSS    -->
		<link href="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-switch/bootstrap-switch.min.css');?>" rel="stylesheet"/>
		<!-- BS 4 Margin -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-4/css/bs-4-margin.css'); ?>">

		
		<!-- ETC -->
		<!-- Animation library notifications -->
		<link href="<?php echo base_url('assets/plugins/animate/animate.min.css');?>" rel="stylesheet"/>
		<!--  Chosen Select Box Plugin -->
		<link href="<?php echo base_url('assets/plugins/jquery/jquery-chosen/css/chosen.css');?>" rel="stylesheet"/>
		<!--  Awesomplate CSS  -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/awesomplete/awesomplete.css');?>" />
		<!--  Nestable (JQuery)-->
		<link href="<?php echo base_url('assets/plugins/nestable/css/nestable.css');?>" rel="stylesheet"/>
		<!-- nProgress -->
		<link href="<?php echo base_url('assets/plugins/nprogress/css/nprogress.css'); ?>" rel='stylesheet' />
		<!--  jQuery UI   -->
		<link href="<?php echo base_url('assets/plugins/jquery/jquery-ui/jquery-ui.css" rel="stylesheet');?>" />


		<!--  Core CSS  -->
		<link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />		
		<!--   Core JS Files   -->
	 	<script src="<?php echo base_url('assets/plugins/jquery/jquery/jquery-1.12.4.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/plugins/jquery/jquery-ui/jquery-ui.js');?>"></script>
</head>
<body>