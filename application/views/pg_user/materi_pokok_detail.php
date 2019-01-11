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
            <div class="row">
                <div class="col-md-5">
                    <h3 class="judul-list-materi">Materi Akses 1 (Basic)</h3>
                    <ul>
                        <li><b>BAB 1</b> Lorem ipsum dolor adipiscing elit</li>
                        <li><b>BAB 2</b> Lorem ipsum dolor sit amet</li>
                        <li><b>BAB 3</b> Lorem consectetur adipiscing elit</li>
                        <li><b>BAB 4</b> Lorem adipiscing elit</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <span class="icon">
                        <img src="<?= base_url('assets/pg_user/images/open-book.png') ?>"/>
                    </span>
                </div>
                <div class="border"></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h3 class="judul-list-materi">Materi Akses 1 Tahun (Silver)</h3>
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
                <div class="col-md-2">
                    <span class="icon">
                        <img src="<?= base_url('assets/pg_user/images/open-book.png') ?>"/>
                    </span>
                </div>
                <div class="border"></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h3 class="judul-list-materi">Materi Akses 1 Tahun (Gold)</h3>
                    <ul>
                        <li><b>BAB 1</b> Lorem ipsum dolor adipiscing elit</li>
                        <li><b>BAB 2</b> Lorem ipsum dolor sit amet</li>
                        <li><b>BAB 3</b> Lorem consectetur adipiscing elit</li>
                        <li><b>BAB 5</b> Lorem adipiscing elit</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <span class="icon">
                        <img src="<?= base_url('assets/pg_user/images/open-book.png') ?>"/>
                    </span>
                </div>
                <div class="border"></div>
            </div>
        </div>
    </div>
    
</section>

<?php include('footer.php'); ?>
</body>
</html>