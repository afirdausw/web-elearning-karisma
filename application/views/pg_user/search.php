<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Lembaga Pendidikan Islam Hidayatullah</title>
    
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-lpi.png');?>" >

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">
    
  </head>
  <body>
    <header>
      <!-- nav bar -->
      <?php include('header.php');?>
      
      <div class="search-wrap" style="margin-top:65px;">
        <div class="container" style="padding: 0px 50px;">
          <form name="search_form" id="search_form" action="<?=base_url('pencarian/cari');?>" method="get" class="form-inline">
            <div class="form-group">
              <input type="text" name="key" id="key" class="form-control" placeholder="Masukkan kata kunci..."
              <?php
              if(isset($_GET['key']))
              { ?>
              value="<?php echo $_GET['key']; ?>"
            <?php 
              } ?>
              >
            </div>
            <button class="btn btn-default" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </header>
    
    <div class="container-fluid daftar-isi konten-wrapper" style="padding: 20px 12% !important;">

	<div class="row well" style="background:#fff;">

      <div class="container col-lg-12" style="min-height:300px;">
        <?php
        if(isset($_GET['key']))
          {?>
          <div class="page-title" style="padding-bottom:20px;">
            <h3>Hasil Pencarian untuk "<?php echo $_GET['key']; ?>"</h3>
            <p class="text-mute"><i>Ditemukan <?php echo $total_rows?> hasil</i></p>
          </div>
          <hr style="margin:0px 0px 10px 0px;">
        <?php 
          } ?>

        <?php 
          $get = $_GET;
          if(isset($get['tipe'])) 
            { unset($get['tipe']); }
          
          $get = '?'.http_build_query($get);
        ?>

        <ul class="list-inline nav-searching">
          <li class="<?php echo (empty($_GET['tipe'])) ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get;?>">Semua</a>
          </li>
          <li class="<?php echo (isset($_GET['tipe']) && $_GET['tipe'] == 'teks') ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get.'&tipe=teks';?>">Materi Teks</a>
          </li>
          <li class="<?php echo (isset($_GET['tipe']) && $_GET['tipe'] == 'video') ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get.'&tipe=video';?>">Materi Video</a>
          </li>
        </ul>
        <hr style="margin:0px 0px 20px 0px;">
        
        <div id="search_result_all">
        
          <?php 
          if(!empty($search_result))
            {
              $img_default = base_url('assets/img/no-image.jpg'); 
              foreach ($search_result as $item) 
              {
                $img_materi = base_url().'assets/js/plugins/kcfinder/upload/images/'.$item['gambar_materi']
                ?>
                
                <div class="row page-result">
				  <!--
                  <div class="col-sm-3 text-center">
                    <img src="<?php echo (!empty($item['gambar_materi']) ? $img_materi : $img_default) ;?>" class="" style="height:100px;"></img>
                  </div>
                  -->
                  <div class="col-sm-12">
                    <h4>
                      <?php
                      if($item['kategori'] == 1) { ?>
                        <a href="<?php echo base_url('materi/konten_teks/'.$item['id_konten'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php
                      } else if($item['kategori'] == 2) { ?>
                        <a href="<?php echo base_url('materi/konten_video/'.$item['id_konten'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php 
                      } else if($item['kategori'] == 3) { ?>
                        <a href="<?php echo base_url('latihan/index/'.$item['id_sub_materi'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php
                      } ?>
                    </h4>
                    <p><?php echo $item['nama_materi_pokok']?></p>
                    <p><?php echo $item['nama_mapel']?></p>
                    <p><?php echo $item['alias_kelas']?></p>
                  </div>
                </div>
				<hr style="margin:0px 0px 20px 0px;">

              <?php
              }
            }
          ?>
        </div> <!-- /#search_result_all -->

        <div class="col-sm-12 search-pagination">
          <nav class="text-center">
            <?php echo isset($pagination) ? $pagination : ''; ?>
          </nav>
        </div>

      </div>  <!-- /container -->      

    </div>

    </div>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
  
    <script type="text/javascript">
      $('#search_form').submit(function(e){
        // e.preventDefault();
        // ajax_search();
      });
    </script>

    <script type="text/javascript">
      function ajax_search()
      {
        var key = $('#kata_kunci').val();
        console.log(key);
        $.ajax({
          url: "<?=base_url('pencarian/ajax_search');?>",
          type: 'post',
          // dataType: 'json',
          data: { 'key': key },
          success: function(data, status) {
            $('#search_result_all').html(data);
          },
          error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
          }
        });
      }
    </script>
  </body>
</html>
