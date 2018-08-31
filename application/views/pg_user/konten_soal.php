<!DOCTYPE html>
<html lang="en" class="fullpage-login-html">
<head>
    <title>Karisma Academy - Sertifikasi Online</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/themify-icons.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/font-awesome.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/responsive.css'); ?>">
</head>

<body>
<?php
// Pengaturan waktu countdown
// if(isset($_SESSION['mulai_waktu'])){
//     $telah_berlalu = time() - $_SESSION["mulai_waktu"];
// } else {
//     $_SESSION["mulai_waktu"] = date("r",strtotime($log["start"]));
//     $telah_berlalu = 0;
// }

// $waktu_quiz = date("r",strtotime($log['finish']));
// $waktu_sisa = $waktu_quiz - $telah_berlalu;

// Session halaman sebelumnya ketika sudah login
$_SESSION['RedirectKe'] = current_url();


$status_finish = 0;
$nilai = (float)0.0;
$waktu_quiz = (float)0.0;
$jam = (float)0.0;
// Pengaturan waktu countdown
if (isset($log) AND $log != NULL) {
    $telah_berlalu = time() - strtotime($log->start);
    $nilai = $log->nilai;
    if ($log->finish_ujian != NULL) {
        $status_finish = 1;
    }

} else {
    $telah_berlalu = 0;
}
foreach ($soal as $s) {
    if ($s->waktu_soal != 0 || $s->waktu_soal != NULL) {
        $jam = $s->waktu_soal;
    } else {
        $jam = 90;
    }
    $waktu_quiz = $jam * 60;
}
$waktu_sisa = $waktu_quiz - $telah_berlalu;
if ($waktu_sisa < 0) {
    $waktu_sisa = 0;
    $status_finish = 1;
}
?>
<!-- Sidebar Menu -->
<div class="overlay"></div>
<nav id="sidebar">
    <div id="wrap-sidebar">
        <div id="dismiss">
            <span class="ti-close"></span>
        </div>

        <div class="sidebar-header">
            <img src="<?php echo base_url('assets/pg_user/images/header-logo.png') ?>" width="250px" height="38px"
                 alt="Karisma Academy">
        </div>

        <ul class="list-unstyled components">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Kelas</a></li>
            <li><a href="#">Quiz</a></li>
            <li><a href="#">Tanya Jawab</a></li>
        </ul>
    </div>
</nav> <!-- Sidebar Menu -->

