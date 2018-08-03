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

		<link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

		

		<!-- Stylesheets -->

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">

		

	</head>
<!-- body data-spy="scroll" data-target="#content-sidebar"  -->
	<body style="position:relative;height:auto;overflow:scrolled;">

		<header>

			<!-- nav bar -->

				 <?php include('header_dynamic.php'); ?>
				<div class="mapel-header" style="padding:190px 0 50px;">

						<h2 class="mapel-title"><?php //echo $header->nama_mapel." ".$header->alias_kelas ?></h2>

						<h2 class="mapel-title" style="margin:130px 0 90px;">Daftar Tryout</h2>

				</div>
		</header>



		<!-- Table of Content -->

		<div id="content-sidebar">

		<div class="tableofcontent">

			<div class="table-sidebar"  style="display:none;">

				<div id="sidebar" class="left-side affix-top">

<!--      <h3><?php echo isset($data->nama_materi_pokok)?$data->nama_materi_pokok:'Judul Materi Pokok' ?></h3>

 -->      <ul class="nav nav-pills nav-stacked">

						<?php foreach ($data as $list_side_pokok) {

						//   if($list_side_pokok->mapel_id == $header->id_mapel)

						//   {

							?>

							<li role="presentation" id="pokok_<?php echo $list_side_pokok->id_materi_pokok?>">

								<a data-toggle="pill" href="#"><?php echo $list_side_pokok->nama_materi_pokok; ?></a>

							</li>

							<?php

						//   }

						}?>

					</ul>desc-content

				</div>

			</div>

			

			<div class="table-desc">
			<div class="desc-content">
				<h3><?php //echo $tryout_desc->nama_sub_materi;?></h3>
				<p><?php //echo $tryout_desc->deskripsi_sub_materi;?></p>
				<p>Kamu dapat memilih Try Out yang akan diikuti/dikerjakan sesuai dengan jenjang kelas dan mata pelajaran yang dipilih. Silahkan klik tombol "Mulai" di setiap kategori
				
				<table class="table table-stripped table-hover">
				    
					<?php
						foreach($daftar_kategori_baru as $kategori){
					?>
					    <td colspan="3" style="vertical-align:middle; text-align: center;"><h3><?php echo $kategori['nama_profil']; ?></h3></td>
						
					</tr>
					<?php 
					    if(count($kategori['daftar_kategori']) > 0 ){
					foreach($kategori['daftar_kategori'] as $dk){ ?>
                        
					<tr>
					    <td style="vertical-align:middle; text-align: center; font-size: 20px;"><?php echo $dk['nama_kategori']; ?></td>
						<td style="vertical-align:middle">
							<span class="label label-success">waktu: <?php echo $dk['durasi'];?> menit</span> 
							<span class="label label-warning">jumlah: <?php echo $dk['jumlah_soal'];?> soal</span>
						</td>
						<td style="vertical-align:middle; text-align: center;">
							<?php
								if($dk['status'] == '0'){
									echo "Try Out tidak tersedia";
								}else{
									echo ' <a href="../tryout/mulai/'.$dk['id_kategori'].'" class="btn btn-danger">MULAI</a>';
								}
							?>
						</td>
						</tr>
					    <?php
					}
					            }
            						}
            					?>
						        
				
				</table>
				
				<hr>
				<p class="center"> Keterangan :
				<ol>
					<li>
						Klik tombol MULAI untuk memulai pengerjaan soal
					</li>
					<li>
						Pilihlah salah satu jawaban yang anda anggap paling benar atau paling tepat.
					</li>
					<li>
						Perhatikan sisa waktu yang tersedia pada bagian kanan atas.
					</li>
				</ol>
				<p>&nbsp;
				<p class="center">Selamat Mengerjakan !
			</div>
			</div>

		</div> 

			</div>       

		

		<?php include('footer.php');?>

		

		<!-- Javascript -->

		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

		<!-- Menu Toggle Script -->

		<script>

		$("#menu-toggle").click(function(e) {

			e.preventDefault();

			$("#wrapper").toggleClass("toggled");

		});

		</script>

		<script>

			// $('#sidebar').affix({

			//     offset: {

			//     top: 300

			//     }

			// });

		</script>

	</body>

</html>

	</body>

</html>