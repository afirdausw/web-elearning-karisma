<?php
$judul_tab = "Kelas ";
if (isset($kelas->alias_kelas)) {
    $judul_tab .= $kelas->alias_kelas;
}

include('header.php');
?>
<section class="banner-top" style="background: #90BB35;"> <!-- BANNER-->
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Daftar Sekarang GRATIS</h1>
                <span>diskusi langsung dengan instruktur</span>
            </div>
            <div class="col-md-4 banner-right">
                <a href="#">Start Learn</a>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->
<?php $background = (isset($kelas->gambar_kelas) ? (!empty($kelas->gambar_kelas) ? base_url() . 'image/kelas/' . $kelas->gambar_kelas : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>
<section class="banner-materi darker" style="background-image: url('<?= $background ?>')"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= (isset($kelas->gambar_kelas) ? (!empty($kelas->gambar_kelas) ? base_url() . 'image/kelas/' . $kelas->gambar_kelas : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $kelas->alias_kelas ?></h1>
                <h3>Karisma Academy</h3>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Deskripsi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <?= (isset($kelas->deskripsi_kelas) && $kelas->deskripsi_kelas != '' ? $kelas->deskripsi_kelas : 'Ini adalah kelas dari kelompok kursus ' . $kelas->alias_kelas) ?>
            </div>
        </div><!-- End of Row  -->

        <div class="row">
            <div class="col-md-5">
                <h1>Kelas <?= $kelas->alias_kelas ?></h1>
            </div>
        </div>
        <div class="row">
            <?php
            if ($mapel != NULL) { ?>
                <?php foreach ($mapel as $data) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thumbnail materi-lainnya">
                            <a href="<?= base_url() . 'materi/' . $data->id_mapel ?>">
                                <!-- <span class="badge-diskon">Diskon 25%</span> -->
                                <div class="mapel-image">
                                    <img src="<?= (isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) ? base_url() . 'image/mapel/' . $data->gambar_mapel : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>"
                                        alt="Thumbnail Kursus <?= $data->nama_mapel ?>">
                                </div>
                                <div class="caption">
                                    <h4><?= $data->nama_mapel ?></h4>
                                    <h5 class="text-right font-size-h2 mt-5"><span>Rp. <?= money($data->harga) ?></span></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php
            } else { ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="thumbnail text-center">
                        <!-- <span class="badge-diskon">Diskon 25%</span> -->
                        <div class="caption text-center" style="display:table;margin:0 auto;">
                            <h3 style="vertical-align:middle;display:table-cell;">Daftar Kelas Tidak Ada</h3>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div><!-- End of Row  -->
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>