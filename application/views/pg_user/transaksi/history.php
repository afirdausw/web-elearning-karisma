<?php


$this->load->view('pg_user/header');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<!-- //sementara -->
<style>
    .row .vertical-align {
        display: flex;
        align-items: center;
    }

    .panel, .panel > * {
        border-radius: 0;
    }

    .panel-primary {
        border-color: #BABABA;
    }

    .panel-primary > .panel-heading {
        background-color: #F2F2F2;
        border: none;
    }

    .cart-list {
        border-radius: 2px;
    }

    .cart-list .panel-heading ul.nav.nav-tabs {
        font-weight: 500;
        border: none;
    }

    .cart-list .panel-heading ul.nav.nav-tabs li {
        border-radius: 0;
        border-bottom: solid 3px #0779AF;
    }

    .cart-list .panel-heading ul.nav.nav-tabs li > a {
        background: none;
        border: none;
        padding: 1em 2em;
    }

    .cart-list .panel-footer {
        border: none;
    }

    .cart-list .panel-footer > a {
        text-decoration: underline;
    }

    .cart-list #daftar_belanja div.row {
        box-shadow: black 0px 0px 30px -5px;
        position: relative;
    }

    .cart-list #daftar_belanja div.row::before,
    .cart-list #daftar_belanja div.row::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        border-color: transparent;
        border-style: solid;
    }

    .cart-list #daftar_belanja div.row::after {
        border-width: 1.35em;
        border-left-color: #E69100;
        border-top-color: #E69100;
    }

    .cart-list #daftar_belanja div.row .numbering {
        position: absolute;
        padding: 0 1%;
        top: 0;
        left: 0;
        z-index: 2;
        color: white;
        font-size: 110%;
        font-weight: bold;
    }

    .cart-list #daftar_belanja span#harga {
        color: #2A6C95;
    }

    .cart-list #daftar_belanja span.label {
        border-radius: 0;
    }

    @media (max-width: 970px) {
        /* reset vertical-align */
        .row .vertical-align {
            display: flow-root;
        }
    }

</style>
<section class="wrap-deskripsi"> <!-- konten -->
    <div class="mt-5 mx-auto row">
        <div class="row mx-auto w-75">
            <div class=" col-md-12">

            </div>
        </div><!-- End of Row  -->
        <div class="row mx-auto w-75">
            <div class="col-md-12">
                <div class="panel panel-primary cart-list">
                    <div class="panel-heading text-center p-0">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#daftar_belanja">Daftar Belanja</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="daftar_belanja" class="tab-pane active">
                            <div class="p-4">
                                <?php
                                $i = 1;
                                foreach ($transaksi as $key => $value) {
                                    ?>

                                    <div class="row m-3 p-3 vertical-align">
                                        <div class="numbering"><?= $i++; ?></div>
                                        <div class="text-center col-md-2 col-sm-12">
                                            <div class="mx-auto"
                                                 style="width: 100px;height: 100px;border-radius:100%;background: url('<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>') center center / 200px no-repeat;"></div>
                                        </div>
                                        <div class="col-md-7 col-sm-12">
                                            <button class="btn btn-primary btn-sm p-1">Kelas Premium</button>
                                            <h4 class="font-weight-bold mb-0"><?= $value->nama_mapel ?></h4>
                                            <span class="font-weight-bold"><?= date("d F Y", strtotime($value->created_at)) ?></span>
                                            <span id="id_transaksi"
                                                  class="text-gray-3">ID Transaksi : <?= str_pad($value->id_transaksi, 10, "0", STR_PAD_LEFT) ?></span>
                                            <br>
                                            <label for="harga">Total Pembayaran : </label> <span id="harga"
                                                                                                 class="font-weight-bold font-size-h1">Rp. <?= money($value->jumlah_total) ?></span>
                                        </div>
                                        <div class="col-md-3 col-sm-12 text-right">
                                            <label for="status" class="text-gray-3">Status :</label>
                                            <br>
                                            <?php
                                            $status = array(
                                                1 => array(
                                                    "tipe" => "success",
                                                    "teks" => "Pesanan Selesai",
                                                ),
                                                0 => array(
                                                    "tipe" => "danger",
                                                    "teks" => "Belum Di Bayar",
                                                ),
                                                2 => array(
                                                    "tipe" => "warning",
                                                    "teks" => "Menunggu Konfirmasi Admin",
                                                ),
                                            );

                                            ?>
                                            <span class="label label-<?= $status[$value->status]['tipe'] ?> px-5 font-size-h5"><?= $status[$value->status]['teks'] ?></span>
                                        </div>
                                    </div>
                                    <?php
                                    ?>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer text-center">
                        <a href="#">Muat Lebih Banyak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    </div>
    </div>
</section> <!-- End of konten-->
<?php $this->load->view('pg_user/footer'); ?>

</body>
</html>
