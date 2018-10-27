<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= ((isset($judul_tab) AND $judul_tab != '') ? $judul_tab." - " : "" ) ?>Karisma Academy - Sertifikasi Online</title>
    
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/themify-icons.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/font-awesome.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jquery.mCustomScrollbar.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/responsive.css'); ?>">

</head>

<body>
    <div id="navtop" style="opacity:0;width:0;height:0"></div>
    <?php
    if($this->uri->segment(1) != ''){ ?>
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

    <?php
    }
    ?>

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
    <!-- HEADER -->
    <header class="top-header" <?php if($this->uri->segment(1) == ''){ ?> style="position:sticky;top:5;" <?php }?>>
        <div class="container">
            <nav class="navbar navbar-default navbar-custom" role="navigation">
                <div class="">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php
                        if($this->uri->segment(1) != ''){ ?>
                            <button type="button" id="sidebarCollapse" class="open-sidebar">
                                <span class="ti-menu"></span>
                            </button>
                        <?php }  ?>
                        <a class="navbar-brand logo" href="<?php echo base_url(); ?>"></a>
                    </div>

                    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Beranda <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tentang Kami <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kursus <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    foreach($kelas_navbar as $key) :
                                        echo "<li><a href='".base_url("kelas/$key->id_kelas")."'>$key->alias_kelas</a> </li>";
                                    endforeach;
                                    ?>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sertifikat <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Daftar</a></li>
                                    <li><a href="#">Login</a></li>
                                </ul>
                            </li>
                            <?php
                                $idsiswa = $this->session->userdata('id_siswa');
                                if($idsiswa != NULL){
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $siswa->nama_siswa ?> <span class="ti-face-smile" style="color:green;" data-toggle="tooltip"  data-placement="bottom" title="Anda telah terdaftar sebagai siswa"></span> <span class="arrow-down ti-angle-down"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?=base_url('profil') ?>">Profil</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } else if ($this->session->userdata('pretest_logged_in')){ ?>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= ($this->session->userdata('pretest_nama') != NULL ? $this->session->userdata('pretest_nama') : "Anonim"); ?> <span class="ti-face-sad" style="color:red;" data-toggle="tooltip"  data-placement="bottom" title="Anda hanya terdaftar sebagai siswa pretest"></span> <span class="arrow-down ti-angle-down"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?=base_url('profil') ?>">Profil</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?= base_url("pretest/logout") ?>">Logout</a></li>
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
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </header>