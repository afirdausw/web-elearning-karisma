<?php
    include('header.php');
?>
<section class="materi-top-header"> <!-- BANNER-->
    <div class="background" style="background: url('<?= base_url().'image/mapel/'.$kelas->gambar_mapel ?>');"></div>
    <div class="container">
        <div class="row text-center">
            <h1><?= $kelas->nama_mapel ?></h1>
            <h2><?= $kelas->alias_kelas ?></h2>
        </div>
    </div>
</section> <!-- End of BANNER-->

<section class="materi-konten">
    <div class="container">
        <div class="row text-center">
            <h1>Cara Belajar Online Learning di i-Karismax</h1>
            <h3>Harga Paket i-Karismax untuk 1 Tahun Akses Materi Online</h3>
        </div>
        <div class="row">
            <div class="materi-video">
                <div class="top">
                    <img class="image-responsive" src="https://media.boingboing.net/wp-content/uploads/2015/05/lean.jpg" alt="">
                </div>
                <div class="bottom">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eu dolor tincidunt, lacinia mi eget, bibendum lectus. Vivamus eu turpis nunc. Aenean in elit vitae mi ornare sollicitudin sed ac ante. In sagittis viverra turpis eu consequat. Suspendisse potenti. Curabitur et fermentum elit. Nunc ac hendrerit nulla. Donec euismod rhoncus libero id fringilla. Donec sed arcu placerat, convallis ex eget, dictum nisi.</p>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <h1>Paket Kursus Online <?= $kelas->nama_mapel ?></h1>
            <h3>Harga Paket i-Karismax untuk 1 Tahun Akses Materi Online</h3>
        </div>
        <div class="wrap-materi-list">
            <div class="wrap-content left">
                <div class="content">
                    <h2 class="judul-list-materi">Materi Akses 1 (Basic)</h2>
                    <ul>
                        <li><b>BAB 1</b> Lorem ipsum dolor adipiscing elit</li>
                        <li><b>BAB 2</b> Lorem ipsum dolor sit amet</li>
                        <li><b>BAB 3</b> Lorem consectetur adipiscing elit</li>
                        <li><b>BAB 4</b> Lorem adipiscing elit</li>
                    </ul>
                </div>
            </div>
            <div class="wrap-content right">
                <div class="content">
                    <h2 class="judul-list-materi">Materi Akses 2 (Silver)</h2>
                    <ul>
                        <li><b>BAB 1</b> Lorem ipsum dolor adipiscing elit</li>
                        <li><b>BAB 2</b> Lorem ipsum dolor sit amet</li>
                        <li><b>BAB 3</b> Lorem consectetur adipiscing elit</li>
                        <li><b>BAB 4</b> Lorem adipiscing elit</li>
                        <li><b>BAB 6</b> Lorem adipiscing </li>
                        <li><b>BAB 7</b> Lorem elit</li>
                        <li><b>BAB 8</b> Lorem</li>
                    </ul>
                </div>
            </div>
            <div class="wrap-content left">
                <div class="content">
                    <h2 class="judul-list-materi">Materi Akses 1 Tahun (Gold)</h2>
                    <ul>
                        <li><b>BAB 1</b> Lorem ipsum dolor adipiscing elit</li>
                        <li><b>BAB 2</b> Lorem ipsum dolor sit amet</li>
                        <li><b>BAB 3</b> Lorem consectetur adipiscing elit</li>
                        <li><b>BAB 5</b> Lorem adipiscing elit</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" ">
            <table class="table table-responsive materi-list"> 
                <colgroup>
                    <col class="col-xs-4 col-sm-4 col-md-4">
                    <col class="col-xs-2 col-sm-2 col-md-2">
                    <col class="col-xs-2 col-sm-2 col-md-2">
                    <col class="col-xs-2 col-sm-2 col-md-2">
                </colgroup>
                <tr class="materi-list-header text-center">
                    <td><h3>Choose your plan</h3></td>
                    <td>
                       <span class="basic">Basic</span>
                       <p>(Rp. 1.300.000)</p>
                    </td>
                    <td>
                       <span class="silver">Silver</span>
                       <p>(Rp. 1.500.000)</p>
                    </td>
                    <td>
                       <span class="gold">Gold</span>
                       <p>(Rp. 1.800.000)</p>
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="text-left">Sertifikat Karisma Academy</td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                </tr>
                <tr class="text-center">
                    <td class="text-left">Sertifikat Internasional</td>
                    <td><i class="fa fa-times"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                </tr>
                <tr class="text-center">
                    <td class="text-left">Live Instruktur</td>
                    <td><i class="fa fa-times"></i></td>
                    <td><b>60 Hari</b></td>
                    <td><b>120 Hari</b></td>
                </tr>
                <tr class="text-center">
                    <td></td>
                    <td><a href="#" class="btn btn-xs btn-primary btn-beli">Beli Sekarang</a></td>
                    <td><a href="#" class="btn btn-xs btn-primary btn-beli">Beli Sekarang</a></td>
                    <td><a href="#" class="btn btn-xs btn-primary btn-beli">Beli Sekarang</a></td>
                </tr>
            </table>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>