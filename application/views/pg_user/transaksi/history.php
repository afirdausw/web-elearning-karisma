<?php


$this->load->view('pg_user/header');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<!-- //sementara -->
<style>
	.row .vertical-align {
    display: flex;
    align-items: center;
	}

	.panel, .panel > * {
		border-radius: 0;
	}

	.panel-primary{
		border-color: #BABABA;
	}

	.panel-primary > .panel-heading {
		background-color: #F2F2F2;
		border:none;
	}

	.cart-list {
		border-radius:2px;
	}

	.cart-list .panel-heading ul.nav.nav-tabs{
		font-weight:500;
		border:none;}
	.cart-list .panel-heading ul.nav.nav-tabs li{
		border-radius:0;border-bottom:solid 3px #0779AF;}
	.cart-list .panel-heading ul.nav.nav-tabs li > a{
		background:none;border:none;
		padding:1em 2em;}


	.cart-list .panel-footer{
		border:none;
	} 
	.cart-list .panel-footer > a{
		text-decoration: underline;
	}

	.cart-list #daftar_belanja div.row{
		box-shadow:black 0px 0px 30px -5px
	}
	.cart-list #daftar_belanja span#harga{
		color:#2A6C95;
	}

	.cart-list #daftar_belanja span.label{
		border-radius:0;
	}

</style>
<section class="wrap-deskripsi"> <!-- konten -->
	<div class="mt-5 mx-auto row">
		<div class="row mx-auto w-75">
			<div class=" col-md-12">

			</div>
		</div><!-- End of Row  -->
		<div class="row mx-auto w-75">
			<div class="col-md-12">
				<div class="panel panel-primary cart-list">
					<div class="panel-heading text-center p-0">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#daftar_belanja">Daftar Belanja</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div id="daftar_belanja" class="tab-pane active">
							<div class="p-4">
									<?php
									foreach ($transaksi as $key => $value) {
										?>
										<div class="row m-3 p-3 vertical-align">
											<div class="text-center col-md-2">
												<div class="mx-auto"style="width: 100px;height: 100px;border-radius:100%;background: url('<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>') center center / 200px no-repeat;"></div>
											</div>
											<div class="col-md-7">
												<button class="btn btn-primary btn-sm p-1">Kelas Premium</button>
												<h4 class="font-weight-bold mb-0"><?= $value->nama_mapel ?></h4>
												<span class="font-weight-bold">Tanggal</span>
												<span id="id_transaksi" class="text-gray-3">ID Transaksi : <?=str_pad($value->id_transaksi, 10, "0", STR_PAD_LEFT)?></span>
												<br>													
												<label for="harga">Total Pembayaran : </label> <span id="harga" class="font-weight-bold font-size-h1">Rp. <?= money($value->jumlah_total) ?></span>													
											</div>
											<div class="col-md-3 text-right">
												<label for="status" class="text-gray-3">Status :</label>
												<br>
												<?php
												$status = array(
													0=> array(
														"tipe" => "success",
														"teks" => "Pesanan Selesai",
													),
													1=> array(
														"tipe" => "warning",
														"teks" => "Pending",
													),
													2=> array(
														"tipe" => "danger",
														"teks" => "Belum Selesai",
													),
												);

												?>
												<span class="label label-<?=$status[$value->status]['tipe']?> px-5 font-size-h5"><?=$status[$value->status]['teks']?></span>
											</div>
										</div>
										<?php
										?>
									<?php }
									 ?>
							</div>
						</div>
					</div>
					
						<div class="panel-footer text-center">
							<a href="#">Muat Lebih Banyak</a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Modal -->
	</div>
	</div>
</section> <!-- End of konten-->
<?php $this->load->view('pg_user/footer'); ?>

</body>
</html>
