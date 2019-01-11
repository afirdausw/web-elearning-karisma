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
                
                <h4 class="title">Edit User LPIH</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url("pg_admin/user/proses_edit");?>" method="post">
					<input type="hidden" name="iduser" value="<?php echo $user->id_adm;?>" />
					<div class="form-group">
						<label>Username<span class="text-danger">*</span></label>
						<input type="text" name="username" class="form-control" placeholder="Masukkan Username..." value="<?php echo $user->username;?>" required />
					</div>
					<div class="form-group">
						<label>Level<span class="text-danger">*</span></label>
						<select id="level" class="form-control" name="level" required>
							<option value="<?php echo $user->level;?>">
								<?php
									if($user->level == 'superadmin'){
										echo "Super Administrator";
									}elseif($user->level == 'admin'){
										echo "Administrator";
									}else{
										echo "Editor";
									}
								;?>
							</option>
							<option value="superadmin">Super Administrator</option>
							<option value="admin">Administrator</option>
							<option value="editor">Editor</option>
						</select>
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
<?php $this->load->view("pg_admin/alert_modal.php"); ?>
</html>
