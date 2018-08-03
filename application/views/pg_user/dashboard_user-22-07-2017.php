<?php
include('header_dashboard.php');
$idsiswa = $this->session->userdata('id_siswa');
foreach ($kelasaktif as $kelas) {
		foreach ($data_profil as $profil) {
				if ($profil->id_kelas == $kelas->id_kelas and $profil->status == 1) {
						$id_tryout = $profil->id_tryout;
//            $status_modal_cbt = '1';
//        } else if ($profil->id_kelas == $kelas->id_kelas and $profil->status == 2) {
//            $status_modal_cbt = '2';
						$cek_status_pembayaran = $this->model_dashboard->cek_status_pembayaran($idsiswa, $id_tryout);
						if ($cek_status_pembayaran == '1') {
								$status_modal_cbt = '1';
						} else if ($cek_status_pembayaran == '2') {
								$status_modal_cbt = '2';
						} else if ($cek_status_pembayaran == 0) {
								$status_modal_cbt = '0';
						} else {
								$status_modal_cbt = '4';
						}
				}
		}
}
?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#profil").load("profil/" + $("#kelas").val());
	});
	$("#profil").change(function(){
		$("#tryout").load("tryout/" + $("#profil").val());
	});
	$("#pilihkelas").change(function(){
		$("#pilihmapel").load("pilihmapel/" + $("#pilihkelas").val());
	});
	$("#pilihmapel").change(function(){
		$("#materi").load("materi/" + $("#pilihmapel").val());
	});
	
	$("#dropkelas li").click(function() {
		$("#dropmapel").load("pilihmapel/" + $(this).attr('id'));
	});
	
	$("#dropkelastryout li").click(function() {
		$("#dropprofil").load("profil/" + $(this).attr('id'));
	});

	$('#cari').keypress(function (e) {
		if (e.which == 13) {
		$("#materi").load("carimateri/" + encodeURIComponent($(this).val()));
		}
	});
	$("#pilihprovinsi").change(function(){
		$("#pilihkota").load("../signup/kota/" + $("#pilihprovinsi").val());
	});
	
	$("#pilihkota").change(function(){
		$("#btnTambahSekolah").prop('disabled', false);
		$("#pilihsekolah").load("../signup/sekolah/" + $("#pilihkota").val());
	});
	
	$("#pilihsekolah").change(function(){
		$("#kelassekolah").load("kelasbysekolah/" + $("#pilihsekolah").val());
	});
	$("#jenjangbaru").change(function(){
		$("#kelassekolah").load("kelasbyjenjang/" + $("#jenjangbaru").val());
	});
	
	$(".btn-kelas").click(function() {
		$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
		$("#materi").load("lihatmapel/" + $(this).attr('id'));
	});
});
</script>
<script>
	function supports_media_source()
	{
			"use strict";
			var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
					hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
			return (hasWebKit || hasMediaSource);
	}
</script>


<div class="breadcrumb-container">
	<ol class="breadcrumb">
		<li class="active">Dashboard</li>
	</ol>
</div>

