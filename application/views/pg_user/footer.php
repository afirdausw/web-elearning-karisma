<section id="bawah">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 sosial-icon" align="center">
				<a href="#">
					<i class="fa fa-facebook"></i>
				</a>
				<a href="#">
					<i class="fa fa-instagram"></i>
				</a>
				<a href="#">
					<i class="fa fa-twitter"></i>
				</a>
				<a href="#">
					<i class="fa fa-google-plus"></i>
				</a>
				<a href="#">
					<i class="fa fa-youtube-play"></i>
				</a>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-lg-1" style="margin-right:45px"></div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 center-block">
				<i class="fa fa-envelope"></i>&nbsp; Email
				<br><br>
				<p>info@karismaacademy.com</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 center-block">
				<i class="fa fa-map-marker"></i>&nbsp; Alamat Kantor
				<br><br>
				<p>Jl. Watu Gong No.18, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 center-block">
				<i class="fa fa-phone"></i>&nbsp; Kontak
				<br><br>
				<p>(0341) 2995599</p>
				<p>085 731 444 767</p>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="container">
		<div class="row vertical-middle">
			<div class="col-lg-8 col-md-7 col-sm-5 col-xs-2 vertical-middle">
				<a class="logo-footer" href="#" ></a>
				<span class="hidden-xs" style="margin-left: 20px">&copy; 2018 All Right Reserved</span>
			</div>
			<div class="col-lg-4 col-md-5 col-sm-7 col-xs-10 text-right">
				<a href="#">Syarat dan Ketentuan</a>
				<a href="#">Privasi</a>
				<a href="#">Kontak</a>
				<a href="#">Media</a>
			</div>
		</div>
	</div>
</footer>

<a href="#navtop">
	<div class="to-top" id="to-top">
		<span class="glyphicon glyphicon-arrow-up" style="position:absolute;top:33%;left:30%;"></span>
	</div>
</a>

<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.CustomScrollbar.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/my-sidebar.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/my-collapse.js');?>"></script>

<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});
</script>

<script type="text/javascript">
<?php
if($this->uri->segment(1) == ''){ ?>
	height = $('.top-header').height();
	$( window ).on( "load", function() {
		$(".top-header").next().css("padding-top", height);
	});
	$( window ).resize(function() {
		height = $('.top-header').height();
		$(".top-header").next().css("padding-top", height);
	});
<?php } ?>
	window.onload = function() {scrollFunction()};
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
			document.getElementById("to-top").style.display = "block";
		} else {
			document.getElementById("to-top").style.display = "none";
		}
	}
	$(document).on('click', 'a[href="#navtop"]', function (event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top,
		}, 500);
	});
</script>
