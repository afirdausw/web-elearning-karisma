<!DOCTYPE html>
<html lang="en">
<head>
    <title>Karisma Academy - Sertifikasi Online</title>
    
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/responsive.css'); ?>">

</head>

<body>
    <!-- HEADER -->  
    <header class="top-header">
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
                                    foreach($kelas as $key) :
                                        echo "<li><a href='kelas/$key->id_kelas'>$key->alias_kelas</a> </li>";
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
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </header>
    
    <section class="banner-home">
        <div class="container">
            <div class="row">
                <h1>Kursus ONLINE<br>
                Website, Digital Marketing,<br>
                Desain grafis, &amp; Arsitektur Bersertifikasi</h1>
                <a href="<?php echo base_url().'signup' ?>"><button class="btn btn-info">Daftar Sekarang</button></a>
                <a href="<?php echo base_url().'pretest' ?>"><button class="btn btn-warning">Coba Gratis</button></a>
            </div>
        </div>
    </section>

    <section>
        <div class="container home-materi-list">
            <h1>Belajar Desain Grafis, Website, Digital Marketing, dan Arsitektur</h1>
            <h2>Lihat konten Karisma Academy lebih dari <span>500+</span> kelas yang tersedia</h2>


            
            <div class="row">
                <div class="col-md-12" style="text-align: center; clear: both" id="home_materi_pagination_top">
                </div>
            </div>           
            <div class="row" id="home_list_materi"> <!-- BARIS KE 1 -->
                <?php
                 //TODO SAMAKAN DENGAN controller home.php
                foreach ($mapel as $value) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="thumbnail materi-lainnya">
                            <a href="<?php echo base_url().'mapel/'.$value->id_mapel; ?>">
                                <span class="badge-diskon">Diskon 25%</span>
                                <img src="<?=(isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) && substr($value->gambar_mapel,0,5) == 'data:' ? $value->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>" alt="<?= $value->nama_mapel ?>">
                                <div class="caption">
                                    <?php
                                        if(strlen($value->nama_mapel) >= 60 ){
                                            $mapel = substr($value->nama_mapel, 0, strpos($value->nama_mapel, ' ', 50))." . . .";
                                        }else{
                                            $mapel = $value->nama_mapel;
                                        }
                                    ?>
                                    <a href="<?= base_url().'kelas/'.$value->kelas_id; ?>" class="badge-kelas">
                                        <?= $value->alias_kelas ?>
                                    </a>
                                    <h3><?= $mapel ?></h3>
                                    <p>Pelajari lebih lanjut ...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }   
                ?>
            </div> <!-- END OF BARIS KE 1 -->
            
            <div class="row">
                <div class="col-md-12" style="text-align: center; clear: both" id="home_materi_pagination_bot">
                </div>
            </div>

            <div class="row">
                <div id="content"></div>
            </div>
        </div>

    </section>

    
    <section>
        <div class="section-qoutes">
            <div class="container">
                <h1>Apa kata mereka tentang Karisma Academy?</h1>
                <h2>Dengarkan pengalaman mereka belajar online dengan Karisma Academy</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header" style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg1.png'); ?>)">
                                        <span>Dinda Adinda</span>
                                    </div>
                                    <span class="card-profile">D</span>
                                    <div class="card-text">
                                        <p>“Saya kursus disini punya ketertarikan sendiri karena di karisma watu kursusnya sangat fleksibal, saya pulang kerja bisa langsung belajar, tentor proffesional”</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header" style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg2.png'); ?>)">
                                        <span>Adinda Dinda</span>
                                    </div>
                                    <span class="card-profile">A</span>
                                    <div class="card-text">
                                        <p>“Saya kursus disini punya ketertarikan sendiri karena di karisma watu kursusnya sangat fleksibal, saya pulang kerja bisa langsung belajar, tentor proffesional”</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <a href="#">
                                    <div class="card-header" style="background-image: url(<?php echo base_url('assets/pg_user/images/index-bg1.png'); ?>)">
                                        <span>Dinda Adinda</span>
                                    </div>
                                    <span class="card-profile">D</span>
                                    <div class="card-text">
                                        <p>“Saya kursus disini punya ketertarikan sendiri karena di karisma watu kursusnya sangat fleksibal, saya pulang kerja bisa langsung belajar, tentor proffesional”</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container partner">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <h1>Partner Kami</h1>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 text-center">
                    <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-ic3.png'); ?>" alt="IC3"></a>
                    <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-vedc.png'); ?>" alt="VEDC"></a>
                    <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-ub.png'); ?>" alt="UB"></a>
                    <a href="#"><img src="<?php echo base_url('assets/pg_user/images/partner-um.png'); ?>" alt="UM"></a>
                </div>
            </div>
        </div>
    </section>

<?php include('footer.php'); ?>

</body>

<script type="text/javascript" src="https://cdn.rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>

<script>
    // init bootpag
    $('#home_materi_pagination_top,#home_materi_pagination_bot').bootpag({
        total: <?=ceil($jumlah_mapel/$limit);?>,
        page: 1,
        maxVisible: <?=$limit?>,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event, /* page number here */ num){
        bnner = $( "section.banner-home" );
        lst = $( "#home_list_materi" );
        nav = $("nav.navbar");
        $("html, body").animate({ scrollTop: bnner.height()-nav.height() }, "slow");
        $.ajax({
            url: "<?=base_url();?>home/ajax_load_listmapel/"+<?=$limit?>+"/"+num,
            success: function(result){
                lst.html(result);
            }
        });
    });
</script>
</html>
