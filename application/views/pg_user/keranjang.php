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
.cart-list a:hover,
.cart-list a:focus,
.cart-list a:active{
  text-decoration: none;
}
.cart-list .table tr > td:nth-child(3) > a:hover,
.cart-list .table tr > td:nth-child(3) > a:focus{
  color:#C9302C !important;
}


.cart-list .table tr > td:nth-child(3) > .glyphicon{
  font-size:40px;
}
.cart-list .table tr > td:nth-child(3) > .glyphicon,
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

.cara-bayar .panel-footer{
  background:white;
}
    
</style>
<section class="wrap-deskripsi"> <!-- konten -->
    <div class="container">
      <div class="row mt-5 mx-auto w-75">
        <div class=" col-md-12">
          <h4 class="text-right text-gray-3">ID Transaksi #12930129310293</h4>
        </div>
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
                  $total=0;
                  $hargaKodeUnik=110;
                  $kodeUnik = 0;
                  $expired = date("d M Y \j\a\m H:i");
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
                        <a href="#" class="glyphicon glyphicon-trash"></a>
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
                    if(!$value->status){ ?>
                      <span class="label label-warning">Belum Dibayar</span>
                    <?php }else{ ?>
                      <span class="label label-success">Sudah Dibayar</span>
                    <?php } ?>
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
        <div class="col-md-12">
          <div class="panel panel-primary cara-bayar">
            <div class="panel-heading text-center">Cara Pembayaran</div>
            <div class="panel-body">
              <div class="container w-100">
                <div class="row">
                  <div class="col-md-12">
                    <p style="padding:1.5rem 0;" class="text-gray-3">Silahkan transfer <?="Rp. ".money($total);?> pada salah satu rekening berikut</p>
                  </div>
                </div>
                <div class="row">
                  <?php
                  $bank = array(
                    "bca" => [
                      "image" => ".png",
                      "rekening" => "4890279797",
                      "atasNama" => "Karisma Academy",
                      "link"      => "#",
                    ],
                    "bri" =>  [
                      "image" => ".png",
                      "rekening" => "4890279797",
                      "atasNama" => "Karisma Academy",
                      "link"      => "#",
                    ],
                    "mandiri" =>  [
                      "image"     => ".png",
                      "rekening"  => "4890279797",
                      "atasNama"  => "Karisma Academy",
                      "link"      => "#",
                    ],
                  );
                  $colBagi = 12/count($bank);
                  foreach($bank as $key=>$val){
                  ?>
                  <div class="col-md-<?=$colBagi?> col-sm-12">
                      <div class="materi-lainnya px-3 py-4">
                          <a href="<?=$val['link']?>">
                              <img style="display: block;" class="w-75 mx-auto" src="<?= base_url() ?>assets/pg_user/images/<?=$key.$val['image']?>">
                              <div class="container w-100">
                                <div class="caption mt-3 text-gray-2 min-height-20">
                                    <p class="m-0"><?=$val['rekening']?></p>
                                    <p class="m-0">a/n <?=$val['atasNama']?></p>
                                </div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <?php } ?>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <p style="padding:1.5rem 0;" class="text-gray-3">Tulis berita acara dengan ID transaksi, contoh transaksi 12839128391283</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-footer px-10 text-md-right text-sm-center">
              <span class="text-gray-3">
                Transaksi otomatis akan dicancel pada <span style="color:#C9302C;"><?=$expired?></span>
              </span>
              <button class="btn btn-primary btn-lg btn-sm-block" style="border-radius:0;">Konfirmasi Pembayaran</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row mx-auto w-75">

      </div>
    </div>
</section> <!-- End of konten-->

<?php include('footer.php'); ?>
</body>
</html>
