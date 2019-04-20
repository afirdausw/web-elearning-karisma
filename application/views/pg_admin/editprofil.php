<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("pg_admin/inc/html_header.php");

?>

<div class="wrapper">

	<?php $this->load->view("pg_admin/inc/sidebar.php"); ?>



	<div class="main-panel">

		<?php $this->load->view("pg_admin/inc/navbar.php"); ?>



		<div class="content">

			<div class="container-fluid">

				<?php echo $this->session->flashdata('alert'); ?>



				<div class="row">

					<div class="col-md-12">

						<div class="card">

							<?php

							foreach($data_table as $datanya){

							?>

							<div class="header">

								<h4 class="title">Edit Profil "<?php echo $datanya->nama_profil; ?>"</h4>

							</div>



							<div class="content">

								<form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">

									<div class="row">

										<div class="col-lg-12">

											<div class="col-md-4 col-lg-4" style="padding-left: 6px;">

												Nama Test

												<input type="text" class="form-control" name="nama" value="<?php echo $datanya->nama_profil; ?>"/>
                                                <input value="<?php echo $datanya->id_tryout; ?>" type="hidden"
                                                       class="form-control" name="id_tryout"/>
											</div>

											<div class="col-md-4 col-lg-4">

												Penyelenggara

												<input type="text" class="form-control" name="penyelenggara" value="<?php echo $datanya->penyelenggara ;?>" />

											</div>

											<div class="col-md-4 col-lg-4">

												Biaya Testa

												<input type="text" class="form-control" name="biaya" value="<?php echo $datanya->biaya; ?>"/>

											</div>

											<div class="col-md-4 col-lg-4">

												Tanggal Acara

												<input type="text" class="form-control" name="tanggal" id="datepicker" value="<?php echo $datanya->tgl_acara; ?>"/>

											</div>

											<div class="col-md-4 col-lg-4">

												Jam Acara (berapa jam)

												<input type="text" class="form-control" name="jam" value="<?php echo $datanya->jam_acara; ?>" />

											</div>

											<div class="col-md-4 col-lg-4">

												Jenjang Kelas

												<select data-placeholder="Pilih Kelas..." name="kelas" class="form-control" style="width: 100%;" tabindex="2" required="required">

													<option value=""></option>

													<?php

													foreach ($select_options as $item) { ?>

														<option value="<?php echo $item->id_kelas ?>"



														<?php

														if($datanya->id_kelas == $item->id_kelas){

															echo "selected";

														}

														?>



														> <?php echo $item->alias_kelas ?>

														</option>

													<?php } ?>

												</select>

											</div>

										</div>





										<div class="col-md-6 col-lg-6">

											<div class="col-lg-12">

												Tipe Profil

												<select name="tipe" class="form-control">

													<option value="0" 

													<?php

														if($datanya->tipe == 0){

															echo "selected";

														}

													?>

													>Try Out Reguler</option>

													<option value="1"

													<?php

														if($datanya->tipe == 1){

															echo "selected";

														}

													?>

													>CBT Contest</option>

												</select>

											</div>



											<div class="col-lg-12">

												Banner Test

												<input type="file" name="banner"/>



												<?php

													if($datanya->banner != "-"){

												?>

												<img src="<?php echo base_url()."assets/uploads/banner/"; echo "default.png"?>" alt="">

												<?php

													}

												?>

											</div>

										</div>

										<div class="col-md-6 col-lg-6">

											Keterangan

                                            <textarea name="keterangan" class="form-control"><?php echo $datanya->keterangan; ?></textarea>

										</div>

										<div class="col-md-4 col-lg-4" style="display: none;">



										</div>

										<div class="col-md-4" style="display: none;">

											<div class="form-group">

												<label>Tanggal Post <span class="text-danger">*</span></label>

												<?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>

												<input class="form-control" type="date" id="tanggal_post" name="tanggal_post" value="<?php echo set_value('tanggal_post', (!isset($datanya) ? date('Y-m-d') : (($datanya->tanggal!=0) ? $datanya->tanggal : date('Y-m-d'))) );?>" required="required">

											</div>

										</div>

										<div class="col-md-4" style="display: none;">

											<div class="form-group">

												<label>Waktu Post <span class="text-danger">*</span></label>

												<?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?>

												<input class="form-control" type="time" id="waktu_post" name="waktu_post" value="<?php echo set_value('waktu_post', (!isset($datanya) ? date('H:i') : (($datanya->waktu!=0) ? $datanya->waktu : date('H:i'))) );?>" required="required">

											</div>

										</div>

									</div>

									<input type="submit" value="Modifikasi Profil" name="form_submit" class="btn btn-primary"/>

								</form>

							</div>





							<?php

							} // Penutup Data Table foreach

							?>

						</div>

					</div>



				</div>

			</div>

		</div> <!-- end .content -->



		<?php $this->load->view("pg_admin/inc/footer.php"); ?>


<?php $this->load->view("pg_admin/alert/alert_modal.php"); ?>


<!--  Datatables Plugin -->

<script type="text/javascript" src="<?php echo base_url('assets/plugins/dataTables/js/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/dataTables/js/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/plugins.js');?>"></script>



<!--  Notifications Plugin    -->

<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-notify/bootstrap-notify.js');?>"></script>



<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->

<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/light-bootstrap-dashboard/js/light-bootstrap-dashboard.js');?>"></script>



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





<script>

	$(function(){

		$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

	});

</script>



</html>

