<?php include('header_dashboard.php'); ?>
<?php
//PERHITUNGAN SKOR
foreach($kategoridiagnostic as $diagnostic){
	foreach($datasoal as $soal){
		if($soal->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenar as $datanilai){
				if($datanilai->id_diagnostic == $diagnostic->id_diagnostic){
					
					$skor[$diagnostic->id_diagnostic] = round(($datanilai->jumlah_benar / $soal->jumlah)*100, 2);
					
					$soalbenar[$diagnostic->id_diagnostic] = $datanilai->jumlah_benar;
					
					$jumlahsoalasli[$diagnostic->id_diagnostic] = $soal->jumlah;
					
					$soalsalah[$diagnostic->id_diagnostic] = $soal->jumlah - $datanilai->jumlah_benar;
				}
			}
		}
	}
}

foreach($kategoridiagnostic as $diagnostic){
	if(!isset($skor[$diagnostic->id_diagnostic])){
		$skor[$diagnostic->id_diagnostic] = 0;
	}
	if($skor[$diagnostic->id_diagnostic] < 40){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 40 AND $skor[$diagnostic->id_diagnostic] < 56){
		$kategori[$diagnostic->id_diagnostic] = "Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 56 AND $skor[$diagnostic->id_diagnostic] < 71){
		$kategori[$diagnostic->id_diagnostic] = "Sedang";
	}elseif($skor[$diagnostic->id_diagnostic] >= 71 AND $skor[$diagnostic->id_diagnostic] < 86){
		$kategori[$diagnostic->id_diagnostic] = "Tinggi";
	}elseif($skor[$diagnostic->id_diagnostic] >= 86){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Tinggi";
	}
}

foreach($kategoridiagnostic as $diagnostic){
	foreach($jumlahhasil as $jumlah){
		if($jumlah->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenarhasil as $jumlahbenar){
				if($jumlahbenar->id_diagnostic == $diagnostic->id_diagnostic){
					$average[$diagnostic->id_diagnostic] = round(($jumlahbenar->jumlah_benar / $jumlah->jumlah_soal) * 100, 2);
					
					
				}
			}
		}
		$jumlahsoalasli[$diagnostic->id_diagnostic] = $jumlah->jumlah_soal;
	}
}
?>

<?php
	$total = $totalv + $totala + $totalk;
	
	$persenv = ($totalv / $total) * 100;
	$persena = ($totala / $total) * 100;
	$persenk = ($totalk / $total) * 100;
?>

<?php 
	$rank = array();
	$skor_maxmin = array();
	$rankkelas = array();
	foreach ($kategoridiagnostic as $diagnostic) {
		foreach ($hasildiagnostic as $hasil) {
			if($hasil->id_diagnostic == $diagnostic->id_diagnostic){
				//rank[id_diagnostic][id_siswa] = jumlah_status
				$rank[$diagnostic->id_diagnostic][] = $hasil->id_siswa;
				
				foreach ($datasoal as $soal) {
					if($soal->id_diagnostic == $diagnostic->id_diagnostic){
						$skor_maxmin[$diagnostic->id_diagnostic][] = round((($hasil->jumlah_status / $soal->jumlah) * 100), 2);
					}
				}

			}
		}
	}
	foreach ($peringkatsiswa as $kelas) {
		$rankkelas[] = $kelas->id_siswa;
	}
	
	if(!isset($skor)){
		$skor = 0;
	}
