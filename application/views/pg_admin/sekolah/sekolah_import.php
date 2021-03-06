<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<div class="wrapper">
  <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/inc/navbar.php");?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Import Data Sekolah"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">

                <div class="row">
                  <div class="col-md-12">
                    <?php echo $this->session->flashdata('alert'); ?>
                  </div>
                </div>

                <form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <h5>Ketentuan</h5>
                        </div>
                        <div class="panel-body">
                          <ul>
                            <li>File yang akan di-import dapat berupa file <strong>*.xls</strong> atau <strong>*.csv</strong></li>
                            <li>Pastikan format tabel excel sesuai dengan <i>template</i> yang telah disediakan <a href="<?php echo base_url().'assets/template/data_sekolah.xls'?>" class="label label-primary">DI SINI</a></li>
                            <li>Kolom <strong>Nama Sekolah</strong> dan <strong>Jenjang</strong> tidak boleh kosong!</li>
                            <li>Kolom <strong>Kota (ID)</strong> harus diisi sesuai dengan ID Kota yang telah ditentukan pada Sheet 2 dalam <i>template excel</i></li>
                            <li>Data akan di-import mulai dari baris kedua sampai baris terakhir
                            <li>Tidak boleh ada kolom/baris yang <strong>tersembunyi</strong> atau <strong>di-hidden</strong></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Import file CSV/XLS</label>
                        <input type="file" name="import_data" id="import_data" class="form-control">
                        <?php echo form_error('import_data', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-import"></i> Import</button>

                    </div>
                  
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div id="my_datatables">

                      </div>
                    </div>
                  </div>
                
                </form>

                <div class="footer">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-history"></i> Updated 3 minutes ago
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>

</html>
