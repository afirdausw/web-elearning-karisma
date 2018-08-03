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

	li.sidebar-header span{
		color:white;
	}

	.sidebar .sidebar-wrapper{
		overflow-y: scroll !important;
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
<!-- 2017-09-18 -->
				<li class="hidden-lg hidden-md <?php echo ($active=='profil' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-user"></i>
							<p>Menu profil<b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">	
						<li>
							<a href="<?php echo site_url('psep_sekolah/user_profil')?>">
								Edit Profil
							</a>
							<a href="<?php echo site_url('psep_sekolah/login/logout')?>">
								Log out
							</a>
						</li>
					</ul>
				</li>

				<li class="sidebar-header"><span></span></li>
<!-- 2017-07-17 -->

				<li class="<?php echo ($active=='kelas' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>Kelas <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<?php
						if($this->session->userdata('level') == "sekolah"){
							?>
						<li>
							<a href="<?php echo site_url('psep_sekolah/kelas')?>">Semua Kelas</a>
						</li>

<!--                        if pindah kesini-->
						<li>
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

		<!-- end menu kelas -->
		<!-- ############################-->
		
		<!-- menu mata pelajaran -->
		<!-- hanya bisa diakses superadmin dan admin -->
		<!-- ############################-->

<!--				<li class="--><?php //echo ($active=='mapel' ? 'active' : '')?><!--">-->
<!--					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
<!--							<i class="pe-7s-notebook"></i>-->
<!--							<p>Mata Pelajaran <b class="caret"></b></p>-->
<!--					</a>-->
<!--					<ul class="dropdown-menu sub-nav">-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('psep_sekolah/mapel')?><!--">Semua Mata Pelajaran</a>-->
<!--						</li>-->
						<!--                        if pindah kesini-->
<!---->
<!--                        --><?php
//                        if($this->session->userdata('level') == "sekolah"){
//                        ?>
<!---->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('psep_sekolah/mapel/manajemen/tambah')?><!--">Tambah Baru</a>-->
<!--						</li>-->
<!---->
<!--                            --><?php
//                        }
//                        ?>
<!---->
<!--					</ul>-->
<!--				</li>-->

		<!-- end menu mata pelajaran -->
		<!-- ############################-->

			<!--                        if di comment-->
		<?php
			//if($this->session->userdata('level') == "sekolah"){
		?>
		
		
<!--				<li class="--><?php //echo ($active=='materi_pokok' ? 'active' : '')?><!--">-->
<!--					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
<!--							<i class="pe-7s-notebook"></i>-->
<!--							<p>Materi Pokok <b class="caret"></b></p>-->
<!--					</a>-->
<!--					<ul class="dropdown-menu sub-nav">-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('psep_sekolah/materi_pokok')?><!--">Semua Materi Pokok</a>-->
<!--						</li>-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('psep_sekolah/materi_pokok/manajemen/tambah')?><!--">Tambah Baru</a>-->
<!--						</li>-->
<!--					</ul>-->
<!--				</li>-->
		<?php
			//}
		?>
			<!--                        if di comment-->
		<?php
			//if($this->session->userdata('level') == "sekolah"){
		?>

				<li class="<?php echo ($active=='materi' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>Konten Materi <b class="caret"></b></p>
					</a>

						<?php
							if($this->session->userdata('level') == "sekolah") {
								?>
								<ul class="dropdown-menu sub-nav">
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi') ?>">
											Semua Materi
										</a>
									</li>
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi/manajemen/tambah') ?>">
											Tambah Baru
										</a>
									</li>
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi/manajemen/tambah-bulk') ?>">
											Tambah Materi Bulk
										</a>
									</li>
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi/manajemen/tambah-soal-bulk') ?>">
											Tambah Latihan Soal Bulk
										</a>
									</li>
								</ul>
								<?php
							} elseif($this->session->userdata('level') == "guru") {
						?>
								<ul class="dropdown-menu sub-nav">
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi_guru') ?>">
											Semua Materi
										</a>
									</li>
									<li>
										<a href="<?php echo site_url('psep_sekolah/materi_guru/manajemen/tambah') ?>">
											Tambah Baru
										</a>
									</li>

								</ul>

							<?php } ?>

				</li>

<!--            <li class="--><?php //echo ($active=='paud' ? 'active' : '')?><!--">-->
<!--                <a href="--><?php //echo site_url('psep_sekolah/paud') ?><!--">-->
<!--                    <i class="pe-7s-notebook"></i>-->
<!--                    <p>Konten Paud</p>-->
<!--                </a>-->
<!--            </li>-->

		<?php
			//}
		?>

				<li class="sidebar-header"><span>Latihan Soal</span></li>
				
				<li class="<?php echo ($active=='latihansoal' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Latihan Soal <b class="caret"></b></p>
					</a>


					<?php
					if($this->session->userdata('level') == "sekolah") {
					?>

					<ul class="dropdown-menu sub-nav">
						<li>
							<a href="<?php echo site_url('psep_sekolah/latihansoal')?>">
								Semua Soal
							</a>
						</li>
						<?php 
						$hide = true;
						if($hide == false) { ?>
						<li>
							<a href="<?php echo site_url('psep_sekolah/latihansoal/manajemen/tambah')?>">
								Tambah Baru
							</a>
							<?php } ?>
						</li>
					</ul>

						<?php
					} elseif($this->session->userdata('level') == "guru") {
					?>

					<ul class="dropdown-menu sub-nav">
						<li>
							<a href="<?php echo site_url('psep_sekolah/guru_latihan_soal')?>">
								Semua Soal
							</a>
						</li>
						<?php
						$hide = true;
						if($hide == false) { ?>
						<li>
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
		
		<li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Bank Soal <b class="caret"></b></p>
					</a>

			<?php
			if($this->session->userdata('level') == "sekolah"){
				?>
				<ul class="dropdown-menu sub-nav">
					<li class="<?php echo($active == 'banksoal/kategori' ? 'active' : '') ?>">
						<a href="<?php echo site_url('psep_sekolah/banksoal/kategori') ?>">
							<p>Kategori Bank Soal</p>
						</a>
					</li>
					<li class="<?php echo($active == 'banksoal' ? 'active' : '') ?>">
						<a href="<?php echo site_url('psep_sekolah/banksoal/filter') ?>">
							<p>Manage Bank Soal</p>
						</a>
					</li>
				</ul>

				<?php
						}   elseif($this->session->userdata('level') == "guru"){
				?>
						<ul class="dropdown-menu sub-nav">
							<li class="<?php echo($active == 'banksoal/kategori' ? 'active' : '') ?>">
								<a href="<?php echo site_url('psep_sekolah/guru_banksoal/kategori') ?>">
									<p>Kategori Bank Soal</p>
								</a>
							</li>
							<li class="<?php echo($active == 'banksoal' ? 'active' : '') ?>">
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
			}else {
                ?>
                <li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
                    <a href="<?php echo site_url('psep_sekolah/tryout_guru') ?>">
                        <i class="pe-7s-note2"></i>
                        <p>Try Out</p>
                    </a>
                </li>
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
		?>
				<li class="sidebar-header"><span>Siswa</span></li>
				<li class="<?php echo ((($active=='siswa' && $tambah=='tambah') OR ($active=='log')) ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-id"></i>
							<p>Pendaftaran <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li>
							<a href="<?php echo site_url('psep_sekolah/siswa/manajemen/tambah')?>">Tambah Pendaftar</a>
						</li>
					</ul>
				</li>
				<li class="<?php echo (($active=='siswa' && $tambah!='tambah') ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-id"></i>
							<p>Siswa <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<?php 
						$hide2 = true;
						if($hide2 == false) { ?>
						<li>
							<a href="<?php echo site_url('psep_sekolah/siswa')?>">Semua Siswa</a>
						</li>
						<?php } ?>
						<li>
							<a href="<?php echo site_url('psep_sekolah/siswa/pendaftar')?>">Pendaftar</a>
						</li>
						<li>
							<a href="<?php echo site_url('psep_sekolah/siswa/aktif')?>">Siswa Aktif</a>
						</li>
						<li>
							<a href="<?php echo site_url('psep_sekolah/log')?>">Log Akses</a>
						</li>
						<?php 
						if($hide2 == false) { ?>
						<li>
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
		<li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
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
		?>

		
		<!-- MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
				<li class="sidebar-header"><span>Academic General Check Up</span></li>
				<li class="<?php echo ($active=='agcu' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>AGCU <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li>
							<a href="<?php echo site_url('psep_sekolah/agcu/report_siswa')?>">Report Siswa</a>
						</li>
						<li>
							<a href="<?php echo site_url('psep_sekolah/agcu/rekap')?>">Rekapitulasi AGCU</a>
						</li>
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