?>
	<div class="container-fluid stat-wrapper">
		<div class="diagnistic-wrapper">
		    
		    <!--
		    
		<div class="diagnistic-header">
			<h1>DIAGNOSTIC TEST</h1>
		</div>
		
		<div class="diagnistic-container"> 
			<div class="grafik">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
			<table class="table table-chart">
				<tr class="diagnistic-title">
					<th>Bid. Studi</th>
					<th>Nilai</th>
					<th>Rata-rata Kelas</th>
					<th>Rank. Bid Studi</th>
					<th>Kategori</th>
				</tr>
				<?php
				/*	foreach($kategoridiagnostic as $diagnostic){
				?>
					<tr>
						<td>
							<?php echo $diagnostic->nama_kategori; ?>
						</td>
						<td>
							<?php
								
								echo number_format($skor[$diagnostic->id_diagnostic], 2, '.', ',');
							?>
						</td>
						<td>
							<?php 
							if(isset($average[$diagnostic->id_diagnostic])){
								echo number_format($average[$diagnostic->id_diagnostic], 2, '.', ',');
							}else{
								echo 0;
							}
							; 
							
							?>
						</td>
						<td>
							<?php 
								echo (array_search($_SESSION['id_siswa'], $rank[$diagnostic->id_diagnostic])) + 1;
							?> 
						</td>
						<td>
							<?php
								
								echo $kategori[$diagnostic->id_diagnostic];
							?>
						</td>
					</tr>
				<?php
					}
				?>
				<tr>
					<td>Jumlah Nilai</td>
					<td><?php 
					if($skor !== 0){
						echo array_sum($skor);
					}else{
						echo "0";
					}
					?></td>
					<td style="text-align: center;" colspan="3">Peringkat</td>
				</tr>
				<tr>
					<td>Nilai Rata-rata</td>
					<td>
					<?php
						if($skor !== 0){
							$jumlaharray = count($skor);
							echo array_sum($skor)/$jumlaharray;
						}else{
							echo "0";
						}
					?>
					</td>
					<td style="text-align: center;" colspan="3">
						<?php $r = array_search($_SESSION['id_siswa'], $rankkelas);?>
						Rangking <?php echo !empty($rankkelas) ? ($r+1) : 0 ?> dari <?php echo count($rankkelas) */ ?> Siswa</td>
				</tr>
			</table>
		</div>

