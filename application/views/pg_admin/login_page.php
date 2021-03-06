<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<style type="text/css">
	@media(max-width:767px;){
		.login-page{
			margin-top:40px;
		}
	}
	.login-page{
		margin-top:100px;
	}
</style>

<div class="wrapper">
		<div class="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-xs-12 col-sm-4 col-sm-offset-4 login-page">
					
					 <?php echo $this->session->flashdata('alert'); ?>
					
						<div class="card">
							<div class="header">
								<h4 class="title"><?php echo isset($page_title) ? $page_title : "Login"?>
									<?php if($this->uri->segment(1)== "psep_sekolah"){
										echo "Sekolah / Guru";
									}else{
										echo "Admin";
									}

									?>
									
								</h4>
							</div>
							<div class="content">
								<form method="post" action="<?php echo $form_action?>">
				
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
													<input type="text" name="username" id="username" class="form-control" placeholder="Username" required="required" autofocus="true">
												</div>
												<?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
											</div>
										</div>
									</div>
				
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
													<input type="password" name="userpass" id="userpass" class="form-control" placeholder="Password" required="required">
												</div>
												<?php echo form_error('userpass', '<div class="text-danger">', '</div>'); ?>
											</div>
										</div>
									</div>
								
									<div class="row">
										<div class="col-sm-12">
											<button type="submit" name="form_submit" value="submit" class="btn btn-fill btn-primary form-control">
												<i class="glyphicon glyphicon-log-in"></i> Login
											</button>
										</div>
									</div>
								</form>

								<div class="footer text-right">
									<hr>
									<div class="stats">
										<i class="fa fa-copyright"></i> <?php echo date('Y');?> <span class="text-primary">Karisma Academy</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end .content -->

	</div>
</div> <!-- end .wrapper -->

</body>

	<!--   Core JS Files   -->
	<script src="<?php echo base_url('assets/plugins/jquery/jquery-1.12.4.min.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/plugins/bootstrap-3/js/bootstrap.min.js');?>" type="text/javascript"></script>

	<!--  Notifications Plugin    -->
	<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-notify/bootstrap-notify.js');?>"></script>

</html>
