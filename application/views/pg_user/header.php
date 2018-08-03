<?php
if ($this->uri->segment(1) != "login" AND $this->uri->segment(1) != "signup") {
    ?>
    <div class="navbar navbar-fixed-top navhome" role="navigation" id="header">
        <div class="container-fluid" style="padding:0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
                    <span class="icon-bar first"></span>
                    <span class="icon-bar second"></span>
                    <span class="icon-bar third"></span>
                </button>
                <a class="logo" href="<?php echo base_url(''); ?>"><img
                            src="<?php echo base_url('assets/dashboard/images/icon-lpi.png') ?>"
                            alt="Lembaga Pendidikan Islam Hidayatullah" style="width:50px;"></a>
            </div>

            <div class="collapse navbar-collapse navstyle" id="nav-bso">
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
                                <li><a href="<?php echo base_url('user/beli'); ?>">Beli Paket</a></li>
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

                        <li style='padding: 15px 0px;' class="hidden-xs">|</li>
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
                        <li style='padding: 15px 0px;' class="hidden-xs">|</li>
                        <li><a href="<?php echo base_url('signup') ?>">DAFTAR</a></li>
                        <li style='padding: 15px 0px;' class="hidden-xs">|</li>
                        <?php
                    } ?>
                </ul>
                <ul class="nav navbar-nav navbar-left">


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
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="#"><?php echo $jenjang; ?>
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu megamenu row">
                                            <?php foreach ($data_kelas as $kelas) {
                                                ?>
                                                <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <ul>
                                                        <li class="dropdown-header"><?php echo $kelas['alias_kelas']; ?></li>
                                                        <?php foreach ($kelas['Mapel'] as $mapel) {
                                                            $mapok = $this->model_login->get_id_materipokok($mapel['id_mapel']);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo($id_mapok == "#" ? "javascript:alert('Data Materi Kosong');" : (base_url() . "materi/tabel_konten_detail/" . $id_mapok)) ?>"><?php echo $mapel['nama_mapel'] ?>
                                                                    Kelas <?php echo $kelas['tingkatan_kelas'] ?></a>
                                                            </li>
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
                    <?php
                    if ($paketaktif == 0) {

                    }
                    ?>
                    <!-- Perlu kode untuk PAUD -->
                    <?php if ($paketaktif >= 4 && $paketaktif <= 6 || $paketaktif == 0) { ?>
                        <li class="dropdown menu-large">
                            <a href="#">PAUD</a>
                        </li>
                    <?php } ?>


                    <?php if ($paketaktif >= 4 && $paketaktif <= 6 || $paketaktif == 0) { ?>
                        <li class="dropdown menu-large">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">SD
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu megamenu row">
                                <?php if ($paketaktif == 4 || $paketaktif == 0) { ?>
                                    <li class="col-sm-4">
                                        <ul>
                                            <li class="dropdown-header">Kelas 4</li>
                                            <?php foreach ($navbar_links as $mapel) {

                                                if ($mapel->tingkatan_kelas == 4) {

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>

                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                    $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                    if (count($mapok) > 0) {
                                                        $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                    } else {
                                                        $id_mapok = "#";
                                                    }

                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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

                                                            $mapok = $this->model_login->get_id_materipokok($mapel->id_mapel);
                                                            if (count($mapok) > 0) {
                                                                $id_mapok = "materi/tabel_konten_detail/" . $mapok[0]['id_materi_pokok'];
                                                            } else {
                                                                $id_mapok = "#";
                                                            }

                                                            ?>
                                                            <li>
                                                                <a href="<?php echo base_url() . $id_mapok; ?>"><?php echo $mapel->nama_mapel ?>
                                                                    Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
                </ul>
            </div>
        </div>
    </div>

    <?php
} //Penutup if != login
else {
    ?>
    <div class="nav navlogin">
        <a class="logo" href="<?php echo base_url(''); ?>">
            <img src="<?php echo base_url('assets/dashboard/images/icon-lpi.png') ?>"
                 alt="Lembaga Pendidikan Islam Hidayatullah" class="img-responsive">
        </a>
    </div>

    <?php
} //Penutup else != login
?>
			
