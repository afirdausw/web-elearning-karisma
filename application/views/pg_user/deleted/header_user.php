				<nav class="navbar navbar-default navbar-static-top navbar-page">
				 <div class="container container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-bso">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>  
						</button>
						<a class="navbar-brand" href="<?php echo base_url(''); ?>"></a>
					</div>
					<div class="collapse navbar-collapse" id="nav-bso">
						<ul class="nav navbar-nav">
						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">MATA PELAJARAN 
							<span class="caret"></span></a>
							<ul class="dropdown-menu megamenu mega-mapel row">
								<li class="col-sm-3">
									<ul>
										<li class="dropdown-header">Bahasa Indonesia</li>
										<li><a href="#">Bahasa Indonesia Kelas 7</a></li>
										<li class="dropdown-header">Bahasa Inggris</li>
										<li><a href="#">Bahasa Inggris Kelas 7</a></li>
									</ul>
								</li>
								<li class="col-sm-3">
									<ul>
										<li class="dropdown-header">Matematika</li>
										<li><a href="#">Matematika Kelas 7</a></li>
										<li class="dropdown-header">Fisika</li>
										<li><a href="#">Fisika Kelas 7</a></li>
										<li class="dropdown-header">Biologi</li>
										<li><a href="#">Biologi Kelas 7</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">BELI PAKET <span class="caret"></span></a>
								<ul class="dropdown-menu dropdown-paket">
								<li>
									<a href="<?php echo base_url('user/beli');?>">Beli</a>
									<a href="<?php echo base_url('user/buylist');?>">Riwayat</a>
									<a href="<?php echo base_url('user/aktivasi');?>">Aktivasi</a>
								</li>
							</ul>
						</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
								<?php 
								if(!empty($_SESSION['id_siswa'])) { ?>
									<li class="search-lg"><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
									<li class="dropdown user-profile">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#">
											<?php echo isset($_SESSION['nama_siswa']) ? strtok($_SESSION['nama_siswa'], ' ') : 'No name' ?>
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="<?php echo base_url('user/beli');?>">Beli Paket</a></li>
											<li><a href="<?php echo base_url('user/buylist');?>">Riwayat</a></li>
											<li><a href="<?php echo base_url('user/aktivasi');?>">Aktivasi</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="<?php echo base_url('user');?>">Profilku</a></li>
											<li><a href="<?php echo base_url('parents');?>">Orang Tua</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
										</ul>
									</li>
								<?php 
								} 
								else { ?>
									<li><a href="<?php echo base_url('pencarian')?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
									<li style='padding: 15px 0px;'>|</li>
									<li>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" href="#">
											LOGIN
											<span class="caret"></span>
										</a>

										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url('login')?>">Siswa / Orang Tua</a></li>
											<li><a href="<?php echo base_url('psep_sekolah/login');?>">Sekolah / Guru</a></li>
										</ul>
									</li>
									<li style='padding: 15px 0px;'>|</li>
									<li><a href="<?php echo base_url('signup')?>">DAFTAR</a></li>
									<li style='padding: 15px 0px;'>|</li>
								<?php 
								} ?>
						</ul>
					</div>
				</div>
		</nav>