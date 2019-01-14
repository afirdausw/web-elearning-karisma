<?php
$judul_tab = "Pretest";
$this->load->view('pg_user/inc/header.php');
?>

<section>
    <div class="container home-materi-list" style="margin-top: 50px">
        <h1>Selamat datang,
            <b><?= ($this->session->userdata('pretest_nama') != NULL ? $this->session->userdata('pretest_nama') : "Anonim"); ?></b>
        </h1>
        <h1>Anda masuk sebagai siswa pretest di <b>Karisma Academy</b></h1>
        <h2 style="margin-bottom: 10px">Lihat konten Karisma Academy lebih dari <span>500+</span> kelas yang tersedia
        </h2>
        <h3>Dan segera bergabung dengan kami untuk melihat lebih banyak konten lainnya dan diskusi bersama</h3>

        <?= $this->session->flashdata('alert'); ?>

        <div class="line-text">
            <span style="font-size: 16px">Silakan pilih <b>Mata Pelajaran</b> yang ingin anda ikuti</span>
        </div>

        <div class="row" id="home_list_materi" style="margin-top: 40px"> <!-- BARIS KE 1 -->
            <?php
            //TODO SAMAKAN DENGAN controller home.php
            foreach ($mapel as $value) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail materi-lainnya">
                        <a href="<?php echo base_url() . 'pretest/mapel/' . $value->id_mapel; ?>">
                            <span class="badge-diskon">Diskon 25%</span>
                            <img src="<?= (isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) && substr($value->gambar_mapel, 0, 5) == 'data:' ? $value->gambar_mapel : base_url() . 'assets/pg_user/images/icon/no-image.jpg') : base_url() . 'assets/pg_user/images/icon/no-image.jpg') ?>"
                                 alt="<?= $value->nama_mapel ?>">
                            <div class="caption">
                                <?php
                                if (strlen($value->nama_mapel) >= 60) {
                                    $mapel = substr($value->nama_mapel, 0, strpos($value->nama_mapel, ' ', 50)) . " . . .";
                                } else {
                                    $mapel = $value->nama_mapel;
                                }
                                ?>
                                <a href="<?= base_url() . 'pretest/mapel/' . $value->id_mapel; ?>" class="badge-kelas">
                                    <?= $value->alias_kelas ?>
                                </a>
                                <h3><?= $mapel ?></h3>
                                <p>Pelajari lebih lanjut ...</p>
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

<?php $this->load->view('pg_user/inc/footer.php'); ?>
<!-- Validasi -->
<script type="text/javascript"
        src="<?php echo base_url('assets/plugins/form-validator/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/form-validator/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-steps/jquery.steps.min.js'); ?>"></script>
<script type="text/javascript"
        src="https://cdn.rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>

<script>
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
        bnner = $("section.banner-home");
        lst = $("#home_list_materi");
        nav = $("nav.navbar");
        $("html, body").animate({scrollTop: bnner.height() - nav.height()}, "slow");
        var url =
        $.ajax({
            url: "<?= base_url() ?>pretest/ajax_load_listmapel/"+<?=$limit?>+"/"+num,
            success: function (result) {
                lst.html(result);
            }
        });
    });
</script>
</body>
</html>
