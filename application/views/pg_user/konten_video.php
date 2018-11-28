<?php
$judul_tab = $sub_materi->materi_pokok_id.".".$sub_materi->urutan_materi." ".$sub_materi->nama_sub_materi;
include('header.php');
?>

<section> <!-- konten-->
    <div class="container fixed-top">
        <div class="row">
            <!-- Sub Materi Kanan -->
            <div class="col-lg-4 col-md-5 col-sm-5 panel-group panel-group-konten" style="float: right" id="list-sub-materi">
                <span class="judul-header">Materi</span>
                <!-- Pretest Konten (IF exist) -->
                <?php
                foreach ($materi_pokok_pre as $data) {
                    $idsiswa = $this->session->userdata('id_siswa');

                    $disable_class = '';
                    $pretest_text = '';
                    $status_materi = $data->materi_status;
                    $user_akses = 3;
                    if ($status_materi == 'buy') {
                        if ($idsiswa == NULL) {
                            echo "<style>
                            .not-active {
                              pointer-events: none;
                              cursor: default;
                              color: grey !important;
                            }
                            </style>";
                            $pretest_text = "<span class='ti-lock' title='Login diperlukan'></i>";
                            $disable_class = ' not-active';
                            $user_akses = 0;
                            // 0 = tidak login dan pretest dilarang
                        } else {
                            $user_akses = 1;
                            // 1 = Login tapi tidak premium
                        }
                    }
                ?>
                <?php
                    //2018-08-31 Rendy
                    //Current Sidebar already collapsed
                    //Button Viewed = Glyphicon Plus or Min
                    //Toogle Sidebar = Ganti mode ditampilan atau tidak (in)
                    $id_mapok_cur       = $materi->id_materi_pokok;
                    $side_id_mapok      = $data->id_materi_pokok; //yang diulang

                    $button_viewed      = "glyphicon-plus";
                    $toogle_sidebar     = "";
                    if($id_mapok_cur == $side_id_mapok){
                        $button_viewed = "glyphicon-minus";
                        $toogle_sidebar = "in";
                    }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-konten" role="tab">
                        <h4 class="panel-title panel-title-konten">
                            <a class="collapsed"  href="#bab<?= $status_materi; ?>" role="button" data-toggle="collapse" data-parent="#list-sub-materi">
                                <i class="more-less glyphicon <?=$button_viewed?>"></i>
                                <b><?= $data->nama_materi_pokok ?></b>
                            </a>
                        </h4>
                    </div>
                    <div id="bab<?= $status_materi; ?>" class="panel-collapse collapse <?=$toogle_sidebar?>" role="tabpanel">
                        <div class="wrap-media-list">
                            <?php
                                foreach ($data->sub_materi as $bab) {
                                    if ($bab->kategori == '1') {
                                        $link = base_url() . 'konten/detail/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-align-left"></i>';
                                        $type = 'Tipe Teks';
                                    } elseif ($bab->kategori == '2') {
                                        $link = base_url() . 'konten/detail_video/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-youtube"></i>';
                                        $type = 'Tipe Video';
                                    } else {
                                        $link = base_url() . 'konten/detail_soal/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-check-square-o"></i>';
                                        $type = 'Tipe Soal';
                                    }
                                    if ($user_akses == 0) {
                                        $link = "#";
                                        $icon = '<i class="fa fa-lock"></i>';
                                    }
                                    /*
                                    DEBUG
                                    ---------*/
                                    // if($idsiswa != NULL){
                                    //     $konten = $link;
                                    // }else{
                                    //     $konten = '#';
                                    // }

                                    //Current materi link is not available and highlighted
                                    //bg_cur = highlighted html code
                                    $bg_cur = "";
                                    $id_sub_cur = $sub_materi->id_sub_materi;
                                    if($bab->id_sub_materi == $id_sub_cur){
                                        $bg_cur = "style='background:#26aed442;'";
                                        $link = "#";
                                    }
                            ?>
                            <a class="media-link<?= $disable_class ?>" href="<?= $link ?>">
                                <div class="media" <?=$bg_cur;?>>
                                    <div class="media-left">
                                        <?= $icon ?>
                                    </div>
                                    <div class="media-body">
                                        <span><?= $bab->urutan_materi ?>.</span>
                                        <h4><?= $bab->nama_sub_materi ?></h4>
                                        <small><?= $type ?></small>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- Free/Buy Konten -->
                <?php $no = 0;
                foreach ($materi_pokok as $data) {
                    $no++;
                    $idsiswa = $this->session->userdata('id_siswa');

                    $disable_class = '';
                    $pretest_text = '';
                    $pretest_stat = $data->pretest_status;
                    $user_akses = 3;
                    if ($pretest_stat == 0) {
                        if ($idsiswa == NULL) {
                            echo "<style>
                            .not-active {
                              pointer-events: none;
                              cursor: default;
                              color: grey !important;
                            }
                            </style>";
                            $pretest_text = "<span class='ti-lock' title='Login diperlukan'></i>";
                            $disable_class = ' not-active';
                            $user_akses = 0;
                            // 0 = tidak login dan pretest dilarang
                        } else {
                            $user_akses = 1;
                            // 1 = Login tapi tidak premium
                        }
                    }
                ?>
                <?php 
                    //2018-08-31 Rendy
                    //Current Sidebar already collapsed
                    //Button Viewed = Glyphicon Plus or Min
                    //Toogle Sidebar = Ganti mode ditampilan atau tidak (in)
                    $id_mapok_cur       = $materi->id_materi_pokok;
                    $side_id_mapok      = $data->id_materi_pokok; //yang diulang

                    $button_viewed      = "glyphicon-plus";
                    $toogle_sidebar     = "";
                    if($id_mapok_cur == $side_id_mapok){
                        $button_viewed = "glyphicon-minus";
                        $toogle_sidebar = "in";
                    }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-konten" role="tab">
                        <h4 class="panel-title panel-title-konten">
                            <a class="collapsed"  href="#bab<?= $no; ?>" role="button" data-toggle="collapse" data-parent="#list-sub-materi">
                                <i class="more-less glyphicon <?=$button_viewed?>"></i>
                                <b>BAB <?= $no ?> :</b> <?= $data->nama_materi_pokok ?> <?=$pretest_text;?>
                            </a>
                        </h4>
                    </div>
                    <div id="bab<?= $no; ?>" class="panel-collapse collapse <?=$toogle_sidebar?>" role="tabpanel">
                        <div class="wrap-media-list">
                            <?php
                                foreach ($data->sub_materi as $bab) {
                                    if ($bab->kategori == '1') {
                                        $link = base_url() . 'konten/detail/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-align-left"></i>';
                                        $type = 'Tipe Teks';
                                    } elseif ($bab->kategori == '2') {
                                        $link = base_url() . 'konten/detail_video/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-youtube"></i>';
                                        $type = 'Tipe Video';
                                    } else {
                                        $link = base_url() . 'konten/detail_soal/' . $bab->id_sub_materi;
                                        $icon = '<i class="fa fa-check-square-o"></i>';
                                        $type = 'Tipe Soal';
                                    }
                                    if ($user_akses == 0) {
                                        $link = "#";
                                        $icon = '<i class="fa fa-lock"></i>';
                                    }
                                    /*
                                    DEBUG
                                    ---------*/
                                    // if($idsiswa != NULL){
                                    //     $konten = $link;
                                    // }else{
                                    //     $konten = '#';
                                    // }

                                    //Current materi link is not available and highlighted
                                    //bg_cur = highlighted html code
                                    $bg_cur = "";
                                    $id_sub_cur = $sub_materi->id_sub_materi;
                                    if($bab->id_sub_materi == $id_sub_cur){
                                        $bg_cur = "style='background:#26aed442;'";
                                        $link = "#";
                                    }
                            ?>
                            <a class="media-link<?= $disable_class ?>" href="<?= $link ?>">
                                <div class="media" <?=$bg_cur;?>>
                                    <div class="media-left">
                                        <?= $icon ?>
                                    </div>
                                    <div class="media-body">
                                        <span><?= $bab->urutan_materi ?>.</span>
                                        <h4><?= $bab->nama_sub_materi ?></h4>
                                        <small><?= $type ?></small>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

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
                        <p>Oleh <a href="">Muhammad Nur Alfiyan</a> . 12/02/2018</p>
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
