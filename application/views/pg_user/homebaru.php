<?php include("header.php"); ?>

<style>
	#carouselAchievement{
		background:white;
	}
	#carouselAchievement ol.carousel-indicators{
		position: absolute;
    top: -3rem;
	}
	.section-abu .carousel ol.carousel-indicators li{
		border:none;
	}
	.section-abu .carousel ol.carousel-indicators li.active{
		background:#aaa;
	}
	.section-abu .carousel ol.carousel-indicators li:not(.active){
		background:#ddd;
	}

	.vertical-middle{
		display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
	}
	.vertical-middle>*{		
		display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
		flex-direction: column;
	}

	#carouselAchievement .panel-default{
		box-shadow: none;
		border:none;
	}
	

	/*
	Text Middle Line
	*/
	.group { 
		display: table;
		width: 50%;
		margin: 0 auto;
	} 
	.item {
		display: table-cell;
	}
	.text { 
		white-space: nowrap;
		width: 1%;
		padding: 0 10px;
	}
	.line {
		border-bottom: 1px solid #A5A5A5;
		position: relative;
		top: -.5em;
	}
</style>
<section class="banner-home">
    <div class="container">
        <div class="row">
            <h1>Kursus ONLINE<br>
                Website, Digital Marketing,<br>
                Desain grafis, &amp; Arsitektur Bersertifikasi</h1>
            <a href="<?php echo base_url() . 'signup' ?>">
                <button class="btn btn-info">Daftar Sekarang</button>
            </a>
            <a href="<?php echo base_url() . 'pretest' ?>">
                <button class="btn btn-warning">Coba Gratis</button>
            </a>
        </div>
    </div>
</section>


