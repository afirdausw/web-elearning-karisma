<?php


$this->load->view('pg_user/inc/header');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<!-- //sementara -->
<style>
	.panel, .panel > * {
		border-radius: 0;
	}

	.panel-primary, .panel > .panel-footer {
		border-color: #BABABA;
	}

	.panel-primary > .panel-heading {
		background-color: #0779AF;
		border-color: #0779AF;
	}

	.cart-list .table tr > td {
		vertical-align: middle;
	}

	.cart-list .table tr > td > img {
		border-radius: 100%;
	}

	.cart-list a:hover,
	.cart-list a:focus,
	.cart-list a:active {
		text-decoration: none;
	}

	.cart-list .table tr > td:nth-child(3) > a:hover,
	.cart-list .table tr > td:nth-child(3) > a:focus {
		color: #C9302C !important;
	}

	.cart-list .table tr > td:nth-child(3) > .glyphicon {
		font-size: 20px;
	}

	.cart-list .table tr > td:nth-child(3) > .glyphicon,
	.cart-list .table tr > td:nth-child(3) > div > label,
	.cart-list .panel-footer > table td:last-child span {
		color: #ACACAC;
	}

	.cart-list .panel-footer {
		border-bottom: 1px solid;
		border-color: inherit;
	}

	.cart-list .panel-footer table td {
		border-top: 0;
	}

	.cart-list .panel-footer > table td:last-child {
		text-align: right !important;
	}

	.cart-list .panel-footer > table td:last-child h1 {
		border: 0;
		font-size: 40px;
		padding: 0;
		color: #0679AF;
	}

	.cara-bayar .panel-footer {
		background: white;
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
					<div class="panel-heading text-center">Daftar Belanja</div>
					<div class="table-responsive">
						<table class="table table-hover m-0">
							<colgroup>
								<col class="col-md-4">
								<col class="col-md-5">
								<col class="col-md-3">
							</colgroup>
							<?php
							foreach ($transaksi as $key => $value) {
								?>
								<tr>
									<td class="text-center">
										<img class="img-responsive w-75 mx-auto"
											 src="<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>"
											 alt="<?= $value->nama_mapel ?>">
									</td>
									<td>
										<button class="btn btn-primary p-2">
											Kelas Premium
										</button>
										<h3 class="w-100 font-weight-bold"><?= $value->nama_mapel ?></h3>
										<p>Created by <a
													href="<?= base_url('instruktur/' . $value->id_instruktur); ?>"><?= $value->nama_instruktur ?></a>
										</p>
									</td>
									<td class="text-right">
										<div>
											<label for="harga">Harga:</label>
											<br>
											<!--<span class="mr-3 text-gray text-line-through font-w700">Rp. 1.200.000</span>-->
											<h2 class="mt-0" id="harga">Rp. <?= money($value->harga) ?></h2>
										</div>
									</td>
								</tr>
								<?php
								?>
							<?php }
							 ?>
						</table>
					</div>

				</div>
			</div>


		</div>


		<!-- Modal -->
	</div>
	</div>
</section> <!-- End of konten-->
<?php 
$this->load->view('pg_user/inc/footer');
?>

</body>
</html>
