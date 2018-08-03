<?php include('header_dashboard.php'); ?>

		<!-- slider mapel  2017-08-14 -->

		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
    	<link href="<?php echo base_url('assets/dashboard/css/responsive-lpi.css'); ?>" rel="stylesheet">


		<div class="breadcrumb-container">
			<ol class="breadcrumb text-center">
				<li><a href="<?php echo base_url("") ?>">Dashboard</a></li>
				<li><a href="<?php echo base_url("agcutest") ?>">AGCU Test</a></li>
				<li><a href="<?php echo base_url("user/tryout") ?>">Try Out</a></li>
				<li><a href="<?php echo base_url("user/tryoutsiswa/1"); ?>">Analisis Try Out</a></li>
				<li class="active"><a href="<?php echo base_url("user/download_konten"); ?>">Download Konten</a></li>

			 <!--    <li><a href="<?php echo base_url("user/tryoutsiswa"); ?>/<?php echo $try; ?>">">Analisis Try Out</a></li> -->
			</ol>
		</div>

		<section class="download-konten">
			<div class="container">
				<div class="row">
					<div class="panel-group stat-wrapper container">
						<div class="panel panel-default">
							<div class="panel-heading row">
								<div class="slider-nav">
									<?php
									foreach ($konten_download_kat as $konten_download_kat_key => $konten_download_kat_val) {
										?>
											<div class="mapel_link_detail" data-konten-show="<?php echo $konten_download_kat_val->id;?>">
												<img src="<?php echo base_url().'assets/uploads/konten_download/'.$konten_download_kat_val->gambar;?>" alt="<?php echo $konten_download_kat_val->id; ?>">

										<?php
											echo "<span>".$konten_download_kat_val->kategori_konten_download."</span>";
										?>
											</div>

										<?php
									}; ?>
								</div>
							</div>
							<div class="panel-body">
								<p><strong>Materi Download</strong></p>
								<div class="slider-for">
								</div>
							</div>

							<div class="clearfix"></div>

							<div class="panel-footer"></div>

						</div>
					</div>
				</div>
			</div>
		</section>



		<?php include('footer.php'); ?>




		<!-- SCRIPT JS -->
		<!-- jquery footer dihapus -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

		<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/dashboard/js/jquery.matchHeight.js'); ?>"></script>


		<!-- slider mapel  2017-08-14 -->
		<!-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
		<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/slick/slick.min.js'); ?>"></script>

		<script>
			// yang ditampilkan
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});

			 // navigasinya
			$('.slider-nav').slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						infinite: true
						}
					},
					{
						breakpoint: 767,
						settings: {
						slidesToShow: 2,
						slidesToScroll: 1
						}
					},
					{
						breakpoint: 600,
						settings: {
						slidesToShow: 2,
						slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
						slidesToShow: 1,
						slidesToScroll: 1
						}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			});
		</script>


		<!-- AJAX DATA  -->
		<script type="text/javascript">

			//fungsi untuk melihat data-konten-show yang memiliki value terkecil (bisa untuk max juga)
			function minMaxKontenshow(selector) {
			  var min=null, max=null;
			  $(selector).each(function() {
			    var id = parseInt($(this).attr('data-konten-show'), 10);
			    if ((min===null) || (id < min)) { min = id; }
			    if ((max===null) || (id > max)) { max = id; }
			  });
			  return min;
			  /*
			  https://stackoverflow.com/questions/14775921/get-the-highest-and-lowest-values-of-a-certain-attribute-in-jquery-or-javascript
			  */
			}

			$(function () {
				$('.mapel_link_detail').matchHeight();
			});

			$(document).ready(function () {
				//pemanggilan data-konten-show terkecil
				$(".slider-for").load("download_konten_mapeldetail/"+minMaxKontenshow('.mapel_link_detail'));
				$(".mapel_link_detail").click(function () {
					$(".slider-for").load("download_konten_mapeldetail/"+$(this).attr('data-konten-show'));
				});
			});
			
		</script>


		<style>
			.slick-list{
				padding:0 !important;
			}
		</style>
	</body>
</html>