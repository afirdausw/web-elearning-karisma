<style>
	input.onoffswitch-checkbox {
		position: absolute;
	}

	.onoffswitch-label {
		display: block;
		overflow: hidden;
		cursor: pointer;
		width: 85px;
		border: 2px solid #999999;
		border-radius: 20px;
		position: relative;
	}

	.onoffswitch-inner {
		display: block;
		width: 200%;
		margin-left: -100%;
		transition: margin 0.3s ease-in 0s;
	}

	.onoffswitch-inner:before, .onoffswitch-inner:after {
		display: block;
		float: left;
		width: 50%;
		height: 25px;
		padding: 0;
		line-height: 25px;
		font-size: 11px;
		color: white;
		font-family: Trebuchet, Arial, sans-serif;
		font-weight: bold;
		box-sizing: border-box;
	}

	.onoffswitch-inner:before {
		content: "PREMIUM";
		padding-left: 20px;
		background-color: #34A7C1;
		color: #FFFFFF;
	}

	.onoffswitch-inner:after {
		content: "FREE";
		padding-left: 28px;
		background-color: #EEEEEE;
		color: #999999;
		text-align: left;
	}

	.onoffswitch-switch {
		display: block;
		width: 20px;
		height: 20px;
		margin: 2.5px;
		background: #FFFFFF;
		position: relative;
		top: 0;
		bottom: 0;
		right: 0px;
		border: 2px solid #999999;
		border-radius: 20px;
		transition: all 0.3s ease-in 0s;
	}

	.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
		margin-left: 0;
	}

	.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
		right: 0px;
	}


	

	/*untuk spinner*/
	/*#nprogress .spinner{
		top: 0;
		right: 0;

		width:100%;
		height:100%;

		background:rgba(255,255,255,0.5);

		opacity:1;
		transition: opacity 0.2s ease-in-out;
	}

	#nprogress .spinner-icon {
		border-top-color: #1BBC9B;
		border-left-color: #1BBC9B;

		width: 30%;
		height: 64%;
		border-width: 15px;

		margin: 10% 35%;
	}

	#nprogress {
		pointer-events: all;
	}*/
</style>
<script type="text/javascript">
	$(function () {


		$("#mapok").change(function () {
			var urlSearch = "<?php echo base_url() . 'psep_sekolah/materi_guru/tabel_ajax/'; ?>" + $("#kelas").val() + "/" + $("#mapel").val() + "/" + $("#mapok").val();
			$.ajax({
				url: urlSearch,
				beforeSend: function () {
					NProgress.start();
					//$("#containerajax").html('<div class="text-center"><img src="<?php echo base_url() . 'assets/img/table_loading.gif'; ?>"></div>');
				},
				success: function (data) {
					NProgress.done();
					$("#containerajax").html(data);
				}
			});
			return false;
		});
	});
</script>
<div class="row" style="margin-bottom:20px;">

	<div class="col-md-6" hidden>
		<input id="kelas" type="text" value="<?php echo $idkelas ?>">
	</div>
	<div class="col-md-6" hidden>
		<input id="mapel" type="text" value="<?php echo $idmapel ?>">
	</div>

	<div class="col-md-6">
		<select id="mapok" class="form-control">
			<option value="">Pilih Materi Pokok...</option>

			<?php foreach ($carimapok as $mapok) { ?>
				<option value="<?php echo $mapok->id_materi_pokok; ?>" <?= $idmapok == $mapok->id_materi_pokok ? 'selected' : '' ?>><?php echo $mapok->nama_materi_pokok; ?></option>
			<?php } ?>

		</select>
	</div>
</div>



