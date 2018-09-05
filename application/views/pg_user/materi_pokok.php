<!DOCTYPE html>
<html lang="en" class="fullpage-login-html">
<head>
    <title>Karisma Academy - Sertifikasi Online</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
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
<?php $_SESSION['RedirectKe'] = current_url(); ?>
<body>
<!-- Sidebar Menu -->
<div class="overlay"></div>
<nav id="sidebar">
    <div id="wrap-sidebar">
        <div id="dismiss">
            <span class="ti-close"></span>
        </div>

        <div class="sidebar-header">
            <img src="<?php echo base_url('assets/pg_user/images/header-logo.png') ?>" width="250px" height="38px" alt="Karisma Academy">
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
                        <li class="dropdown">
                            <?php
                            if(!$this->session->userdata("pretest_logged_in") AND $this->session->userdata("siswa_logged_in")){ ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=($this->session->userdata('siswa_nama')!=NULL ? $this->session->userdata('siswa_nama') : "Anonim");?> <span class="arrow-down ti-angle-down"></span></a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Akun</a></li>
                                    <li><a href="<?=base_url('profil') ?>">Profil</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            <?php
                            }else if($this->session->userdata("pretest_logged_in")){ ?>
                                <a href="<?=base_url("pretest/logout")?>">Logout (<?=($this->session->userdata('pretest_nama')!=NULL ? $this->session->userdata('pretest_nama') : "Anonim");?>)</a>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header> <!-- END OF HEADER -->

<?php $data = $kelas ?>
<section class="banner-top banner-materi darker"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?=(isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) && substr($data->gambar_mapel,0,5) == 'data:' ? $data->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $data->nama_mapel ?></h1>
                <h3>Created by <a href="#">Muhammad Nur Alfiyan</a> <a class="button">Contact</a></h3>
                <span><b><?= $data->alias_kelas ?></b> Karisma Academy</span>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<!-- Cek apakah sudah pernah membaca sebelumnya atau belum -->
<?php

// 180824 - Rendy
$jumlahPretest = 0;
foreach ($materi as $key){
    //hitung jumlah pretest
    if($key->pretest_status) $jumlahPretest++;
}
// $siswa_status == hak akses premium atau tidak
if($this->session->userdata("siswa_logged_in") AND $siswa_status){
    //reset kondisi
    $jumlahPretest = 1;
}
//jika materi ada
if(isset($key->id_materi_pokok)){
    //jika jumlah pretest lebih dari 1 / reset dari status premium
    if ($jumlahPretest>0){
        //jika telah dibaca
        if($baca_total!=0){
            $persen_baca = ($baca_total / $materi_total) * 100;
            $persen_baca = round($persen_baca, 1);
        ?>
            <section class="banner-bottom" style="background: #90BB35;"> <!-- BANNER-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 banner-left">
                            <h1>Lanjutkan Belajar</h1>
                            <span>Selesaikan belajar anda untuk memperdalam materi pelajaran ini</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?=$persen_baca;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$persen_baca;?>%">
                                </div>
                                <b><?=$persen_baca;?>%</b>
                            </div>
                        </div>
                        <div class="col-md-4 banner-right">
                            <a class="btn-continue" href="<?= base_url("konten/detail_soal/".$key->id_materi_pokok) ?>">Lanjutkan</a>
                        </div>
                    </div>
                </div>
            </section> <!-- End of BANNER-->
        <?php
        //jika belum dibaca
        }else{ ?>
            <section class="banner-top" style="background: #F58634; margin-top: 0;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 banner-left">
                            <h1>Ayo mulai belajar dengan kami</h1>
                            <span>dan diskusi langsung dengan instruktur</span>
                        </div>
                        <div class="col-md-4 banner-right">
                            <a href="<?= base_url("konten/mapel/".$key->mapel_id) ?>">Mulai Belajar</a>
                        </div>
                    </div>
                </div>
            </section> <!-- End of BANNER-->
        <?php }
    }else{
    //jika materi sepenuhnya perlu akses premium
    ?>

        <section class="banner-top" style="background: #cc3434; margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 banner-left">
                        <h1>Mohon maaf, materi berikut hanya berlaku bagi pengguna <b>Premium</b></h1>
                        <span>Daftar sekarang dan daftar sebagai siswa premium</span>
                    </div>
                    <div class="col-md-4 banner-right">
                        <a href="<?= base_url("signup") ?>" style="color:#cc3434 !important;">Mulai Daftar</a>
                    </div>
                </div>
            </div>
        </section> <!-- End of BANNER-->
    <?php
    }
}else{
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
        if (isset($materi) AND $materi != NULL){
        ?>

        <div class="row">
            <div class="col-md-5">
                <h1>Materi <?= $data->nama_mapel ?></h1>
            </div>
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                        $no = 1;
                        foreach ($materi as $key) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a class="collapse"  role="button" data-toggle="collapse" data-parent="#accordion" href="#materi<?= $key->id_materi_pokok ?>">
                                    <i class="more-less glyphicon glyphicon-plus"></i> <?= $key->nama_materi_pokok ?> <?= (($key->pretest_status) ? "" : "<span class='ti-lock'></span>" ); ?></a>
                            </h4>
                        </div>
                        
                        <div id="materi<?= $key->id_materi_pokok ?>" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <?php
                                    foreach ($key->mapok as $bab) {
                                        if($bab->kategori == '2'){
                                            $link = "href='".base_url()."konten/detail_video/".$bab->id_sub_materi."'";
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

                                        } elseif ($bab->kategori == '1'){
                                            $link = "href='".base_url()."konten/detail/".$bab->id_sub_materi."'";
                                            $icon = "<i class='fa fa-align-left'></i>";
                                        } else {
                                            $link = "href='".base_url()."konten/detail_soal/".$bab->id_sub_materi."'";
                                            $icon = "<i class='fa fa-check-square-o'></i>";
                                        }
                                        //jika premium
                                        if(!$key->pretest_status){
                                            if($this->session->userdata("siswa_logged_in")){
                                                if($siswa_status < 1){
                                                    $link = "href='".base_url()."profil'";
                                                    $icon = "<i class='fa fa-lock'></i>";
                                                }
                                            }else if($this->session->userdata("pretest_logged_in")){
                                                $link = "href='".base_url()."login'";
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
        if(isset($mapel_lain)){ ?>

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
                                $linkmaterilain=base_url();
                                if($this->session->userdata("pretest_logged_in")){
                                    $linkmaterilain .= "pretest/";
                                }
                                $linkmaterilain .= 'mapel/'.$data->id_mapel;
                            ?>
                            <a href="<?= $linkmaterilain; ?>">
                                <span class="badge-diskon">Diskon 25%</span>
                                <img src="<?=(isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) && substr($data->gambar_mapel,0,5) == 'data:' ? $data->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>" alt="<?= $data->nama_mapel ?>" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <h3><?= $data->nama_mapel ?> . . .</h3>
                                    <p>Pelajari lebih lanjut ...</p>
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

<?php include('footer.php'); ?>
</body>
</html>
