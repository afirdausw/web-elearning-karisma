<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard "<?php echo $infoortu->nama_ortu;?>" | Lembaga Pendidikan Islam Hidayatullah</title>

		<!-- Icon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >
		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

		<link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">

		<link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/pg_user/css/style.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/pg_user/css/custom.css');?>" rel="stylesheet">


		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js');?>"></script>
	</head>

	<body>
		
		<div class="navbar navhome navortu" role="navigation" id="header">
			<div class="container-fluid" style="padding:0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
						<span class="icon-bar first"></span>
						<span class="icon-bar second"></span>
						<span class="icon-bar third"></span>
					</button>
					<a class="logo" href="<?php echo base_url(''); ?>"><img src="<?php echo base_url('assets/dashboard/images/icon-lpi.png')?>" alt="Lembaga Pendidikan Islam Hidayatullah" style="width:50px;">
					</a>
				</div>

				<div class="navbar-collapse collapse navstyle" id="nav-bso">
					<ul class="nav navbar-nav navbar-right">
						<li class="search-sm" style="display:none;"><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>		
						<?php 
						if(!empty($_SESSION['id_ortu'])) { ?>
							<?php 
							//echo isset($_SESSION['nama_ortu']) ? strtok($_SESSION['nama_ortu'], ' ') : 'No name';
							//$infoortu->nama_ortu;
							?>
							<li class="search-lg"><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
							<li class="dropdown">
								
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<?php echo $infoortu->nama_ortu; ?>
									<span class="caret"></span>
								</a>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('parents/dashboard');?>">Dashboard</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="<?php echo base_url('parents/logout');?>">Logout</a></li>
								</ul>
							</li>
						<?php 
						} 
						else { ?>
							<li><a href="<?php echo base_url('pencarian')?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
							<li><a href="<?php echo base_url('login')?>">LOGIN/DAFTAR</a></li>
						<?php 
						} ?>
					</ul>
				</div>
			</div>
		</div>

		<header class="akun-header">
			<div class="wrapper">
				<div class="profile-name">
					<h5>Selamat datang, <?php echo $infoortu->nama_ortu;?></h5>
					<h6>Nama Siswa : <?php echo $infoortu->nama_siswa;?></h6>
				</div>
				<div class="akun-edit">
					
				</div>
			</div>
		</header>