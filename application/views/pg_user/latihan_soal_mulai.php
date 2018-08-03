<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Latihan Soal Mulai | Lembaga Pendidikan Islam Hidayatullah</title>
			
			<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Icon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">

	<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/style.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-2.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
	</head>
	<body style="background:url(<?php echo base_url('assets/dashboard/images/bg-reason.png');?>) fixed #1abc9c;background-size:40%;">
		<div class="header">
			<!-- Navbar  -->
			<?php include('header_latihan.php'); ?>
		</div>
		<!-- /Header -->

		<!-- Page Body -->
		<div class="page-body latihan" style="">
			<div class="container">
				<?php include('modal_akses_materi.php'); ?>
				<div class="row">
					 <div class="content">					
<!--
						<span class="deskripsi">
							<p><?php //echo $data->deskripsi_sub_materi ? $data->deskripsi_sub_materi : '<br>' ?></p>
						</span>
	-->
						<span class="latihan-header">
							<h2 class="text-center emp"><?php echo $data->nama_sub_materi ? $data->nama_sub_materi : '' ?></h2>
						</span>
						<div class="wrapper">					
							<table class="table">
								<tr class="img-table hidden-xs hidden-sm">
									<td rowspan=6 style="border:none;vertical-align: middle;">
										<img src="<?php echo base_url('assets/pg_user/images/latihan-intro.png')?>" alt="Intro Latihan" class="img-responsive mulai-latihan-img">									
									</td>
								</tr>
								<tr>
									<td>Kelas </td>
									<td>:</td>
									<td><?php echo $infolatihan->alias_kelas; ?></td>
								</tr>
								<tr>
									<td>Mata Pelajaran</td>
									<td>:</td>
									<td><?php echo $infolatihan->nama_mapel; ?></td>
								</tr>
								<tr>
									<td>Materi Pokok</td>
									<td>:</td>
									<td><?php echo $infolatihan->nama_materi_pokok; ?></td>
								</tr>
								<tr>
									<td>Jumlah Soal</td>
									<td>:</td>
									<td><?php echo $jumlahsoal; ?> Soal</td>
								</tr>
								<tr>
									<td colspan=3>
										<?php
										//backup kondisi if(($data->status_materi == 0) OR ($allow_akses == TRUE))
										if($kondisi_flag==0)
											{ ?>
													<a href="<?php echo base_url().'latihan/soal/'.$data->id_sub_materi;?>" class="btn btn-latihan">Mulai Latihan!</a>
												<?php
												} 
												else 
												{ ?>
													<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-latihan">Mulai Latihan!</a>
												<?php
												} ?>										
									</td>
							</table>
										
						
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Body -->

		<!-- Footer -->
		<?php include('footer_latihan.php'); ?>
		<!-- /Footer -->
		
		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
	</body>
</html>