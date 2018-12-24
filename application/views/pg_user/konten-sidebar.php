<!-- Sub Materi Kanan -->
<div class="col-lg-4 col-md-5 col-sm-5 panel-group panel-group-konten" style="float: right"
		id="list-sub-materi">
	<span class="judul-header">Materi</span>
	<!-- Pretest Konten (IF exist) -->
	<?php
	foreach ($materi_pokok_pre as $data) {
		$idsiswa = $this->session->userdata('id_siswa');

		$disable_class = '';
		$pretest_text = '';
		$status_materi = $data->materi_status;
		$user_akses = 1;
		if ($status_materi == 'buy') {
			if ($idsiswa == NULL || $siswa->id_premium == 0) {
				echo "<style>
				.not-active {
				pointer-events: none;
				cursor: default;
				color: grey !important;
				}
				</style>";
				$pretest_text = "<span class='ti-lock' title='Login diperlukan'></i>";
				$disable_class = ' not-active';
				$user_akses = 0;
				// 0 = tidak login dan pretest dilarang
			} else {
				if($siswa->id_premium!=0){
					$user_akses = 1;
				}else{
					$user_akses = 0;
				}
				// 1 = Login tapi premium
			}
		}
		?>
		<?php
		//Current Sidebar already collapsed
		//Button Viewed = Glyphicon Plus or Min
		//Toogle Sidebar = Ganti mode ditampilan atau tidak (in)
		$id_mapok_cur = $materi->id_materi_pokok;
		$side_id_mapok = $data->id_materi_pokok; //yang diulang

		$button_viewed = "glyphicon-plus";
		$toogle_sidebar = "";
		if ($id_mapok_cur == $side_id_mapok) {
			$button_viewed = "glyphicon-minus";
			$toogle_sidebar = "in";
		}
		?>
		<div class="panel panel-default">
			<div class="panel-heading panel-heading-konten" role="tab">
				<h4 class="panel-title panel-title-konten">
					<a class="collapsed" href="#bab<?= $status_materi; ?>" role="button"
						data-toggle="collapse" data-parent="#list-sub-materi">
						<i class="more-less glyphicon <?= $button_viewed ?>"></i>
						<b><?= $data->nama_materi_pokok ?></b>
					</a>
				</h4>
			</div>
			<div id="bab<?= $status_materi; ?>" class="panel-collapse collapse <?= $toogle_sidebar ?>"
					role="tabpanel">
				<div class="wrap-media-list">
					<?php
					foreach ($data->sub_materi as $bab) {
						if ($bab->kategori == '1') {
							$link = base_url() . 'konten/detail/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-align-left"></i>';
							$type = 'Tipe Teks';
						} elseif ($bab->kategori == '2') {
							$link = base_url() . 'konten/detail_video/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-youtube"></i>';
							$type = 'Tipe Video';
						} else {
							$link = base_url() . 'konten/detail_soal/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-check-square-o"></i>';
							$type = 'Tipe Soal';
						}
						if ($user_akses == 0) {
							$link = "#";
							$icon = '<i class="fa fa-lock"></i>';
						}
						/*
						DEBUG
						---------*/
						// if($idsiswa != NULL){
						//     $konten = $link;
						// }else{
						//     $konten = '#';
						// }

						//Current materi link is not available and highlighted
						//bg_cur = highlighted html code
						$bg_cur = "";
						$id_sub_cur = $sub_materi->id_sub_materi;
						if ($bab->id_sub_materi == $id_sub_cur) {
							$bg_cur = "style='background:#26aed442;'";
							$link = "#";
						}
						?>
						<a class="media-link<?= $disable_class ?>" href="<?= $link ?>">
							<div class="media" <?= $bg_cur; ?>>
								<div class="media-left">
									<?= $icon ?>
								</div>
								<div class="media-body">
									<span><?= $bab->urutan_materi ?>.</span>
									<h4><?= $bab->nama_sub_materi ?></h4>
									<small><?= $type ?></small>
								</div>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<!-- Free/Buy Konten -->
	<?php $no = 0;
	foreach ($materi_pokok as $data) {
		$no++;
		$idsiswa = $this->session->userdata('id_siswa');

		$disable_class = '';
		$pretest_text = '';
		$pretest_stat = $data->materi_status;
		$user_akses = 1;
		if ($pretest_stat == "buy") {
			if ($idsiswa == NULL) {
				echo "<style>
				.not-active {
					pointer-events: none;
					cursor: default;
					color: grey !important;
				}
				</style>";
				$pretest_text = "<span class='ti-lock' title='Login diperlukan'></i>";
				$disable_class = ' not-active';
				$user_akses = 0;
				// 0 = tidak login dan pretest dilarang
			} else {
				if($siswa->id_premium!=0){
					$user_akses = 1;
				}else{
					$user_akses = 0;
				}
				// 1 = Login tapi premium
			}
		}
		?>
		<?php
		//Current Sidebar already collapsed
		//Button Viewed = Glyphicon Plus or Min
		//Toogle Sidebar = Ganti mode ditampilan atau tidak (in)
		$id_mapok_cur = $materi->id_materi_pokok;
		$side_id_mapok = $data->id_materi_pokok; //yang diulang

		//variable on class
		$button_viewed = "glyphicon-plus";
		$toogle_sidebar = "";
		if ($id_mapok_cur == $side_id_mapok) {
			$button_viewed = "glyphicon-minus";
			$toogle_sidebar = "in";
		}
		?>
		<div class="panel panel-default">
			<div class="panel-heading panel-heading-konten" role="tab">
				<h4 class="panel-title panel-title-konten">
					<a class="collapsed" href="#bab<?= $no; ?>" role="button" data-toggle="collapse"
						data-parent="#list-sub-materi">
						<i class="more-less glyphicon <?= $button_viewed ?>"></i>
						<b>BAB <?= $no ?> :</b> <?= $data->nama_materi_pokok ?> <?= $pretest_text; ?>
					</a>
				</h4>
			</div>
			<div id="bab<?= $no; ?>" class="panel-collapse collapse <?= $toogle_sidebar ?>" role="tabpanel">
				<div class="wrap-media-list">
					<?php
					foreach ($data->sub_materi as $bab) {
						if ($bab->kategori == '1') {
							$link = base_url() . 'konten/detail/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-align-left"></i>';
							$type = 'Tipe Teks';
						} elseif ($bab->kategori == '2') {
							$link = base_url() . 'konten/detail_video/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-youtube"></i>';
							$type = 'Tipe Video';
						} else {
							$link = base_url() . 'konten/detail_soal/' . $bab->id_sub_materi;
							$icon = '<i class="fa fa-check-square-o"></i>';
							$type = 'Tipe Soal';
						}
						if ($user_akses == 0) {
							$link = "#";
							$icon = '<i class="fa fa-lock"></i>';
						}
						/*
						DEBUG
						---------*/
						// if($idsiswa != NULL){
						//     $konten = $link;
						// }else{
						//     $konten = '#';
						// }

						//Current materi link is not available and highlighted
						//bg_cur = highlighted html code
						$bg_cur = "";
						$id_sub_cur = $sub_materi->id_sub_materi;
						if ($bab->id_sub_materi == $id_sub_cur) {
							$bg_cur = "style='background:#26aed442;'";
							$link = "#";
						}

						?>
						<a class="media-link<?= $disable_class ?>" href="<?= $link ?>">
							<div class="media" <?= $bg_cur; ?>>
								<div class="media-left">
									<?= $icon ?>
								</div>
								<div class="media-body">
									<span><?= $bab->urutan_materi ?>.</span>
									<h4><?= $bab->nama_sub_materi ?></h4>
									<small><?= $type ?></small>
								</div>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>