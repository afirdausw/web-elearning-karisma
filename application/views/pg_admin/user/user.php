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
          <div class="col-md-8">
            <div class="card">
              <div class="header">
                <a href="<?php echo site_url('pg_admin/user/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah User</a>
                <h4 class="title">Semua User LPIH</h4>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>level</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						$no = 1;
						foreach($data_table as $data){
						?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $data->username;?></td>
								<td><?php echo $data->level;?></td>
								<td>
									<a href="<?php echo base_url('pg_admin/user/edit/'.$data->id_adm);?>">Edit</a> | 
									<a href="<?php echo base_url('pg_admin/user/edit_password/'.$data->id_adm);?>">Ubah Password</a>
									| 
									<a href="<?php echo base_url('pg_admin/user/hapus/'.$data->id_adm);?>" onclick="return confirm('Apakah anda yakin untuk menghapus user <?php echo $data->username;?> ?');">Hapus</a>
								</td>
							</tr>
						<?php
						}
					  ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>
<?php $this->load->view("pg_admin/alert/alert_modal.php"); ?>

</html>
