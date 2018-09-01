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
                                <a href="<?=base_url("pretest/logout")?>">Logout (<?=($this->session->userdata('pretest_nama')!=NULL ? $this->session->userdata('pretest_nama') : "Anonim");?>)
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

<section class="banner-top banner-materi banner-profil darker"> <!-- konten Judul -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <img src="<?= base_url('assets/pg_user/images/foto-siswa/siswa.jpg'); ?>" alt="Foto Profil Siswa">
            </div>
            <div class="col-md-9 col-sm-12">
                <h1>Nama Siswa</h1>
                <h3>Akun Regular <a class="button">Daftar Premium</a></h3>
                <span>Mengikuti kelas <b>Web Design</b> di Karisma Academy</span>
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
                    <h4>Surabaya, 08-10-1993</h4>
                </div>
                <div class="col-md-12">
                    <p>Alamat</p>
                    <h4>Kota Malang, Jawa Timur</h4>
                </div>
                <div class="col-md-12">
                    <p>Pekerjaan</p>
                    <h4>Mahasiswa</h4>
                </div>
                <div class="col-md-12">
                    <p>Nomor Telepon</p>
                    <h4>+62 8221 2389 77</h4>
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
                    <h4>siswa1</h4>
                </div>
                <div class="col-md-12">
                    <p>Email</p>
                    <h4>emailsiswa@gmail.com</h4>
                </div>
                <div class="col-md-12">
                    <p>Tanggal Daftar</p>
                    <h4>29 Agustus 2018</h4>
                </div>
            </div><!-- End of Row  -->
        </div>
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>