<header class="top-header"> <!-- HEADER -->
    <div class="container">
        <nav class="navbar navbar-default navbar-custom" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <button type="button" id="sidebarCollapse" class="open-sidebar">
                        <span class="ti-menu"></span>
                    </button>
                    <a class="navbar-brand logo" href="<?php echo base_url(); ?>"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Aktifitas</a></li>
                        <li><a href="#">Peserta</a></li>
                        <li><a href="#">Tanya Jawab</a></li>
                        <li><a href="#">Quiz</a></li>

                        <?php
                        $idsiswa = $this->session->userdata('id_siswa');
                        if ($idsiswa != NULL) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><?= $siswa->nama_siswa ?> <span
                                            class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Akun</a></li>
                                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        <?php } else {
                            if ($this->session->userdata('pretest_logged_in')) {
                                $idsiswa = $this->session->userdata('pretest_id'); ?>
                                <li><a href="<?= base_url("pretest/logout") ?>">Logout Pretest
                                        (<?= ($this->session->userdata('pretest_nama') != NULL ? $this->session->userdata('pretest_nama') : "Anonim"); ?>)</a></li>
                                <?php
                            } else { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false">Login <span class="arrow-down ti-angle-down"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo base_url() . 'signup' ?>">Daftar</a></li>
                                        <li><a href="<?php echo base_url() . 'login' ?>">Login</a></li>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>

                            <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header> <!-- END OF HEADER -->

<section> <!-- konten-->
    <div class="container fixed-top">
        <div class="row">
            <!-- Sub Materi Kanan -->
            <div class="col-lg-4 col-md-5 col-sm-5 panel-group panel-group-konten" style="float: right" >
                <span class="judul-header">Materi</span>
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

                    //variable on class
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
                            <a class="collapsed"  href="#bab<?= $no; ?>" role="button" data-toggle="collapse">
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

            <div class="col-lg-8 col-md-7 col-sm-7 materi" style="float: left">
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

                <!-- WRAP ISI MATERI -->
                <div class="row" style="text-align: center">
                    <div class="col-lg-12">
                        <img src="<?php echo base_url('assets/pg_user/images/icon-soal.png') ?>" width="552px"
                             class="img-soal"/><br>
                        <?php
                        $pretest = $key->pretest_status;
                        ?>
                        <?php
                        if ($this->session->userdata('id_siswa') != NULL OR $this->session->userdata('pretest_id') != NULL) { ?>
                            <button id="mulai" data-toggle="modal" href="#soal" type="button" class="btn
							<?php if ($test_jum == 0) {
                                echo 'btn-primary';
                            } else {
                                echo 'btn-success';
                            } ?> btn-md">
                                <?php if ($test_jum == 0) { ?>
                                    <i class="ti-check-box"></i> Mulai Quiz
                                <?php } else { ?>
                                    <i class="ti-control-forward"></i> Lanjutkan
                                <?php } ?>
                            </button>
                            <?php
                        } else if ($this->session->userdata('id_siswa') == NULL || $this->session->userdata('pretest_id') == NULL) { ?>
                            <a href="<?= base_url(); ?>login">
                                <button type="button" class="btn btn-default btn-md" id="mulai">
                                    <i class="ti-lock"></i> Login untuk memulai
                                </button>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="row hidden" id="nilaiContainer">
                    <div>Nilai Anda</div>
                    <span class="nilainya">
                		10
                	</span>
                </div>
                <dialog id="timeUp">Waktu mengerjakan sudah selesai, tekan <b>esc</b> untuk menutup pesan ini!</dialog>


                <!-- MODAL -->
                <div class="modal multi-step modal-quiz modal-center fade" id="soal">
                    <div class="modal-dialog modal-dialog-quiz">
                        <div id="progressBar">
                            <div class="bar"></div>
                        </div>
                        <div class="modal-content modal-content-quiz">
                            <div class="modal-header">
                                <div class="quiz-waktu">
                                    <i class="ti-time"></i>
                                    <span id="timer">-</span>
                                </div>
                                <h4 class="modal-judul"><i
                                            class="ti-check-box"></i>&nbsp;&nbsp;<b>Quiz <?= $sub_materi->id_sub_materi ?></b> <?= $sub_materi->nama_sub_materi ?>
                                </h4>
                            </div>
                            <?php
                            $no = 1;
                            foreach ($soal as $value) {
                                $id_soal = $value->id_soal;
                                $inc_terjawab = 0;
                                $array_terjawab = [];


                                if (isset($data_jawaban)) {
                                    foreach ($data_jawaban as $dj) {
                                        if ($dj->soal_id == $id_soal) {
                                            $array_terjawab[$inc_terjawab] = $dj->jawaban;
                                        } else {
                                            $array_terjawab[$inc_terjawab] = 0;
                                        }
                                        $inc_terjawab++;
                                    }
                                }
                                ?>
                                <div class="modal-body modal-konten step-<?= $no ?>" data-step="<?= $no ?>">
                                    <div class="row">
                                        <div class="col-md-7 pertanyaan">
                                            <span class="badge">Soal <?= $no ?> dari <?= $jumlah ?></span>
                                            <p><?= $value->isi_soal ?></p>
                                        </div>
                                        <div class="col-md-5 jawaban">
                                            <div class="row">
                                                <span class="badge">Pilihan</span>
                                            </div>
                                            <div class="row">
                                                <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 1) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option1" autocomplete="off"
                                                           value="1"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 1) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>A.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_1);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 2) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option2" autocomplete="off"
                                                           value="2"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 2) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>B.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_2);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 3) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option3" autocomplete="off"
                                                           value="3"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 3) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>C.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_3);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 4) {
                                                        echo "active";
                                                    }
                                                } ?>">
                                                    <input type="radio" name="jawabSoal" id="option4" autocomplete="off"
                                                           value="4"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 4) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>D.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_4);
                                                    echo $text;
                                                    ?>
                                                </label>
                                                <label class="btn btn-primary btn-block <?php if (isset($data_jawaban)) {
                                                    if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 5) {
                                                        echo "active";
                                                    }
                                                } ?>">

                                                    <input type="radio" name="jawabSoal" id="option5" autocomplete="off"
                                                           value="5"
                                                           soal-no="<?= $id_soal; ?>" <?php if (isset($data_jawaban)) {
                                                        if (isset($array_terjawab[$no - 1]) AND $array_terjawab[$no - 1] == 5) {
                                                            echo "checked='checked'";
                                                        }
                                                    } ?>><span>E.</span> <?php $text = str_ireplace('<p>', '', $value->jawab_5);
                                                    echo $text;
                                                    ?>
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++;
                            } ?>
                            <div class="modal-footer" style="text-align: center">
                                <div class="col-md-12">
                                    <ul class="pagination">
                                        <li class="prev"><a href="javascript:prev_m();"><i
                                                        class="fa fa-chevron-left"></i></a></li>
                                        <?php
                                        $no = 1;
                                        foreach ($soal as $value) {
                                            ?>
                                            <li id="page-<?= $no ?>"><a href="#"
                                                                        onclick="hal(<?= $no ?>)"><?= $no ?></a>
                                            </li>
                                            <?php $no++;
                                        } ?>
                                        <li class="next"><a href="javascript:next_m();"><i
                                                        class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="finalButton" class="col-md-12 text-center hidden" style="margin-top: 10px">
                                    <button class="btn btn-block btn-success"><span
                                                class="glyphicon glyphicon-ok"></span> Selesai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- WRAP DETAIL MATERI -->
                <?php $data = $materi ?>
                <div class="row wrap-detail-materi">
                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right">
                        <img class="centered-cover" src="<?= $materi->gambar_mapel ?>" alt="Logo Materi">
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
                            if (!empty($prev) || !empty($prev_mapok)) {
                                if (!empty($prev)) {
                                    $prev = $prev;
                                } elseif (!empty($prev_mapok)) {
                                    $prev = $prev_mapok;
                                }
                                $prev_url = "#";
                                if ($prev->kategori == "1") {
                                    $prev_url = base_url('konten/detail/' . $prev->id_konten);
                                }
                                if ($prev->kategori == "2") {
                                    $prev_url = base_url('konten/detail_video/' . $prev->id_konten);
                                }
                                if ($prev->kategori == "3") {
                                    $prev_url = base_url('konten/detail_soal/' . $prev->id_konten);
                                }

                                echo '<li><a href="' . $prev_url . '" title="' . $prev->nama_sub_materi . '" class="prev-materi"><span class="ti-angle-left"></span> Sebelumnya</a></li>';
                            }
                            ?>

                            <?php
                            if (!empty($next) || !empty($next_mapok)) {
                                if (!empty($next)) {
                                    $next = $next;
                                } elseif (!empty($next_mapok)) {
                                    $next = $next_mapok;
                                }
                                $next_url = "#";
                                if ($next->kategori == "1") {
                                    $next_url = base_url('konten/detail/' . $next->id_konten);
                                }
                                if ($next->kategori == "2") {
                                    $next_url = base_url('konten/detail_video/' . $next->id_konten);
                                }
                                if ($next->kategori == "3") {
                                    $next_url = base_url('konten/detail_soal/' . $next->id_konten);
                                }

                                echo '<li><a href="' . $next_url . '" title="' . $next->nama_sub_materi . '" class="next-materi">Selanjutnya <span class="ti-angle-right"></span></a></li>';
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
<script src="<?php echo base_url('assets/pg_user/js/my-multi-modal.js'); ?>"></script>
<script src="<?php echo base_url('assets/pg_user/js/jquery.plugin.js'); ?>"></script>
<script src="<?php echo base_url('assets/pg_user/js/jquery.countdown.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<?php if ($this->session->userdata('pretest_logged_in')) {
    $idsiswa = $this->session->userdata('pretest_id');
}
?>