<div class="content">
	<div class="table-responsive">
		<table id="my_datatable" class="table table-striped table-hover">
			<thead align="center">
			<tr>
				<th>#</th>
				<th class="text-center">Kelas</th>
				<th class="text-center">Mata Pelajaran</th>
				<th class="text-center">Materi Pokok</th>
				<th class="text-center">Materi Pembelajaran</th>
				<th class="text-center">Konten</th>
				<th class="text-center">Tipe</th>
				<th class="text-center">Daftar Soal</th>
				<th class="text-center" style="width:80px;">Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php if ($data_tabel != '') { ?>
				<?php
				$i = ($hal == 1 ? 1 : (($hal - 1) * $per + 1));
				foreach ($data_tabel as $row) {
					if ($row->id_sub_materi != '') {
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row->alias_kelas ?></td>
							<td><?= $row->nama_mapel ?></td>
							<td><?= $row->nama_materi_pokok ?></td>
							<td><?= $row->nama_sub_materi ?></td>
							<td><?= ($row->kategori == 1 ? "<span class='glyphicon glyphicon-file'></span> Teks" : ($row->kategori == 2 ? "<span class='glyphicon glyphicon-play-circle'></span> Video" : ($row->kategori == 3 ? "<span class='glyphicon glyphicon-star'></span> Soal" : '-'))) ?></td>
							<td class="text-center">
								<div class="onoffswitch">
									<input type="checkbox" name="status_materi_<?= $row->id_sub_materi ?>"
										   class="onoffswitch-checkbox hidden"
										   id="myonoffswitch<?= $row->id_sub_materi ?>" <?= $row->status_materi == 1 ? 'checked' : '' ?>
										   onchange="if (this.checked === false){ ajaxStatusMateri(<?= $row->id_sub_materi ?>, 0); } else { ajaxStatusMateri(<?= $row->id_sub_materi ?>, 1); }">
									<label class="onoffswitch-label" for="myonoffswitch<?= $row->id_sub_materi ?>">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</td>
							<td class="text-center">
								<?php if ($row->kategori == 3) { ?>
									<a href="<?= base_url() . "psep_sekolah/latihansoal/detail/" . $row->id_sub_materi ?>"
									   class="btn btn-sm btn-fill btn-info">Lihat <span
												class='glyphicon glyphicon-arrow-right'></span></a>
								<?php } else { ?>
									<span style="color:red;"><i class="glyphicon glyphicon-remove"></i></span>
								<?php } ?>
							</td>
							<td class="text-center">
								<a href="<?= base_url() ?>psep_sekolah/materi_guru/manajemen/ubah?id=<?= $row->id_sub_materi ?>"
								   class="btn btn-warning btn-xs" title="Ubah"><span
											class="glyphicon glyphicon-pencil"></span></a>

								<?php
								if ($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin") {
									?>
									<button type="button" class="btn btn-danger btn-xs" title="Hapus"
											data-number="<?= $i ?>" value="<?= $row->id_sub_materi ?>"
											data-toggle="modal" data-target="#deleteRow_modal"><i
												class="glyphicon glyphicon-trash"></i></button>
									<?php
								}
								?>
							</td>
						</tr>
						<?
						$i++;
					}
				}foreach ($data_tabel as $row) {
					if ($row->id_sub_materi != '') {
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row->alias_kelas ?></td>
							<td><?= $row->nama_mapel ?></td>
							<td><?= $row->nama_materi_pokok ?></td>
							<td><?= $row->nama_sub_materi ?></td>
							<td><?= ($row->kategori == 1 ? "<span class='glyphicon glyphicon-file'></span> Teks" : ($row->kategori == 2 ? "<span class='glyphicon glyphicon-play-circle'></span> Video" : ($row->kategori == 3 ? "<span class='glyphicon glyphicon-star'></span> Soal" : '-'))) ?></td>
							<td class="text-center">
								<div class="onoffswitch">
									<input type="checkbox" name="status_materi_<?= $row->id_sub_materi ?>"
										   class="onoffswitch-checkbox hidden"
										   id="myonoffswitch<?= $row->id_sub_materi ?>" <?= $row->status_materi == 1 ? 'checked' : '' ?>
										   onchange="if (this.checked === false){ ajaxStatusMateri(<?= $row->id_sub_materi ?>, 0); } else { ajaxStatusMateri(<?= $row->id_sub_materi ?>, 1); }">
									<label class="onoffswitch-label" for="myonoffswitch<?= $row->id_sub_materi ?>">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</td>
							<td class="text-center">
								<?php if ($row->kategori == 3) { ?>
									<a href="<?= base_url() . "psep_sekolah/latihansoal/detail/" . $row->id_sub_materi ?>"
									   class="btn btn-sm btn-fill btn-info">Lihat <span
												class='glyphicon glyphicon-arrow-right'></span></a>
								<?php } else { ?>
									<span style="color:red;"><i class="glyphicon glyphicon-remove"></i></span>
								<?php } ?>
							</td>
							<td class="text-center">
								<a href="<?= base_url() ?>psep_sekolah/materi_guru/manajemen/ubah?id=<?= $row->id_sub_materi ?>"
								   class="btn btn-warning btn-xs" title="Ubah"><span
											class="glyphicon glyphicon-pencil"></span></a>

								<?php
								if ($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin") {
									?>
									<button type="button" class="btn btn-danger btn-xs" title="Hapus"
											data-number="<?= $i ?>" value="<?= $row->id_sub_materi ?>"
											data-toggle="modal" data-target="#deleteRow_modal"><i
												class="glyphicon glyphicon-trash"></i></button>
									<?php
								}
								?>
							</td>
						</tr>
						<?
						$i++;
					}
				}
				?>
			<?php } else { ?>
				<tr>
					<td colspan="8"><i>No Data Found</i></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<!--   Core JS Files   -->

<!--  Datatables Plugin -->
<script type="text/javascript"
		src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
		src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>

