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
		
		<style>
			#isi_materi img{
				width: auto;
			}

			
			/*.navbar{
				position:inherit !important;
			}
			.mapel-header{
				margin:0 !important;
			}*/
			footer{
				position: relative !important;
			}
		</style>
	</head>
	<body>
		<header class="header">
			<!-- nav bar -->
				 <?php include('header.php'); ?>
				<div class="mapel-header" style="margin-top: 60px;">
						<h2 class="mapel-title"><?php echo $header->alias_kelas; ?></h2>
						<h4 class="mapel-title"><?php echo $header->nama_mapel; ?></h4>
				</div>
		</header>
			<!-- apa kata -->

		<div class="desc-content">
			<?php include('modal_akses_materi.php'); ?>
		</div>

		<div class="mapel-subs" data-sticky_parent>
			<div class="subs-right mapel-rightbar" data-sticky_column>
				<div class="content-rightbar">
						<div id="listbar" class="subs-konten desc-content">
							<div style="padding-left:45px">
								<div class="subject-title">
								<?php 
									// echo base_url('materi/tabel_konten_detail/'.$data->materi_pokok_id.'#pokok_'.$data->materi_pokok_id)
								?>
								<?php if($prev) //controller materi.php
									{ 
										$prev_url = "#";
										if($prev->kategori == "1") { $prev_url = base_url('materi/konten_teks/'.$prev->id_konten); }
										if($prev->kategori == "2") { $prev_url = base_url('materi/konten_video/'.$prev->id_konten); }
										if($prev->kategori == "3") { $prev_url = base_url('latihan/index/'.$prev->id_sub_materi); }
										?>
										
										<a href="<?php echo $prev_url;?>" class="arrow-prev">
											<span class="arrow"></span>
										</a>
										<h4><?php echo $data->nama_materi_pokok?></h4>
									<?php 
									} ?>
								</div>
							</div>


							<div class="sub-scroll">
								<ul>
								<?php
									foreach ($sidebar as $konten_lain) 
									{ ?>
									<li>
										<span class="materi-sep"></span>
										<?php
										switch($konten_lain->kategori){
											case 1 : 
												if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
													{ echo "<a href=".base_url('materi/konten_teks/'.$konten_lain->id_konten)." id='link_teks-".$konten_lain->id_konten."'>"; }
												else
													{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
												echo "<span class='icon-teks'></span> ";
													 break;
											case 2 : 
												if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
													{ echo "<a href=".base_url('materi/konten_video/'.$konten_lain->id_konten)." id='link_video-".$konten_lain->id_konten."'>"; }
												else
													{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
												echo "<span class='icon-video'></span> "; 
													 break;
											case 3 : 
												if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
													{ echo "<a target='_blank' href=".base_url('latihan/index/'.$konten_lain->sub_materi_id).">"; }
												else 
													{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
												echo "<span class='icon-tugas'></span> ";
													 break;
											default : echo "Materi Teks";
														break;
										}
										echo $konten_lain->nama_sub_materi ?>
										</a>
									</li>
									<?php } ?>
								</ul>

								<?php if($next) //controller materi.php
								{ 
									$next_url = "#";
									if($next->kategori == "1") { $next_url = base_url('materi/konten_teks/'.$next->id_konten); }
									if($next->kategori == "2") { $next_url = base_url('materi/konten_video/'.$next->id_konten); }
									if($next->kategori == "3") { $next_url = base_url('latihan/index/'.$next->id_sub_materi); }
									?>
									
									<a href="<?php echo $next_url;?>" class="btn btn-default next-konten">
										<h6>Bab Selanjutnya</h6>
										<p><b><?php echo $next->nama_materi_pokok?></b></p>
										<span class="arrow-next"><span class="arrow"></span></span>
									</a>
								<?php 
								} ?>
							</div>

						</div>
				</div>
			</div>

			<div class="subs-left" data-sticky_column>
				<div id="ajax-loading" class="col-xs-12 col-md-12 text-center" style="display:none; padding-top:60px;"> 
					<span class="cssload-loader"><span class="cssload-loader-inner"></span></span>
				</div>
					<h3 class="center-title" id="judul_materi"><?php echo $data->nama_sub_materi?></h3>
				
				<?php 
				if(($data->status_materi == 0) OR ($allow_akses == TRUE))
				{ ?>
					<div id="isi_materi">
						<?php echo html_entity_decode($data->isi_materi)?>
					</div>
				<?php
				} 

				else 
				{ ?>
					<div id="isi_materi" class="text-center">
						<img src="<?php echo base_url('assets/pg_user/images/icon/paid-notif.png');?>" width="468" height="216" alt="Notifikasi Pembayaran" class="img-responsive">
						<br>
						<p>
							Maaf... Konten ini khusus untuk premium member. Silahkan memilih paket dengan harga mulai Rp 150.000,-
							<br>
							Ingin menjadi premium member? silahkan daftar <a href="<?php echo base_url('signup'); ?>" class="link-login">disini</a>.
						</p>
					</div>
				<?php
				} ?>

			</div>
		</div>
		
		
		<?php include('footer.php'); ?>
		
		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<!-- <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script> -->
		<!-- <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
 -->
 	<!-- 	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/sticky-kit/jquery.sticky-kit.js');?>"></script> -->
 	<script src="http://leafo.net/sticky-kit/src/sticky-kit.js"></script>
		
		<!-- Menu Toggle Script -->
		<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
		</script>
		
		<!-- Scroll to Fixed -->
<!-- 		<script type="text/javascript">
				$('#listbar').scrollToFixed({
						marginTop: $('.header').outerHeight() - 250,
						limit: function() {
								var limit = $('.footer').offset().top - $('#listbar').outerHeight(true) - 10;
								return limit;
						},
						zIndex: 999,
						removeOffsets: true
				});
				$('#fixednav').scrollToFixed();
		</script> -->
		
<!--
		<script>
			$('#sidebar').affix({
					offset: {
						top: 345,
						bottom: 333
					}
			});
		</script>
-->

		<script type="text/javascript">
			//Show/Hide loading image (.gif) on AJAX process
			$(document).ready(function(){
				$(document).ajaxStart(function(){
					$('#judul_materi').hide();
					$('#isi_materi').hide();
					$("#ajax-loading").show();
					// $("#ajax-loading").fadeIn(100);
				});
				$(document).ajaxComplete(function(){
					// $("#ajax-loading").css("display", "none");
					$("#ajax-loading").fadeOut(100);
				});
			});
		</script>

		<script type="text/javascript">
			//Ajax function trigger
			$(document).ready(function(){
				$("[id^=link_teks-]").click(function(e){
					e.preventDefault();
					var target = e.length > 0 ? e : e.target.id;
					
					ajaxChangeContent(target); 
				});
			});

			//Ajax request to Change Content
			function ajaxChangeContent(target)
			{
				var value = target.split('-');
				
				$.ajax({
					url: "<?=base_url('materi/ajax_change_content');?>",
					type: 'post',
					dataType: 'json',
					data: { 'id': value[1], 'tipe':'teks' },

					success:function(data, status){
						console.log('\ntipe: '+value[0]+ ', id: '+value[1]);
						console.log("\nStatusChangeContent: " + status + "\nDATA: " + data.judul_materi);

						// JSON.parse(data);
						$('#judul_materi').html(data.judul_materi);
						$('#isi_materi').html(data.isi_materi);
						$("#judul_materi").fadeIn(700); 
						$("#isi_materi").fadeIn(700); 
					},
					error: function(xhr, desc, err) {
						console.log(xhr);
						console.log("Details: " + desc + "\nError:" + err);
					}
				});

			}
		</script>
	<style>
	.affix-top{
  		position: relative;
	}
    
.affix{

  position: fixed;
  top: 30px;
}
  
.affix-bottom{

  position: absolute;
  bottom: 20px;
}
	</style>

		<script type="text/javascript">
			// $("#listbar").affix({
			// 	offset: {
			// 	  bottom: function() {
			// 	    return (this.bottom = $('#footer').outerHeight(true))
			// 	  }
			// 	}
			// });


			$(window).scroll(function() {
			    $("#listbar").stick_in_parent({
						parent: '.mapel-subs',
						offset_top: '64',
					}
				).on("sticky_kit:stick", function(e) {
					$(this).css({
						'top': '64px',
						'position':'fixed'
					});
					$('.sub-scroll').css({
						'max-height' : ($(window).height())-158
					});
				}).on('sticky_kit:bottom', function(e) {
				    $('.mapel-subs').parent().css('position', 'static');
				})
				.on('sticky_kit:unbottom', function(e) {
				    $('.mapel-subs').parent().css('position', 'relative');
				});
			});

			
		</script>
	</body>
</html>