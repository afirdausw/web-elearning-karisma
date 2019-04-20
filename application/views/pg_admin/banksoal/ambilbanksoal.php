<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("pg_admin/inc/html_header.php");
?>

<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery/jquery-ui/jquery-ui.css'); ?>">

<style>

	/*untuk spinner*/

	#nprogress .spinner {

		top: 0;

		right: 0;



		width: 100%;

		height: 100%;



		background: rgba(255, 255, 255, 0.5);



		opacity: 1;

		transition: opacity 0.2s ease-in-out;

	}



	#nprogress .spinner-icon {

		border-top-color: #1BBC9B;

		border-left-color: #1BBC9B;



		width: 5%;

		height: 11%;

		border-width: 8px;

		margin: 20% 50%;

	}



	#nprogress {

		pointer-events: all;

	}



	#nprogress .bar {

		display: none;

	}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">

</script>

<script>

	$(function () {



		NProgress.configure({

			showSpinner: true

		});

	});

</script>

<div class="wrapper">

	<?php $this->load->view("pg_admin/inc/sidebar.php"); ?>



	<div class="main-panel">

		<?php $this->load->view("pg_admin/inc/navbar.php"); ?>





		<div class="content">

			<div class="container-fluid">



				<?php echo $this->session->flashdata('alert'); ?>





				<div class="row">

					<div class="col-md-12">

						<div id="my_datatables">



						</div>

					</div>

				</div>





				<div class="row">

					<div class="col-md-12">

						<div class="card">

							<div class="header">

								<div class="table-responsive">

									<?php

									foreach ($submateri as $item) {

										$kelas_soal = $item->kelas_id; 

										$mapel_soal = $item->id_mapel; 

										$mapok_soal = $item->id_materi_pokok;

									} ?>

									<table class="table table-stripped">

										<tr>

											<td>

												<select id="kelas" class="form-control">

													<?php

													foreach ($select_options_kelas as $item) {

														if($kelas_soal== $item->id_kelas){

															?>

															<option value="<?php echo $item->id_kelas; ?>"

																data-kelas="<?php echo $item->alias_kelas; ?>">

																<?php echo $item->alias_kelas; ?>

															</option>

														<?php 

														}

													}

													?>

												</select>

											</td>

											<td>

												<select id="mapel" class="form-control">													

													<?php

														foreach ($select_options_mapel as $item) {

															if($mapel_soal == $item->id_mapel){

																?>

																<option value="<?php echo $item->id_mapel; ?>"

																	data-mapel="<?php echo $item->nama_mapel; ?>">

																	<?php echo $item->nama_mapel; ?>

																</option>

															<?php 

															}

														}

													?>

												</select>

											</td>

										

										</tr>

									</table>

								</div>

							</div>

							<div class="content">



								<!--                                <a class="btn btn-primary" href="banksoal/duplikat">Duplikat Bank Soal</a>-->

								

								<!-- TABLE UNTUK BANK SOAL -->

								<div class="table-responsive">

									<table class="table table-striped table-hover">

										<thead>

										<tr>

											<th>Kelas</th>

											<th>Soal</th>

											<th>Topik</th>

											<th>Pembahasan</th>

											<th>Pelajaran</th>

											<th>Bobot Soal</th>

											<th>Kunci Jawaban</th>

											<th>Operasi</th>

										</tr>

										</thead>

										<tbody id="list-soal">

										<?php

										foreach ($data_soal as $data) {

											?>

											<tr>

												<td><?php echo $data->alias_kelas; ?></td>

												<td><?php echo $data->topik; ?> ...</td>

												<td><?php echo $data->topik; ?></td>

												<td>

													<?php

													if ($data->pembahasan_teks !== "" AND $data->pembahasan_video !== "") {

														?>

														<a href=""><span

																	class="label label-success">Pembahasan Teks</span></a>

														<a href=""><span

																	class="label label-warning">Pembahasan Video</span></a>

														<?php

													} elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video !== "") {

														?>

														<a href=""><span

																	class="label label-warning">Pembahasan Video</span></a>

														<?php

													} elseif ($data->pembahasan_teks !== "" AND $data->pembahasan_video == "") {

														?>

														<a href=""><span

																	class="label label-success">Pembahasan Teks</span></a>

														<?php

													} elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video == "") {



													}

													?>



												</td>

												<td>

													<?php

													echo $data->nama_mapel;

													?>

												</td>

												<td>

													<?php

													echo $data->bobot_soal;

													?>

												</td>

												<td>

													<?php

													echo $data->kunci;

													?>

												</td>

												<td class="text-center">

													<a href="#" data-toggle="modal"

													   data-target="#myModal<?php echo $data->id_banksoal; ?>">

														<span class="glyphicon glyphicon-eye-open"></span>

													</a>

													<?php $hal = ($page <= 0 ? 1 : $page); ?>

													<?php if (!in_array($data->id_banksoal, $datasoal)) { ?>

														<a style="color: #1caf2d;" href="<?php echo base_url('pg_admin/latihansoal/simpanbanksoal/' . $id_sub_materi . '/' . $data->id_banksoal . '/' . $hal) ?>"

														> <span class="glyphicon glyphicon-ok"></span>

														</a>

													<?php } else {

														?>

														<a style="color: red;" href="<?php echo base_url('pg_admin/latihansoal/hapusbanksoal/' . $id_sub_materi . '/' . $data->id_banksoal . '/' . $hal) ?>"

														> <span class="glyphicon glyphicon-remove"></span>

														</a>

														<?php

													}

													?>

												</td>

											</tr>

											<?php

										}

										?>

										</tbody>

									</table>



									<?php

									echo $pagination;

									?>

									<br>



								</div>

								<!-- END TABLE BANK SOAL -->





								<div class="footer">

									<hr>

								</div>

							</div>

						</div>

					</div>

				</div>



			</div>

		</div>



		<?php $this->load->view("pg_admin/inc/footer.php"); ?>

