<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- no cache -->
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <!-- no cache -->

    <title>Lembaga Pendidikan Islam Hidayatullah</title>

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/animate.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png'); ?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png'); ?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png'); ?>">

    <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/pg_user/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/pg_user/css/custom.css'); ?>" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js'); ?>"></script>
</head>

<body>
<div class="navbar navhome" role="navigation" id="header">
    <div class="container-fluid" style="padding:0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
                <span class="icon-bar first"></span>
                <span class="icon-bar second"></span>
                <span class="icon-bar third"></span>
            </button>
            <a class="logo" href="<?php echo base_url(''); ?>"><img
                        src="<?php echo base_url('assets/dashboard/images/icon-lpi.png') ?>"
                        alt="Lembaga Pendidikan Islam Hidayatullah" style="width:50px;">
            </a>
        </div>

        <div class="navbar-collapse collapse navstyle" id="nav-bso">
            <ul class="nav navbar-nav">
                <li class="search-sm" style="display:none;">
                    <a href="<?php echo base_url('pencarian'); ?>">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                </li>

                <?php
                if (!empty($_SESSION['id_siswa'])) {
                    if (isset($_SESSION['akses'])) {
//                        if (count($_SESSION['akses']) > 0) {
//                            if (isset($_SESSION['akses']['reguler'])) {
//                                $paketaktif = $_SESSION['akses']['reguler'][0];
//                            } else if (isset($_SESSION['akses']['premium'])) {
//                                $paketaktif = $_SESSION['akses']['premium'][0];
//                            }
//                        } else {
//                            $paketaktif = 0;
//                        }
                        $paketaktif = 100;
                        if (count($_SESSION['menu']) > 0) {
                            foreach ($_SESSION['menu'] as $jenjang => $data_kelas) {
                                ?>
                                <li class="dropdown menu-large">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $jenjang; ?>
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu megamenu row">
                                        <?php foreach ($data_kelas as $kelas) {
                                            ?>
                                            <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <ul>
                                                    <li class="dropdown-header"><?php echo $kelas['alias_kelas']; ?></li>
                                                    <?php foreach ($kelas['Mapel'] as $mapel) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo($mapel['id_mapok'] == 0 ? "javascript:alert('Data Materi Kosong');" : (base_url() . "materi/tabel_konten_detail/" . $mapel['id_mapok'])); ?>"><?php echo $mapel['nama_mapel'] ?>
                                                                Kelas <?php echo $kelas['tingkatan_kelas'] ?></a></li>
                                                        <?php
                                                    } ?>
                                                </ul>
                                            </li>
                                        <?php }

                                        ?>
                                    </ul>
                                </li>
                            <?php }
                        }
                    } else {
                        $paketaktif = 0;
                    }
                } else {
                    $paketaktif = 0;
                }


             
                ?>
                <?php if ($paketaktif >= 4 && $paketaktif <= 6 || $paketaktif == 0) { ?>
                    <li class="dropdown menu-large">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">SD
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu megamenu row">
                            <?php if ($paketaktif == 4 || $paketaktif == 0) { ?>
                                <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <ul>
                                        <li class="dropdown-header">Kelas 4</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 4) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($paketaktif == 5 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <li class="dropdown-header">Kelas 5</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 5) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($paketaktif == 6 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <li class="dropdown-header">Kelas 6</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 6) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($paketaktif >= 7 && $paketaktif <= 9 || $paketaktif == 0) { ?>
                    <li class="dropdown menu-large">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMP
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu megamenu row">
                            <?php if ($paketaktif == 7 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <li class="dropdown-header">Kelas 7</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 7) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($paketaktif == 8 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <li class="dropdown-header">Kelas 8</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 8) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($paketaktif == 9 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <li class="dropdown-header">Kelas 9</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 9) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                        Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ($paketaktif >= 19 && $paketaktif <= 24 || $paketaktif == 0) { ?>
                    <li class="dropdown menu-large">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMA
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu megamenu row">

                            <?php if ($paketaktif >= 23 && $paketaktif <= 24 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <?php if ($paketaktif == 23 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 10 IPA</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 10) {
                                                    if (strpos($mapel->nama_mapel, 'IPA') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                        <?php if ($paketaktif == 24 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 10 IPS</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 10) {
                                                    if (strpos($mapel->nama_mapel, 'IPS') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if ($paketaktif >= 21 && $paketaktif <= 22 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <?php if ($paketaktif == 21 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 11 IPA</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 11) {
                                                    if (strpos($mapel->nama_mapel, 'IPA') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                        <?php if ($paketaktif == 22 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 11 IPS</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 11) {
                                                    if (strpos($mapel->nama_mapel, 'IPS') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if ($paketaktif >= 19 && $paketaktif <= 20 || $paketaktif == 0) { ?>
                                <li class="col-sm-4">
                                    <ul>
                                        <?php if ($paketaktif == 19 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 12 IPA</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 12) {
                                                    if (strpos($mapel->nama_mapel, 'IPA') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                        <?php if ($paketaktif == 20 || $paketaktif == 0) { ?>
                                            <li class="dropdown-header">Kelas 12 IPS</li>
                                            <?php foreach ($navbar_links as $mapel) {
                                                if ($mapel->tingkatan_kelas == 12) {
                                                    if (strpos($mapel->nama_mapel, 'IPS') == true) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?>
                                                                Kelas <?php echo $mapel->tingkatan_kelas ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                <?php } ?>

                <?php if ($paketaktif >= 37 && $paketaktif <= 38 || $paketaktif == 0) { ?>
                    <li class="dropdown menu-large">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">SBMPTN
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu megamenu row">
                            <?php if ($paketaktif == 37 || $paketaktif == 0) { ?>
                                <li class="col-sm-6">
                                    <ul>
                                        <li class="dropdown-header">SOSHUM</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 13 && $mapel->kelas_id == 37) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?></a>
                                                </li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($paketaktif == 38 || $paketaktif == 0) { ?>
                                <li class="col-sm-6">
                                    <ul>
                                        <li class="dropdown-header">SAINTEK</li>
                                        <?php foreach ($navbar_links as $mapel) {
                                            if ($mapel->tingkatan_kelas == 13 && $mapel->kelas_id == 38) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; ?>"><?php echo $mapel->nama_mapel ?></a>
                                                </li>
                                                <?php
                                            }
                                        } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php }

                ?>

            </ul>


            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!empty($_SESSION['id_siswa'])) { ?>
                    <li class="search-lg"><a href="<?php echo base_url('pencarian'); ?>"><span
                                    class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                    <li class="dropdown user-profile">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo isset($_SESSION['nama_siswa']) ? strtok($_SESSION['nama_siswa'], ' ') : 'No name' ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('user/dashboard'); ?>">Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url('user/buylist'); ?>">Riwayat</a></li>
                            <li><a href="<?php echo base_url('user/aktivasi'); ?>">Aktivasi</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url('user'); ?>">Profilku</a></li>
                            <li><a href="<?php echo base_url('parents'); ?>">Orang Tua</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url('user/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                } else { ?>
                    <li><a href="<?php echo base_url('pencarian') ?>"><span class="glyphicon glyphicon-search"
                                                                            aria-hidden="true"></span></a></li>
                    <li style='padding: 15px 0px;'>|</li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" href="#">
                            LOGIN
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('login') ?>">Siswa / Orang Tua</a></li>
                            <li><a href="<?php echo base_url('psep_sekolah/login'); ?>">Sekolah / Guru</a></li>
                        </ul>
                    </li>
                    <li style='padding: 15px 0px;'>|</li>
                    <li><a href="<?php echo base_url('signup') ?>">DAFTAR</a></li>
                    <li style='padding: 15px 0px;'>|</li>
                    <?php
                } ?>
            </ul>
        </div>
    </div>
</div>

<header class="akun-header">
    <div class="wrapper">
        <img src="<?php
        if ($infosiswa->foto == "") {
            echo base_url('assets/uploads/foto_siswa/default.png');
        } else {
            echo base_url('assets/uploads/foto_siswa/' . $infosiswa->foto);
        }
        ?>">
        <div class="profile-name">
            <h5><?php echo $infosiswa->nama_siswa; ?></h5>
            <h7><?php echo $infosiswa->nama_sekolah; ?></h7>
        </div>
        <div class="akun-edit">
            <a id="edit-profile-menu2" href="<?php echo base_url('user/ubah_profil'); ?>"
               class="btn btn-default btn-edit"><span class="glyphicon glyphicon-cog"></span>Edit Profil</a>
            <div class="score">
			<span class="akun-badge number">
				<span class="akun-mask-medal orange"></span>
				<span class="badge">1</span>
			</span>
                <span class="akun-badge poin">
				<span class="akun-mask-medal yellow"></span>
				<span class="badge"><?php echo $infosiswa->poin; ?></span>
			</span>
            </div>
        </div>
    </div>
</header>
