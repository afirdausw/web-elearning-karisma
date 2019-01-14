<?php
$data = $kelas;
$judul_tab = "Materi ";
if (isset($data->nama_mapel)) {
    $judul_tab .= $data->nama_mapel;
}

$this->load->view('pg_user/inc/header.php');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<section class="banner-top banner-materi darker"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= (isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) ? base_url() . 'image/mapel/' . $data->gambar_mapel : base_url() . 'assets/pg_user/images/icon/no-image.jpg') : base_url() . 'assets/pg_user/images/icon/no-image.jpg') ?>">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $data->nama_mapel ?></h1>
                <h3>Created by
                    <?php if (isset($instruktur) && count($instruktur) > 0 && $instruktur != null): ?>
                        <a target="_blank"
                           href="<?= base_url('instruktur/' . $instruktur[0]->id_instruktur) ?>"><?= $instruktur[0]->nama_instruktur ?></a>
                        <a class="button" href="tel:<?= $instruktur[0]->telepon ?>">Contact</a>
                        <?php
                    else: ?>
                        <a>Karisma Academy</a> <a class="button">Contact</a>
                        <?php
                    endif; ?>
                </h3>
                <span><b><?= $data->alias_kelas ?></b> Karisma Academy</span>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<!-- Cek apakah sudah pernah membaca sebelumnya atau belum -->
<?php

