<?php


$this->load->view('pg_user/header');
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

</style>
<section class="wrap-deskripsi"> <!-- konten -->
    <div class="mt-5 mx-auto row">
        <div class="row">
            <div class=" col-md-12">

            </div>
        </div><!-- End of Row  -->
        <div class="row mx-auto w-75">
            <div class=" col-md-12">
                <?php
                if (isset($_SESSION['alert'])) {
                    if (count($_SESSION['alert']) > 0) {
                        foreach ($_SESSION['alert'] as $key => $item) {
                            echo $item;
                            echo "<br>";
                        }
                        $_SESSION['alert'] = null;
                    }
                }

                ?>
                <h4 class="text-right text-gray-3">ID Transaksi
                    #<?= sprintf("%08d", $transaksi->id_transaksi); ?></h4>
                <div class="panel panel-primary cara-bayar">
                    <div class="panel-heading text-center">Cara Pembayaran</div>
                    <div class="panel-body">
                        <div class="container w-100">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    if (isset($transaksi->status) && $transaksi->status == 0) { ?>
                                        <span style="font-size: 20px;" class="label label-danger">Belum Dibayar</span>
                                    <?php } elseif (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                        <span style="font-size: 15px;" class="label label-warning">Menunggu Konfirmasi Admin</span>
                                    <?php } else { ?>
                                        <span class="label label-success">Sudah Dibayar</span>
                                    <?php } ?>
                                    <h3 style="padding:1.5rem 0;" class="text-gray-3">Silahkan
                                        transfer <strong><?= "Rp. " . money($transaksi->jumlah_total); ?></strong> pada
                                        salah satu rekening berikut Sebelum : </h3>
                                    <?php if (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                        <h3 class="w-75 mt-0 mx-auto text-center ">Bukti Pembayaran Berhasil Di Upload
                                            Masih Menunggu Konfirmasi Dari Admin</h3>
                                    <?php } else { ?>
                                        <h2 class="w-50 mt-0 mx-auto text-center h1" id="clock"></h2>
                                    <?php } ?>
                                </div>
                                <select onchange="ganti_bank(this.value)" class="form-control">
                                    <option value="bca">Transfer Ke BCA</option>
                                    <option value="bri">Transfer Ke BRI</option>
                                    <option value="mandiri">Transfer Ke Mandiri</option>
                                </select>
                            </div>
                            <div class="row">
                                <?php
                                $bank = array(
                                    "bca"     => [
                                        "image"    => ".png",
                                        "rekening" => "4890279797",
                                        "atasNama" => "Karisma Academy",
                                        "link"     => "#",
                                    ],
                                    "bri"     => [
                                        "image"    => ".png",
                                        "rekening" => "4890279797",
                                        "atasNama" => "Karisma Academy",
                                        "link"     => "#",
                                    ],
                                    "mandiri" => [
                                        "image"    => ".png",
                                        "rekening" => "4890279797",
                                        "atasNama" => "Karisma Academy",
                                        "link"     => "#",
                                    ],
                                );
                                $colBagi = 12;
                                foreach ($bank as $key => $val) {
                                    ?>
                                    <div id="bank-<?= $key ?>" class="col-md-<?= $colBagi ?>   col-sm-12 mt-4"
                                         style="display: none;">
                                        <div class=" w-50 mx-auto  px-3 py-4"
                                             style="border: solid 1px white;box-shadow: 1px 2px 1px 0 rgba(20, 23, 28, .1), 0 2px 1px 0 rgba(20, 23, 28, .1)">
                                            <img style="display: block;" class="w-75 mx-auto"
                                                 src="<?= base_url() ?>assets/pg_user/images/<?= $key . $val['image'] ?>">
                                            <div class="container w-100">
                                                <div class="mt-3 text-gray-2 min-height-20">
                                                    <p class="m-0"><?= $val['rekening'] ?></p>
                                                    <p class="m-0">a/n <?= $val['atasNama'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p style="padding:1.5rem 0;" class="text-gray-3">Tulis berita acara dengan ID
                                        transaksi, contoh
                                        transaksi <?= sprintf("%08d", $transaksi->id_transaksi); ?></p>
                                    <p>
                                    <h3 class="text-red" style="color: #ff0033;">Jangan Lupa Simpan atau Foto
                                        Bukti
                                        Pembayaran/transfer
                                    </h3>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer px-10 text-md-right text-sm-center">
              <span class="text-gray-3">
<!--                Transaksi otomatis akan dicancel pada <span style="color:#C9302C;">-->
                  <? //= $expired ?><!--</span>-->
              </span>
                        <button class="btn btn-primary btn-lg btn-sm-block" data-toggle="modal" data-target="#myModal"
                                style="border-radius:0;">Upload Bukti
                            Pembayaran
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-primary cart-list">
                    <div class="panel-heading text-center">Daftar Belanja</div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <colgroup>
                                <col class="col-md-4">
                                <col class="col-md-5">
                                <col class="col-md-3">
                            </colgroup>
                            <?php
                            $total = 0;
                            $hargaKodeUnik = 110;
                            $kodeUnik = 0;
                            $expired = $transaksi->expired;
                            foreach ($detail_transaksi as $key => $value) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <img class="img-responsive w-75 mx-auto"
                                             src="<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>"
                                             alt="<?= $value->nama_mapel ?>">
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
                    <div class="panel-footer px-10">
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
                                    if (isset($transaksi->status) && $transaksi->status == 0) { ?>
                                        <span style="font-size: 20px;" class="label label-danger">Belum Dibayar</span>
                                    <?php } elseif (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                        <span style="font-size: 15px;" class="label label-warning">Menunggu Konfirmasi Admin</span>
                                    <?php } else { ?>
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


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog  mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title ml-4" id="myModalLabel">Upload Bukti Pembayaran</h4>
                    </div>
                    <form method="POST" action="<?= base_url('konfirmasi/pembayaran/' . $transaksi->id_transaksi) ?>"
                          enctype="multipart/form-data">
                        <div class="modal-body">
                            <table class="table table bordered">
                                <tr>
                                    <th>Atas Nama :</th>
                                    <td><input <?= $transaksi->status == 2 ? "readonly" : "" ?> class="form-control"
                                                                                                type="text"
                                                                                                name="atas_nama"
                                                                                                value="<?= $transaksi->atas_nama ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Yang Di Transfer :</th>
                                    <td><input <?= $transaksi->status == 2 ? "readonly" : "" ?> class="form-control"
                                                                                                type="text"
                                                                                                name="total_transfer"
                                                                                                value="<?= $transaksi->total_transfer ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bukti Transfer :</th>
                                    <td><input <?= $transaksi->status == 2 ? "disabled" : "" ?> type="file"
                                                                                                name="bukti_pembayaran">
                                    </td>
                                </tr>
                                <?php if ($transaksi->status == 1 || $transaksi->status == 0) {
                                    $gambar = base_url() . "/assets/img/no-image.jpg";
                                } else {
                                    $gambar = base_url() . "/assets/uploads/bukti_transfer/".$transaksi->bukti_pembayaran;
                                } ?>
                                <tr>
                                    <td align="right" colspan="2">
                                        <img src="<?= $gambar ?>" class="w-50"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                        if ($transaksi->status == 0) {
                            ?>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Upload</button>

                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section> <!-- End of konten-->
<?php $this->load->view('pg_user/footer'); ?>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.countdown.js'); ?>"></script>
<script type="text/javascript">
    ganti_bank('bca');
    $('#clock').countdown('<?= $expired ?>', function (event) {
        var $this = $(this).html(event.strftime(''
            + '%d : %H : %M : %S'));
    });

    function ganti_bank(value) {
        <?php
        foreach ($bank as $key => $val) {
        ?>
        $('#bank-<?= $key ?>').hide();
        <?php } ?>
        $('#bank-' + value).show();
    }
</script>
</body>
</html>
