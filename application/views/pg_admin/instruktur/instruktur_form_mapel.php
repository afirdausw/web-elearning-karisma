<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>


<div class="wrapper">
	<?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

	<div class="main-panel">
		<?php $this->load->view("pg_admin/inc/navbar.php"); ?>

		<div class="content">
			<div class="container-fluid">
				<?=$this->session->flashdata('alert');?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<a href="<?=site_url("pg_admin/{$basic_info['slug']}/daftar/mapel/{$data_instruktur->id_instruktur}") ?>" class="btn btn-success btn-fill pull-right"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>
								<h4 class="title"><?="{$main_title}"?></h4>
								<p class="category"><?="{$navbar_title}"?></p>

							</div>
							<form action="<?=$form_action?>" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Anda Yakin Update?');">
								<div class="content">
									<div class="row">
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover">
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
													endforeach;?>
													<th class="text-center">Aksi</th>
												</tr>
												</thead>
												<tbody id="listsiswa">
												<?php
												if(!empty($data_mapel)){
													foreach($data_mapel as $val){ ?>
														<tr> <?php
																foreach($table_fields as  $field):?>
																	<td><?php
																		if ($field == "gambar_mapel"){
																			echo "<img src='".base_url();
																			if($val->$field)
																				echo "image/mapel/"."{$val->$field}";
																			else
																				echo "assets/img/no-image.jpg";
																			echo "' width='75px' class='img-responsive m-auto'>";
																		}else{
																			echo $val->$field;
																		}
																	?></td>
																<?php
																endforeach;
																?>
																<td>
																	<input type="checkbox" name="id_mapel[<?=$val->id_mapel?>]" class="form-control" 
																	<?php
																	if(!empty($data_instruktur_mapel)):
																		foreach($data_instruktur_mapel as $val_insmap){
																			if($val_insmap->id_mapel == $val->id_mapel) echo "checked";
																		}
																	endif;
																	?>>
																</td>
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

								<input type="hidden" value="<?=$data_instruktur->id_instruktur;?>" readonly>
								<button type="submit" class="btn btn-warning btn-lg btn-block" name="submit_batch" value="TRUE"><i class="fa fa-cogs"></i> Batch Edit Mata Pelajaran</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end .content -->

		<?php $this->load->view("pg_admin/inc/footer.php"); ?>


<script type="text/javascript">
	function fetch_select_kota(val)
	{
		if($("#provinsi option:selected").val() != '') {
			$("#kota").attr('disabled', false);
			$("#btnTambahSekolah").attr('disabled', 'disabled');
			$.ajax({
				type: 'POST',
				url: "<?=base_url('pg_admin/agcu/ajax_select_kota')?>",
				data: { id:val },
				success: function(response){
					document.getElementById('kota').innerHTML=response;
					$("#kota").trigger("chosen:updated");
				}
			});
		}
		else {
			$("#kota").attr('disabled', 'disabled');
		}
	}

	function fetch_select_sekolah(val)
	{
		$('#hidden_id_kota').val(val);
		if($("#kota option:selected").val() != '') {
			$("#sekolah").attr('disabled', false);
			$("#btnTambahSekolah").attr('disabled', false);
			$.ajax({
				type: 'POST',
				url: "<?=base_url('pg_admin/agcu/ajax_select_sekolah')?>",
				data: { id:val },
				success: function(response){
					document.getElementById('sekolah').innerHTML=response;
					$("#sekolah").trigger("chosen:updated");
				}
			});
		}
		else {
			$("#sekolah").attr('disabled', 'disabled');
			$("#btnTambahSekolah").attr('disabled', 'disabled');
		}
	}

	function fetch_select_kelas(val)
	{
		if($("#sekolah option:selected").val() != '') {
			$("#kelas").attr('disabled', false);
			$.ajax({
				type: 'POST',
				url: "<?=base_url('pg_admin/agcu/ajax_select_kelas')?>",
				data: { id:val },
				success: function(response){
					document.getElementById('kelas').innerHTML=response;

					$("#kelas").trigger("chosen:updated");
				}
			});
		}
		else {
			$("#kelas").attr('disabled', 'disabled');
		}
	}




</script>


<!-- JS Function for this Modal -->



</html>