<div class="container-fluid akun-container">
	<div class="col-lg-12">
	
		<div class="well agcu-welcome">
			<p class="text-center">"<?php echo $quote->quote?>"</p>
			<p class="text-center"><i>-<?php echo $quote->tokoh?></i></p>
		</div>
		<br>
	
	
		<div class="agcu-welcome">
			<div class="content">
				<h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
				<p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
				<?php
				if($status_siswa == "tidak_aktif"){
				?>
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#aktivasiagcu">
					Mulai AGCU
				</button>
				<?php
				}else{
				?>
				<a href="../agcutest" class="btn btn-primary">Mulai AGCU</a>
				<?php
				}
				?>
			</div>
			<img class="image" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>" style="float: right;">
		</div>
		<!-- <p>&nbsp; -->
		
		<!--
	<div class="profile-option">
				<div class="input-group search">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search search"></span></span>
					<input type="text" class="form-control" placeholder="Cari Materi..." id="cari">
				</div>
				<ul class="options nav navbar-nav">
					<li class="dropdown kelas-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH KELAS<span class="glyphicon glyphicon-chevron-down"></span></a>
						<ul class="dropdown-menu" id="dropkelas">
				<?php
					foreach($kelasaktif as $kelas){
				?>
					<li id='<?php echo $kelas->id_kelas; ?>'><a href="#dropkelas"><?php echo $kelas->alias_kelas; ?></a></li>
				<?php
					}
					?>
						</ul>
					</li>
			<li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH MATA PELAJARAN<span class="glyphicon glyphicon-chevron-down"></span></a>
						<ul class="dropdown-menu" id="dropmapel">
									 <li class='pilih' id="hehehe"><a href='#dropmapel'>coba klik disini<span class='circle' style='background-color:#e6353c;'></span></a></li> 
						</ul>
					</li>
				</ul>
			</div>
	 -->
		<div class="mapel-wrapper" id="materi">
			<?php
				foreach($kelasaktif as $kelas){
			?>
				<div class="mapel-container">
					<div class="content">
						<div class="title">
							<h4><?php echo $kelas->alias_kelas;?></h4>
						</div>
						<button class="btn btn-success btn-kelas" type="submit" style="float: right; margin: 15px 0;" id="<?php echo $kelas->id_kelas;?>">Lihat Mata Pelajaran</button>
					</div>
				</div>
			<?php
				}
				?>
		</div>


	
	<div class="profile-option">
				<div class="input-group search">
					<span class="input-group-addon"><span class="glyphicon glyphicon-file search"></span></span>
					<span class="form-control" id="cari">CBT | <a href="liveskor">Lihat Peringkat CBT</a></span> 
				</div>
				<ul class="options nav navbar-nav">
					<li class="dropdown kelas-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH KELAS<span class="glyphicon glyphicon-chevron-down"></span></a>
						<ul class="dropdown-menu" id="dropkelastryout">
				<?php
					foreach($kelasaktif as $kelas){
				?>
					<li id='<?php echo $kelas->id_kelas; ?>'><a href="#dropkelas"><?php echo $kelas->alias_kelas; ?></a></li>
				<?php
					}
					?>
						</ul>
					</li>
					<li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH PROFIL CBT<span class="glyphicon glyphicon-chevron-down"></span></a>
						<ul class="dropdown-menu" id="dropprofil">
									 
						</ul>
					</li>
				</ul>
			</div>


	<form action="statistiknilai" method="get">
		<div class="col-lg-12">
			<?php echo $this->session->flashdata('alert'); ?>
				<input type="hidden" id="profilterpilih" name="profil" required/>
			<input class="btn btn-danger" id="submitstatistik" type="submit" value="Lihat Statistik" style="float: right; display: none;" />
		</div>
	 </form>
	<div class="col-lg-12"><p>&nbsp;</div>

	<div class="mapel-wrapper" id="tryout">
 
	</div> 

	 <!-- mulai sini -->
<!-- untuk snmptn dihapus di pindah ke snmptn.php --.
<!-- akhiri sini -->



	
	
