<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>
<script>
	$(function () {
		$("#kelas").change(function () {
			$("#mapel").prop('disabled', false);
			$("#mapel").attr('disabled', false);
			$("#mapel").load("ajax_mapel/" + $("#kelas").val());
		});
	});
</script>
<div class="wrapper">
	<?php include "inc/sidebar.php"; ?>

	<div class="main-panel">
		<?php include "inc/navbar.php"; ?>

		<div class="content">
			<div class="container-fluid">
				<?php echo $this->session->flashdata('alert'); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<h4 class="title">Input Download Konten </h4>
							</div>
							<div class="content">
								<div class="row">

									<form action="<?php echo base_url("pg_admin/konten_download/proses_tambah"); ?>"
										  method="post" enctype="multipart/form-data">
										<div class="col-md-12">
											<div class="form-group">
												<label>Judul</label>
												<input type="text" name="judul" class="form-control" required/>
											</div>
											<div class="form-group">
												<label>Keterangan</label>
												<textarea type="text" name="ket" class="form-control" cols="50" ></textarea>
											</div>
											<div class="form-group">
												<label>Gambar</label>
												<input type="file" name="gambar" required/>
											</div>
											<div class="form-group">
												<label>Link</label>
												<input type="url" name="link" class="form-control" required/>
											</div>
											<div class="form-group">
												<label>Point</label>
												<input type="text" name="poin" class="form-control" required/>
											</div>
											<div class="form-group">
												<label>Kategori</label>
												<select id="kategori_konten" placeholder="Pilih Kategori..." name="kategori_konten"
														class="chosen-select form-control"
													   style="width: 100%;"
														tabindex="1" required="required">
													<option value="" disabled selected>-- Pilih Kategori --</option>
													<?php
													foreach ($select_kategori as $item) { ?>
														<option value="<?php echo $item->id; ?>">
															<?php echo $item->kategori_konten_download; ?>
														</option>
														<?php
													} ?>
												</select>
											</div>


											<br>&nbsp;
											<br>&nbsp;
											<input type="submit" class="btn btn-primary" value="Input Konten"/>
										</div>
									</form>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div> <!-- end .container-fluid -->
		</div> <!-- end .content -->

		<?php include "inc/footer.php"; ?>

<script type="text/javascript">
	var config = {
		'.chosen-select': {},
		'.chosen-select-deselect': {allow_single_deselect: true},
		'.chosen-select-no-single': {disable_search_threshold: 10},
		'.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
		'.chosen-select-width': {width: "95%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}




</script>

</html>
