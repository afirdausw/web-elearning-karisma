<?php
$judul_tab = "Profil Siswa";

include('header.php');
?>

<section class="banner-top banner-materi banner-profil darker"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= base_url('assets/pg_user/images/foto-siswa/siswa.jpg'); ?>" alt="Foto Profil Siswa">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $siswa->nama_siswa ?></h1>
                <h3>Akun Regular</h3>
                <span>Mengikuti kelas <b>Web Design</b> di Karisma Academy</span>
                <p>
                    <a class="button button-link"><i class="fa fa-credit-card"></i> Daftar Premium</a>
                    <a class="button button-link"><i class="fa fa-thumbs-o-up"></i> Nilai Kami</a>
                </p>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<section class="wrap-deskripsi wrap-profil"> <!-- konten -->
    <div class="container">
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-6">
                    <h1>Profil</h1>
                </div>
            </div><!-- End of Row  -->
            <div class="row">
                <div class="col-md-12">
                    <p>Jenis Kelamin</p>
                    <h4>Laki-laki</h4>
                </div>
                <div class="col-md-12">
                    <p>Tempat, Tanggal Lahir</p>
                    <h4><?= $siswa->tempat_lahir.", ".date('d-m-Y', strtotime($siswa->tanggal_lahir)) ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Alamat</p>
                    <h4><?= $siswa->alamat ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Pekerjaan</p>
                    <h4><?= $siswa->pekerjaan ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Nomor Telepon</p>
                    <h4><?= $siswa->telepon ?></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="row">
                <div class="col-md-6">
                    <h1>Akun</h1>
                </div>
                <div class="col-md-12">
                    <p>Username</p>
                    <h4><?= $siswa->username ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Email</p>
                    <h4><?= $siswa->email ?></h4>
                </div>
                <div class="col-md-12">
                    <p>Tanggal Mendaftar</p>
                    <h4><?= $siswa->timestamp ?></h4>
                </div>
            </div><!-- End of Row  -->
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h1>Riwayat Pembelajaran</h1>
                </div>
                <div class="col-md-12">
                    <p>Empty</p>
                    <?= $history ?>
                </div>
            </div><!-- End of Row  -->
        </div>
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