<!-- 
		 <div class="akun-slider hidden-sm hidden-xs">
			<div class="content">
				
			</div>
		 </div> -->
		
		<div class="container">
			<div class="content">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-menu">
					<a href="<?php echo base_url("user/tryout");?>">
							<div class="container-col-menu menu-2">
								<div class="col-menu-caption">
									<h1>TRY OUT</h1>
								</div>
							</div>
					</a>	
				</div>
					
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-menu">
					<a href="<?php echo base_url("user/tryoutsiswa");?>">
						<div class="container-col-menu menu-2">
							<div class="col-menu-caption">
								<h1>ANALISIS TRY OUT</h1>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>



		 <div class="akun-video">
			<h5>BONUS VIDEO MOTIVASI & INSPIRASI</h5>
			<div class="video-wrapper">
				 <?php 
				$no = 1;
				foreach ($data_video_motivasi as $video) 
				{ 
					$unlocked = in_array($video->id_konten, $bonus_unlocked);
					$style = $unlocked ? "display:none;" : '';
					$url = $unlocked ? "data-target='#videoMotivasiModal' data-source='".$video->url."'" : "data-target='#unlockBonus_modal'";
					?>
				<div class="video-container" style="height: 150px;">
					<div class="video">
						<div class="caption">
							<img class="lock" src="<?php echo base_url('assets/dashboard/images/lock.png');?>" style="<?php echo $style?>">
							<h6><span class="glyphicon glyphicon-play"></span>5:54</h6>
						</div>
						<?php if($video->gambar !== ""){
			?>
			<img src="<?php echo base_url('assets/uploads/bonus/'.$video->gambar);?>">
			<?php
			}else{
			?>
			<img src="<?php echo base_url('assets/dashboard/images/video1.jpg');?>">
			<?php
			}
			?>
					</div>
					<h6>
						<a href="#;" target="_BLANK" class="modal-video-motivasi" data-value="<?php echo $video->id_konten?>" data-toggle="modal" <?php echo $url?> >
							<?php echo $video->judul_konten?>
						</a>
					</h6>
				</div>
				<?php
				} ?>
			</div>
		</div>


		<div class="akun-video" >
			<h5>BONUS KONTEN BELAJAR</h5>
			<div class="video-wrapper" style="height: 360px; overflow-y: auto;">
					<?php 
				$no = 1;
				foreach ($data_bonus as $bonus)
				{ 
					$unlocked = in_array($bonus->id_konten, $bonus_unlocked);
					$style = $unlocked ? "display:none;" : '';
					$url = $unlocked ? $bonus->url : '#';
					$target = $unlocked ? '' : "data-target='#unlockBonus_modal'";
				?>
				<div class="video-container" style="height: 150px;">
					<div class="video">
						<div class="caption">
							<img class="lock" src="<?php echo base_url('assets/dashboard/images/lock.png');?>" style="<?php echo $style?>">
							<h6 style="<?php echo $style?>">UNLOCK</h6>
						</div>
						<?php if($bonus->gambar !== ""){
			?>
			<img src="<?php echo base_url('assets/uploads/bonus/'.$bonus->gambar);?>">
			<?php
			}else{
			?>
			<img src="<?php echo base_url('assets/dashboard/images/konten1.jpg');?>">
			<?php
			}
			?>
					</div>
					<h6>
						<a href="<?php echo $url?>" target="_BLANK" data-value="<?php echo $bonus->id_konten?>" data-toggle="modal" <?php echo $target?> >
							<?php echo $bonus->judul_konten?>
						</a>
					</h6>
				</div>
				<?php
				} ?>  
			</div>
		 </div>
		</div>
</div>