-->
		</div>

		<div class="learn-wrapper">
		<div class="diagnistic-header">
			<h1>LEARNING STYLE</h1>
		</div>

		<div class="diagnistic-container">
			<table class="table">
				<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th style="text-align:center;">Skor</th>
				<th>Dominasi
				<span class="hasil">
				<?php
					if($dominasi == "V"){
						echo "VISUAL";
					}elseif($dominasi == "A"){
						echo "AUDITORI";
					}elseif($dominasi == "K"){
						echo "KINESTETIK";
					}elseif($dominasi == "VA"){
						echo "VISUAL - AUDITORI";
					}elseif($dominasi == "VK"){
						echo "VISUAL - KINESTETIK";
					}elseif($dominasi == "AK"){
						echo "AUDITORI - KINESTETIK";
					}
				?>
				</span></th>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/visual.jpg');?>"></td>
				<td>VISUAL</td>
				<td><?php echo $totalv; ?></td>
				<td>
					<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenv; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenv; ?>%;">
						<span class="sr-only"><?php echo $persenv; ?>%</span>
					</div>
					</div>
				</td>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/auditori.jpg');?>"></td>
				<td>AUDITORI</td>
				<td><?php echo $totala; ?></td>
				<td>
					<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persena; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persena; ?>%;">
						<span class="sr-only"><?php echo $persena; ?>%</span>
					</div>
					</div>
				</td>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/kinestetik.jpg');?>"></td>
				<td>KINESTETIK</td>
				<td><?php echo $totalk; ?></td>
				<td>
					<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenk; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenk; ?>%;">
						<span class="sr-only"><?php echo $persenk; ?>%</span>
					</div>
					</div>
				</td>
				</tr>
			</table>
		</div>
		</div>

		<div class="eq-wrapper">
		<div class="diagnistic-header">
			<h1>PSYCHOLOGY POTENTIAL TEST</h1>
		</div>

		<div class="diagnistic-container">
			<table class="table">
				<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th style="text-align:center;">Skor</th>
				<th>Kategori</th>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/aq.jpg');?>"></td>
				<td>AQ (ADVERSITY QUOTIENT) - DAYA JUANG</td>
				<td><?php echo $data_eq->skor_aq; ?></td>
				<?php
				echo "<td style='color:white;";
				if($data_eq->skor_aq < 7){
					echo " background:#DF0F19;'> ";
					echo "Rendah";
				}elseif($data_eq->skor_aq <= 11){
					echo " background:#df0f52;'> ";
					echo "Rata-Rata Bawah";
				}elseif($data_eq->skor_aq <= 21){
					echo " background:#4EA32A;'> ";
					echo "Rata-Rata";
				}elseif($data_eq->skor_aq <= 26){
					echo " background:#059B9A'> ";
					echo "Rata-Rata Atas";
				}elseif($data_eq->skor_aq <= 32){
					echo " background:#c1bd33;'> ";
					echo "Tinggi";
				}
				?>
				</td>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/eq.jpg');?>"></td>
				<td>EQ (EMOTIONAL QUOTIENT) - KECERDASAN EMOSI</td>
				<td><?php echo $data_eq->skor_eq; ?></td>
				<?php
				echo "<td style='color:white;";
				if($data_eq->skor_eq < 7){
					echo " background:#DF0F19;'> ";
					echo "Rendah";
				}elseif($data_eq->skor_eq <= 11){
					echo " background:#df0f52;'> ";
					echo "Rata-Rata Bawah";
				}elseif($data_eq->skor_eq <= 21){
					echo " background:#4EA32A;'> ";
					echo "Rata-Rata";
				}elseif($data_eq->skor_eq <= 26){
					echo " background:#059B9A'> ";
					echo "Rata-Rata Atas";
				}elseif($data_eq->skor_eq <= 32){
					echo " background:#c1bd33;'> ";
					echo "Tinggi";
				}
				?>
				</td>
				</tr>
				<tr>
				<td><img src="<?php echo base_url('assets/dashboard/images/am.jpg');?>"></td>
				<td>AM (ACHIEVEMENT MOTIVATION) - MOTIVASI BERPRESTASI</td>
				<td><?php echo $data_eq->skor_am; ?></td>
				<?php
				echo "<td style='color:white;";
				if($data_eq->skor_am < 7){
					echo " background:#DF0F19;'> ";
					echo "Rendah";
				}elseif($data_eq->skor_am <= 11){
					echo " background:#df0f52;'> ";
					echo "Rata-Rata Bawah";
				}elseif($data_eq->skor_am <= 21){
					echo " background:#4EA32A;'> ";
					echo "Rata-Rata";
				}elseif($data_eq->skor_am <= 26){
					echo " background:#059B9A'> ";
					echo "Rata-Rata Atas";
				}elseif($data_eq->skor_am <= 32){
					echo " background:#c1bd33;'> ";
					echo "Tinggi";
				}
				?>
				</td>
				</tr>
			</table>
		</div>
		</div>

