<?php
$judul_tab = $sub_materi->materi_pokok_id.".".$sub_materi->urutan_materi." ".$sub_materi->nama_sub_materi;
include('header.php');
?>

<section> <!-- konten-->
    <div class="container fixed-top">
        <div class="row">
            <!-- Sub Materi Kanan -->
            <?php include("konten-sidebar.php");?>

            <?php $isi = $konten; ?>
            <div class="col-lg-8 col-md-7 col-sm-7 materi" style="float: left">
                <div class="wrap-video embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= $isi->video_materi ?>?rel=0" allowfullscreen></iframe>
                </div>

                <!-- WRAP JUDUL MATERI -->
                <?php $key = $sub_materi; ?>
                <div class="row wrap-materi">
                    <div class="col-lg-7 col-md-7">
                        <span class="materi-no"><?= $key->urutan_materi ?>.</span>
                        <span class="judul-submateri"><?= $key->nama_sub_materi ?></span>
                    </div>
                    <div class="col-lg-5 col-md-5 wrap-button-materi">
                        <button class="btn btn-default">
                            <span class="ti-more-alt"></span> Pertanyaan
                        </button>
                        <button class="btn btn-default">
                            <span class="ti-user"></span> Peserta
                        </button>
                    </div>
                </div>

                <!-- WRAP DETAIL MATERI -->
                <?php $data = $materi ?>
                <div class="row wrap-detail-materi">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right">
                        <a href="<?= base_url().'mapel/'.$materi->mapel_id ?>">
                            <img class="centered-cover" src="<?= base_url()?>/image/mapel/<?= $materi->gambar_mapel ?>" alt="Logo Materi">
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                        <h3><?= $data->nama_materi_pokok ?></h3>
                        <span class="badge">12 Materi</span>
                        <span class="badge">50 Peserta</span>
                        <p>Oleh
                            <?php if ($instruktur != null): ?>
                                <a href="<?= base_url('instruktur/' . $instruktur[0]->id_instruktur) ?>"
                                   target="_blank"><?= $instruktur[0]->nama_instruktur ?></a>
                            <?php else: ?>
                                <a href="#">Instruktur Karisma Academy</a>
                            <?php endif; ?>
                            . 12/02/2018</p>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                        <ul class="pager">
                            <?php
                                if(!empty($prev) || !empty($prev_mapok)){
                                    if (!empty($prev)) {
                                        $prev = $prev;
                                    } elseif (!empty($prev_mapok)) {
                                        $prev = $prev_mapok;
                                    }
                                    $prev_url = "#";
                                    if ($prev->kategori == "1") { $prev_url = base_url('konten/detail/' . $prev->id_konten); }
                                    if ($prev->kategori == "2") { $prev_url = base_url('konten/detail_video/' . $prev->id_konten); }
                                    if ($prev->kategori == "3") { $prev_url = base_url('konten/detail_soal/' . $prev->id_konten); }

                                    echo '<li><a href="'.$prev_url.'" title="'.$prev->nama_sub_materi.'" class="prev-materi"><span class="ti-angle-left"></span> Sebelumnya</a></li>';
                                }
                            ?>

                            <?php
                                if(!empty($next) || !empty($next_mapok)){
                                    if (!empty($next)) {
                                        $next = $next;
                                    } elseif (!empty($next_mapok)) {
                                        $next = $next_mapok;
                                    }
                                    $next_url = "#";
                                    if ($next->kategori == "1") { $next_url = base_url('konten/detail/' . $next->id_konten); }
                                    if ($next->kategori == "2") { $next_url = base_url('konten/detail_video/' . $next->id_konten); }
                                    if ($next->kategori == "3") {  $next_url = base_url('konten/detail_soal/' . $next->id_konten); }

                                    echo '<li><a href="'.$next_url.'" title="'.$next->nama_sub_materi.'" class="next-materi">Selanjutnya <span class="ti-angle-right"></span></a></li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
