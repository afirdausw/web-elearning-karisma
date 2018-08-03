<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
	<?php include "sidebar.php"; ?>

	<div class="main-panel">
		<?php include "navbar.php"; ?>

		<div class="content">
			<div class="container-fluid">
				<?php echo $this->session->flashdata('alert'); ?>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h5>Ketentuan</h5>
							</div>
							<div class="panel-body">
								<ul>
									<li>File yang akan di-import dapat berupa file <strong>*.xls</strong> atau <strong>*.csv</strong>
									</li>
									<li>Pastikan format tabel excel sesuai dengan <i>template</i> yang telah disediakan
										<a href="<?php echo base_url() . 'assets/template/latihansoal.xlsx' ?>"
											 class="label label-primary">DI SINI</a></li>
									<li>Data akan di-import mulai dari baris kedua sampai baris terakhir
									<li>Tidak boleh ada kolom/baris yang <strong>tersembunyi</strong> atau <strong>di-hidden</strong>
									</li>
								</ul>
							</div>
						</div>
					</div>


					<form action="<?php echo base_url(); ?>pg_admin/latihansoal/upload/<?php echo $submateri->id_sub_materi ?>"
							method="post"
							enctype="multipart/form-data">

						<div class="col-md-6">
							<div class="form-group">
								<label>Import file CSV/XLS</label>

								<input type="file" name="import_data" id="import_data" class="form-control">
							</div>
							<button type="submit" name="form_submit" value="submit" class="btn btn-primary pull-right">
								<i class="glyphicon glyphicon-import"></i> Import
							</button>

						</div>

					</form>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<!--                <a href="-->
								<?php //echo $form_action . 'manajemen/tambah_soal?id=' . $submateri->id_sub_materi ?><!--" class="btn btn-fill btn-success pull-right">-->
								<!--                  <span class="glyphicon glyphicon-plus"></span> Tambah Soal 1-->
								<!--                </a>-->
								<a href="#" class="btn btn-fill btn-success pull-right" data-toggle="modal"
									 data-target="#myModal">
									<span class="glyphicon glyphicon-plus"></span> Tambah Soal
								</a>


								<a href="<?php echo $form_action . 'ambilbanksoal/' . $submateri->id_sub_materi ?>"
									 class="btn btn-fill btn-success pull-right">
									<span class="glyphicon glyphicon-plus"></span> Ambil dari bank Soal
								</a>
								<h4 class="title"><?php echo $submateri->nama_sub_materi ?></h4>
								<p class="category">Daftar Soal per Sub-materi</p>
							</div>
							<div class="content">
								<div class="table-responsive">
									<table id="my_datatable" class="table table-striped table-hover">
										<thead>
										<tr>
											<th>#</th>
											<th>Soal</th>
											<th>Pembahasan Teks</th>
											<th>Pembahasan Video</th>
											<th class="text-center">Aksi</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$no = 1;
										foreach ($table_data as $item)
										{
										?>
										<tr>
											<td><?php echo $no; ?></td>
											<td>
												<?php //echo strip_tags($item->isi_soal)
												?>
												<?php
												$soal = html_entity_decode($item->isi_soal);
												$panjangKataSoal = strlen($soal);

												if($panjangKataSoal > 20){
													echo substr($soal, 0, 20)."....<a data-toggle='modal' data-target='#soal_lengkap_".$item->soal_id."' style='cursor:pointer;'> Selengkapnya</a>";
													?>
													<div id="soal_lengkap_<?=$item->soal_id;?>" class="modal  fade" role="dialog" data-backdrop="false">
														<div class="modal-dialog modal-lg">

															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">Soal No. #<?=$item->soal_id?></h4>
																</div>
																<div class="modal-body">
																	<?=$soal?>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																</div>
															</div>

														</div>
													</div>
													<?php
												}else{
													echo $soal;
												} ?>
								</div>
								</td>
								<td class="text-center"><?php echo !empty($item->pembahasan) ? "<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>"; ?></td>
								<td class="text-center"><?php echo !empty($item->pembahasan_video) ? "<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>"; ?></td>
								<td class="text-center">
									<div class="button-group">
										<a href="<?php echo $form_action . 'manajemen/ubah_soal?id=' . $item->id_soal ?>"
											 class="btn btn-warning btn-xs" title="Ubah"><i
													class="glyphicon glyphicon-pencil"></i></a>

										<?php
										if ($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin") {
											?>
											<button type="button" class="btn btn-danger btn-xs" title="Hapus"
													data-number="<?php echo $item->id_soal ?>" value="<?php echo $item->id_soal ?>"
													data-toggle="modal" data-target="#deleteRow_modal"><i
														class="glyphicon glyphicon-remove"></i></button>
											<?php
										}
										?>
									</div>
								</td>
								</tr>
								<?php
								$no++;
								}
								?>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end .container-fluid -->
	</div> <!-- end .content -->

	<footer class="footer">
		<div class="container-fluid">

			<p class="copyright pull-right">
				&copy; <?php echo date("Y"); ?> <a href="http://lpi-hidayatullah.or.id">Lembaga Pendidikan Islam
					Hidayatullah</a>
			</p>
		</div>
	</footer>

</div>
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<!-- <script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript'); ?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="<?php echo $form_action . 'manajemen/tambah_banyak_soal?id=' . $submateri->id_sub_materi ?>"
				method="get" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="id"
							 value="<?php echo $submateri->id_sub_materi ?>"/>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-md-4 col-lg-4" style="padding-left: 6px;">
								Input jumlah soal
								<input type="number" class="form-control" name="jml_soal" id="jml_soal"
										 placeholder="input jumlah soal"/>
							</div>
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<input type="submit" value="ok" name="form_submit" class="btn btn-primary"/>
				</div>
			</div>
		</form>

	</div>
</div>


<!--  Datatables Plugin -->
<script type="text/javascript"
		src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
		src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>

<!-- JS Function for this Modal -->
<script type="text/javascript">
	$('#deleteRow_modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var rownumber = button.data('number') // Extract info from data-* attributes
		var id = button.attr('value')
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.number').text("#" + rownumber + "?")
		modal.find('input[name=hidden_row_id]').val(id)
	});

</script>


</html>
