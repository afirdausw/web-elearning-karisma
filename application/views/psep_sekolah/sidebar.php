<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->
<?php
	//read uri segment to determine CSS active link
	$active = $this->uri->segment(2);
	$seg3 = $this->uri->segment(3);
	$tambah = $this->uri->segment(4);
?>
<style>
	.nav .sub-nav li{
	  margin: 0;
	}
	.sidebar .nav li:hover > a {
	  background: none;
	}
	.dropdown-menu {
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.nav .open>a, .nav .open>a:focus, .nav .open>a:hover{
		color: #FFFFFF;
		opacity: 1;
		background: rgba(255, 255, 255, 0.23);
	}
</style>
<div class="sidebar" data-color="turquoise" data-image="<?php echo base_url('assets/dashboard/images/bg-reason.png');?>">
	<div class="sidebar-wrapper">
		<div class="logo">
			<img src="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" alt="logo.png" class="img-responsive hidden-sm hidden-xs" style="filter:invert(1); margin:0 auto; width:20%;">
			<a href="http://lpi-hidayatullah.or.id/" class="simple-text">
					Selamat datang, <?php 
						echo $this->session->userdata("username");
					?>
			</a>
		</div>

		<ul class="nav">
				<li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
					<a href="<?php echo base_url('psep_sekolah/dashboard'); ?>">
							<i class="pe-7s-display1"></i>
							<p>Dashboard</p>
					</a>
				</li>
<!-- 2017-07-17 -->
			<li class="sidebar-header"><span>Materi</span></li>
				<li class="<?php if(strpos($active, 'kelas') !== false) echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>Kelas <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<?php
						if($this->session->userdata('level') == "sekolah"){
						$page_act='kelas';
							?>
						<li class="<?php echo ($active==$page_act&&$tambah=='' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/kelas')?>">Semua Kelas</a>
						</li>

<!--                        if pindah kesini-->
						<li class="<?php echo ($active==$page_act&&$tambah=='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/kelas/manajemen/tambah')?>">Tambah Baru</a>
						</li>

							<?php
						} else {
						?>

							<li>
								<a href="<?php echo site_url('psep_sekolah/kelas_ampu')?>">Data Kelas </a>
							</li>

						<?php } ?>

					</ul>
				</li>

				<li class="sidebar-header"><span>Latihan Soal</span></li>
				
				<li class="<?php if(strpos($active, 'latihansoal') !== false || strpos($active, 'ambil_bank_soal') !== false) echo 'active';?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Latihan Soal <b class="caret"></b></p>
					</a>


					<?php
					if($this->session->userdata('level') == "sekolah") {
						$page_act='latihansoal';
					?>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active==$page_act&&$tambah!='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/latihansoal')?>">
								Semua Soal
							</a>
						</li>
						<li class="<?php echo ($active=="ambil_bank_soal") ? 'active' : ''?>">
							<a href="<?php echo site_url('psep_sekolah/ambil_bank_soal')?>">
								Tambah soal
							</a>
						</li>
						<?php 
						$hide = true;
						if($hide == false) { ?>
						<li class="<?php echo ($active==$page_act&&$tambah=='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/latihansoal/manajemen/tambah')?>">
								Tambah Baru
							</a>
							<?php } ?>
						</li>
					</ul>

						<?php
					} elseif($this->session->userdata('level') == "guru") {
						$page_act='guru_latihan_soal';
					?>

					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active==$page_act&&$tambah!='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/guru_latihan_soal')?>">
								Semua Soal
							</a>
						</li>

						<?php
						$hide = true;
						if($hide == false) { ?>
						<li class="<?php echo ($active==$page_act&&$tambah=='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/guru_latihan_soal/manajemen/tambah')?>">
								Tambah Baru
							</a>
							<?php } ?>
						</li>
					</ul>

					<?php } ?>
				</li>
				
		<!-- Menu Try Out -->
			<!-- Menu Try Out -->
		<li class="sidebar-header"><span>CBT</span></li>
		<?php
			$page_act='banksoal';
		?>
		
		<li class="<?php echo ($active==$page_act ? 'active' : '')?>">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Bank Soal <b class="caret"></b></p>
					</a>

			<?php
			if($this->session->userdata('level') == "sekolah"){
				?>
				<ul class="dropdown-menu sub-nav">
					<li class="<?php echo ($active==$page_act && $seg3=='kategori' ? 'active' : '')?>">
						<a href="<?php echo site_url('psep_sekolah/banksoal/kategori') ?>">
							<p>Kategori Bank Soal</p>
						</a>
					</li>
					<li class="<?php echo ($active==$page_act && $seg3=='filter' ? 'active' : '')?>">
						<a href="<?php echo site_url('psep_sekolah/banksoal/filter') ?>">
							<p>Manage Bank Soal</p>
						</a>
					</li>
				</ul>

				<?php
						}   elseif($this->session->userdata('level') == "guru"){
							$page_act="guru_banksoal";
				?>
						<ul class="dropdown-menu sub-nav">
							<li class="<?php echo ($active==$page_act && $seg3=='kategori' ? 'active' : '')?>">
								<a href="<?php echo site_url('psep_sekolah/guru_banksoal/kategori') ?>">
									<p>Kategori Bank Soal</p>
								</a>
							</li>
							<li class="<?php echo ($active==$page_act && $seg3!='kategori' ? 'active' : '')?>">
								<a href="<?php echo site_url('psep_sekolah/guru_banksoal') ?>">
									<p>Manage Bank Soal</p>
								</a>
							</li>
						</ul>

				<?php
					}
				?>

		</li>
			<?php
			if($this->session->userdata('level') == "sekolah"){
				?>
		<li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/tryout') ?>">
							<i class="pe-7s-note2"></i>
							<p>Try Out</p>
					</a>
				</li>

<!--		<li class="--><?php //echo ($active=='Pembayaran cbt contest' ? 'active' : '')?><!--">-->
<!--					<a href="--><?php //echo site_url('psep_sekolah/tryout/pembayarancbt') ?><!--">-->
<!--							<i class="pe-7s-note2"></i>-->
<!--							<p>Pembayaran CBT</p>-->
<!--					</a>-->
<!--				</li>-->
		<?php
			}
		?>
		
	
		<li class="<?php echo ($active=='analisis' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/analisis') ?>">
							<i class="pe-7s-note2"></i>
							<p>Pencapaian Siswa</p>
					</a>
				</li>
	
				<!-- END MENU TRY OUT -->

		<?php
			if($this->session->userdata('level') == "sekolah"){
		?>
				
				 <!-- menu agcu test -->
				<li class="sidebar-header"><span>AGCU Test</span></li>
		<li class="<?php echo ($active=='diagnostictest' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/diagnostictest') ?>">
							<i class="pe-7s-note2"></i>
							<p>Diagnostic Test</p>
					</a>
				</li>
		<!-- end menu agcu test -->

		<?php
			}
		?>
		
		<?php
			if($this->session->userdata('level') == "sekolah"){
				$page_act = 'siswa';
		?>
				<li class="sidebar-header"><span>Siswa</span></li>
				
				<li class="<?php echo ((($active==$page_act || $active=='log') && $seg3!='manajemen') ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-id"></i>
							<p>Siswa <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<?php 
						$hide2 = true;
						if($hide2 == false) { ?>
						<li class="<?php echo (($active==$page_act && $seg3=='') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/siswa')?>">Semua Siswa</a>
						</li>
						<?php } ?>
						<li class="<?php echo (($active==$page_act && $seg3=='pendaftar') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/siswa/pendaftar')?>">Pendaftar</a>
						</li>
						<li class="<?php echo (($active==$page_act && $seg3=='aktif') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/siswa/aktif')?>">Siswa Aktif</a>
						</li>
						<li class="<?php echo (($active=='log') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/log')?>">Log Akses</a>
						</li>
						<?php 
						if($hide2 == false) { ?>
						<li class="<?php echo (($active==$page_act && $seg3=='manajemen' && $tambah=='tambah') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/siswa/manajemen/tambah')?>">Tambah Baru</a>
						</li>
						<?php } ?>
					</ul>
				</li>
		<?php
			}
		?>
		
		<?php
