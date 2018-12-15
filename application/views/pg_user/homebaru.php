<?php include("header.php"); ?>
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
                                            <div class="glyphicon glyphicon-heart pull-left py-3"></div>
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
    <div class="section-qoutes">
        <div class="container">
            <h1>Apa kata mereka tentang Karisma Academy?</h1>
            <h2>Dengarkan pengalaman mereka belajar online dengan Karisma Academy</h2>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    foreach ($testimoni as $testi) {
                        ?>
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
                    <!--
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header" style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg2.png'); ?>)">
                                        <span>Adinda Dinda</span>
                                    </div>
                                    <span class="card-profile">A</span>
                                    <div class="card-text">
                                        <p>“Saya kursus disini punya ketertarikan sendiri karena di karisma watu kursusnya sangat fleksibal, saya pulang kerja bisa langsung belajar, tentor proffesional”</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header" style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg1.png'); ?>)">
                                        <span>Dinda Adinda</span>
                                    </div>
                                    <span class="card-profile">D</span>
                                    <div class="card-text">
                                        <p>“Saya kursus disini punya ketertarikan sendiri karena di karisma watu kursusnya sangat fleksibal, saya pulang kerja bisa langsung belajar, tentor proffesional”</p>
                                    </div>
                                </a>
                            </div>
                        </div>-->
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

<script type="text/javascript"
        src="https://cdn.rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>

<script>
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
