<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>
<script>
	$(function () {
		// $("#kelas").change(function () {
		//     $("#mapel").prop('disabled', false);
		//     $("#mapel").attr('disabled', false);
		//     $("#mapel").load("konten_download/ajax_mapel/" + $("#kelas").val());
		// });
		// $("#mapel").change(function () {
		//     $("#konten").load("konten_download/ajax_konten_by_mapel/" + $("#mapel").val());
		// });
	});
</script>
<div class="wrapper">
	<?php include "sidebar.php"; ?>

	<div class="main-panel">
		<?php include "navbar.php"; ?>

		<div class="content">
			<div class="container-fluid">
				<?php echo $this->session->flashdata('alert'); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<h4 class="title">List Download Konten </h4>
							</div>
							<div class="content">
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="header">
												<div class="row">
													<!-- <div class="col-md-5 form-group">
														<select id="kategori_download" placeholder="Pilih Kategori..." name="kategori_download"
																class="chosen-select form-control"
																style="width: 100%;"
																tabindex="1" required="required">
															<option value="" disabled selected>-- Pilih Kategori --
															</option>
															<?php
															foreach ($select_kategori as $item) { ?>
																<option value="<?php echo $item->id ?>"> <?php echo $item->kategori_konten_download ?> </option>
																<?php
															} ?>
														</select>
													</div> -->
													<div class="col-md-2 pull-right">
														<a href="<?php echo site_url('pg_admin/konten_download/tambah') ?>"
														   class="btn btn-success btn-fill"><i
																	class="fa fa-plus"></i>Tambah
															Konten</a>
													</div>
												</div>


											</div>
											<div class="content">

												<div class="table-responsive">
													<table id="my_datatable" class="table table-striped table-hover">
														<thead>
														<tr>
															<th>#</th>
															<th>Gambar</th>
															<th>Judul</th>
															<th>Point</th>
															<th>Kategori</th>
															<th class="text-center">Aksi</th>
														</tr>
														</thead>
														<tbody id="konten">
														<?php
															if (count($konten) > 0) {
																?>
																<?php
																foreach ($konten as $k) {
																	?>

																	<tr>
																		<td><?php echo $k->id ?></td>
																		<td>
																			<?php
																			if ($k->gambar !== "") {
																				?>
																				<img src="<?php echo base_url('assets/uploads/konten_download/' . $k->gambar); ?>"
																					 style="width: 75px;">
																				<?php
																			} else {
																				?>
																				<img src="<?php echo base_url('assets/uploads/konten_download/default.png'); ?>"
																					 style="width: 75px;">
																				<?php
																			}
																			?>

																		</td>
																		<td><?php echo $k->judul ?></td>
																		<td><?php echo $k->point ?></td>
																		<td><?php echo $k->kategori_konten_download ?></td>
																		<td class="text-center">

																			<div class="button-group">
																				<a href="<?php echo base_url().'/pg_admin/konten_download/ubah?id=' .  $k->id ?>"
																				   class="btn btn-warning btn-xs" title="Ubah"><i
																							class="glyphicon glyphicon-pencil"></i></a>

																				
																				<button type="button" class="btn btn-danger btn-xs" title="Hapus" data-number="<?php echo  $k->id ?>" value="<?php echo  $k->id ?>" data-toggle="modal" data-target="#deleteRow_modal"><i
																						class="glyphicon glyphicon-remove"></i></button>


																			</div>

																		</td>
																	</tr>
																	<?php
																}
															} else {
																?>
																<tr>
																	<td colspan="5" class="text-center">Data Kosong</td>
																</tr>
																<?php
															}
															?>

														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div> <!-- end .container-fluid -->
		</div> <!-- end .content -->

		<?php include "inc/footer.php"; ?>

	</div>
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript'); ?>"></script>

<!--  Nestable Plugin    -->


<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

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
	})
</script>


</html>
