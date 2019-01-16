<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fixing <?= ((isset($judul_tab) AND $judul_tab != '') ? $judul_tab . " - " : "") ?>Karisma Academy - Sertifikasi
        Online</title>

    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/merk/favicon.ico'); ?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/img/merk/favicon.ico'); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/themify/css/themify-icons.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/fontawesome-4.7/css/font-awesome.min.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-3/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-4/css/bs-4-margin.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jquery/jquery-steps/jquery.steps.css'); ?>">

    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css'); ?>">

    <style>
		/* Footer optimization */
		html, body {
			height: 77.3%;
		}
		#wrap {
			min-height: 100%;
		}
	</style>
</head>

<body>
<div id="wrap">
<div id="main" class="clear-top">
<div id="navtop" style="opacity:0;width:0;height:0"></div>
<?php
if ($this->uri->segment(1) != '') { ?>
    <div class="overlay"></div>
    <nav id="sidebar">
        <div id="wrap-sidebar">
            <div id="dismiss">
                <span class="ti-close"></span>
            </div>

            <div class="sidebar-header">
                <img src="<?php echo base_url('assets/img/merk/header-logo.png') ?>" width="250px" height="38px"
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
    <?php
}
?>

<nav id="sidebar">
    <div id="wrap-sidebar">
        <div id="dismiss">
            <span class="ti-close"></span>
        </div>

        <div class="sidebar-header">
            <img src="<?php echo base_url('assets/img/merk/header-logo.png') ?>" width="250px" height="38px"
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
<!-- HEADER -->
<header class="top-header" <?php if ($this->uri->segment(1) == '') { ?> style="position:sticky;top:5;" <?php } ?>>
    <div class="container">
        <nav class="navbar navbar-default navbar-custom" role="navigation">
            <div class="">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                    if ($this->uri->segment(1) != '') { ?>
                        <button type="button" id="sidebarCollapse" class="open-sidebar">
                            <span class="ti-menu"></span>
                        </button>
                    <?php } ?>
                    <a class="navbar-brand logo" href="<?php echo base_url(); ?>"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
							<a href="<?php echo base_url(); ?>" role="button"aria-expanded="false">Beranda</span></a>
						</li>
						<li>
							<a href="#" role="button" aria-expanded="false">Tentang Kami</a>
						</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Kursus <span class="arrow-down ti-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                $kelas_navbar = $this->Model_pg->fetch_all_kelas();
                                foreach ($kelas_navbar as $key) :
                                    echo "<li><a href='" . base_url("kelas/$key->id_kelas") . "'>$key->alias_kelas</a> </li>";
                                endforeach;
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Sertifikat <span class="arrow-down ti-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Daftar</a></li>
                                <li><a href="#">Login</a></li>
                            </ul>
                        </li>
                        <?php
                        $idsiswa = $this->session->userdata('id_siswa');
                        if ($idsiswa != NULL) {
                            $siswa = $this->Model_pg->get_data_user($idsiswa);
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><?= $siswa->nama_siswa ?> <span class="ti-face-smile"
                                                                                         style="color:green;"
                                                                                         data-toggle="tooltip"
                                                                                         data-placement="bottom"
                                                                                         title="Anda telah terdaftar sebagai siswa"></span>
                                    <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                                    <li><a href="<?= base_url('history-transaksi') ?>">History Transaksi</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                            <?php
                            $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
                            $cart = obj_to_arr($cart);
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    <i class="ti-shopping-cart"></i><span
                                            class="badge"><?= count($cart) ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right min-width-320"
                                    aria-labelledby="dropdownMenuCart" style="padding: 0px;">
                                    <?php
                                    if ($numCart == 0) {
                                        ?>
                                        <li class="cart-dropdown" style="display: block;">
                                            <div style="white-space: normal;" class="pull-right w-100 pl-3 mt-2 text-center">
                                                <h4 class="w-100 mt-0 cart-judul">Keranjang anda Kosong</h4> 
                                                <br>
                                                <span><small>Silahkan anda pilih produk yang kita miliki.</small></span>
                                            </div>
                                        </li>	
                                        <?php
                                    } else {
                                    foreach ($cart as $key => $value) {
                                        ?>
                                        <li class="cart-dropdown" style="display: block;">
                                            <a href="#">
                                                <div class="pull-left w-25 mt-2">
													<img class="w-100 thumb-cart"
                                                         src="<?= base_url() ?>image/mapel/<?= $value['gambar_mapel'] ?>">
                                                </div>
                                                <div style="white-space: normal;" class="pull-right w-75 pl-3  mt-2">
                                                    <h4 class="w-100 mt-0 font-weight-bold cart-judul"><?= $value['nama_mapel'] ?></h4>
                                                    <h5 class="w-100">
                                                        <small><span class="font-italic">Rp. <?= money($value['harga']) ?></span></small>
                                                    </h5>
                                                </div>
                                            </a>
                                        </li>
                                    <?php }
                                    }?>
                                    <li class="text-center" style="margin-top: 80px;">
                                        <a class="mt-2" style="display: block;" href="<?= base_url('keranjang') ?>">Checkout Cart</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else if ($this->session->userdata('pretest_logged_in')) { ?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><?= ($this->session->userdata('pretest_nama') != NULL ? $this->session->userdata('pretest_nama') : "Anonim"); ?>
                                    <span class="ti-face-sad" style="color:red;" data-toggle="tooltip"
                                          data-placement="bottom"
                                          title="Anda hanya terdaftar sebagai siswa pretest"></span> <span
                                            class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?= base_url("pretest/logout") ?>">Logout</a></li>
                                </ul>
                            </li>

                        <?php } else { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">Login <span class="arrow-down ti-angle-down"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo base_url() . 'signup' ?>">Daftar</a></li>
                                    <li><a href="<?php echo base_url() . 'login' ?>">Login</a></li>
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