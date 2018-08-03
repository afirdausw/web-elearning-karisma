<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Lembaga Pendidikan Islam Hidayatullah</title>
    
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">
    
  </head>
  <body>
    <header>
      <!-- nav bar -->
      <?php include('header.php');?>
      
    </header>
    
    <div class="container-fluid daftar-isi konten-wrapper" style="padding: 20px 12% !important;margin-top:66px;">

		<div class="row well">
			<h2>Kontak Kami</h2>
			<hr>
			<form action="<?= base_url('kontak/proses_pesan') ?>" method="post">
				<div class="form-horizontal">
					
					<?php if ($this->session->flashdata('sukses') != ''){ ?>
					<label class="alert alert-success" style="width:100%"><i><?= $this->session->flashdata('sukses') ?></i></label>
					<br>
					<?php } ?>
					
					<div class="form-group">
						<div class="col-md-3">Masukkan Nama</div>
						<div class="col-md-9">
							<input type='text' name="nama" id="nama" value="<?php echo $nama ?>" placeholder="Masukkan Nama" class="form-control" required/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3">Masukkan Nomor Handphone</div>
						<div class="col-md-9">
							<input type='text' name="hp" id="hp" value="<?php echo $hp ?>" placeholder="Masukkan Nomor Handphone" class="form-control" required/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3">Masukkan Email</div>
						<div class="col-md-9">
							<input type='text' name="email" id="email" value="<?php echo $email ?>" placeholder="Masukkan Email" class="form-control" required/>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-md-3">Masukkan Pesan</div>
						<div class="col-md-9">
							<textarea name="pesan" id="pesan" rows="8" value="<?php echo $pesan ?>" placeholder="Masukkan Pesan Anda disini" class="form-control" required/></textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="form-group">
						<div class="col-md-3">&nbsp;</div>
						<div class="col-md-9">
							<button type="submit" name="submit" value="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Kirim Pesan</button>
						</div>
					</div>
				</div>
			</form>

		</div>

    </div>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
  
  </body>
</html>
