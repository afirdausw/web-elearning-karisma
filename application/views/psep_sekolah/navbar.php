<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-default navbar-fixed">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><?php echo isset($navbar_title) ? $navbar_title : 'Manajemen' ?></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<?php echo $this->session->userdata("username") ? $this->session->userdata("username") : 'No name'; ?>
						<span class="caret" style="border-bottom-color:#5e5e5e;border-top-color:#5e5e5e;"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url('psep_sekolah/dashboard'); ?>">Dashboard</a></li>
						<!-- <li><a href="<?php echo site_url('psep_sekolah/user_profil')?>">Edit Profil</a> -->
						</li>
						<li role="separator" class="divider" style="margin:0;"></li>
						<li><a href="<?php echo site_url('psep_sekolah/login/logout'); ?>">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>