<script type="text/javascript">



	function coba() {

		NProgress.start();

		setTimeout(function () {

			NProgress.done();

		}, 2000);

	}



	//    window.onbeforeunload = function(){

	//        my_fun();

	////        return 'Are you sure you want to leave?';

	//    };

</script>

<script src="<?= base_url('assets/plugins/nprogress/js/nprogress.js') ?>"></script>

<!--  Datatables Plugin -->

<script type="text/javascript"

		src="<?php echo base_url('assets/plugins/dataTables/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript"

		src="<?php echo base_url('assets/plugins/dataTables/js/dataTables.bootstrap.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/plugins.js'); ?>"></script>

<div id="list_modal">

	<?php

	$no = 1;

	foreach ($data_soal as $data) {

		?>

		<div class="modal fade" id="myModal<?php echo $data->id_banksoal; ?>" tabindex="-1" role="dialog">

			<div class="modal-dialog" role="document">

				<div class="modal-content" id="modalsoal">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

									aria-hidden="true">&times;</span></button>

					</div>

					<div class="modal-body">

						<p>Pertanyaan</p>

						<p><?php echo $data->pertanyaan; ?></p><br>

						<p>Jawaban</p>

						<?php if ($data->kunci == 1){ ?>

							<p><?php echo $data->jawab_1; ?></p><br>

						<?php } elseif ($data->kunci == 2) { ?>

							<p><?php echo $data->jawab_2; ?></p><br>

						<?php } elseif ($data->kunci == 3) { ?>

							<p><?php echo $data->jawab_3; ?></p><br>

						<?php }

						elseif ($data->kunci == 4){ ?>

						<p><?php echo $data->jawab_4;

							} ?></p><br>

					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					</div>

				</div><!-- /.modal-content -->

			</div><!-- /.modal-dialog -->

		</div><!-- /.modal -->

		<?php

		$no++;

	}

	?>

</div>





<!--  Datatables Plugin -->

<script type="text/javascript"

		src="<?php echo base_url('assets/plugins/dataTables/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript"

		src="<?php echo base_url('assets/plugins/dataTables/js/dataTables.bootstrap.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/plugins.js'); ?>"></script>

<script type="text/javascript">





</script>

</html>