// 			if($this->session->userdata('level') == "sekolah"){
		?>
			<!--		<li class="<?php // echo ($active=='sekolah' ? 'active' : '')?>">-->
				<!--	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
				<!--			<i class="pe-7s-study"></i>-->
				<!--			<p>Sekolah <b class="caret"></b></p>-->
				<!--	</a>-->
				<!--	<ul class="dropdown-menu sub-nav">-->
				<!--		<li>-->
					<!--		<a href="<?php // echo site_url('psep_sekolah/sekolah')?>">Semua Sekolah</a>-->
				<!--		</li>-->
				<!--		<li>-->
					<!--		<a href="<?php // echo site_url('psep_sekolah/sekolah/manajemen/tambah')?>">Tambah Baru</a>-->
				<!--		</li>-->
				<!--		<li>-->
							<!--<a href="<?php // echo site_url('psep_sekolah/sekolah/manajemen/import')?>">Import Data</a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</li>-->
				<?php
// 			}
		?>
		

				<!-- tambahan menu reward & bonus -->
		<!-- ############################ -->
		<!-- ############################ -->
		<?php
			if($this->session->userdata('level') == "sekolah"){
		?>
		<li class="sidebar-header"><span>Rewards & Quotes</span></li>
		<li class="<?php echo ($active=='poin' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/poin') ?>">
							<i class="pe-7s-server"></i>
							<p>Poin</p>
					</a>
				</li>
		<li class="<?php echo ($active=='bonus' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/bonus') ?>">
							<i class="pe-7s-door-lock"></i>
							<p>Bonus</p>
					</a>
				</li>
		<li class="<?php echo ($active=='quote' ? 'active' : '')?>">
					<a href="<?php echo site_url('psep_sekolah/quote') ?>">
							<i class="pe-7s-chat"></i>
							<p>Quotes</p>
					</a>
				</li>
		<?php
			}
		?>
		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- tambahan menu untuk PSES dan manajemen login PSES -->
		<!-- ############################ -->
		<!-- ############################ -->
		<?php
			if($this->session->userdata('level') == "sekolah"){
		?>
		<li class="sidebar-header"><span>Manajemen PSEP</span></li>
<!--		<li class="--><?php //echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?><!--">-->
<!--			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
<!--				<i class="pe-7s-credit"></i>-->
<!--				<p>Akun Sekolah <b class="caret"></b></p>-->
<!--			</a>-->
<!--			<ul class="dropdown-menu sub-nav">-->
<!--			<li>-->
<!--				<a href="--><?php //echo site_url('psep_sekolah/sekolah')?><!--">Semua Akun</a>-->
<!--			</li>-->
<!--			<li>-->
<!--				<a href="--><?php //echo site_url('psep_sekolah/sekolah/manajemen/tambah')?><!--">Tambah Baru</a>-->
<!--			</li>-->
<!--			</ul>-->
<!--		</li>-->
		<li class="<?php echo ($active=='guru' ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/guru') ?>">
							<i class="pe-7s-chat"></i>
							<p>Manajemen Guru</p>
					</a>
				</li>
		<?php
			}
		?>
		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->
		



		<?php
			if($this->session->userdata('level') == "sekolah"){
				$page_act="agcu";
		?>

		
		<!-- MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
				<li class="sidebar-header text-center"><span style="color:white!important;">Academic General Check Up</span></li>
				<li class="<?php echo ($active==$page_act ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>AGCU <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo (($active==$page_act && $seg3=='report_siswa') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/agcu/report_siswa')?>">Report Siswa</a>
						</li>
						<!-- <li class="<?php echo (($active==$page_act && $seg3=='rekap') ? 'active' : '')?>">
							<a href="<?php echo site_url('psep_sekolah/agcu/rekap')?>">Rekapitulasi AGCU</a>
						</li> -->
					</ul>
				</li>
		<!-- END MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		

		<?php
			}
		?>
		
		
	
		
		
		</ul>
	</div>
</div>