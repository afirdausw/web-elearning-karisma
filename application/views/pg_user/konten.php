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
                                <?php }else{
                                    if($this->session->userdata('pretest_logged_in')){ ?>
                                        <li><a href="<?=base_url("pretest/logout")?>">Logout Pretest (<?=($this->session->userdata('pretest_nama')!=NULL ? $this->session->userdata('pretest_nama') : "Anonim");?>)</a></li>
                                    <?php
                                    }else{ ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login <span class="arrow-down ti-angle-down"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?php echo base_url().'signup' ?>">Daftar</a></li>
                                                <li><a href="<?php echo base_url().'login' ?>">Login</a></li>
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
                    <div class="col-lg-4 col-md-5 col-sm-5 panel-group panel-group-konten" style="float: right"  id="list-sub-materi">>
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

                    <div class="col-lg-8 col-md-7 col-sm-7 materi" style="float: left">
                        <!-- WRAP JUDUL MATERI -->
                        <?php $data = $materi ?>
                        <?php $key = $sub_materi; ?>
                        <?php
                            $isi = $konten;

                            if($isi->kategori == '2') {
                                redirect(site_url('konten/detail_video/'.$isi->sub_materi_id));
                            }
                        ?>
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
                        <div class="row teks-materi">
                            <div class="col-lg-12">
                                <?= $isi->isi_materi ?>
                            </div>
                        </div>

                        <!-- WRAP DETAIL MATERI -->
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
                            <?php $page = $list_submateri; ?>
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
