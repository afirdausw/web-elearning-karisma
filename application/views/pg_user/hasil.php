<?php
$judul_tab = "Hasil Quiz";

include('header.php');
?>
<?php if($konten == ""){ ?>


<section class="banner-top banner-quiz-hasil" style="margin-bottom: 30px;"> <!-- BANNER-->
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Silahkan Pilih</h1>
                <span>Pilihan terdapat pada dropdown di bawah</span>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->
<section> <!-- konten-->
    <div class="container">
        <div class="row">
            <div class="input-group">
                <select name="id_submateri" class="form-control" id="id_submateri">
                <?php
                foreach($log_ujian as $log) {?>
                    <option value="<?=$log->sub_materi_id?>" ><?=$log->nama_sub_materi." (".$log->sub_materi_id.")"?></option>
                <?php
                } ?>
                </select>
                <span class="input-group-btn">
                    <input type="button" class="btn btn-primary" onClick="window.location.href='<?=base_url()?>'+'hasil/'+id_submateri.value;" value="Cek nilai">
                </span>
            </div>
        </div>
    </div>
</section>

<?php } else if($konten != ""){ ?>
<style type="text/css">
.mCSB_inside>.mCSB_container{
    margin:0 !important;
}
.mCSB_scrollTools{
    width:2.5%;
}
</style>

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
            <div class="input-group">
                <select name="id_submateri" class="form-control" id="id_submateri">
                <?php
                foreach($log_ujian as $log) {?>
                    <option value="<?=$log->sub_materi_id?>" <?=($log->sub_materi_id==$konten->sub_materi_id) ? "selected" : "" ?>><?=$log->nama_sub_materi." (".$log->sub_materi_id.")"?></option>
                <?php
                } ?>
                </select>
                <span class="input-group-btn">
                    <input type="button" class="btn btn-primary" onClick="window.location.href='<?=base_url()?>'+'hasil/'+id_submateri.value;" value="Cek nilai">
                </span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- Sub Materi Kiri -->
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="float: left">
                <div class="row wrap-quiz">
                    <div class="col-lg-7 col-md-7">
                        <h1>Quiz 1 <?= $konten->nama_sub_materi ?></h1>
                        <div class="row">
                            <table class="table table-my table-striped">
                                <tbody>
                                <tr>
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
                                </tr>
                                </tbody>
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
                                <td width='30%'><a href="<?php echo base_url() . "quiz/riwayat" ?>">22 Jun 2018 at 11.14
                                        WIB</a></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-riwayat progress-merah" role="progressbar"
                                             style="width:60%">
                                            <span>60%</span>
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
                        <h3>Hasil Test</h3>

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
                        <img class="centered-cover"
                             src="<?= (isset($konten->gambar_mapel) ? (!empty($konten->gambar_mapel) && substr($konten->gambar_mapel, 0, 5) == 'data:' ? $konten->gambar_mapel : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>"
                             alt="Logo Materi">
                    </div>
                    <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
                        <h3><?= $konten->nama_mapel ?></h3>
                        <span class="badge">12 Materi</span>
                        <span class="badge">50 Peserta</span>
                        <p>Oleh <a href="">Putra Daroini</a> . 12/02/2018</p>
                    </div>
                </div>
            </div>

            <!-- Peserta Kanan -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 tab-peserta" style="float: right">
                <span class="judul-header">
                    Hasil Test
                    <p>dari 10 peserta di Kelas</p>
                </span>
                <div id="tab-peserta-isi">
                    <ul class="peserta-list">
                        <?php foreach ($siswa_quiz as $data) { ?>
                            <li style="cursor:default;">
                                    <div class="wrap-left">
                                        <span class="blue"><?= substr($data->nama_siswa, 0, 1) ?></span>
                                    </div>
                                    <div class="wrap-center">
                                        <?= $data->nama_siswa ?>
                                        <p>pada <?= date('H:i, d-m-Y', strtotime($data->timestamp)) ?></p>
                                    </div>
                                    <span class="nilai"><?= str_replace(".", "", substr($data->nilai, 0, 2)) ?></span>
                                </li>
                        <?php } ?>
                        <!--
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="blue">N</span>
                            </div>
                            <div class="wrap-center">
                                Nur Rohman
                                <p>at 20 November 2017</p>
                            </div>
                            <span class="nilai">85</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <img class="user-male" src="<?php echo base_url('assets/pg_user/images/user-male.png') ?>">
                            </div>
                            <div class="wrap-center">
                                Agus Budiyanto
                                <p>at 18 Desember 2017</p>
                            </div>
                            <span class="nilai">89</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="red">E</span>
                            </div>
                            <div class="wrap-center">
                                Elma
                                <p>8 January 2018</p>
                            </div>
                            <span class="nilai">82</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <img class="user-female" src="<?php echo base_url('assets/pg_user/images/user-female.png') ?>">
                            </div>
                            <div class="wrap-center">
                                Fitri Handayani
                                <p>15 February 2018</p>
                            </div>
                            <span class="nilai">84</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="blue">N</span>
                            </div>
                            <div class="wrap-center">
                                Nur Rohman
                                <p>at 20 November 2017</p>
                            </div>
                            <span class="nilai">85</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="blue">A</span>
                            </div>
                            <div class="wrap-center">
                                Agus Budiyanto
                                <p>at 18 Desember 2017</p>
                            </div>
                            <span class="nilai">89</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="red">E</span>
                            </div>
                            <div class="wrap-center">
                                Elma
                                <p>8 January 2018</p>
                            </div>
                            <span class="nilai">82</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="red">F</span>
                            </div>
                            <div class="wrap-center">
                                Fitri Handayani
                                <p>15 February 2018</p>
                            </div>
                            <span class="nilai">84</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="blue">N</span>
                            </div>
                            <div class="wrap-center">
                                Nur Rohman
                                <p>at 20 November 2017</p>
                            </div>
                            <span class="nilai">85</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="blue">A</span>
                            </div>
                            <div class="wrap-center">
                                Agus Budiyanto
                                <p>at 18 Desember 2017</p>
                            </div>
                            <span class="nilai">89</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="red">E</span>
                            </div>
                            <div class="wrap-center">
                                Elma
                                <p>8 January 2018</p>
                            </div>
                            <span class="nilai">82</span>
                        </a></li>
                        <li><a href="#">
                            <div class="wrap-left">
                                <span class="red">F</span>
                            </div>
                            <div class="wrap-center">
                                Fitri Handayani
                                <p>15 February 2018</p>
                            </div>
                            <span class="nilai">84</span>
                        </a></li>-->
                    </ul> <!-- End Peserta -->
                </div> <!-- End custom ScrollBar -->
            </div>
        </div>
    </div>
</section> <!-- End of konten-->

<?php } ?>

<?php include('footer.php'); ?>

<?php if($konten != ""){ ?>
<script>
    $("#tab-peserta-isi").mCustomScrollbar({
        setHeight:"200px",
        theme: "dark-thick",
        scrollbarPosition: "inside",
    });
</script>
}
<?php } ?>
</body>
</html>
