<!DOCTYPE html>
<html lang="en" class="fullpage-login-html">
	<head>
    	<title>Karisma Academy - Sertifikasi Online</title>
			
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/favicon.ico'); ?>">
		
		<!-- Stylesheets -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/themify-icons.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/font-awesome.min.css'); ?>">

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style2.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/responsive.css'); ?>">
	</head>

	<body>
		<!-- HEADER -->  
	    <header class="top-header">
	        <div class="container">
	            <nav class="navbar navbar-default navbar-custom" role="navigation">
	                <div class="container-fluid">
	                    <div class="navbar-header">
	                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                                <span class="sr-only">Toggle navigation</span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                          </button>
	                          <a class="navbar-brand logo" href="." ></a>
	                    </div>

	                    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
	                        <ul class="nav navbar-nav">
	                            <li><a href="<?php echo base_url().'signup' ?>">Daftar</a></li>
	                            <li><a href="<?php echo base_url().'login' ?>">Masuk</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </nav>
	        </div>
		</header>

		<section>
			<div class="container">
	            <div class="row">
					<div class="col-lg-5 col-md-6 col-xs-12 col-center login">
                        <?php echo $this->session->flashdata('alert'); ?>

	                    <h2>Login</h2>
                        <h3><?php echo $this->session->userdata("id_siswa"); ?></h3>
						<br>
						<button class="btn btn-primary btn-block">
							<i class="fa fa-facebook"></i>&emsp; Masuk dengan Facebook
						</button>
						<button class="btn btn-danger btn-block">
							<i class="fa fa-google-plus"></i>&emsp; Masuk dengan Google
						</button>
	                    <div class="line-text">
	                      <span>atau</span>
	                    </div>

	                    <form action="<?php echo base_url('login/login_submit') ?>" method="post" enctype="multipart/form-data">
	                        <div class="form-group has-feedback">
	                            <span class="ti-user form-control-feedback"></span>
	                            <input type="text" class="form-control" placeholder="Username atau Email" name="username">
	                        </div>
	                        <div class="form-group has-feedback">
	                            <span class="ti-lock form-control-feedback"></span>
	                            <input type="password" class="form-control" placeholder="Kata Sandi" name="password">
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <button type="submit" class="btn btn-primary btn-login">
	                                    Masuk
	                                </button>
	                            </div>
	                            <div class="col-md-8 text-right">
	                                <a href='#'>Lupa Password?</a><br>
	                                Belum punya akun? Daftar <a href="<?php echo base_url().'signup' ?>">di sini</a>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
			</div>
		</section>
	</body>

		<!-- Footer -->
		<?php // include('modal_lupa_password.php'); ?>
		<?php include('footer.php');?> 
		<!-- /Footer -->

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$("#btnLoginFb").on("click", function() {
					_login();
				})
			})
		</script>

		<script type="text/javascript">
		//Validator untuk modal_lupa_password
			$(document).ready(function() {
			 $('#formLupaPassword')
			 .formValidation({
					icon: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						email_reset: {
							validators: {
								notEmpty: {
										message: 'Alamat email tidak boleh kosong'
								},
								emailAddress: {
										message: 'Alamat email tidak valid'
								}
							}
						}
					}
				})
			 .on('success.form.fv', function(e, data) {
					// Prevent form submission
					e.preventDefault();
					var email = $("input[name^='email_reset']").val();
					var $form = $(e.target),
							fv    = $form.data('formValidation');

					if (fv.getSubmitButton()) {
							$.ajax({
								url: $form.attr('action'),
								type: 'POST',
								data: {email:email},
								success: function(response){
									if(response === 'true') {
										$("#alertDangerLupaPassword").slideUp();
										$("#alertSuccessLupaPassword").slideDown().delay(4000).slideUp();
									} 
									else {
										$("#alertSuccessLupaPassword").slideUp();
										$("#alertDangerLupaPassword").slideDown().delay(4000).slideUp();
									}
								}
							});
						}
				})

			 $('#modalLupaPassword').on('hidden.bs.modal', function() {
					$('#formLupaPassword').formValidation('resetForm', true);
				})

			});
		</script>

		<!-- Facebook Login -->
		<script>
			// Load the SDK asynchronously
		 
			(function(d, s, id){
				 var js, fjs = d.getElementsByTagName(s)[0];
				 if (d.getElementById(id)) {return;}
				 js = d.createElement(s); js.id = id;
				 js.src = "//connect.facebook.net/en_US/sdk.js";
				 fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
				
			window.fbAsyncInit = function() {
			FB.init({
				appId      : '674931862665310', //Your APP ID
				cookie     : true,  // enable cookies to allow the server to access 
														// the session
				xfbml      : true,  // parse social plugins on this page
				version    : 'v2.7' // use version 2.1
			});

			// These three cases are handled in the callback function.
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response);
			});

			};
				
			// This is called with the results from from FB.getLoginStatus().
			function statusChangeCallback(response) {
				if (response.status === 'connected') {
					// Logged into your app and Facebook.
					FB.api('/me?fields=name', function(response) {
						$("#labelLoginFb").text("Masuk sebagai " + response.name);
					});
				} else if (response.status === 'not_authorized') {
					// The person is logged into Facebook, but not your app.
					// document.getElementById('status').innerHTML = 'Please log ' +
					//   'into this app.';
				}
			}  
			
			function _login() {
				FB.login(function(response) {
					 // handle the response
					 if(response.status==='connected') {
						_i();
					 }
				 }, {scope: 'email, public_profile'});
			}

			function _logout() {
					FB.logout(function(response) {
						// user is now logged out
					});
			}
		 
		 function _i(){
				 FB.api('/me?fields=name, email', function(response) {
						// console.log(response);
						$("#labelLoginFb").text("Masuk sebagai " + response.name);

						$.ajax({ 
							url: "<?php echo base_url('login/cek_akun_fb')?>",
							type: 'post',
							data: { 'id': response.id },
							success: function(data, status) {
								// console.log("data: " + data);
								if(data == 'true') {
									// console.log("Hey it's true");
									window.location.replace("<?php echo base_url();?>");
								} 
								else if(data == 'false') {
									// console.log("Hey it's false");
									$("#alertLoginFb").fadeIn();
								}
							},
							error: function(xhr, desc, err) {
								console.log(xhr);
								console.log("Details: " + desc + "\nError:" + err);
							}

						 })
				});
		 }

		</script>
	</body>
</html>