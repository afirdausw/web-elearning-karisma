<?php
    $judul_tab = "Hasil Quiz Pretest";

    $this->load->view('pg_user/inc/header.php');
?>

<section class="banner-top banner-quiz-hasil" style="margin-bottom: 30px;"> <!-- BANNER-->
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Selamat, Test ini sudah dikerjakan</h1>
                <span>Untuk melanjutkan belajar, klik tautan disamping</span>
            </div>
            <div class="col-md-4 banner-right">
                <a href="#">Lanjutkan Belajar</a>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->

<section> <!-- konten-->
    <div class="container">
        <div class="row">
            <!-- Sub Materi Kiri -->
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="float: left">
                <div class="row wrap-quiz">
                    <div class="col-lg-7 col-md-7">
                        <h1>Quiz 1 Materi Apa itu HTML</h1>
                        <div class="row">
                            <table class="table table-my table-striped">
                                <tbody><tr>
                                    <td width='35%'>Instruktur</td>
                                    <td>: <a href="#"> Guru 1</a></td>
                                </tr>
                                <tr>
                                    <td>Durasi</td>
                                    <td>: 90 Menit</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Soal</td>
                                    <td>: 4 Soal</td>
                                </tr>
                                <tr>
                                    <td>Jenis Soal</td>
                                    <td>: Pilihan Ganda</td>
                                </tr></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <h1>Progress</h1>
                        <div class="archive-group">
                            <span class="active">Melihat</span>
                            <span class="active">Mengerjakan</span>
                            <span>Coba 100 Kali</span>
                        </div>
                        <br/>
                        <button class="btn btn-quiz btn-block">
                            <i class="fa fa-check-square-o"></i> Mulai mengerjakan
                        </button>
                        <span class="archive-nb">
                            * Test ini telah anda kerjakan, Anda bisa mencoba ulang ini tanpa mengubah Hasil Test anda
                        </span>
                        <br/>
                    </div>
                </div>

                <div class="row wrap-konten"> <!-- KONTEN RIWAYAT -->
                    <div class="col-lg-9 col-md-10">
                        <h3>Riwayat</h3>
                        <span>Untuk melihat detail jawaban dan pertanyaan, anda bisa klik tanggal progressnya</span>

                        <table class="table table-riwayat table-striped">
                            <tbody>
                            <tr>
                                <td width='30%'><a href="<?php echo base_url()."quiz/riwayat" ?>">22 Jun 2018 at 11.14 WIB</a></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-riwayat progress-hijau" role="progressbar" style="width:80%">
                                            <span>80%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!--<tr>
                                <td><a href="#">24 Feb 2018 at 20.00 WIB</a></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-riwayat progress-merah" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:65%"></div>
                                        <span>65</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#">28 Feb 2018 at 14.00 WIB</a></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-riwayat progress-hijau" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:75%"></div>
                                        <span>75</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#">01 Feb 2018 at 19.00 WIB</a></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-riwayat progress-hijau" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"></div>
                                        <span>80</span>
                                    </div>
                                </td>
                            </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div> <!-- END OF KONTEN RIWAYAT -->

                <div class="row wrap-konten"> <!-- KONTEN HASIL -->
                    <div class="col-lg-12">
                        <h3>Hasil PreTest</h3>

                        <!--<table class="table table-hasil hasil-merah">-->
                        <table class="table table-hasil hasil-hijau">
                            <thead>
                            <tr>
                                <th colspan="2" style="text-align: center">Pertanyaan</th>
                                <th width='35%'>Jawaban</th>
                                <th width='10%'>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $jumsoal=0;
                            $benar  =0;
                            foreach ($soal as $data) {$jumsoal++;}
                            foreach ($soal as $data) {
                                ?>
                                <tr class="<?= $data->jawaban != $data->kunci_jawaban ? "null" : ""?>">
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $data->isi_soal ?></td>
                                    <?php $kolom_jawaban = "jawab_" . $data->jawaban; ?>
                                    <td><?= $data->$kolom_jawaban ?></td>
                                    <?php
                                        if($data->jawaban == $data->kunci_jawaban) $benar++;
                                    ?>
                                    <td align='center'><b><?= $data->jawaban != $data->kunci_jawaban ? "0" : round(1/$jumsoal*100,2,PHP_ROUND_HALF_UP) ?></b></td>
                                </tr>
                            <?php
                            }
                            $nilai = round($benar/$jumsoal*100, 2, PHP_ROUND_HALF_UP);
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">Nilai Total</td>
                                <td></td>
                                <td><b><?= $nilai ?></b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> <!-- END OF KONTEN HASIL -->

                <!-- WRAP DETAIL MATERI -->
                <div class="row wrap-detail-materi">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right">
                        <img class="centered-cover" src="<?php echo base_url('assets/js/plugins/kcfinder/upload/images/html.jpg') ?>" alt="Logo Materi">
                    </div>
                    <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
                        <h3>Apa itu HTML</h3>
                        <span class="badge">12 Materi</span>
                        <span class="badge">50 Peserta</span>
                        <p>Oleh <a href="">Putra Daroini</a> . 12/02/2018</p>
                    </div>
                </div>
            </div>

            <!-- Peserta Kanan -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="float: right">
                <span class="judul-header">
                    Hasil PreTest
                    <p>dari 4 peserta di Kelas</p>
                </span>

                <ul class="peserta-list">
                    <?php foreach ($pretest_nilai as $data){ ?>
                        <li style="cursor:default;">
                            <div class="wrap-left">
                                <span class="blue"><?= substr($data->nama_siswa_pretest, 0,1) ?></span>
                            </div>
                            <div class="wrap-center">
                                <?= $data->nama_siswa_pretest ?>
                                <p>pada <?= date('H:i, d/m/Y', strtotime($data->finish)) ?></p>
                            </div>
                            <span class="nilai"><?= str_replace(".","",substr($data->nilai, 0, 2)) ?></span>
                        </li>
                    <?php } ?>
                </ul> <!-- End Peserta -->
            </div>
        </div>
    </div>
</section> <!-- End of konten-->

<?php $this->load->view('pg_user/inc/footer.php'); ?>
</body>
</html>
