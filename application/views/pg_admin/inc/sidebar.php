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
	$active2 = $this->uri->segment(3);
	$tambah = $this->uri->segment(4);
?>

<style>
	.dd-handle{
		height:auto;
	}
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
		color:#337ab7;
		opacity: 1;
		background: rgba(255, 255, 255, 0.23);
	}
	.sidebar .nav .open>a, .sidebar .nav .open>a:focus, .sidebar .nav .open>a:hover{
		color:white;
	}
	.dropdown-backdrop {
	    display:none;
	}
</style>
<!-- Light Bootstrap Dashboard CSS -->
<div class="sidebar" data-color="blue" data-image="<?php echo base_url('assets/dashboard/images/bg-reason.png');?>">
	<div class="sidebar-wrapper">
		<div class="logo">
			<img src="<?php echo base_url('assets/pg_user/images/header-logo.png');?>" alt="logo.png" class="img-responsive hidden-sm hidden-xs" style="margin:0 auto;">
			<a href="<?=base_url();?>" class="simple-text">
				Selamat datang, <?php 
						echo $this->session->userdata("level");
				?>
			</a>
		</div>

		<ul class="nav clearfix">
				<li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
					<a href="<?php echo base_url('pg_admin/dashboard'); ?>">
							<i class="pe-7s-display1"></i>
							<p>Dashboard</p>
					</a>
				</li>

				<li class="sidebar-header"><span>Materi</span></li>
		<!-- menu kelas -->
		<!-- hanya bisa diakses superadmin dan admin -->
		<!-- ############################-->
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
				<li class="<?php echo ($active=='kelas' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>Kelas <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active=='kelas'  && $tambah=='' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/kelas')?>">Semua Kelas</a>
						</li>
						<li class="<?php echo ($active=='kelas' && $active2=='manajemen' && $tambah=='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/kelas/manajemen/tambah')?>">Tambah Baru</a>
						</li>
					</ul>
				</li>
		<?php
			}
		?>
				<li class="sidebar-header"><span>Latihan Soal</span></li>
				
				<li class="<?php echo ($active=='latihansoal' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Latihan Soal<b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active=='latihansoal' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/latihansoal')?>">
								Semua Soal
							</a>
						</li>
						<?php 
						$hide = true;
						if($hide == false) { ?>
						<li>
							<a href="<?php echo site_url('pg_admin/latihansoal/manajemen/tambah')?>">
								Tambah Baru
							</a>
							<?php } ?>
						</li>
					</ul>
				</li>
				
		<!-- Menu Try Out -->
			<!-- Menu Try Out -->
		<li class="sidebar-header"><span>CBT</span></li>
		
		<li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-note2"></i>
							<p>Bank Soal <b class="caret"></b></p>
					</a>
		<ul class="dropdown-menu sub-nav">
			<li class="<?php echo ($active2=='kategori' ? 'active' : '')?>">
				<a href="<?php echo site_url('pg_admin/banksoal/kategori') ?>">
					<!-- <i class="pe-7s-note2"></i> -->
					<p>Kategori Bank Soal</p>
				</a>
			</li>
			<li class="<?php echo ($active=='banksoal'  && $active2!='kategori'  ? 'active' : '')?>">
				<a href="<?php echo site_url('pg_admin/banksoal') ?>">
					<!-- <i class="pe-7s-note2"></i> -->
					<p>Manage Bank Soal</p>
				</a>
			</li>
		</ul>
		</li>
		<li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/tryout') ?>">
							<i class="pe-7s-note2"></i>
							<p>Try Out</p>
					</a>
				</li>
		
		<?php
			if($this->session->userdata('level') == "superadmin"){
		?>
		<li class="<?php echo ($active=='analisis' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/analisis') ?>">
							<i class="pe-7s-graph2"></i>
							<p>Pencapaian Siswa</p>
					</a>
				</li>
		<?php
			}
		?>
				<!-- END MENU TRY OUT -->

		<!-- START INSTRUKTUR -->
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
				$menuSlug = "instruktur";
				$menuTitle = ucwords(strtolower($menuSlug));
		?>
				<li class="sidebar-header"><span><?="{$menuTitle}"?></span></li>
				<li class="<?php echo (($active=="{$menuSlug}" && $tambah=='tambah') ? 'active' : '')?>">
					<a href="<?php echo site_url("pg_admin/{$menuSlug}/manajemen/tambah") ?>">
						<i class="pe-7s-add-user"></i>
						<p>Tambah <?="{$menuTitle}"?></p>
					</a>
				</li>
				<li class="<?php echo ($active=="{$menuSlug}" && $active2=='daftar' ? 'active' : '')?>">
					<a href="<?php echo site_url("pg_admin/{$menuSlug}/daftar")?>">
						<i class="pe-7s-menu"></i>						
						<p>Semua <?="{$menuTitle}"?></p>
					</a>
				</li>
		<?php
			}
		?>
		<!-- END INSTRUKTUR -->
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
				<li class="sidebar-header"><span>Siswa</span></li>
				<li class="<?php echo (($active=='siswa' && $tambah=='tambah') ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-id"></i>
							<p>Pendaftaran <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active=='siswa' && $active2=='manajemen' && $tambah=='tambah' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah')?>">Tambah Siswa Individu</a>
						</li>
						<li class="<?php echo ($active=='siswa' && $active2=='' && $tambah=='' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/siswa')?>">Tambah Siswa Kolektif </a>
						</li>
					</ul>
				</li>
				<li class="<?php echo ((($active=='siswa' OR ($active=='log')) && $tambah!='tambah') ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-id"></i>
							<p>Siswa <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<?php 
						$hide2 = true;
						if($hide2 == false) { ?>

						<?php } ?>
						<li class="<?php echo ($active=='siswa' && $active2=='pendaftar' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/siswa/pendaftar')?>">Semua Siswa</a>
						</li>
						<li class="<?php echo ($active=='siswa' && $active2=='aktif' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/siswa/aktif')?>">Siswa Aktif</a>
						</li>
						<li class="<?php echo ($active=='log' ? 'active' : '')?>">
							<a href="<?php echo site_url('pg_admin/log')?>">Log Akses</a>
						</li>
						<?php 
						if($hide2 == false) { ?>
						<li>
							<a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah')?>">Tambah Baru</a>
						</li>
						<?php } ?>
					</ul>
				</li>
		<?php
			}
		?>
		
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
<!--				<li class="--><?php //echo ($active=='sekolah' ? 'active' : '')?><!--">-->
<!--					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
<!--							<i class="pe-7s-study"></i>-->
<!--							<p>Sekolah <b class="caret"></b></p>-->
<!--					</a>-->
<!--					<ul class="dropdown-menu sub-nav">-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('pg_admin/sekolah')?><!--">Semua Sekolah</a>-->
<!--						</li>-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('pg_admin/sekolah/manajemen/tambah')?><!--">Tambah Baru</a>-->
<!--						</li>-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('pg_admin/sekolah/manajemen/import')?><!--">Import Data</a>-->
<!--						</li>-->
<!--					</ul>-->
<!--				</li>-->
				<?php
			}
		?>
		
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
<!--				<li class="sidebar-header"><span>Paket</span></li>-->
<!--				<li class="--><?php //echo ($active=='paket' ? 'active' : '')?><!--">-->
<!--					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">-->
<!--							<i class="pe-7s-credit"></i>-->
<!--							<p>Paket <b class="caret"></b></p>-->
<!--					</a>-->
<!--					<ul class="dropdown-menu sub-nav">-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('pg_admin/paket')?><!--">Semua Paket</a>-->
<!--						</li>-->
<!--						<li>-->
<!--							<a href="--><?php //echo site_url('pg_admin/paket/manajemen/tambah')?><!--">Tambah Baru</a>-->
<!--						</li>-->
<!--					</ul>-->
<!--				</li>-->
<!--				<li class="--><?php //echo ($active=='pembayaran' ? 'active' : '')?><!--">-->
<!--					<a href="--><?php //echo site_url('pg_admin/pembayaran') ?><!--">-->
<!--							<i class="pe-7s-cash"></i>-->
<!--							<p>Pembayaran</p>-->
<!--					</a>-->
<!--				</li>-->
		
		<?php /*
		<li class="<?php echo ($active=='voucher' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-notebook"></i>
							<p>Voucher<b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li>
							<a href="<?php echo site_url('pg_admin/voucher')?>">
								Semua Voucher
							</a>
						</li>
						<li>
							<a href="<?php echo site_url('pg_admin/voucher/manajemen/tambah')?>">
								Tambah Voucher
							</a>
						</li>
					</ul>
				</li>
				*/ ?>
				 
				<?php
			}
		?>
		
				<!-- tambahan menu reward & bonus -->
		<!-- ############################ -->
		<!-- ############################ -->
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
		<li class="sidebar-header"><span>Rewards & Quotes</span></li>