<section>
    <div class="section-abu">
        <div class="container">
            <h1>Prestasi dalam Bidang Informasi dan Teknologi</h1>
            <h2>Lihat semua konten di Karisma Academy lebih dari <span>500+</span> kelas yang tersedia</h2>
            <div class="row">
                <div class="w-75 mx-auto">
									<div id="carouselAchievement" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators my-0">
                    <?php
                    $prestasi = array(
											0 => [
												"title" => "Coba0",
												"icon" => "https://picsum.photos/50/50/?random&gravity=center",
												"detail" => "StartUp Digital Lenovo Do Network1",
												"penyelenggara" => "Lenovo0",
												"img" => "https://picsum.photos/580/380/?random&gravity=center",
											],
											1 => [
												"title" => "Coba1",
												"icon" => "https://picsum.photos/50/50/?gravity=center",
												"detail" => "StartUp Digital Lenovo Do Network2",
												"penyelenggara" => "Lenovo1",
												"img" => "https://picsum.photos/580/380/?gravity=center",
											],
										);
                    foreach ($prestasi as $key=>$value) {
                        ?>
														<li data-target="#carouselAchievement" data-slide-to="<?=$key?>" class="<?=($key==0?"active":"")?>"></li>
                    <?php } ?>
										</ol>
										<!-- Wrapper for slides -->
										<div class="carousel-inner">
											<?php
											foreach ($prestasi as $key=>$value) {
												?>
											<div class="item<?=($key==0?" active":"")?>">
												<div class="col-md-8 col-sm-12 p-0">
													<img src="<?="{$value['img']}"?>" alt="<?="{$value['title']}"?>" class="img-responsive w-100">
												</div>
												<div class="col-md-4 col-sm-12 py-5 text-center vertical-middle">
													<div>	
														<img src="<?="{$value['icon']}"?>" alt="<?="{$value['title']}"?>">
														<h3 class="clearfix"><?="{$value['title']}"?></h3>
													</div>
													<div>
														<i><b>"<?="{$value['detail']}"?>"</b>
														<br>(<?="{$value['penyelenggara']}"?>)</i>
													</div>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container home-materi-list">
        <h1>Kenapa Blended LEARNING I-KARISMAX Dapat Membantu Anda?</h1>
        <h2>Lihat konten Karisma Academy lebih dari <span>500+</span> kelas yang tersedia</h2>
        <div class="row">
					<?php
					 $alasan = array(
						0 => [
							"title" => "Instruktur",
							"icon" => "https://picsum.photos/500/500/?random&gravity=center",
							"detail" => "Instruktur SAMA PERSIS dengan kelas Reguler tatap muka di Karisma Academy",
						],
						1 => [
							"title" => "Materi",
							"icon" => "https://picsum.photos/500/500/?random&gravity=center",
							"detail" => "Materi SAMA PERSIS dengan kelas Reguler tatap muka di Karisma Academy",
						],
						2 => [
							"title" => "Sertifikat",
							"icon" => "https://picsum.photos/500/500/?random&gravity=center",
							"detail" => "Sertifikat SAMA PERSIS dengan kelas Reguler tatap muka di Karisma Academy",
						],
					);
					$colBagi = 12/count($alasan);

					foreach($alasan as $key=>$val){
					?>
						<div class="col-xs-<?=$colBagi?> col-md-<?=$colBagi?>">
							<div class="p-5">
								<img src="<?="{$val['icon']}"?>" alt="<?="{$val['title']}"?>" class="img-responsive" style="border-radius:100%;">
							</div>
							<h2 class="my-2"><b><?="{$val['title']}"?></b></h2>
							<p class="text-gray-3 m-0 text-center"><?="{$val['detail']}"?></p>
						</div>
					<?php } ?>         
        </div>
				<div class="clearfix"></div>
				<div class="col-md-12 font-italic text-center">
					<div class="row">
						<div class="group">
							<div class="item line"></div>
								<div class="item text">Bedanya:</div>
							<div class="item line"></div>
						</div>
					</div>
					<div class="row text-grey-2 font-weight-bold">
						"Anda bisa belajar darimana saja dengan harga 80% Lebih Efisien > Hanya 1 Harga untuk Puluhan Paket Kursus"
					</div>
				</div>   
    </div>

</section>

<section>
    <div class="section-abu">
        <div class="container">
            <h1>Apa itu Live Instruktur?</h1>
            <h2>Lihat konten Karisma Academy lebih dari <span>500+</span> kelas yang tersedia</h2>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                   <!-- 16:9 aspect ratio -->
									<div class="embed-responsive embed-responsive-16by9 mx-auto">
										<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/95q_npbZQ5o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="embed-responsive-item"></iframe>
									</div>
                </div>
            </div>
						<div class="row">
							<hr class="col-md-offset-1 col-md-10" style="border-color:inherit;">
						</div>
						<div class="row">
							<p class="col-md-offset-1 col-md-10 font-italic text-justify">
								Akan memastikan anda mudah menguasai Skill yang anda pelajari. Kapanpun anda bertanya pada masa Belajar, Instruktur akan menjawab secara realtime. Jika ada masalah dalam proses praktek anda, Instruktur akan LIVE mengkoreksi kesalahan Anda. Anda pun dapat berkomunitas dan berkomunikasi dengan murid dan alumni Karisma Academy. Instruktur LIVE Selasa s/d Jumat, pukul 13:00 s/d 21:00, Sabtu - Minggu Pukul 10:00 s/d 17:00.
							</p>
						</div>
        </div>
    </div>
</section>

<section>
    <div class="container home-materi-list" id="materi_list">
        <h1>Belajar Desain Grafis, Website, Digital Marketing, dan Arsitektur</h1>
        <h2>Lihat konten Karisma Academy lebih dari <span>500+</span> kelas yang tersedia</h2>
        <div class="row">
            <div class="col-md-12" style="text-align: center; clear: both" id="home_materi_pagination_top">
            </div>
        </div>
        <div class="row" id="home_list_materi"> <!-- BARIS KE 1 -->
						<?php
            foreach ($mapel as $value) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 pr-3 pl-3">
                    <div class="thumbnail materi-lainnya">
                        <a href="<?php echo base_url() . 'mapel/' . $value->id_mapel; ?>">
                            <!--                            <span class="badge-diskon">Diskon 25%</span>-->
                            <img style="border: 1px solid  #999;" src="<?= (isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) ? base_url() . 'image/mapel/' . $value->gambar_mapel : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>"
                                 alt="<?= $value->nama_mapel ?>">
                            <div class="caption">
                                <?php
                                if (strlen($value->nama_mapel) >= 20) {
                                    $mapel = substr($value->nama_mapel, 0, 15) . " . . .";
                                } else {
                                    $mapel = $value->nama_mapel;
                                }
                                ?>
                                <a href="<?= base_url() . 'kelas/' . $value->kelas_id; ?>" class="badge-kelas">
                                    <?= $value->alias_kelas ?>
                                </a>
                                <div class="w-100">
                                    <div class="title w-75 pull-left">
                                        <h4><?= $mapel ?></h4>
                                    </div>
                                    <div class="title w-25 pull-right text-right">
                                        <span class="badge font-size-h5"
                                              style="background-color:rgb(245, 134, 52); padding: 7px 20px;"> 7 Sesi</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <p class="m-t-2 font-size-md"
                                   style="padding-right: 5rem !important;font-style: italic;">
                                    Instruktur, Materi & Sertifikat sama persis Kelas Regular tatap muka di Karisma
                                    Academy
                                </p>
                                <hr style="border-top: 1px solid  #999"/>
                                <div class="w-100 font-size-h1 mt-5 container-fluid">
                                    <div class="row m-0">
                                        <div class="col-md-2 col-sm-6 p-0">
                                            <div class="glyphicon glyphicon-heart pull-left py-3" title="Tambah Kursus '<?=$value->nama_mapel?>' ke WISHLIST"></div>
                                        </div>                                        
                                        <div class="col-md-3 col-sm-6 p-0">
                                            <?php
                                            $link = "";
                                            if ((isset($_SESSION['siswa_logged_in']) && $_SESSION['siswa_logged_in'])) {
                                                $mapel = $this->Model_Cart->getCartByIdSiswaIdMapel($_SESSION['id_siswa'], "{$value->id_mapel}");
                                                if (count($mapel) <= 0) { 
                                                    $link = base_url("keranjang/add/{$value->id_mapel}");
                                                } else {
                                                    $link =  base_url("keranjang/");
                                                } ?>
                                            <?php }else{
                                                $link = base_url("login");
                                            }?>
                                            <a class="btn btn-primary btn-lg btn-block" title="Tambahkan ke Cart" href="<?=$link?>"><i class="fa fa-cart-plus"></i></a>
                                        </div>
                                        <div class="col-md-7 col-sm-12 text-right p-0">
                                            <span class="font-size-h4 text-gray mr-3">  * mulai dari </span>
                                            <span style="color: #93bc3a">Rp. <?= money($value->harga) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> <!-- END OF BARIS KE 1 -->

        <div class="row">
            <div class="col-md-12" style="text-align: center; clear: both" id="home_materi_pagination_bot">
            </div>
        </div>

        <div class="row">
            <div id="content"></div>
        </div>
    </div>

</section>


<section>
    <div class="section-abu">
        <div class="container">
            <h1>Apa kata mereka tentang Karisma Academy?</h1>
            <h2>Dengarkan pengalaman mereka belajar online dengan Karisma Academy</h2>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach ($testimoni as $testi) {
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header"
                                         style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg1.png'); ?>)">
                                        <span><?= $testi->id_siswa ?></span>
                                    </div>
                                    <span class="card-profile">S</span>
                                    <div class="card-text">
                                        <p>“<?= $testi->testimoni ?>”</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container partner">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <h1>Partner Kami</h1>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 text-center">
                <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-ic3.png'); ?>" alt="IC3"></a>
                <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-vedc.png'); ?>" alt="VEDC"></a>
                <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-ub.png'); ?>" alt="UB"></a>
                <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-um.png'); ?>" alt="UM"></a>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>

</body>
<script  type="text/javascript"
	src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script type="text/javascript"
				src="https://cdn.rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
				
				

<script>
		$(function() {			
			$('#carouselAchievement .item > div').matchHeight();
		});
    var base_url = "<?= base_url() ?>";
    // init bootpag
    $('#home_materi_pagination_top,#home_materi_pagination_bot').bootpag({
        total: <?=ceil($jumlah_mapel / $limit);?>,
        page: 1,
        maxVisible: <?=$limit?>,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function (event, /* page number here */ num) {
        var url = base_url + "home/ajax_load_listmapel/<?= $limit ?>/" + num;
        bnner = $("section.banner-home");
        lst = $("#home_list_materi");
        nav = $("nav.navbar");
        $("html, body").animate({scrollTop: bnner.height() - nav.height()}, "slow");
        $.ajax({
            url: url,
            success: function (result) {
                lst.html(result);
            }
        });
    });
</script>
</html>
