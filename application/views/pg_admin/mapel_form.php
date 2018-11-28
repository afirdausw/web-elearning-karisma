<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Mata Pelajaran"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Kelas<span class="text-danger">*</span></label>
                    <?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Kelas..." name="kelas" class="chosen-select" style="width: 100%;" tabindex="1" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options as $item) { ?>
                            <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data->id_kelas) ? FALSE : ($data->id_kelas == $item->id_kelas ? TRUE : FALSE)) );?> value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Mata Pelajaran<span class="text-danger">*</span></label>
                        <?php echo form_error('mata_pelajaran', '<div class="text-danger">', '</div>'); ?>
                        <input type="text" name="mata_pelajaran" class="form-control" placeholder="Nama Mata Pelajaran" value="<?php echo set_value('mata_pelajaran', isset($data->nama_mapel) ? $data->nama_mapel : '');?>" required="required">
                      </div>
                    </div>
                  </div>
                  <?php //$hide = true;?>
                  <?php //if($hide == false) { ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gambar_mapel">Gambar Thumbnail</label>
                        <input type="file" id="" class="form-control" name="gambar_mapel" accept="image/*">
                      </div>
                    </div>
                    <?php if($page_title == "Ubah Mata Pelajaran"){?>
                    <div class="col-md-6">
                      <label for="gambar_mapel">Gambar Thumbnail Sekarang</label>
                      <img src="<?=(isset($data->gambar_mapel) ? (!empty($data->gambar_mapel)  ? base_url().'image/mapel/'.$data->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>" alt="Gambar Mapel" style="display:block;max-width: 10vw;">
                    </div>
                    <?php } ?>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskripsi Mata Pelajaran</label>
                        <textarea name="deskripsi_mapel" class="form-control" placeholder="Deskripsi Mata Pelajaran" rows="8"><?php echo set_value('deskripsi_mapel', isset($data->deskripsi_mapel) ? $data->deskripsi_mapel : '');?></textarea>
                      </div>
                    </div>
                  </div>
                  <?php //} ?>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="button" class="btn btn-danger pull-right" onclick="window.history.back();"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>

                <div class="footer">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-history"></i> Updated 4 minutes ago
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

  <!--   Core JS Files   -->
  <script src="<?php echo base_url('assets/js/jquery-3.2.1.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

  <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
 <script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

 <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->

 <script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
  function resetForm(form){
    // clearing selects
    $('.chosen-select').val('').trigger('chosen:updated');
  }
</script>

<!-- PLUGINS FUNCTION -->
 <!-- Chosen - select box plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

  <!-- Manually open kcfinder -->
  <script type="text/javascript">
    /*
    function openKCFinder(field) {
      console.log("OPENKCFINDER" + field);
      window.KCFinder = {
        callBack: function(url) {
            // field.value = url; DEFAULT (Full URL)
            field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
            window.KCFinder = null;
        }
      };
      window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=images&dir=images", 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
    */
  </script>
</html>
