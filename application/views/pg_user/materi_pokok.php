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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Firdaus <span class="arrow-down ti-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header> <!-- END OF HEADER -->

<?php $data = $kelas ?>
<?php foreach ($materi as $key); ?>
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

<section class="banner-bottom" style="background: #90BB35;"> <!-- BANNER-->
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-left">
                <h1>Lanjutkan Belajar</h1>
                <span>Selesaikan belajar anda untuk memperdalam pelajaran ini</span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                        Selesai <b>70%</b>
                    </div>
                </div>
            </div>
            <div class="col-md-4 banner-right">
                <a href="#">Lanjutkan</a>
            </div>
        </div>
    </div>
</section> <!-- End of BANNER-->

<!--<section class="banner-top">
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
</section>--> <!-- End of BANNER-->
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
                                <a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" href="#materi<?= $key->id_materi_pokok ?>">
                                    <i class="more-less glyphicon glyphicon-plus"></i> <?= $key->nama_materi_pokok ?>
                                </a>
                            </h4>
                        </div>
                        <div id="materi<?= $key->id_materi_pokok ?>" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <?php
                                    foreach ($key->mapok as $bab) {
                                        if($bab->kategori == '2'){
                                            $link = "data-toggle='modal' href='".base_url()."materi/#".$bab->id_konten."'";
                                            $icon = "<i class='fa fa-youtube'></i>";
                                            echo '
                                                    <div class="modal modal-center fade" id="'.$bab->id_konten.'" role="dialog">
                                                        <div class="modal-dialog modal-dialog-center" style="width: 90%">
                                                            <div class="modal-content modal-content-youtube">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-judul">'.$bab->nama_sub_materi.'</h4>
                                                                </div>
                                                                <div class="wrap-video embed-responsive embed-responsive-16by9">
                                                                    <iframe class="embed-responsive-item" src="'.$bab->video_materi.'?rel=0&controls=0&showinfo=0" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';

                                        } elseif ($bab->kategori == '1'){
                                            $link = "href='".base_url()."konten/detail/".$bab->id_sub_materi."'";
                                            $icon = "<i class='fa fa-align-left'></i>";
                                        } else {
                                            $link = "href='".base_url()."konten/detail_soal/".$bab->id_sub_materi."'";
                                            $icon = "<i class='fa fa-check-square-o'></i>";
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
        </div><!-- End of Row  -->

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
                        <a href="<?= base_url().'mapel/'.$data->id_mapel; ?>">
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
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>