<script type="text/javascript">
    var cur = 1;
    $('#soal').on('shown.bs.modal', function () {
        hal(cur);
    });
    var ttl = <?= count($soal) ?>;
    var next = (cur + 1) > ttl ? ttl : (cur + 1);
    var prev = (cur - 1) < 1 ? 1 : (cur - 1);

    function hal(i) {
        $('li#page-' + cur).removeClass('active');
        cur = i;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (i ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    function next_m() {
        $('li#page-' + cur).removeClass('active');
        cur = next;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (cur ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    function prev_m() {
        $('li#page-' + cur).removeClass('active');
        cur = prev;
        $('li#page-' + cur).addClass('active');
        $('#soal').trigger('next.m.' + cur);
        next = (cur + 1) > ttl ? ttl : (cur + 1);
        prev = (cur - 1) < 1 ? 1 : (cur - 1);

        if (cur ==<?= $jumlah ?>) {
            $('#finalButton').removeClass('hidden');
        } else {
            $('#finalButton').addClass('hidden');
        }
    }

    sendEvent = function (sel, step) {
        $('#soal').trigger('next.m.' + step);
    }

    // Progressbar
    function progress(timeleft, timetotal, $element) {
        // var progressBarWidth = timeleft * $element.width() / timetotal
        var progressBarWidth = timeleft / timetotal * $element.width();
        $element.find('div').animate({width: progressBarWidth}, timeleft == timetotal ? 0 : 1000, 'linear');

        if (timeleft > 0) {
            setTimeout(function () {
                progress(timeleft - 1, timetotal, $element);
            }, 1000);
        }
    };

    // Timer start
    var sisa_waktu = <?= $waktu_quiz ?> - <?= $telah_berlalu ?>;
    $(document).ready(function () {
        if ((<?= $waktu_quiz ?> - <?= $telah_berlalu ?>) < 0 || <?=$status_finish;?>== 1) {
            $("#mulai").removeClass("btn-success").addClass("btn-danger");
            $("#mulai").attr('disabled', 'disabled');
            $("#mulai").html("<i class='glyphicon glyphicon-minus-sign'></i> Waktu Habis");
            $("#soal").remove();
            $("body").addClass("modal-open");
            document.getElementById("timeUp").showModal();
            $("#nilaiContainer").removeClass("hidden").addClass("text-center");
            $("#nilaiContainer span.nilainya").html("<?=$innerHTMLnya?>");
        }
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27 && <?=$status_finish;?>== 1) {
            $("body").removeClass("modal-open");
        }
    });
    $("#mulai").click(function () {
        <?php
        if($idsiswa != NULL){
        ?>
        var currentURL = 'http://' + window.location.hostname + window.location.pathname;
        var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);

        $.ajax({
            url: "<?=base_url();?>konten/start_soal/" + idSubMateri,
            success: function (result) {
                $("#mulai").html("<i class='ti-control-forward'></i> Lanjutkan");
                $("#mulai").removeClass("btn-primary").addClass("btn-success");
            }
        });


        progress(<?= $waktu_sisa ?>, <?= $waktu_quiz ?>, $('#progressBar'));

        <?php //$telah_berlalu ?>
        $("#timer").countdown({
            until: sisa_waktu,
            compact: true,
            format: 'MS',
            onTick: hampirHabis,
            onExpiry: waktuHabis,
            // expiryUrl: ''
        });
        <?php
        }
        ?>

    });

    function hampirHabis(periods) {
        if ($.countdown.periodsToSeconds(periods) <= 60) {
            $(this).css({color: "red"});
        }
    }

    function waktuHabis() {
        document.getElementById("timeUp").showModal();

        window.location.reload(true);
    }


    $("#finalButton").click(function () {
        bootbox.confirm({
            message: "Apakah anda yakin untuk mengakhiri soal?",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Ya, saya yakin',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-times"></i> Tidak',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    var currentURL = 'http://' + window.location.hostname + window.location.pathname;
                    var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);
                    $.ajax({
                        type: 'POST',
                        url: "<?=base_url();?>konten/end_soal/" + idSubMateri + "/",
                        success: function (result) {
                            alert("Selesai");
                            window.location.reload(true);
                        }
                    });
                }
            }
        });
    })


    //SOAL

    $("input[name='jawabSoal']").change(function () {
        var currentURL = 'http://' + window.location.hostname + window.location.pathname;
        var idSubMateri = currentURL.substr(currentURL.lastIndexOf('/') + 1);
        $.ajax({
            type: 'POST',
            url: "<?=base_url();?>konten/submit_jawab/" + idSubMateri + "/" + $(this).attr("soal-no") + "/" + this.value,
            success: function (result) {
                alert(result);
            }
        });
    });
</script>
</body>
</html>

<!-- TO-DO -->
<!-- 
	Waktu habis langsung menampilkan nilai
	Jawaban mengubah nilai
 -->
