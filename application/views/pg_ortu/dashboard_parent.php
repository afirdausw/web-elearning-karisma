<?php include('header_dashboard.php'); ?>
<script>
	function supports_media_source()
	{
		"use strict";
		var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
			hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
		return (hasWebKit || hasMediaSource);
	}
</script>

<?php
	include('breadcrumb-parent.php')
?>

<div class="container-fluid akun-container">
	<a href="<?php echo base_url("parents/aktivitas_siswa");?>">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-menu">
		<div class="container-col-menu menu-1">
			<div class="col-menu-caption">
				<h1>AKTIVITAS SISWA</h1>
			</div>
		</div>
	</div>
	</a>
	<a href="<?php echo base_url("ortu/analisis/tryout/1");?>">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-menu">
		<div class="container-col-menu menu-2">
			<div class="col-menu-caption">
				<h1>ANALISIS TRY OUT</h1>
			</div>
		</div>
	</div>
	</a>
	<a href="<?php echo base_url("ortu/agcu/siswa");?>">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-menu">
		<div class="container-col-menu menu-3">
			<div class="col-menu-caption">
				<h1>Analisis AGCU</h1>
			</div>
		</div>
	</div>
	</a>
</div>

<div class="container-fluid akun-container">
	<div class="col-lg-12">	
	 <div class="akun-slider">
		<div class="content">
		</div>
	 </div> 

	</div>
</div>

<?php include('footer.php'); ?>

	 <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
	
	<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
	
	<!-- JS Function for this Modal -->
 
	</body>
</html>