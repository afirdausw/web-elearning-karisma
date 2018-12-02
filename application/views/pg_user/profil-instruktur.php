<?php
$judul_tab = "Profil Instruktur";

include('header.php');
?>

<section class="banner-top banner-materi banner-profil darker"> <!-- konten Judul -->
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<img src="<?=base_url('image/instruktur/'.$instruktur->foto)?>" alt="Foto Profil Instruktur">
			</div>
			<div class="col-md-9 col-sm-12">
				<h1><?=$instruktur->nama_instruktur?></h1>
				<span>Instruktur</span>
			</div>
		</div>
	</div>
</section> <!-- End of konten Judul -->

<section class="wrap-deskripsi wrap-profil"> <!-- konten -->
	<div class="container">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-md-6">
					<h1>Profil</h1> 
				</div>
			</div><!-- End of Row  -->
			<div class="row">
				<div class="col-md-12">
					<p>Jenis Kelamin</p>
					<h4><?=($instruktur->jenis_kelamin-1) ? "Perempuan" : "Laki-Laki" ?></h4>
				</div>
				<div class="col-md-12">
					<p>Tempat, Tanggal Lahir</p>
					<h4><?= $instruktur->tempat_lahir.", ".date('d-m-Y', strtotime($instruktur->tanggal_lahir)) ?></h4>
				</div>
				<div class="col-md-12">
					<p>Alamat</p>
					<h4><?= $instruktur->alamat ?></h4>
				</div>
				<div class="col-md-12">
					<p>Nomor Telepon</p>
					<h4><?= $instruktur->telepon ?></h4>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-md-6">
					<h1>Akun</h1>
				</div>
				<div class="col-md-12">
					<p>Email</p>
					<h4><?= $instruktur->email ?></h4>
				</div>
			</div><!-- End of Row  -->
		</div>
		<?php if(count($materi_list) != 0): ?>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<h1>Daftar Materi Yang Diinstruksikan</h1>
				</div>
				<div class="col-md-12">
					<table class="table table-responsive table-bordered table-striped table-hover">
						<tr>
							<th>No</th>
							<th>Materi Pokok</th>
							<th>Link</th>
						</tr>
						<?php
						foreach($materi_list as $m_l):
						?>
						<tr>
							<td><?=$m_l->id_materi_pokok?></td>
							<td><?=$m_l->nama_materi_pokok?></td>
							<td><a href="<?=base_url('materi/'.$m_l->id_materi_pokok)?>" class="btn btn-primary btn-block">Menuju ke Materi</a></td>
						</tr>
						<?php
						endforeach;?>
					</table>
				</div>
			</div><!-- End of Row  -->
		</div>
	<?php endif;?>
	</div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