// 180824 - Rendy
$jumlahPretest = 0;
foreach ($materi as $key) {
    //hitung jumlah pretest
    if ($key->pretest_status) $jumlahPretest++;
}
// $siswa_status == hak akses premium atau tidak
if ($this->session->userdata("siswa_logged_in") AND $siswa_status) {
    //reset kondisi
    $jumlahPretest = 1;
}
//jika materi ada
if (isset($materi[0]->id_materi_pokok)) {
    //jika jumlah pretest lebih dari 1 / reset dari status premium
    if ($jumlahPretest > 0) {
        //jika telah dibaca
        if ($baca_total != 0) {
            $persen_baca = ($baca_total / $materi_total) * 100;
            $persen_baca = round($persen_baca, 1);
            ?>
            <section class="banner-bottom" style="background: #90BB35;"> <!-- BANNER-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 banner-left">
                            <h1>Lanjutkan Belajar</h1>
                            <span>Selesaikan belajar anda untuk memperdalam materi pelajaran ini</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $persen_baca; ?>"
                                     aria-valuemin="0" aria-valuemax="100" style="width:<?= $persen_baca; ?>%">
                                </div>
                                <b><?= $persen_baca; ?>%</b>
                            </div>
                        </div>
                        <div class="col-md-6 banner-right">

                            <a class="btn-continue"
                               href="<?= base_url("konten/detail_soal/" . $key->id_materi_pokok) ?>">Lanjutkan</a>
                        </div>
                    </div>
                </div>
            </section> <!-- End of BANNER-->

            <?php
            //jika belum dibaca
        } else { ?>
            <section class="banner-top mt-0 pb-3" style="background: #F58634;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 banner-left">
                            <h1>Ayo mulai belajar dengan kami</h1>
                            <span>dan diskusi langsung dengan instruktur</span>
                        </div>
                        <div class="col-md-6 banner-right row <?= (isset($_SESSION['siswa_logged_in']) && $_SESSION['siswa_logged_in']) ? "mt-4" : "" ?> ">
                            <div class="col-md-8 text-right mr-0  <?= (isset($_SESSION['siswa_logged_in']) && $_SESSION['siswa_logged_in']) ? "mt-5" : "" ?>">
                                <h3 class="text-white mt-1 mb-2 font-w700">Rp. <?= money($data->harga) ?></h3>
                                <h4 class="text-gray text-line-through mt-1 mb-2 font-w700">
                                    Rp. <?= money($data->harga) ?></h4>
                            </div>
                            <div class="col-md-4 ml-0">
                                <a class="mb-3" href="<?= base_url("konten/mapel/" . $key->mapel_id) ?>">Coba
                                    Pretest</a>
                                <?php
                                if ((isset($_SESSION['siswa_logged_in']) && $_SESSION['siswa_logged_in'])) {
                                    $mapel = $this->Model_Cart->getCartByIdSiswaIdMapel($_SESSION['id_siswa'], $key->mapel_id);
                                    if (count($mapel) <= 0) { ?>
                                        <a href="<?= base_url('keranjang/add/' . $key->mapel_id) ?>">Mulai Belajar</a>
                                    <?php } else { ?>
                                        <a href="#">Go To Cart</a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- End of BANNER-->
        <?php }
    } else {
        //jika materi sepenuhnya perlu akses premium
        ?>

        <section class="banner-top" style="background: #cc3434; margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 banner-left">
                        <h1>Mohon maaf, materi berikut hanya berlaku bagi pengguna <b>Premium</b></h1>
                        <span>Daftar sekarang dan daftar sebagai siswa premium</span>
                    </div>
                    <div class="col-md-6 banner-right">
                        <div class="col-md-8 text-right mr-0">
                            <h3 class="text-white mt-1 mb-2 font-w700">Rp. <?= money($data->harga) ?></h3>
                            <h4 class="text-gray text-line-through mt-1 mb-2 font-w700">
                                Rp. <?= money($data->harga) ?></h4>
                        </div>
                        <div class="col-md-4 ml-0">
                            <a href="<?= base_url("signup") ?>" style="color:#cc3434 !important;">Mulai Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- End of BANNER-->
        <?php
    }
} else {
    //jika materi tidak ada di db
    ?>

    <section class="banner-top" style="background: #cc3434; margin-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 banner-left">
                    <h1>Mohon maaf, materi <b>belum tersedia</b></h1>
                    <span>Kami akan segera memperbaharui materi ini</span>
                </div>
                <div class="col-md-4 banner-right">
                    <a href="<?= base_url() ?>" style="color:#cc3434 !important;">Kembali ke menu utama</a>
                </div>
            </div>
        </div>
    </section> <!-- End of BANNER-->
    <?php
} ?>

<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>Deskripsi</h1>
            </div>
            <div class="col-md-12">
                <?= $data->deskripsi_mapel ?>
            </div>
        </div><!-- End of Row  -->

        <?php
        if (isset($materi) AND $materi != NULL) {
            ?>

            <div class="row">
                <div class="col-md-5">
                    <h1>Materi <?= $data->nama_mapel ?></h1>
                </div>
                <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- MATERI PRE -->
                        <?php
                        $no = 1;
                        foreach ($materi_pre as $key) {
                            ?>


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a class="collapse" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#materi<?= $key->id_materi_pokok ?>">
                                            <i class="more-less glyphicon glyphicon-plus"></i> <?= $key->nama_materi_pokok ?> <?= (($key->pretest_status) ? "" : "<span class='ti-lock'></span>"); ?>
                                        </a>
                                    </h4>
                                </div>

                                <div id="materi<?= $key->id_materi_pokok ?>" class="panel-collapse collapse"
                                     role="tabpanel">
                                    <div class="panel-body">
                                        <?php
                                        foreach ($key->sub_materi as $bab) {
                                            if ($bab->kategori == '2') {
                                                $link = "href='" . base_url() . "konten/detail_video/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-youtube'></i>";
                                            } elseif ($bab->kategori == '1') {
                                                $link = "href='" . base_url() . "konten/detail/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-align-left'></i>";
                                            } else {
                                                $link = "href='" . base_url() . "konten/detail_soal/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-check-square-o'></i>";
                                            }
                                            //jika premium
                                            if (!$key->pretest_status) {
                                                if ($this->session->userdata("siswa_logged_in")) {
                                                    if ($siswa_status < 1) {
                                                        $link = "href='" . base_url() . "profil' title='Konten ini hanya untuk siswa premium'";
                                                        $icon = "<i class='fa fa-lock'></i>";
                                                    }
                                                } else if ($this->session->userdata("pretest_logged_in")) {
                                                    $link = "href='" . base_url() . "login'";
                                                    $icon = "<i class='fa fa-lock'></i>";
                                                }

                                            }
                                            ?>
                                            <div class="media">
                                                <a <?= $link; ?>>
                                                    <div class="media-left"><?= $icon ?></div>
                                                    <div class="media-body">
                                                        <p><?= $bab->nama_sub_materi ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> <!-- panel-group -->
                        <?php } ?>
                        <!-- MATERI FREE/BUY -->
                        <?php
                        $no = 1;
                        foreach ($materi as $key) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a class="collapse" role="button" data-toggle="collapse"
                                           data-parent="#accordion" href="#materi<?= $key->id_materi_pokok ?>">
                                            <i class="more-less glyphicon glyphicon-plus"></i> <?= $key->nama_materi_pokok ?> <?= (($key->pretest_status) ? "" : "<span class='ti-lock'></span>"); ?>
                                        </a>
                                    </h4>
                                </div>

                                <div id="materi<?= $key->id_materi_pokok ?>" class="panel-collapse collapse"
                                     role="tabpanel">
                                    <div class="panel-body">
                                        <?php
                                        foreach ($key->mapok as $bab) {
                                            if ($bab->kategori == '2') {
                                                $link = "href='" . base_url() . "konten/detail_video/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-youtube'></i>";
                                                // echo '
                                                //         <div class="modal modal-center fade" id="'.$bab->id_konten.'" role="dialog">
                                                //             <div class="modal-dialog modal-dialog-center" style="width: 70%">
                                                //                 <div class="modal-content modal-content-youtube">
                                                //                     <div class="modal-header">
                                                //                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                //                         <h4 class="modal-judul">'.$bab->nama_sub_materi.'</h4>
                                                //                     </div>
                                                //                     <div class="wrap-video embed-responsive embed-responsive-16by9">
                                                //                         <iframe class="embed-responsive-item" src="'.$bab->video_materi.'?rel=0&controls=0&showinfo=0" allowfullscreen></iframe>
                                                //                     </div>
                                                //                 </div>
                                                //             </div>
                                                //         </div>';

                                            } elseif ($bab->kategori == '1') {
                                                $link = "href='" . base_url() . "konten/detail/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-align-left'></i>";
                                            } else {
                                                $link = "href='" . base_url() . "konten/detail_soal/" . $bab->id_sub_materi . "'";
                                                $icon = "<i class='fa fa-check-square-o'></i>";
                                            }
                                            //jika premium
                                            if (!$key->pretest_status) {
                                                if ($this->session->userdata("siswa_logged_in")) {
                                                    if ($siswa_status < 1) {
                                                        $link = "href='" . base_url() . "profil'";
                                                        $icon = "<i class='fa fa-lock'></i>";
                                                    }
                                                } else if ($this->session->userdata("pretest_logged_in")) {
                                                    $link = "href='" . base_url() . "login'";
                                                    $icon = "<i class='fa fa-lock'></i>";
                                                }

                                            }
                                            ?>
                                            <div class="media">
                                                <a <?= $link; ?>>
                                                    <div class="media-left"><?= $icon ?></div>
                                                    <div class="media-body">
                                                        <p><?= $bab->nama_sub_materi ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> <!-- panel-group -->
                        <?php } ?>
                    </div>
                </div>
            </div><!-- End of Row  -->

            <?php
        }
        ?>

        <?php
        if (isset($mapel_lain)){ ?>

        <div class="row">
            <div class="col-md-4">
                <h1>Materi Lainnya</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php foreach ($mapel_lain as $data) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="thumbnail materi-lainnya">
                            <?php
                            $linkmaterilain = base_url();
                            if ($this->session->userdata("pretest_logged_in")) {
                                $linkmaterilain .= "pretest/";
                            }
                            $linkmaterilain .= 'mapel/' . $data->id_mapel;
                            ?>
                            <a href="<?= $linkmaterilain; ?>">
                                <span class="badge-diskon">Diskon 25%</span>
                                <img src="<?= (isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) ? base_url() . 'image/mapel/' . $data->gambar_mapel : base_url() . 'assets/pg_user/images/icon/no-image.jpg') : base_url() . 'assets/pg_user/images/icon/no-image.jpg') ?>"
                                     alt="<?= $data->nama_mapel ?>" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <h4><?= $data->nama_mapel ?></h4>
                                    <h5 class="text-right font-size-h2 mt-5"><span>Rp. <?= money($data->harga) ?></span>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div><!-- End of Row  -->
    </div>

    <?php
    }
    ?>
</section> <!-- End of konten-->

<?php $this->load->view('pg_user/inc/footer.php'); ?>
</body>
</html>
