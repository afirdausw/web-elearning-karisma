<?php


include('header.php');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>


<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1>Keranjang</h1>
            </div>
        </div><!-- End of Row  -->

        <div class="row mt-5">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <?php
                    foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td class="w-25 text-center">
                                <img class="my-auto w-50"
                                     src="<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>">
                            </td>
                            <td>
                                <h2 class="w-100 font-weight-bold mt-0"><?= $value->nama_mapel ?></h2>
                                <h3 class="w-100 mt-5 text-right">
                                    <!--                                                        <span class="mr-3 text-gray text-line-through font-w700">Rp. 1.200.000</span>-->
                                    <span>Rp. <?= money($value->harga) ?></span>
                                </h3>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="row mx-auto w-75">

            <div class="col-md-4">
                <div class=" materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/bca.png">
                        <div class="caption mt-5 text-gray-2 min-height-50">
                            <h3 class="font-w400">BCA</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/bri.png">
                        <div class="caption mt-5 text-gray-2 min-height-50">
                            <h3 class="font-w400">BRI</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class=" materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/mandiri.png"   >
                        <div class="caption mt-5 text-gray-2 min-height-50">
                            <h3 class="font-w400">MANDIRI</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