<?php include('modal_unlock_bonus.php');?>
	<?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

	 <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
	
	<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
	
	<!-- JS Function for this Modal -->
	<script type="text/javascript">
		$('#unlockBonus_modal').on('show.bs.modal', function (event) {
			var toggle = $(event.relatedTarget) // toggle that triggered the modal
			var judulBonus = toggle.text() // Extract info from data-* attributes
			var id_bonus = toggle.data('value')
			var modal = $(this)
			modal.find('.judul_bonus').text(judulBonus)
			modal.find('input[name=hidden_row_id]').val(id_bonus)
		})
	</script>

	<script type="text/javascript">
	$(document).ready(function() {
		var form = $('#unlockBonus_form');  
		console.log(form.attr('action'));
		form.submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				dataType: 'json',
				data: { 
					id_bonus: $('#hidden_row_id').val()  
				},
				success: function(response){
					$("#poinSiswa").html(response.poin);
					if(response.result != 0) {
						// fetch_select_kategori();
						// $("#tambah_kategori").val('');
						// $("#alertDangerUnlockBonus").slideUp();
						// $("#alertSuccessUnlockBonus").slideDown().delay(5000).slideUp();
						setTimeout(function() { 
							location.reload(); 
						}, 0);
					} 
					else {
						$("#alertSuccessUnlockBonus").slideUp();
						$("#msgDangerUnlockBonus").text(response.msg);
						$("#alertDangerUnlockBonus").slideDown().delay(5000).slideUp();
					}
				}
			})
		});
	<?php
	foreach($kelasaktif as $kelas){
		foreach($data_profil as $profil){
			if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
	?>
	$('#modalcbtcontest<?php echo $profil->id_tryout; ?>').modal('show');
	<?php
			}
		}
	}
	?>
	});
	</script>

	<script>
			if ( supports_media_source() ) {
				// supported.style.display="";
				videoObj.style.display="";
			}
			else {
				notsupported.style.display="";
			}
			var video;
			var player;
			var source; 
			var estimator;

			function connect(src = null)
			{
				if(connectObj.textContent == "Stop") 
				{
					dashStop();
					connectObj.textContent = "Start";
					statusStr.textContent = "Disconnected";
				}
				else 
				{
					
					connectObj.textContent = "Stop";
					statusStr.textContent = "Playing";
					
					if ( video == null )
					{ video = document.querySelector("video"); }

					if ( player == null )
					{ player = new shaka.player.Player(video); }

					// Attach the player to the window so that it can be easily debugged.
					window.player = player;

					// Listen for errors from the Player.
					player.addEventListener('error', failed );

					// Construct a DashVideoSource to represent the DASH manifest.
					//var mpdUrl = 'http://turtle-tube.appspot.com/t/t2/dash.mpd';
					if ( estimator != null ) { estimator=null; }
						estimator = new shaka.util.EWMABandwidthEstimator();

					if ( source != null )
					{ source = null; }

					if (src !== null)
					{
						// source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);
						// source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);
						source = new shaka.player.DashVideoSource(src, null, estimator);

						// Load the source into the Player.
						player.load(source);
					}
				}
			}

			function failed(e)
			{
				var done = false;
				if ( e.detail == 'Error: Network failure.' )
				{
					statusStr.textContent = 'Network Connection Failed.';
					done = true;
				}
				
				if ( e.detail.status!=200 && done == false )
				{
					switch ( e.detail.status )
					{
					case 404:
						statusStr.textContent = e.detail.url+' not found.';
					break;
					
					default:
						statusStr.textContent = 'Error '+e.detail.status+' for '+e.detail.url;
					break;
					}
				}
			}

			function dashStop()
			{
				if(player!=null)
				{
					console.log("player: " + player);
					player.unload();
				}
				connectObj.textContent = "Start";
				statusStr.textContent = "Disconnected";
			}

		</script>
		<!-- /NEEDED FOR SHAKA PLAYER -->

		<script type="text/javascript">
			function playVideo() {
					var video = $("#videoObj");
					// video.paused ? video.get(0).play() : video.get(0).pause();
					video.get(0).play();
					console.log("(onPlay) isPaused: " + video.get(0).paused)
			}        

			function pauseVideo() {
					var video = $("#videoObj");
					// video.paused ? video.get(0).play() : video.get(0).pause();
					video.get(0).pause();
					console.log("(onPause) isPaused: " + video.get(0).paused)
			}

			$("#videoMotivasiModal").on("shown.bs.modal", function(e){
				var video = $("#videoObj");
				console.log('$videoMotivasiModal shown');
				// if(video.get(0).paused == true){
					playVideo();
				// }
			})

			$("#videoMotivasiModal").on("hidden.bs.modal", function(e){
				var video = $("#videoObj");
				console.log('#videoMotivasiModal hidden');
				// if(video.get(0).paused == false){
					pauseVideo();
				// }
			})        

			$(document).ready(function(){
				var video = $("#videoObj");
				var id = null;
				
				$(".modal-video-motivasi").on("click", function(e) 
				{
					if(id == null)
					{ id = $(this).attr("id"); }

					var element = $(this);
					var src = element.data("source");

					if(source == null) {
						connect(src);
						console.log("(onClick) isPaused: " + video.get(0).paused);
					}
					else if(id !== $(this).attr('id')) {
						id = $(this).attr('id'); //update the id value
						dashStop();
						connect(src);
					} 
				})

				console.log("(onStart) isPaused: " + video.get(0).paused);    

			});
		</script>

	<script type="text/javascript" charset="utf-8">
		$(window).load(function(){
 
		});
	</script>
	
	<?php include('modal_aktivasi_agcu.php'); ?>
	<?php include('modal_profil.php'); ?>
	<?php
	foreach($kelasaktif as $kelas){
		foreach($data_profil as $profil){
			if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
				?>
					<div class="modal fade" id="modalcbtcontest<?php echo $profil->id_tryout; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-dialog-contest" role="document">
						<div class="modal-content modal-content-contest">
							<div class="modal-body body-modal-contest">
							<img src="<?php echo base_url('assets/uploads/banner/'.$profil->banner);?>" class="img img-responsive"/>
							<div class="row contest-desc">
								<div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 7px; padding-bottom: 7px;">
								Biaya : Rp. <?php echo $profil->biaya; ?>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4" style="padding-top: 7px; padding-bottom: 7px;">
								Tanggal Pelaksanaan : 
								<?php
								$originalDate = $profil->tgl_acara;
								$newDate = date("d M Y", strtotime($originalDate));
								echo $newDate;
								?>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<button class="btn btn-danger" style="float: right; margin-left: 20px;" data-dismiss="modal">
										Tutup
									</button>
														<a href="../cbt/cbt_detail/<?php echo $profil->id_tryout; ?>" class="btn btn-primary" style="float: right;">
																Informasi Lebih Lanjut
														</a>
								</div>
							</div>
							</div>
						</div>
						</div>
					</div>
			<?php
			}
		}
	}
?>

	</body>
</html>