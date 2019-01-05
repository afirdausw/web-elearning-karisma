<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
			<link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
			<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >
			<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>
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
		<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

		<!-- Animation library for notifications   -->
		<link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet"/>

		<!--  Light Bootstrap Table core CSS    -->
		<link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>

		
		<!--  CSS for Karisma PG_Admin  -->
		<link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />
		
		<link href="<?php echo base_url('assets/js/jquery-ui/jquery-ui.css" rel="stylesheet');?>" />


		<!--     Fonts and icons     -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

		<!-- ADDITIONAL -->
		<!--  Chosen Select Box Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/chosen.css');?>" rel="stylesheet"/>
		
		<!--  Awseomplate Plugin CSS  -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/awesomplete.css');?>" />
		
		<!--  Datatables (Bootstrap) Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/dataTables.bootstrap.min.css');?>" rel="stylesheet"/>
		
		<!--  Nestable (JQuery) Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/nestable.css');?>" rel="stylesheet"/>
		
		<!--  Bootstrap Switch Plugin CSS    -->
		<link href="<?php echo base_url('assets/css/plugins/bootstrap-switch.min.css');?>" rel="stylesheet"/>
		
		<!-- Progress -->
		<link href="<?php echo base_url('assets/css/nprogress.css'); ?>" rel='stylesheet' />
		<!-- BS 4 Margin -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bs-4-margin.css'); ?>">

		<!--   Core JS Files   -->
	 <script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript');?>"></script>
		
		<script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.js');?>"></script>
</head>
<body>