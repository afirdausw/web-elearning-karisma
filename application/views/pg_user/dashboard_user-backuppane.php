
		<div class="panel panel-default panel-user-utama">
			<div class="">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#materi-saya" aria-controls="materi-saya" role="tab" data-toggle="tab">Materi Saya</a></li>
					<li role="presentation"><a href="#semua-materi" aria-controls="semua-materi" role="tab" data-toggle="tab">Semua Materi</a></li>
					<li role="presentation"><a href="#riwayat" aria-controls="riwayat" role="tab" data-toggle="tab">Riwayat</a></li>
				</ul>

			</div>


			<!-- Tab panes -->
			<div class="tab-content tab-user-1">
				<div role="tabpanel" class="tab-pane active" id="materi-saya">
					<ul>
						<?php if ($paketaktif >= 4 && $paketaktif <= 6 || $paketaktif == 0){ ?>
							<?php if ($paketaktif == 4 || $paketaktif == 0){ ?>
									<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==4){
											?>
											<div class="panel panel-default panel-user-materi-saya">
												<a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>">
													<div class="panel-body">
														<div class="col-md-2 col-lg-2 col-sm-2 hidden-xs">
															<img src="<?php echo base_url('assets/pg_user/images/custom/icon-tabel-konten.png')?>" alt="" class="img-responsive">
															
														</div>
														<div class="col-md-10 col-lg-10 col-sm-10 col-xs-12">
															<span class="">
																(Kelas <?php echo $mapel->tingkatan_kelas ?>)
																<?php echo $mapel->nama_mapel ?>			
															</span>
														</div>
														
														
													</div>
												</a>
											</div>
										<?php
										}
									}?>
						<?php } ?>
							<?php if ($paketaktif == 5 || $paketaktif == 0) { ?>
								<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==5){
											?>
											<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
											<?php
										}
									}?>
							<?php } ?>
							<?php if ($paketaktif == 6 || $paketaktif == 0){ ?>
								<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==6){
											?>
											<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
											<?php
										}
									}?>
							<?php } ?>
						<?php
							} ?>

						<?php if ($paketaktif >= 7 && $paketaktif <= 9 || $paketaktif == 0){ ?>
							<?php if ($paketaktif == 7 || $paketaktif == 0){ ?>
									<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==7){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
								<?php } ?>
								<?php if ($paketaktif == 8 || $paketaktif == 0){ ?>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==8){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
								<?php } ?>
								<?php if ($paketaktif == 9 || $paketaktif == 0){ ?>
									<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==9){ ?>
											<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
											<?php
										}
									}?>
								<?php } ?>
						<?php
							} ?>
						 
								<?php if ($paketaktif >= 19 && $paketaktif <= 24 || $paketaktif == 0){ ?>
									<?php if ($paketaktif >= 23 && $paketaktif <= 24 || $paketaktif == 0){ ?> 
										<?php if ($paketaktif == 23 || $paketaktif == 0){ ?>
											<?php foreach ($navbar_links as $mapel) {
												if($mapel->tingkatan_kelas==10){
															if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
															?>
															<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
															<?php
															}
														}
													}?>
													<?php } ?>
										<?php if ($paketaktif == 24 || $paketaktif == 0){ ?>
												<?php foreach ($navbar_links as $mapel) {
													if($mapel->tingkatan_kelas==10){
														if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
														?>
														<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
														<?php
														}
													}
												}?>
										<?php } ?>
									<?php } ?>
								<?php if ($paketaktif >= 21 && $paketaktif <= 22 || $paketaktif == 0){ ?>
									<?php if ($paketaktif == 21 || $paketaktif == 0){ ?>
										<?php foreach ($navbar_links as $mapel) {
												if($mapel->tingkatan_kelas==11){
													if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
															?>
															<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
															<?php
															}
														}
													}?>
													<?php } ?>
												<?php 
												if ($paketaktif == 22 || $paketaktif == 0){ ?>
													<?php foreach ($navbar_links as $mapel) {
														if($mapel->tingkatan_kelas==11){
															if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
															?>
															<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
															<?php
															}
														}
													}?>
											<?php
												} ?>
										<?php } ?>
						<?php if ($paketaktif >= 19 && $paketaktif <= 20 || $paketaktif == 0){ ?>  
							<?php if ($paketaktif == 19 || $paketaktif == 0){ ?>
								<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==12){
											if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
											?>
											<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
											<?php
											}
										}
									}?>
								<?php
								} ?>
								<?php if ($paketaktif == 20 || $paketaktif == 0){ ?>
									<?php foreach ($navbar_links as $mapel) {
										if($mapel->tingkatan_kelas==12){
											if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
											?>
											<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
											<?php
										}
									}
								}?>
							<?php } ?>
						<?php } ?>
					<?php
						} ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="semua-materi">oke</div>
				<div role="tabpanel" class="tab-pane" id="riwayat">...</div>
			</div>
		</div>