<!--        <li class="--><?php //echo ($active=='voucher' ? 'active' : '')?><!--">-->
<!--                    <a href="--><?php //echo site_url('pg_admin/voucher') ?><!--">-->
<!--                        <i class="pe-7s-server"></i>-->
<!--                        <p>Voucher</p>-->
<!--                    </a>-->
<!--                </li>-->

		<li class="<?php echo ($active=='poin' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/poin') ?>">
							<i class="pe-7s-server"></i>
							<p>Poin</p>
					</a>
				</li>
		<li class="<?php echo ($active=='bonus' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/bonus') ?>">
							<i class="pe-7s-door-lock"></i>
							<p>Bonus</p>
					</a>
				</li>
		<li class="<?php echo ($active=='quote' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/quote') ?>">
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
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
		<li class="sidebar-header"><span>Manajemen PSEP</span></li>
		<li class="<?php echo ($active=='akun_psep' && $active2!='guru' ? 'active' : '')?>">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<i class="pe-7s-culture"></i>
				<p>Akun Sekolah <b class="caret"></b></p>
			</a>
			<ul class="dropdown-menu sub-nav">
			<li class="<?php echo ($active=='akun_psep' && $active2=='sekolah' ? 'active' : '')?>">
				<a href="<?php echo site_url('pg_admin/akun_psep/sekolah')?>">Semua Akun</a>
			</li>
			<li class="<?php echo ($active=='akun_psep' && $active2=='tambah_sekolah' ? 'active' : '')?>">
				<a href="<?php echo site_url('pg_admin/akun_psep/tambah_sekolah')?>">Tambah Baru</a>
			</li>
			</ul>
		</li>
		<li class="<?php echo ($active=='akun_psep' && $active2=='guru' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/akun_psep/guru') ?>">
							<i class="pe-7s-study"></i>
							<p>Manajemen Guru</p>
					</a>
				</li>
		<?php
			}
		?>
		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- tambahan menu untuk manajemen user -->
		<!-- ############################ -->
		<!-- ############################ -->
		<?php
			if($this->session->userdata('level') == "superadmin"){
		?>
		<li class="sidebar-header"><span>Manajemen User</span></li>
		<li class="<?php echo ($active=='user' ? 'active' : '')?>">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="pe-7s-users"></i>
					<p>User <b class="caret"></b></p>
			</a>
			<ul class="dropdown-menu sub-nav">
				<li class="<?php echo ($active=='user' && $active2!='tambah' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/user')?>">Semua User</a>
				</li>
				<li class="<?php echo ($active=='user' && $active2=='tambah' ? 'active' : '')?>">
					<a href="<?php echo site_url('pg_admin/user/tambah')?>">Tambah Baru</a>
				</li>
			</ul>
		</li>
		<?php
			}
		?>
		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->

			<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
				?>


				<!-- MENU DOWNLOAD KONTEN -->
				<!-- ################################# -->
				<!-- ################################# -->
				<!-- ################################# -->

				<li class="<?php echo ($active=='konten_download' || $active=='kategori_konten_download' ? 'active' : '')?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<i class="pe-7s-download"></i>
							<p>DOWNLOAD KONTEN <b class="caret"></b></p>
					</a>
					<ul class="dropdown-menu sub-nav">
						<li class="<?php echo ($active2!='tambah' ? ($active=='konten_download' ? 'active' : '') : '')?>">
							<a href="<?php echo site_url('pg_admin/konten_download/')?>">Semua Konten</a>
						</li>
						<li class="<?php echo ($active2!='tambah' ? ($active=='kategori_konten_download' ? 'active' : '') : '')?>">
							<a href="<?php echo site_url('pg_admin/kategori_konten_download/')?>">Semua Kategori</a>
						</li>
						<li class="<?php echo ($active2=='tambah' ? ($active=='konten_download' ? 'active' : '') : '')?>">
							<a href="<?php echo site_url('pg_admin/konten_download/tambah')?>">Tambah Konten Baru</a>
						</li>
						<li class="<?php echo ($active2=='tambah' ? ($active=='kategori_konten_download' ? 'active' : '') : '')?>">
							<a href="<?php echo site_url('pg_admin/kategori_konten_download/tambah')?>">Tambah Kategori Baru</a>
						</li>
					</ul>
				</li>

				<!-- END MENU DOWNLOAD KONTEN -->
				<!-- ################################# -->
				<!-- ################################# -->
				<!-- ################################# -->


				<?php
			}
			?>



		
		</ul>
	</div>
</div>
