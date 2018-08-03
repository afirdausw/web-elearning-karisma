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
                        <?php
                            $idsiswa = $this->session->userdata('id_siswa');
                            if($idsiswa != NULL){
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $siswa->nama_siswa ?> <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Akun</a></li>
                                    <li><a href="<?=base_url('profil') ?>">Profil</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo base_url().'signup' ?>">Daftar</a></li>
                                    <li><a href="<?php echo base_url().'login' ?>">Login</a></li>
                                </ul>
                            </li>
                        <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header> <!-- END OF HEADER -->

<section class="banner-top" style="background: #90BB35;"> <!-- BANNER-->
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
</section> <!-- End of BANNER-->
<?php $background = (isset($kelas->gambar_kelas) ? (!empty($kelas->gambar_kelas) && substr($kelas->gambar_kelas,0,5) == 'data:' ? $kelas->gambar_kelas : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>
<section class="banner-materi darker" style="background-image: url('<?=$background?>')" > <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?=(isset($kelas->gambar_kelas) ? (!empty($kelas->gambar_kelas) && substr($kelas->gambar_kelas,0,5) == 'data:' ? $kelas->gambar_kelas : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1><?= $kelas->alias_kelas ?></h1>
                <h3>Karisma Academy</h3>
            </div>
        </div>
    </div>
</section> <!-- End of konten Judul -->

<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Deskripsi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <?=(isset($kelas->deskripsi_kelas) && $kelas->deskripsi_kelas != '' ? $kelas->deskripsi_kelas : 'Ini adalah kelas dari kelompok kursus '.$kelas->alias_kelas )?>
            </div>
        </div><!-- End of Row  -->

        <div class="row">
            <div class="col-md-5">
                <h1>Kelas <?= $kelas->alias_kelas ?></h1>
            </div>
        </div>
        <div class="row">
            <?php 
            if($mapel!=NULL){ ?>
                <?php foreach ($mapel as $data) { ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="thumbnail materi-lainnya">
                        <a href="<?= base_url().'materi/'.$data->id_mapel ?>">
                            <!-- <span class="badge-diskon">Diskon 25%</span> -->
                            <img src="<?=(isset($data->gambar_mapel) ? (!empty($data->gambar_mapel) && substr($data->gambar_mapel,0,5) == 'data:' ? $data->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>" alt="Thumbnail Kursus <?=$data->nama_mapel?>" style="width:100%; height: 50px">
                            <div class="caption">
                                <h3><?= $data->nama_mapel ?></h3>
                                <p>Pelajari lebih lanjut ...</p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            <?php
            }else{ ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="thumbnail text-center">
                        <!-- <span class="badge-diskon">Diskon 25%</span> -->
                        <div class="caption text-center" style="display:table;margin:0 auto;">
                            <h3 style="vertical-align:middle;display:table-cell;">Daftar Kelas Tidak Ada</h3>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div><!-- End of Row  -->
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>