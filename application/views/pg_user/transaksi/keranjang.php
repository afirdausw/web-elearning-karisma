<?php


$this->load->view('pg_user/inc/header');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<!-- //sementara -->
<style>
    .panel, .panel > * {
        border-radius: 0;
    }

    .panel-primary, .panel > .panel-footer {
        border-color: #BABABA;
    }

    .panel-primary > .panel-heading {
        background-color: #0779AF;
        border-color: #0779AF;
    }

    .cart-list .table tr > td {
        vertical-align: middle;
    }

    .cart-list .table tr > td > img {
        border-radius: 100%;
    }

    .cart-list a:hover,
    .cart-list a:focus,
    .cart-list a:active {
        text-decoration: none;
    }

    .cart-list .table tr > td:nth-child(3) > a:hover,
    .cart-list .table tr > td:nth-child(3) > a:focus {
        color: #C9302C !important;
    }

    .cart-list .table tr > td:nth-child(3) > .glyphicon {
        font-size: 20px;
    }

    .cart-list .table tr > td:nth-child(3) > .glyphicon,
    .cart-list .table tr > td:nth-child(3) > div > label,
    .cart-list .panel-footer > table td:last-child span {
        color: #ACACAC;
    }

    .cart-list .panel-footer {
        border-bottom: 1px solid;
        border-color: inherit;
    }

    .cart-list .panel-footer table td {
        border-top: 0;
    }

    .cart-list .panel-footer > table td:last-child {
        text-align: right !important;
    }

    .cart-list .panel-footer > table td:last-child h1 {
        border: 0;
        font-size: 40px;
        padding: 0;
        color: #0679AF;
    }

    .cara-bayar .panel-footer {
        background: white;
    }
    
    .wrapper-img {
        display: inline-block;
        position: relative;
    }

    .wrapper-img > .circle-img {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 50%;
        margin-top: -50%;
        left: 50%;
        margin-left: -50%;
        border-radius: 100%;
    }

</style>
<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row mt-5 mx-auto w-75">
            <?php if (isset($value->status)) {
                ?>
                <div class=" col-md-12">
                    <h4 class="text-right text-gray-3">ID Transaksi #12930129310293</h4>
                </div>
            <?php } ?>
        </div><!-- End of Row  -->
        <div class="row mx-auto w-75">
            <div class=" col-md-12">
                <div class="panel panel-primary cart-list">
                    <div class="panel-heading text-center">Daftar Belanja</div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <colgroup>
                                <col class="col-md-2">
                                <col class="col-md-7">
                                <col class="col-md-3">
                            </colgroup>
                            <?php
                            $total = 0;
                            $hargaKodeUnik = 110;
                            $kodeUnik = 0;
                            $expired = date("d M Y \j\a\m H:i");
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                    <div class="mx-auto w-100" style="width: 100px;height: 100px;border-radius:5%;background: url('<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>') center center / 100px no-repeat;"></div>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary p-2">
                                            Kelas Premium
                                        </button>
                                        <h3 class="w-100 font-weight-bold"><?= $value->nama_mapel ?></h3>
                                        <p>Created by <a
                                                    href="<?= base_url('instruktur/' . $value->id_instruktur); ?>"><?= $value->nama_instruktur ?></a>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?= base_url('keranjang/delete/' . $value->id_mapel) ?>"
                                           class="glyphicon glyphicon-trash"></a>
                                        <div>
                                            <label for="harga">Harga:</label>
                                            <br>
                                            <!--<span class="mr-3 text-gray text-line-through font-w700">Rp. 1.200.000</span>-->
                                            <h2 class="mt-0" id="harga">Rp. <?= money($value->harga) ?></h2>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $total += $value->harga;
//                                $kodeUnik += $hargaKodeUnik;
                                ?>
                            <?php }
                            $total += $kodeUnik; ?>
                        </table>
                    </div>
                    <div class="panel-footer px-10 table-responsive">
                        <table class="table mx-0 my-3">
                            <colgroup>
                                <col class="col-md-4">
                                <col class="col-md-8">
                            </colgroup>
                            <tr>
                                <td>
                                    <div><h4>Jumlah yang harus dibayar</h4></div>
                                    <span>Status: </span>
                                    <?php
                                    if (isset($value->status) && !$value->status) { ?>
                                        <span class="label label-warning">Belum Dibayar</span>
                                    <?php } elseif (!isset($value->status)) {
                                        ?>
                                        <span class="label label-danger">Keranjang Kosong</span>
                                        <?php
                                    } else { ?>
                                        <span class="label label-success">Sudah Dibayar</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <h1 class="m-0">
                                        <?= "Rp. " . money($total); ?>
                                    </h1>
                                    <!--                                    <span>Termasuk kode unik -->
                                    <? //= "Rp. " . money($kodeUnik) ?><!--</span>-->
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mx-auto w-75">
            <a href="<?= base_url('keranjang/checkout') ?>" class="btn btn-primary btn-lg btn-sm-block w-100 my-5"
               style="border-radius:0;">Bayar</a>
        </div>
        <div class="row mx-auto w-75">

        </div>
    </div>
</section> <!-- End of konten-->

<?php 
$this->load->view('pg_user/inc/footer');
?>
</body>
</html>
