<?php include("header.php"); ?>


<section class="mt-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-5 col-xs-12 col-center login p-5">
				<?php echo $this->session->flashdata('alert'); ?>
				<h2>Login Instruktur</h2>
				<form method="post" action="<?php echo $form_action ?>" class="mt-5">
					<div class="form-group has-feedback">
						<span class="ti-user form-control-feedback"></span>
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" required="required" autofocus="true">
					</div>
					<div class="form-group has-feedback">
						<span class="ti-lock form-control-feedback"></span>
						<input type="password" name="userpass" id="userpass" class="form-control" placeholder="Password" required="required">
					</div>
					<button type="submit" name="form_submit" value="submit" class="btn btn-primary btn-block btn-login">Login</button>
					<div class="mt-2">
                    	<a href='#'>Lupa Password?</a>
                    </div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Footer -->
<?php // include('modal_lupa_password.php'); ?>
<?php include('footer.php'); ?>
<!-- /Footer -->

<!-- Javascript -->
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js'); ?>"></script>

</body>
</html>
