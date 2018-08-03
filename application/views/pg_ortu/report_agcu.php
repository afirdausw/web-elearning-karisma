<?php include('header_dashboard.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<style>
	div#chart-container hr{
		margin:0 !important;
	}
</style>

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
<script>
	function supports_media_source() {
		"use strict";
		var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
			hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
		return (hasWebKit || hasMediaSource);
	}
</script>

<?php
	include('breadcrumb-parent.php')
?>

<div class="container-fluid stat-wrapper">


<!--    LEARNING STYLE-->

	<div class="learn-wrapper">
		<div class="diagnistic-header">
			<h1>
				LEARNING STYLE
			</h1>
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
		</div> <!-- END diagnistic-container -->
	</div> <!-- END Learn Wrapper -->

<!--    PSYCHOLOGY POTENTIAL TEST-->

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



<!--    HASIL ANALISA "LEARNING STYLE-->


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


<!--    HASIL ANALISA TES "PSYCHOLOGY POTENTIAL TEST"-->


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

	</div> <!-- END analisa-eq-wrapper -->

</div> <!-- END container-fluid stat-wrapper -->


<?php include('footer.php'); ?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>

<!-- JS Function for this Modal -->
<!--   Core JS Files   -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="<?php echo base_url()?>/assets/js/plugins/highcharts/themes/grid.js"></script>


<!-- PLUGINS FUNCTION -->
<!-- Needed for Highcharts plugin -->
<script type="text/javascript">
	$(function () {
		$(document).ready(function () {
			// Build the chart
			$('#chart-container').highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: <?php echo "'Grafik akses ".$data_siswa->nama_siswa."'";?>
				},
				subtitle: {
					text: <?php echo "'".date('F Y')."'";?>
				},
				tooltip: {
					// pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					pointFormat: '{series.name}: <b>{point.y} kali</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '{series.name}: <b>{point.y} kali</b>'
						},
						showInLegend: true
					}
				},
				series: [{
					name: 'Akses',
					colorByPoint: true,
					data: [
						{
							name: 'Materi Teks',
							y: <?php echo count($log_teks)?>,
							// sliced: true,
							// selected: true
						}, {
							name: 'Materi Video',
							y: <?php echo count($log_video)?>,
						}, {
							name: 'Latihan Soal',
							y: <?php echo count($log_soal)?>,
						}]
				}]
			});

			$('#input-daterange').datepicker({
				format: "MM yyyy",
				startView: 1,
				minViewMode: 1,
				maxViewMode: 2,
				todayBtn: "linked",
				// language: "id"
			});

			$('button[name^=submitAksesDate]').click(function(e) {
				e.preventDefault();
				var dateStart = $('input[name^=log_date_start]').val();
				var dateEnd = $('input[name^=log_date_end]').val();
				// console.log(dateStart +' - '+ dateEnd + ' ' + $('form[name^=formAksesDate]').attr('action'));

				$.ajax({
					url: $('form[name^=formAksesDate]').attr('action'),
					type: 'POST',
					dataType: 'json',
					data: { id:<?php echo $_SESSION['id_ortu_siswa'];?>, log_date_start:dateStart, log_date_end:dateEnd },
					success: function(response) {
						$('.label_bulan').text(dateStart +' - '+ dateEnd);
						$('#data_teks').html(response.data_teks);
						$('#data_video').html(response.data_video);
						$('#data_soal').html(response.data_soal);

						var chart = $('#chart-container').highcharts();
						chart.series[0].setData([response.count_teks, response.count_video, response.count_soal]);
						chart.setTitle(null, { text: dateStart +' - '+ dateEnd});
						// chart.redraw();
					}
				});
			})
		});
	});
</script>
</body>
</html>