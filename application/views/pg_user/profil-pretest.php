<?php
$judul_tab = "Profil Pretest";

$this->load->view('pg_user/inc/header.php');
?>
<?php
    if(empty($log_baca)){
?>
<section class="banner-top" style="background: #F58634;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Ayo mulai belajar dengan kami</h1>
                <span>dan diskusi langsung dengan instruktur</span>
            </div>
            <div class="col-md-4 banner-right">
                <a href="<?= base_url('pretest/mapel') ?>">Pilih Mapel</a>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->
<?php } else { ?>
<section class="banner-top" style="background: #90BB35;"> <!-- BANNER-->
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Lanjutkan Belajar</h1>
                <span>Selesaikan belajar anda untuk memperdalam materi pelajaran ini</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">
                    </div>
                    <b>10%</b>
                </div>
            </div>
            <div class="col-md-4 banner-right">
                <a class="btn-continue" href="#">Lanjutkan</a>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->
<?php } ?>

<section class="banner-top banner-materi banner-profil darker"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= base_url('assets/pg_user/images/foto-siswa/siswa.jpg'); ?>" alt="Foto Profil Siswa">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $pretest->nama_siswa_pretest ?></h1>
                <h3>Siswa Pretest</h3>
                <span>Mengambil pretest <b>Web Design</b> dengan materi <b>HTML</b> di Karisma Academy</span>
                <p>
                    <a class="button button-link" href="<?=base_url('hasil/pretest')?>"><i class="fa fa-bar-chart"></i> Hasil Quiz</a>
                    <a class="button button-link" href="#"><i class="fa fa-thumbs-o-up"></i> Nilai Kami</a>
                </p>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<section class="wrap-deskripsi wrap-profil"> <!-- konten -->
    <div class="container">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <h1>Profil</h1>
                </div>
            </div><!-- End of Row  -->
            <div class="row">
                <div class="col-md-12">
                    <p>Email</p>
                    <h4><?= $pretest->email_siswa_pretest ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Alamat</p>
                    <h4><?= $pretest->alamat ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Waktu Mendaftar</p>
                    <h4><?= date('H:i, d-m-Y', strtotime($pretest->timestamp_signup)) ?></h4>
                </div>
            </div>
        </div>
<!--         <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-6">
                    <h1>Akun</h1>
                </div>
            </div>
        </div> -->
    </div>
</section> <!-- End of konten-->

<?php $this->load->view('pg_user/inc/footer.php'); ?>
</body>
</html>
