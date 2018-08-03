<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Latihan Soal Selesai | Lembaga Pendidikan Islam Hidayatullah</title>

			

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

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-2.css');?>">

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">

	</head>

	<body>

		<div class="header">

			<!-- Navbar  -->

			<?php include('header_latihan.php'); ?>

		</div>

		<!-- /Header -->



		<!-- Page Body -->

		<div class="page-body latihan">

			<div class="container">

				<div class="latihan-header">

					<!-- <h2>Latihan Soal <b class="emp">Pembacaan Teks</b></h2> -->

					<ul class="list">
					<?php
					if(isset($_SESSION['data_latihan']['list_jawaban'])) {
						foreach ($_SESSION['data_latihan']['list_jawaban'] as $item) {
							if($item == 1) { ?>
				      		<li><span class="glyphicon glyphicon-ok-circle"></span></li>
						<?php	
							}
							else { ?>
				      		<li><span class="glyphicon glyphicon-remove-circle"></span></li>
						<?php	
							}
						} 
					} ?>
				    </ul>

				</div>

				<div class="deskripsi col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				        <div class="wrapper">
				       		<table class="table table-responsive">
								<tr class="img-table hidden-xs hidden-sm">
									<td rowspan=6 style="border:none;vertical-align: middle;">
										<img src="<?php echo base_url('assets/pg_user/images/latihan-intro.png')?>" alt="Intro Latihan" class="img-responsive mulai-latihan-img">									
									</td>
								</tr>
								<tr>
									<td colspan=3><h3>Ayo berusaha lagi!</h3></td>
								</tr>
								<tr>
									<td>Poin Latihan Soal</td>
									<td>:</td>
									<td><?php echo $skor; ?></td>
								</tr>
								<tr>
									<td><a href="<?php echo base_url().'latihan/index/'.$_SESSION['data_latihan']['id_materi']?>" class="btn btn-latihan btn-selesai">Ulangi Latihan!</a></td>
									<td></td>
									<td><a href="<?php echo base_url().'materi/tabel_konten_detail/'.$_SESSION['data_latihan']['id_pokok']?>" class="btn btn-latihan btn-selesai">Kembali Belajar!</a></td>
								</tr>
							</table>				        
				      
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