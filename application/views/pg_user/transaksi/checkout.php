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

    #modalCheckout .modal-content {
        border-radius: 3px;
    }

    #modalCheckout .modal-header {
        background: #E39125;
        border-radius: 3px 3px 0 0;
        color: white;
    }

    #modalCheckout .modal-header .close {
        color: white;
        font-size: 30px;
        float: none;
        opacity: 1 !important;
    }

    #modalCheckout .modal-header > * {
        display: inline-block;
    }

    #modalCheckout .modal-footer {
        border-bottom: none !important;
    }

    .borderless td, .borderless th {
        border-top: none !important;
    }

</style>
<section> <!-- konten -->
    <div class="mt-5 mx-auto row">
        <div class="row mx-auto w-75">
            <div class="text-right">
                <h4 class="text-right text-gray-3 mr-4">ID Transaksi #<?= sprintf("%08d", $transaksi->id_transaksi); ?></h4>
            </div>
            <div class=" col-md-5">
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
                <div class="panel panel-primary cara-bayar">
                    <div class="panel-heading text-center">Cara Pembayaran</div>
                    <div class="p-1 py-4">
                        <div class="container w-100">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <div class="status-transaksi text-right">
                                        <?php
                                        if (isset($transaksi->status) && $transaksi->status == 0) { ?>
                                            <span style="font-size: 14px;" class="label label-danger">Belum Dibayar</span>
                                        <?php } elseif (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                            <span style="font-size: 14px;" class="label label-warning">Menunggu Konfirmasi Admin</span>
                                        <?php } else { ?>
                                            <span class="label label-success">Sudah Dibayar</span>
                                        <?php } ?>
                                    </div>
                                    <p class="text-gray-3 mt-5" style="line-height: 18px;">Silahkan transfer <strong><?= "Rp. " . money($transaksi->jumlah_total); ?></strong> pada
                                        salah satu rekening berikut Sebelum : </p>                                    
                                    <?php if (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                        <p class="w-75 mt-5 mx-auto text-center">Bukti Pembayaran Berhasil Di Upload
                                            Masih Menunggu Konfirmasi Dari Admin</p>
                                    <?php } else { ?>
                                        <h2 class="w-75 mt-5 mx-auto text-center h1" id="clock" style="font-size: 24pt;"></h2>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row mt-5 text-center">
                                <div class="col-md-6 w-100">
                                    <select onchange="ganti_bank(this.value)" class="form-control">
                                        <option value="bca">Transfer Ke BCA</option>
                                        <option value="bri">Transfer Ke BRI</option>
                                        <option value="mandiri">Transfer Ke Mandiri</option>
                                    </select>
                                    <?php
                                    $bank = array(
                                        "bca" => [
                                            "image" => ".png",
                                            "rekening" => "4890279797",
                                            "atasNama" => "Karisma Academy",
                                            "link" => "#",
                                        ],
                                        "bri" => [
                                            "image" => ".png",
                                            "rekening" => "4890279797",
                                            "atasNama" => "Karisma Academy",
                                            "link" => "#",
                                        ],
                                        "mandiri" => [
                                            "image" => ".png",
                                            "rekening" => "4890279797",
                                            "atasNama" => "Karisma Academy",
                                            "link" => "#",
                                        ],
                                    );
                                    foreach ($bank as $key => $val) {
                                        ?>
                                        <div id="bank-<?= $key ?>" class="col-md-12 col-sm-12 mt-3"
                                             style="display: none;">
                                            <div class="row mt-3">
                                                <div class="col-md-5">
                                                    <img class="w-100" src="<?= base_url() ?>assets/pg_user/images/<?= $key . $val['image'] ?>">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class=" text-gray-2 min-height-20">
                                                        <p class="m-0"><small><?= $val['rekening'] ?></small></p>
                                                        <p style="margin-top: -8px;"><small><small>a/n <?= $val['atasNama'] ?></small></small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-gray-3">Tulis berita acara dengan ID transaksi, contoh transaksi <?= sprintf("%08d", $transaksi->id_transaksi); ?></p>
                                    <p class="text-red" style="color: #ff0033; text-align: left;"><i>*Jangan Lupa Simpan atau Foto Bukti Pembayaran/transfer</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer px-10 text-md-right text-sm-center">
                        <button class="btn btn-primary btn-lg btn-sm-block p-3" data-toggle="modal"
                                data-target="#modalCheckout"
                                style="border-radius:0; font-size: 15px;">Upload Bukti Pembayaran
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-primary cart-list">
                    <div class="panel-heading text-center">Daftar Belanja</div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <colgroup>
                                <col class="col-md-2">
                                <col class="col-md-7">
                                <col class="col-2 col-md-4">
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
                                        <!-- <div class="mx-auto"
                                             style="width: 50px;height: 50px; border-radius:100%;background: url('<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>') center center / 400px no-repeat;"></div> -->
                                        <img src="<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>" style="border-radius: 100%;" class="w-100">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary p-2 mt-3" style="font-size: 10px;">
                                            Kelas Premium
                                        </button>
                                        <p class="w-100 font-weight-bold"><?= $value->nama_mapel ?></p>
                                        <p style="margin-top: -10px;">Created by <a href="<?= base_url('instruktur/' . $value->id_instruktur); ?>"><b><?= $value->nama_instruktur ?></b></a>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <div>
                                            <label for="harga">Harga:</label>
                                            <br>
                                            <!--<span class="mr-3 text-gray text-line-through font-w700">Rp. 1.200.000</span>-->
                                            <p class="mt-0" id="harga"><b>Rp. <?= money($value->harga) ?></b></p>
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
                    <div class="panel-footer p-2">
                        <table class="table mx-0 my-3">
                            <colgroup>
                                <col class="col-md-8">
                                <col class="col-md-4">
                            </colgroup>
                            <tr>
                                <td>
                                    <p>Jumlah yang harus dibayar</p>
                                    <span>Status: </span>
                                    <?php
                                    if (isset($transaksi->status) && $transaksi->status == 0) { ?>
                                        <span style="font-size: 14px;" class="label label-danger">Belum Dibayar</span>
                                    <?php } elseif (isset($transaksi->status) && $transaksi->status == 2) { ?>
                                        <span style="font-size: 14px;" class="label label-warning">Menunggu Konfirmasi Admin</span>
                                    <?php } else { ?>
                                        <span class="label label-success">Sudah Dibayar</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <h2 class="m-0">
                                        <small> <b><?= "Rp. " . money($total); ?></b></small>
                                    </h2>
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
        <!-- PROGRESS -->
        <div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog  mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="mx-4 close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title mx-2" id="myModalLabel">Konfirmasi Pembayaran</h4>
                    </div>
                    <form method="POST" action="<?= base_url('konfirmasi/pembayaran/' . $transaksi->id_transaksi) ?>"
                          enctype="multipart/form-data">
                        <div class="modal-body px-5">

                            <div class="form-group">
                                <label for="bank_anda">Bank Yang Anda Gunakan</label>
                                <input <?= $transaksi->status == 2 ? "readonly" : "" ?> type="text" name="bank_anda"
                                                                                        value="<?= $transaksi->bank_anda ?>"
                                                                                        class="form-control"
                                                                                        id="bank_anda"
                                                                                        placeholder="Ex. (BRI/BCA/MANDIRI/BNI)">
                            </div>
                            <div class="form-group">
                                <label for="no_rekening">No. Rekening</label>
                                <input <?= $transaksi->status == 2 ? "readonly" : "" ?> type="text" name="no_rekening"
                                                                                        value="<?= $transaksi->atas_nama ?>"
                                                                                        class="form-control"
                                                                                        id="no_rekening"
                                                                                        placeholder="00000000">
                            </div>
                            <div class="form-group">
                                <label for="atas_nama">Nama Pemilik Rekening</label>
                                <input <?= $transaksi->status == 2 ? "readonly" : "" ?> type="text" name="atas_nama"
                                                                                        value="<?= $transaksi->atas_nama ?>"
                                                                                        class="form-control"
                                                                                        id="atas_nama"
                                                                                        placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="bank_tujuan">Bank Tujuan</label>
                                <select class="form-control" name="bank_tujuan" required>
                                    <?php
                                    foreach ($bank as $key => $val) { ?>
                                        <option value="<?= strtoupper($key); ?>"><?= strtoupper($key) . " a/n " . $val['atasNama']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_transfer">Total Yang Di Transfer</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp </span>
                                    <input <?= $transaksi->status == 2 ? "readonly" : "" ?> type="number"
                                                                                            name="total_transfer"
                                                                                            value="<?= $transaksi->total_transfer ?>"
                                                                                            class="form-control"
                                                                                            placeholder="0000">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 col-sm-12 ">
                                    <label for="bukti_pembayaran">Bukti Transfer</label>
                                    <input <?= $transaksi->status == 2 ? "disabled" : "" ?> type="file"
                                                                                            name="bukti_pembayaran"
                                                                                            accept="image/*">
                                    <p class="help-block">Bukti transfer berupa gambar</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <?php if ($transaksi->status == 1 || $transaksi->status == 0) {
                                        $gambar = base_url() . "/assets/img/no-image.jpg";
                                    } else {
                                        $gambar = base_url() . "/assets/uploads/bukti_transfer/" . $transaksi->bukti_pembayaran; ?>
                                        <a href="<?= $gambar ?>" class="col-md-6">Lihat Gambar</a>
                                        <?php
                                    } ?>
                                </div>
                                <?php
                                if ($transaksi->status == 0) {
                                    ?>
                                    <div class="col-md-offset-2 col-sm-12 col-md-4">
                                        <button type="button" class="btn btn-default btn-lg btn-block"
                                                data-dismiss="modal">Tutup
                                        </button>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Kirim</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
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
