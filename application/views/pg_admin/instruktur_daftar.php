<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>


<script>
</script>

<div class="wrapper">
	<?php include "inc/sidebar.php"; ?>

	<div class="main-panel">
		<?php include "navbar.php"; ?>

		<div class="content">
			<div class="container-fluid">
				<?=$this->session->flashdata('alert');?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<?php if(!in_array("gambar_mapel", $table_fields)): ?>
									<a href="<?=site_url("pg_admin/{$basic_info['slug']}/manajemen/tambah") ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i> Tambah <?="{$basic_info['title']}"?></a>
								<?php else: ?>
									<a href="<?=site_url("pg_admin/{$basic_info['slug']}/manajemen/mapel/".$data_instruktur_main[0]->id_instruktur) ?>" class="btn btn-primary btn-fill pull-right"><i class="fa fa-pencil"></i> Edit Mata Pelajaran</a>
								<?php endif; ?>
								<h4 class="title"><?="{$main_title}"?></h4>
								<p class="category"><?="{$navbar_title}"?></p>

							</div>

							<table class="table table-striped table-hover">
							</table>

					<div class="content">
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-striped ">
									<thead>
									<tr>
										<?php
										//SETUP LABEL
										$table_label = array();
										foreach($table_fields as $v){
											$table_label[] = ucwords(implode(" ", explode("_", $v)));
										}

										foreach($table_label as $val):?>
											<th><?=(strlen($val) > 4) ? "<span title='$val'>".substr($val, 0, 4)."...</span>" : $val ;?></th>
										<?php
										endforeach;
										if(!in_array("gambar_mapel", $table_fields)):?>
											<th class="text-center">Aksi</th>
										<?php
										endif;
										?>
									</tr>
									</thead>
									<tbody id="listsiswa">
									<?php
									if(!empty($data_instruktur)){
										foreach($data_instruktur as $val){ ?>
											<tr> <?php
													foreach($table_fields as  $field):?>
														<td><?php
															if($field == "foto"){
																echo "<img src='".base_url();
																if($val->$field)
																	echo "image/instruktur/"."{$val->$field}";
																else
																	echo "assets/img/no-image.jpg";
																echo "' width='75px' class='img-responsive m-auto'>";
															}else if ($field == "gambar_mapel"){
																echo "<img src='".base_url();
																if($val->$field)
																	echo "image/mapel/"."{$val->$field}";
																else
																	echo "assets/img/no-image.jpg";
																echo "' width='75px' class='img-responsive m-auto'>";
															}else if($field == "jenis_kelamin")
																echo ($val->$field==1) ? "Laki-laki" : "Perempuan";
															else
																echo $val->$field;
														?></td>
													<?php
													endforeach;
													if(!in_array("gambar_mapel", $table_fields)):
													?>
														<td>
															<a href="<?=site_url("pg_admin/{$basic_info['slug']}/manajemen/ubah?id=$val->id_instruktur")?>" class="btn btn-block btn-warning"><i class="pe-7s-pen"></i>Edit</a>
															<a href="<?=site_url("pg_admin/{$basic_info['slug']}/proses_hapus?id=$val->id_instruktur");?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-block btn-danger"><i class="pe-7s-trash"></i>Hapus</a>
															<a href="<?=site_url("pg_admin/{$basic_info['slug']}/daftar/mapel/$val->id_instruktur")?>" class="btn btn-block btn-primary"><i class="pe-7s-eye"></i>Lihat Mapel</a>
														</td>
													<?php
													else:

													endif;
													?>
											</tr>
											<?php
										}
									}else{ ?>
										<tr>
											<td class="text-center" colspan="<?=count($table_label)+1;?>">Data masih kosong</td>
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
		</div> <!-- end .content -->

		<?php include "inc/footer.php"; ?>

	</div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>


<!-- JS Function for this Modal -->



</html>
