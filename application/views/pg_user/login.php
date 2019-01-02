<?php include("header.php"); ?>

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
                    <input type="hidden" name="mapel_id"
                           value="<?= isset($_GET['mapel_id']) ? $_GET['mapel_id'] : 0 ?>">
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
                            Belum punya akun? Daftar <a
                                    href="<?php echo base_url() . 'signup' . (isset($_GET['mapel_id']) ? '?mapel_id=' . $_GET['mapel_id'] : '') ?>">di
                                sini</a><br>
                            <!--                                     Atau anda hanya ingin mencoba <b>pretes</b> dari kami, daftar <a href="<?php echo base_url() . 'pretest' ?>">di sini</a>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>

<!-- Footer -->
<?php // include('modal/modal_lupa_password.php'); ?>
<?php include('footer.php'); ?>
<!-- /Footer -->

<!-- Javascript -->
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnLoginFb").on("click", function () {
            _login();
        })
    })
</script>

<script type="text/javascript">
    //Validator untuk modal_lupa_password
    $(document).ready(function () {
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
            .on('success.form.fv', function (e, data) {
                // Prevent form submission
                e.preventDefault();
                var email = $("input[name^='email_reset']").val();
                var $form = $(e.target),
                    fv = $form.data('formValidation');

                if (fv.getSubmitButton()) {
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: {email: email},
                        success: function (response) {
                            if (response === 'true') {
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

        $('#modalLupaPassword').on('hidden.bs.modal', function () {
            $('#formLupaPassword').formValidation('resetForm', true);
        })

    });
</script>

<!-- Facebook Login -->
<script>
    // Load the SDK asynchronously

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function () {
        FB.init({
            appId: '674931862665310', //Your APP ID
            cookie: true,  // enable cookies to allow the server to access
            // the session
            xfbml: true,  // parse social plugins on this page
            version: 'v2.7' // use version 2.1
        });

        // These three cases are handled in the callback function.
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });

    };

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            FB.api('/me?fields=name', function (response) {
                $("#labelLoginFb").text("Masuk sebagai " + response.name);
            });
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            // document.getElementById('status').innerHTML = 'Please log ' +
            //   'into this app.';
        }
    }

    function _login() {
        FB.login(function (response) {
            // handle the response
            if (response.status === 'connected') {
                _i();
            }
        }, {scope: 'email, public_profile'});
    }

    function _logout() {
        FB.logout(function (response) {
            // user is now logged out
        });
    }

    function _i() {
        FB.api('/me?fields=name, email', function (response) {
            // console.log(response);
            $("#labelLoginFb").text("Masuk sebagai " + response.name);

            $.ajax({
                url: "<?php echo base_url('login/cek_akun_fb')?>",
                type: 'post',
                data: {'id': response.id},
                success: function (data, status) {
                    // console.log("data: " + data);
                    if (data == 'true') {
                        // console.log("Hey it's true");
                        window.location.replace("<?php echo base_url();?>");
                    }
                    else if (data == 'false') {
                        // console.log("Hey it's false");
                        $("#alertLoginFb").fadeIn();
                    }
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }

            })
        });
    }

</script>
</body>
</html>