<!-- sansan code
		<div class="nilai-wrapper">
		<div class="diagnistic-header">
			<h1>STATISTIK NILAI</h1>
		</div>
		<div class="nilai-container">
			<table class="table">
			<tr class="nilai-title">
				<th>Mata Pelajaran</th>
				<th>Nilai Tertinggi</th>
				<th>Nilai Terendah</th>
				<th>Nilai Rata - rata</th>
			</tr>
			<?php
			/*
				$tabelhex = array('#E8F0F3','#7CBFB6','#E8F0F3','#7CBFB6','#E8F0F3','#7CBFB6','#E8F0F3');
				foreach ($kategoridiagnostic as $diagnostic) {
					$currentskor = $skor_maxmin[$diagnostic->id_diagnostic];
					$skor_max = reset($skor_maxmin[$diagnostic->id_diagnostic]); 
					$skor_min = end($skor_maxmin[$diagnostic->id_diagnostic]);
					$skor_rata = round(array_sum($currentskor) / count($currentskor), 2);
				?>
				<tr>
					<td style="background-color:<?php echo current($tabelhex);?>"><?php echo $diagnostic->nama_kategori?></td>
					<td style="background-color:<?php echo current($tabelhex);?>"><?php echo $skor_max?></td>
					<td style="background-color:<?php echo current($tabelhex);?>"><?php echo $skor_min?></td>
					<td style="background-color:<?php echo current($tabelhex); next($tabelhex)?>;">><?php echo $skor_rata?></td>
				</tr>
				<?php
				}
			?>
			</table>
			<div class="nilai-images">
				<div class="top">					
					<div class="grafik">
						<canvas id="statistiknilai" width="260px" height="235px"></canvas>
					</div>
					<div class="ranking">
						<div class="ranking-mask-medal blueneptune">
							<span><?php echo !empty($rankkelas) ? ($r+1) : 0 ?></span>
						</div>
						<span>Ranking Kelas</span> <br>
						<?php echo !empty($rankkelas) ? ($r+1) : 0 ?> dari <?php echo count($rankkelas)?> Siswa
					</div>	
				</div>
				<div class="bottom">
					<?php 
					if($skor !== 0){
						$bimbing = round((array_sum($skor) / count($skor)), 2);
					}else{
						$bimbing = 0;
					}
					
					?>

					<p color=#2E3641>Predikat</p>
					<div class="progress col-lg-7 col-md-7 col-xs-12 col-sm-12" style="padding:0;">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $bimbing; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $bimbing; ?>%">
						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-xs-12 col-sm-12" color=#2E3641 style="padding:0;">
						<span style="margin-left:5%"><?php echo $bimbing; ?>%</span> <span class="pull-right">Perlu Bimbingan</span>
					</div>
				</div>
			</div>
		</div>
		<div class="persentase-wrapper">
			<?php 
			$panelhex = array('#059B9A','#095169','#059B9A','#095169','#059B9A','#095169');
			foreach ($kategoridiagnostic as $diagnostic) {
				?>
				<div class="persentase">
					<h3 style="background-color:<?php echo current($panelhex);?>;"><?php echo strtoupper($diagnostic->nama_kategori)?></h3>
					<hr class="persentase-grid" style="border-top-color:<?php echo current($panelhex);?>;"
					>
					<h5><?php echo $skor[$diagnostic->id_diagnostic]; ?>%
					</h5>
					</div>
				<?php
				next($panelhex);
			}
			*/
			?>
		</div>
		</div>
