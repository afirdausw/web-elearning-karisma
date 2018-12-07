<?php


include('header.php');
?>

<?php $_SESSION['RedirectKe'] = current_url(); ?>

<!-- //sementara -->
<style>
.panel, .panel > *{
  border-radius:0;
}
.panel-primary, .panel > .panel-footer {
  border-color:#BABABA;
}
.panel-primary > .panel-heading{
  background-color:#0779AF;
  border-color:#0779AF;
}



.cart-list .table tr > td{
  vertical-align: middle;
}
.cart-list .table tr > td > img{
  border-radius:100%;
}

.cart-list .table tr > td:nth-child(3) > div.glyphicon{
  font-size:40px;
}
.cart-list .table tr > td:nth-child(3) > div.glyphicon,
.cart-list .table tr > td:nth-child(3) > div > label,
.cart-list .panel-footer > table td:last-child span{
  color:#ACACAC;
}

.cart-list .panel-footer{
  border-bottom: 1px solid;
  border-color:inherit;
}
.cart-list .panel-footer table td{
  border-top:0;
}
.cart-list .panel-footer > table td:last-child{
  text-align:right !important;
}
.cart-list .panel-footer > table td:last-child h1{
  border:0;
  font-size:40px;
  padding:0;
  color:#0679AF;
}
    
</style>


<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1 class="text-right">ID Transaksi #12930129310293</h1>
            </div>
        </div><!-- End of Row  -->
        <div class="row mx-auto w-75">
          <div class=" col-md-12">
            <div class="panel panel-primary cart-list">
              <div class="panel-heading text-center">Daftar Belanja</div>
                <div class="">
                  <div class="table-responsive">
                    <table class="table table-hover m-0">
                      <colgroup>
                        <col class="col-md-2">
                        <col class="col-md-7">
                        <col class="col-md-3">
                      </colgroup>
                      <?php
                      $total=0;
                      $hargaKodeUnik=110;
                      $kodeUnik = 0;
                      foreach ($data as $key => $value) {
                        ?>
                        <tr>
                          <td class="text-center">
                            <img class="img-responsive w-75 mx-auto"
                                 src="<?= base_url() ?>image/mapel/<?= $value->gambar_mapel ?>" alt="<?= $value->nama_mapel ?>">
                          </td>
                          <td>
                            <button class="btn btn-primary p-2">
                              Kelas Premium
                            </button>
                            <h3 class="w-100 font-weight-bold"><?= $value->nama_mapel ?></h3>
                            <p>Created by <a href="<?=base_url('instruktur/'.$value->id_instruktur);?>"><?=$value->nama_instruktur?></a></p>
                          </td>
                          <td class="text-right">
                            <div class="glyphicon glyphicon-trash"></div>
                            <div>
                              <label for="harga">Harga:</label>
                              <br>
                              <!--                                                        <span class="mr-3 text-gray text-line-through font-w700">Rp. 1.200.000</span>-->
                              <h2 class="mt-0" id="harga">Rp. <?= money($value->harga) ?></h2>
                            </div>
                          </td>
                        </tr>
                        <?php
                          $total+=$value->harga;
                          $kodeUnik+=$hargaKodeUnik;
                        ?>
                      <?php }
                      $total+=$kodeUnik;?>
                    </table>
                  </div>
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
                      <span>Status: </span><span class="label label-warning">Belum Dibayar</span>
                    </td>
                    <td>
                      <h1 class="m-0">
                        <?="Rp. ".money($total);?>
                      </h1>
                      <span>Termasuk kode unik <?="Rp. ".money($kodeUnik)?></span>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row mx-auto w-75">

            <div class="col-md-4">
                <div class=" materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/bca.png">
                        <div class="caption mt-3 text-gray-2 min-height-50">
                            <h3 class="font-w500">BCA</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/bri.png">
                        <div class="caption mt-3 text-gray-2 min-height-50">
                            <h3 class="font-w500">BRI</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class=" materi-lainnya p-3">
                    <a>
                        <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/mandiri.png"   >
                        <div class="caption mt-3 text-gray-2 min-height-50">
                            <h3 class="font-w500">MANDIRI</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
