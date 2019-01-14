<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <link rel="icon" type="image/png" href="assets/img/favicon.ico">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

 <title>PG_Admin Preview</title>

 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <!-- Bootstrap core CSS     -->
  <link href="<?php echo base_url('assets/plugins/bootstrap-3/css/bootstrap.min.css');?>" rel="stylesheet" />

    <!--     Fonts and icons     -->
  <link href="<?php echo base_url('assets/plugins/fontawesome-5.6.3/css/all.min.css');?>" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="<?php echo base_url('assets/pg_user/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

</head>
<body>
  <?php 
  	// var_dump($content_preview);
    // echo $thumbnail_dir; 
    echo "Thumbnail: <br>" . "<img src=$thumbnail_dir alt='No Image' style='width:200px;'>" . "<br><br>";
    echo "Konten Teks: <br>";
    echo isset($content_preview->isi_materi) ? htmlspecialchars_decode($content_preview->isi_materi) : "<div class='text-muted'>Preview tidak tersedia</div>";  
    echo "<br>";
    echo "Konten Video: <br>";
    echo isset($content_preview->video_materi) ? $content_preview->video_materi : "<div class='text-muted'>Video tidak tersedia</div>";  
  	?>
</body>
</html>