-->
		<div class="analisa-learn-wrapper">
			<div class="diagnistic-header green">
				<h1>HASIL ANALISA "LEARNING STYLE"</h1>
			</div>


			<div class="diagnistic-container">
				<div class="result">
					<table class="title">
						<tr>
							<td rowspan=2>
								<?php
								if($dominasi == "V"){
								?>
									<img src="<?php echo base_url('assets/dashboard/images/visual-green.png');?>">
								</td>
								<td>
									<h5>VISUAL</h5>
								</td>
								<?php
								}elseif($dominasi == "A"){
								?>
								<img src="<?php echo base_url('assets/dashboard/images/auditori-green.png');?>">
								</td>
								<td>
									<h5>AUDITORI</h5>
								</td>
								<?php
								}elseif($dominasi == "K"){
								?>
								<img src="<?php echo base_url('assets/dashboard/images/kinestetik-green.png');?>">
								</td>
								<td>
									<h5>KINESTETIK</h5>
								</td>
								<?php
								}elseif($dominasi == "VA"){
								?>
								<img src="<?php echo base_url('assets/dashboard/images/visual-green.png');?>">
								<img src="<?php echo base_url('assets/dashboard/images/auditori-green.png');?>">
								</td>
								<td>
									<h5>VISUAL-AUDITORI</h5>
								</td>
								<?php
								}elseif($dominasi == "VK"){
								?>
								<img src="<?php echo base_url('assets/dashboard/images/visual-green.png');?>">
								<img src="<?php echo base_url('assets/dashboard/images/kinestetik-green.png');?>">
								</td>
								<td>
									<h5>VISUAL-KINESTETIK</h5>
								</td>
								<?php
								}elseif($dominasi == "AK"){
								?>
								<img src="<?php echo base_url('assets/dashboard/images/auditori-green.png');?>">
								<img src="<?php echo base_url('assets/dashboard/images/kinestetik-green.png');?>">
								</td>
								<td>
									<h5>AUDITORI-KINESTETIK</h5>
								</td>
								<?php
								}
								?>
						</tr>
						<tr>
							<td>
								<p>Berdasarkan data dan Modalitas Belajar di atas, maka yang menonjol adalah kemampuan 
								<?php
								if($dominasi == "V"){
									echo "VISUAL";
								}elseif($dominasi == "A"){
									echo "AUDITORI";
								}elseif($dominasi == "K"){
									echo "KINESTETIK";
								}elseif($dominasi == "VA"){
									echo "VISUAL - AUDITORI";
								}elseif($dominasi == "VK"){
									echo "VISUAL - KINESTETIK";
								}elseif($dominasi == "AK"){
									echo "AUDITORI - KINESTETIK";
								}
								?>.<br/>
								Putra - putri Bapak/Ibu adalah Pelajar dengan tipe
								<?php
								if($dominasi == "V"){
									echo "VISUAL";
								}elseif($dominasi == "A"){
									echo "AUDITORI";
								}elseif($dominasi == "K"){
									echo "KINESTETIK";
								}elseif($dominasi == "VA"){
									echo "VISUAL - AUDITORI";
								}elseif($dominasi == "VK"){
									echo "VISUAL - KINESTETIK";
								}elseif($dominasi == "AK"){
									echo "AUDITORI - KINESTETIK";
								}
								?>
								. Dengan karakteristik umum dan pola belajar serta metode belajar yang tepat, sebagai berikut.</p>								
							</td>
						</tr>

					</table>
					<div class="title">
						
						
					
					</div>
					
				</div>
				<div class="desc">
					<div class="title">KARAKTERISTIK</div>
					<div class="content">
					<p>						
						<?php echo $karakteristik; ?>
					</p>
					</div>
				</div>
				<div class="desc">
					<div class="title">SARAN STRATEGI BELAJAR</div>
					<div class="content">
					<p>	
					<?php echo $saran; ?>
					</p>
					</div>
				</div>
			</div>
		</div>

		<div class="analisa-eq-wrapper">
			<div class="diagnistic-header lightblue">
				<h1>HASIL ANALISA TES "PSYCHOLOGY POTENTIAL TEST"</h1>
			</div>

			<div class="diagnistic-container">
				<div class="analisa-eq">
					<table style="table-layout:fixed;width:100%;">
						<tr>
							<td width=90px rowspan=2>
								<img src="<?php echo base_url('assets/dashboard/images/aq.jpg');?>">
							</td>
							<td style="padding-left:1.75%;">
								<div class="title"><b>AQ (ADVERSITY QUOTIENT)</b><br/>DAYA JUANG</div>
							</td>
							<td  style="width:18.5%;">
								<?php
								echo "<div class='result' style='";
								if($data_eq->skor_aq < 7){
									echo " background:#DF0F19;'> ";
									echo "Rendah";
								}elseif($data_eq->skor_aq <= 11){
									echo " background:#df0f52;'> ";
									echo "Rata-Rata Bawah";
								}elseif($data_eq->skor_aq <= 21){
									echo " background:#4EA32A;'> ";
									echo "Rata-Rata";
								}elseif($data_eq->skor_aq <= 26){
									echo " background:#059B9A'> ";
									echo "Rata-Rata Atas";
								}elseif($data_eq->skor_aq <= 32){
									echo " background:#c1bd33;'> ";
									echo "Tinggi";
								}
								?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan=2>					
								<div class="content">
								<?php echo $analisis_aq;?>
								</div>			
							</td>
						</tr>
					</table>
				</div>
				<div class="analisa-eq">
					<table style="table-layout:fixed;width:100%;">
						<tr>
							<td width=90px rowspan=2>
								<img src="<?php echo base_url('assets/dashboard/images/eq.jpg');?>">
							</td>
							<td style="padding-left:1.75%;">
								<div class="title"><b>EQ (EMOTIONAL QUOTIENT)</b><br/>KECERDASAN EMOSI</div>
							</td>
							<td  style="width:18.5%;">
								<?php
								echo "<div class='result' style='";
								if($data_eq->skor_eq < 7){
									echo " background:#DF0F19;'> ";
									echo "Rendah";
								}elseif($data_eq->skor_eq <= 11){
									echo " background:#df0f52;'> ";
									echo "Rata-Rata Bawah";
								}elseif($data_eq->skor_eq <= 21){
									echo " background:#4EA32A;'> ";
									echo "Rata-Rata";
								}elseif($data_eq->skor_eq <= 26){
									echo " background:#059B9A'> ";
									echo "Rata-Rata Atas";
								}elseif($data_eq->skor_eq <= 32){
									echo " background:#c1bd33;'> ";
									echo "Tinggi";
								}
								?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan=2>					
								<div class="content">
								<?php echo $analisis_eq;?>
								</div>			
							</td>
						</tr>
					</table>
				</div>
				<div class="analisa-eq">
					<table style="table-layout:fixed;width:100%;">
						<tr>
							<td width=90px rowspan=2>
								<img src="<?php echo base_url('assets/dashboard/images/eq.jpg');?>">
							</td>
							<td style="padding-left:1.75%;">
								<div class="title"><b>AM (ACHIEVEMENT MOTIVATION)</b><br/>MOTIVASI BERPRESTASI</div>
							</td>
							<td  style="width:18.5%;">
								<?php
								echo "<div class='result' style='";
								if($data_eq->skor_am < 7){
									echo " background:#DF0F19;'> ";
									echo "Rendah";
								}elseif($data_eq->skor_am <= 11){
									echo " background:#df0f52;'> ";
									echo "Rata-Rata Bawah";
								}elseif($data_eq->skor_am <= 21){
									echo " background:#4EA32A;'> ";
									echo "Rata-Rata";
								}elseif($data_eq->skor_am <= 26){
									echo " background:#059B9A'> ";
									echo "Rata-Rata Atas";
								}elseif($data_eq->skor_am <= 32){
									echo " background:#c1bd33;'> ";
									echo "Tinggi";
								}
								?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan=2>					
								<div class="content">
								<?php echo $analisis_am;?>
								</div>			
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="analisa-diagnostic-wrapper green">
			<div class="diagnistic-header">
				<h1>HASIL ANALISA "DIAGNOSTIC TEST"</h1>
			</div>

			<div class="diagnistic-container">
				<div class="title">
					<h5>DIAGNOSTIC TEST</h5>
					<h5 class="info">PERLU BIMBINGAN</h5>
					<span class="triangle-left">
						<span class="inner-triangle"></span>
					</span>
				</div>
				<div class="content">
					<p>
					Dari diagnosa kemampuan awal materi uji Academic General Check Up (AGCU), bidang studi Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, dan Biologi, secara umum hasilnya masih rendah, sehingga perlu dipersiapkan sejak dini dan dilakukan pengulangan beberapa materi, sehingga diharapkan siswa mampu memahami kelemahannya dan berusaha terus belajar. Beberapa materi uji AGCU ini masih belum tuntas dan belum memenuhi target awal. Nilai bidang studi (Matematika, Bahasa Inggris, Fisika) masih belum tuntas.
					</p>
				</div>
			</div>
		</div>
		<div class="hasil-nilai-wrapper">
		 <!-- ANALISIS TOPIK -->
		<?php
			foreach($kategoridiagnostic as $diagnostic){
		?>
			<div class="hasil-nilai-container">
					<h4><span><?php echo $diagnostic->nama_kategori; ?></span></h4>
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="75%" style="text-align: center;">INDIKATOR</th>
								<th colspan="2" width="25%" style="text-align: center;">KETUNTASAN</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($analisistopik as $analisis){
									if($analisis->id_diagnostic == $diagnostic->id_diagnostic){
							?>
								<tr>
									<td>
										<?php echo $analisis->topik; ?>
									</td>
									<td class="text-center">
										<?php
											if($analisis->status == 1){
												echo "Tuntas";
											}else{
												echo "Belum Tuntas";
											}
										?>
									</td>
									<td class="text-center">
										<?php
											if($analisis->status == 1){
												echo '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: #059B99"></span>';
											}else{
												echo '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: #DE0F19"></span>';
											}
										?>
									</td>
								</tr>
							<?php
									}
								}
							?>
							
						</tbody>
					</table>
					<div class=" col-lg-offset-4 col-md-offset-4 col-lg-8 col-md-8 col-xs-12 col-sm-12" style="padding:0">
						<table class="table-result table">
							<tr>
								<td class="col-md-2">Nilai</td>
								<td class="col-md-2">
								<?php echo $skor[$diagnostic->id_diagnostic] ;?>
								</td>
								<td class="col-md-2">Tuntas</td>
								<td class="col-md-2">
								
								<?php
								if(isset($soalbenar[$diagnostic->id_diagnostic])){
									echo $soalbenar[$diagnostic->id_diagnostic];
								}else{
									echo 0;
								}
								?> Soal
								
								</td>
								<td class="col-md-2">
								<?php echo $skor[$diagnostic->id_diagnostic] ;?> %
								</td>
							</tr>
							<tr>
								<td class="col-md-2">Kategori</td>
								<td class="col-md-2">
								<?php echo $kategori[$diagnostic->id_diagnostic];?>
								</td>
								<td class="col-md-2">Belum Tuntas</td>
								<td class="col-md-2">
								<?php
								if(isset($soalsalah[$diagnostic->id_diagnostic])){
									echo $soalsalah[$diagnostic->id_diagnostic];
								}else{
									echo $jumlahsoalasli[$diagnostic->id_diagnostic];
								}
								?> Soal
								</td>
								
								<td class="col-md-2">
								<?php echo 100-$skor[$diagnostic->id_diagnostic] ;?> %
								</td>
							</tr>
						</table>
					</div>
			</div>
		<?php
			}
		?>
	<!-- END ANALISIS TOPIK -->
		</div>  <!-- END hasil-nilai-wrapper -->
	</div>

	<?php include('footer.php'); ?>

	<div id="edit-profile" class="edit-profile-wrapper">
	<div class="edit-profile-container">
		<div class="header center"><img src="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" style="filter: invert(1);width: 94%;""></div>
		<h4>Lengkapi Profil Anda</h4><a href="javascript:;" class="close"><span class="glyphicon glyphicon-remove"></span></a>
		<form id="edit-profile-form" class="edit-profile-form">
		<div class="form-group">
			<div class="label-style required">Nama</div>
			<input class="input-style form-control" type="text" id="name" name="name" placeholder="Nama">
		</div>
		<div class="form-group">
			<div class="label-style">Tanggal Lahir</div>
			<input class="input-style form-control" type="text" id="datebirth" name="datebirth" placeholder="Tanggal Lahir">
		</div>
		<div class="form-group">
			<div class="label-style">Nomor HP</div>
			<input class="input-style form-control" type="text" id="phone" name="phone" placeholder="Nomor HP">
		</div>
		<div class="form-group">
			<div class="label-style required">Email</div>
			<input class="input-style form-control" type="text" id="email" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<div class="label-style required">Jenis Kelamin</div>
			<select class="form-control input-style" id="gender" name="gender">
				<option value="laki">Laki - laki</option><option value="perempuan">Perempuan</option>               
			</select>
		</div>
		<div class="form-group">
			<div class="label-style required">Alamat (Domisili)</div>
			<input class="input-style form-control" type="text" id="address" name="address" placeholder="Alamat">
		</div>
		<div class="form-group">
			<div class="label-style required">Kelas/Tingkat</div>
			<input class="input-style form-control" type="text" id="class" name="class" placeholder="KELAS XI IPA">
		</div>
		<div class="form-group">
			<div class="label-style required">Sekolah</div>
			<input class="input-style form-control" type="text" id="school" name="school" placeholder="Sekolah">
		</div>
		<div class="form-group">
			<div class="label-style">Ganti Foto</div>
			<input class="input-style" type="file" id="exampleInputFile">
		</div>
		<div class="form-group">
			<div class="label-style">&nbsp;</div>
			<div class="input-style form-thanks">Thank you for submitting your booking with us, this is not a confirmation for your booking, our reservation staff will contact you through your email within 24 hours. Please also check your SPAM or JUNK mail.</div>
		</div>
		<div class="form-group">
			<div class="label-style">&nbsp;</div>
			<button name="csubmit" type="submit" class="btn btn-primary">Submit</button>&nbsp;<button id="Rreset" name="rreset" type="reset" class="btn btn-warning">Reset</button>
		</div>
		</form>
	</div>
	</div>
	<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
	
	<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" charset="utf-8">
	$(window).load(function(){
 
	});
	</script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>	
	<script src="<?php echo base_url('assets/dashboard/js/jquery.matchHeight.js');?>"></script>


	<script type="text/javascript" charset="utf-8">
		$(function() {
			$('.persentase-wrapper .persentase h3').matchHeight();
		});
	</script>

	<script>

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: [
		<?php
		foreach($kategoridiagnostic as $diagnostic){
			echo '"'.$diagnostic->nama_kategori.'",';
		}
		?>
		],
		datasets: [{
			label: '# Nilai Mata Pelajaran',
			backgroundColor: "rgba(169, 211, 207, 0.5)",
			data: [
			<?php
			foreach($kategoridiagnostic as $diagnostic){
				echo $skor[$diagnostic->id_diagnostic].",";
			}
			?>
			],
			borderWidth: 1
		}]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true,
					max:100
				}
			}]
		},
		legend: {
			display: false
		}
	}
});



var c_sn = document.getElementById("statistiknilai");
var statistiknilai = new Chart(c_sn, {
	type: 'bar',
	data: {
		labels: [
		<?php
		foreach($kategoridiagnostic as $diagnostic){
			echo '"'.$diagnostic->nama_kategori.'",';
		}
		?>
		],
		datasets: [{
			label: '# Rata-rata',
			backgroundColor: [
				"#059B9A","#7CBFB6","#059B9A","#059B9A","#7CBFB6","#059B9A",
			],

			data: [
			<?php
			foreach($kategoridiagnostic as $diagnostic){
				$currentskor = $skor_maxmin[$diagnostic->id_diagnostic];
				$skor_max = reset($skor_maxmin[$diagnostic->id_diagnostic]); 
				$skor_min = end($skor_maxmin[$diagnostic->id_diagnostic]);
				$skor_rata = round(array_sum($currentskor) / count($currentskor), 2);
				echo $skor_rata.",";
			}
			?>],
			borderWidth: 1
		}]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true,
					max:100
				}
			}]
		},
		legend: {
			display: false
		}
	}
});
</script>
	</body>
</html>