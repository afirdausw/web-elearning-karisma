		<footer class="center clearfix" style="width:100%;background:#1BBC9B;" id="footer">
			<div class="footer-latihan">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin:25px 0;">
							<p class="white">Lembaga Pendidikan Islam Hidayatullah</p>
							<p class="white">&copy; 2017 LPIH. All Rights Reserved.</p>
						</div>
						<div class="col-lg-offset-3 col-md-offset-3 col-lg-4 col-md-4 hidden-sm hidden-xs pull-right"  style="margin-top:3%;">
							<ul class="footer-sosio pull-right">
								<li class="pull-left" style="margin-right:2%;"><p class="white">Sosial</p></li>
								<li class="pull-left">
									<a href="https://goo.gl/dMNgwj" target="blank">
										<span class="icon-sosio gplus"></span>
									</a>
									<a href="https://goo.gl/1L92Y9" target="blank">
										<span class="icon-sosio fb"></span>
									</a>
									<a href="https://goo.gl/cWgLAH" target="blank">
										<span class="icon-sosio twit"></span>
									</a>
									<a href="https://goo.gl/3p9ud4" target="blank">
										<span class="icon-sosio yt"></span>
									</a>
									<span class="icon-sosio insta"></span>
								</li>
							</ul>							
						</div>
					</div> <!-- end row1 -->
				</div> <!-- end container1 -->
			</div> <!-- end footer-bot -->
		</footer>




<!-- footer script -->

<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
	var contentHeight = jQuery(window).height();
	var footerHeight = jQuery('#footer').height();
	var footerTop = jQuery('#footer').position().top + footerHeight;
	if (footerTop < contentHeight) {
		jQuery('#footer').css('margin-top', 10+ (contentHeight - footerTop) + 'px');
	}
	});
</script>


