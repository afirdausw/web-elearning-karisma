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
                
                <h4 class="title">Edit Password User LPIH</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url("pg_admin/user/proses_edit_password");?>" method="post">
					<input type="hidden" name="iduser" value="<?php echo $user->id_adm;?>" /> 
					<div class="form-group">
						<label>Password<span class="text-danger">*</span></label>
						<input type="Password" name="password" class="form-control" placeholder="Masukkan Password..." required />
					</div>
					<div class="form-group">
						<label>Ulangi Password<span class="text-danger">*</span></label>
						<input type="Password" name="repassword" class="form-control" placeholder="Ulangi Password..." required />
					</div>
					<input type="submit" class="btn btn-primary" value="Simpan Akun" />
				</form>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>
    
<?php $this->load->view("pg_admin/alert/alert_modal.php"); ?>
</html>
