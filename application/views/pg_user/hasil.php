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
                            <a class="navbar-brand logo" href="#"></a>
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
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header> <!-- END OF HEADER -->

        <section class="banner-top banner-quiz-hasil" style="margin-bottom: 30px;"> <!-- BANNER-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 banner-left">
                        <h1>Selamat, Test ini sudah dikerjakan</h1>
                        <span>Untuk melanjutkan belajar, klik tautan disamping</span>
                    </div>
                    <div class="col-md-4 banner-right">
                        <a href="#">Lanjutkan Belajar</a>
                    </div>
                </div>
            </div>
        </section> <!-- End of BANNER-->

        <section> <!-- konten-->
            <div class="container">
                <div class="row">
                    <!-- Sub Materi Kiri -->
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="float: left">
                        <div class="row wrap-quiz">
                            <div class="col-lg-7 col-md-7">
                                <h1>Quiz 1 Materi Apa itu HTML</h1>
                                <div class="row">
                                    <table class="table table-my table-striped">
                                        <tbody><tr>
                                            <td width='35%'>Instruktur</td>
                                            <td>: <a href="#"> </a></td>
                                        </tr>
                                        <tr>
                                            <td>Durasi</td>
                                            <td>: 20 Menit</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Soal</td>
                                            <td>: 5 Soal</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Soal</td>
                                            <td>: Pilihan Ganda</td>
                                        </tr></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <h1>Progress</h1>
                                <div class="archive-group">
                                    <span class="active">Melihat</span>
                                    <span class="active">Mengerjakan</span>
                                    <span>Coba 100 Kali</span>
                                </div>
                                <br/>
                                <button class="btn btn-quiz btn-block">
                                    <i class="fa fa-check-square-o"></i> Mulai mengerjakan
                                </button>
                                <span class="archive-nb">
                                    * Test ini telah anda kerjakan, Anda bisa mencoba ulang ini tanpa mengubah Hasil Test anda
                                </span>
                                <br/>
                            </div>
                        </div>
                        
                        <div class="row wrap-konten"> <!-- KONTEN RIWAYAT -->
                            <div class="col-lg-9 col-md-10">
                                <h3>Riwayat</h3>
                                <span>Untuk melihat detail jawaban dan pertanyaan, anda bisa klik tanggal progressnya</span>
                                
                                <table class="table table-riwayat table-striped">
                                    <tbody>
                                    <tr>
                                        <td width='30%'><a href="<?php echo base_url()."quiz/riwayat" ?>">22 Jun 2018 at 11.14 WIB</a></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-riwayat progress-merah" role="progressbar" style="width:60%"></div>
                                                <span>60</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <td><a href="#">24 Feb 2018 at 20.00 WIB</a></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-riwayat progress-merah" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:65%"></div>
                                                <span>65</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">28 Feb 2018 at 14.00 WIB</a></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-riwayat progress-hijau" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:75%"></div>
                                                <span>75</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">01 Feb 2018 at 19.00 WIB</a></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-riwayat progress-hijau" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"></div>
                                                <span>80</span>
                                            </div>
                                        </td>
                                    </tr>-->
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- END OF KONTEN RIWAYAT -->
                        
                        <div class="row wrap-konten"> <!-- KONTEN HASIL -->
                            <div class="col-lg-12">
                                <h3>Hasil Test</h3>
                                
                                <table class="table table-hasil hasil-merah">
                                    <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: center">Pertanyaan</th>
                                            <th width='35%'>Jawaban</th>
                                            <th width='10%'>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse a pharetra erat. Cras varius velit nec eros dapibus, eu porttitor est pretium?</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing</td>
                                            <td align='center'><b>20</b></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Aliquam leo erat, imperdiet vel tortor auctor, mattis porta massa. Morbi pretium tellus in nisi sodales eleifend?</td>
                                            <td>Morbi pretium tellus in nisi</td>
                                            <td align='center'><b>20</b></td>
                                        </tr>
                                        <tr class="null">
                                            <td>3.</td>
                                            <td>Etiam ut dolor et sapien feugiat aliquam nec vitae elit. Sed in iaculis dolor. Donec mattis rutrum lacus nec porta?</td>
                                            <td>Sed in iaculis dolor</td>
                                            <td align='center'><b>0</b></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Aliquam leo erat, imperdiet vel tortor auctor, mattis porta massa. Morbi pretium tellus in nisi sodales eleifend?</td>
                                            <td>Morbi pretium tellus in nisi</td>
                                            <td align='center'><b>20</b></td>
                                        </tr>
                                        <tr class="null">
                                            <td>5.</td>
                                            <td>Curabitur a mauris quam. Nunc pharetra orci dolor, sed ornare mi elementum sed?</td>
                                            <td>Ut commodo feugiat elit id dictum</td>
                                            <td align='center'><b>0</b></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Nilai Total</td>
                                            <td></td>
                                            <td><b>Message: Invalid argument supplied for foreach()</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> <!-- END OF KONTEN HASIL -->
                        
                        <!-- WRAP DETAIL MATERI -->
                        <div class="row wrap-detail-materi">
                            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right">
                                <img class="centered-cover" src="<?php echo base_url('assets/js/plugins/kcfinder/upload/images/html.jpg') ?>" alt="Logo Materi">
                            </div>
                            <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
                                <h3>Apa itu HTML</h3>
                                <span class="badge">12 Materi</span>
                                <span class="badge">50 Peserta</span>
                                <p>Oleh <a href="">Putra Daroini</a> . 12/02/2018</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Peserta Kanan -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="float: right">
                        <span class="judul-header">
                            Hasil Test
                            <p>dari 25 peserta di Kelas</p>
                        </span>
                        
                        <ul class="peserta-list">
                            <!--
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="blue">N</span>
                                </div>
                                <div class="wrap-center">
                                    Nur Rohman
                                    <p>at 20 November 2017</p>
                                </div>
                                <span class="nilai">85</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <img class="user-male" src="<?php echo base_url('assets/pg_user/images/user-male.png') ?>">
                                </div>
                                <div class="wrap-center">
                                    Agus Budiyanto
                                    <p>at 18 Desember 2017</p>
                                </div>
                                <span class="nilai">89</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="red">E</span>
                                </div>
                                <div class="wrap-center">
                                    Elma
                                    <p>8 January 2018</p>
                                </div>
                                <span class="nilai">82</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <img class="user-female" src="<?php echo base_url('assets/pg_user/images/user-female.png') ?>">
                                </div>
                                <div class="wrap-center">
                                    Fitri Handayani
                                    <p>15 February 2018</p>
                                </div>
                                <span class="nilai">84</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="blue">N</span>
                                </div>
                                <div class="wrap-center">
                                    Nur Rohman
                                    <p>at 20 November 2017</p>
                                </div>
                                <span class="nilai">85</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="blue">A</span>
                                </div>
                                <div class="wrap-center">
                                    Agus Budiyanto
                                    <p>at 18 Desember 2017</p>
                                </div>
                                <span class="nilai">89</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="red">E</span>
                                </div>
                                <div class="wrap-center">
                                    Elma
                                    <p>8 January 2018</p>
                                </div>
                                <span class="nilai">82</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="red">F</span>
                                </div>
                                <div class="wrap-center">
                                    Fitri Handayani
                                    <p>15 February 2018</p>
                                </div>
                                <span class="nilai">84</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="blue">N</span>
                                </div>
                                <div class="wrap-center">
                                    Nur Rohman
                                    <p>at 20 November 2017</p>
                                </div>
                                <span class="nilai">85</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="blue">A</span>
                                </div>
                                <div class="wrap-center">
                                    Agus Budiyanto
                                    <p>at 18 Desember 2017</p>
                                </div>
                                <span class="nilai">89</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="red">E</span>
                                </div>
                                <div class="wrap-center">
                                    Elma
                                    <p>8 January 2018</p>
                                </div>
                                <span class="nilai">82</span>
                            </a></li>
                            <li><a href="#">
                                <div class="wrap-left">
                                    <span class="red">F</span>
                                </div>
                                <div class="wrap-center">
                                    Fitri Handayani
                                    <p>15 February 2018</p>
                                </div>
                                <span class="nilai">84</span>
                            </a></li>
-->
                        </ul> <!-- End Peserta -->
                    </div>
                </div>
            </div>
        </section> <!-- End of konten-->
        <?php include('footer.php'); ?>
    </body>
</html>