<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<div class="wrapper">
  <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/inc/navbar.php"); ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <a href="<?php echo site_url('pg_admin/sekolah/manajemen/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah Sekolah</a>
                <h4 class="title">Semua Sekolah</h4>
                <p class="category">Daftar Sekolah</p>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Jenjang</th>
                        <th>Nama Sekolah</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1; 
                        foreach ($table_data as $item) 
                        {
                      ?>
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $item->jenjang?></td>
                          <td><?php echo $item->nama_sekolah?></td>
                          <td><?php echo $item->alamat_sekolah?></td>
                          <td><?php echo $item->email?></td>
                          <td><?php echo $item->telepon?></td>
                          <td class="text-center">
                            <div class="button-group">
                              <a href="<?php echo $form_action . 'manajemen/ubah?id=' . $item->id_sekolah ?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
                              <button type="button" class="btn btn-danger btn-xs" title="Hapus" data-number="<?php echo $no?>" value="<?php echo $item->id_sekolah?>" data-toggle="modal" data-target="#deleteRow_modal"><i class="glyphicon glyphicon-remove"></i></button>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $no++;
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>
<?php $this->load->view("pg_admin/alert_modal.php"); ?>
 <!-- JS Function for this Modal -->
<script type="text/javascript">
  $('#deleteRow_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var id = button.attr('value')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.number').text("#" + rownumber + "?")
    modal.find('input[name=hidden_row_id]').val(id)
  })
</script>


</html>
