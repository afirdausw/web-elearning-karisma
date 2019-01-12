<?php
$judul_tab = "Pretest Log In";
$this->load->view('pg_user/inc/header.php');
?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-xs-12 col-center daftar">
                    <?php echo $this->session->flashdata('alert'); ?>
                    <h2>Pretest</h2>
                    <p>di <b>KARISMA ACADEMY</b></p>
                    <p>Sudah punya akun Karisma Academy? Masuk <a href="<?php echo base_url().'login' ?>">di sini</a></p>
                    <div class="line-text">
                      <span>Silahkan isi data diri anda</span>
                    </div>

                    <form action="<?=$form_aksi;?>" method="post" enctype="multipart/form-data">
                        <div class="form-group has-feedback">
                            <span class="ti-id-badge form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="nama">
                        </div>
                        <div class="form-group has-feedback">
                            <span class="ti-mobile form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Nomor Telepon" name="telepon" id="telepon">
                        </div>
                        <div class="form-group has-feedback">
                            <span class="ti-email form-control-feedback"></span>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        </div>
                        <div class="form-group has-feedback">
                            <span class="ti-direction form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat" id="address">
                        </div><br>
                        <p>Dengan menekan Masuk Pretest, anda mengkonfirmasi telah menyetujui</p>
                        <p><a href="#">Syarat dan Ketentuan</a>, serta <a href="#">Kebijakan Privasi</a> Karisma Academy</p>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Masuk Pretest</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $this->load->view('pg_user/inc/footer.php'); ?>

<!-- Validasi -->
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/plugins/jquery/jquery.steps.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnLoginFb").on("click", function () {
            _login();
        });
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
            // _i();
            FB.api('/me?fields=name', function (response) {
                $("#labelLoginFb").text("Daftar sebagai " + response.name);
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
            // $("#labelLoginFb").text("Masuk sebagai " + response.name);

            $.ajax({
                url: "<?php echo base_url('signup/cek_akun_fb')?>",
                type: 'post',
                data: {'id': response.id},
                success: function (data, status) {
                    // console.log("data: " + data);
                    if (data == 'true') {
                        $("#fb_id").val(response.id);
                        $("#namalengkap").val(response.name);
                        $("#email").val(response.email);
                    }
                    else if (data == 'false') {
                        // console.log("Hey it's false");
                        $("#fb_id").val("");
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


<!-- Data Pribadi -->
<script type="text/javascript">
    $(document).ready(function () {
        function adjustIframeHeight() {
            var $body = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                // Adjust the height of iframe
                $iframe.height($body.height());
            }
        }

        // IMPORTANT: You must call .steps() before calling .formValidation()
        $('#profileForm')
            .steps({

                headerTag: 'h2',
                bodyTag: 'section',

                // Disables the finish button (required if pagination is enabled)
                enableFinishButton: true,
                // Disables the next and previous buttons (optional)
                enablePagination: true,
                // Enables all steps from the begining
                enableAllSteps: false,
                // Removes the number from the title
                titleTemplate: "#title#",

                onStepChanged: function (e, currentIndex, priorIndex) {
                    // You don't need to care about it
                    // It is for the specific demo
                    adjustIframeHeight();
                },
                // Triggered when clicking the Previous/Next buttons
                onStepChanging: function (e, currentIndex, newIndex) {
                    var fv = $('#profileForm').data('formValidation'), // FormValidation instance
                        // The current step container
                        $container = $('#profileForm').find('section[data-step="' + currentIndex + '"]');

                    // Validate the container
                    fv.validateContainer($container);

                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        // Do not jump to the next step
                        return false;
                    }

                    return true;
                },
                // Triggered when clicking the Finish button
                onFinishing: function (e, currentIndex) {
                    var fv = $('#profileForm').data('formValidation'),
                        $container = $('#profileForm').find('section[data-step="' + currentIndex + '"]');

                    // Validate the last step container
                    fv.validateContainer($container);

                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }

                    return true;
                },
                onFinished: function (e, currentIndex) {
                    // Uncomment the following line to submit the form using the defaultSubmit() method
                    $('#profileForm').formValidation('defaultSubmit');

                    // For testing purpose
                    // $('#welcomeModal').modal();
                }
            })
            .formValidation({
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                // This option will not ignore invisible fields which belong to inactive panels
                excluded: ':disabled',
                fields: {
                    namalengkap: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Lengkap harus diisi'
                            }
                        }
                    },
                    pengguna: {
                        validators: {
                            notEmpty: {
                                message: 'Username harus diisi'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'Username minimal 6 karakter dan maksimal 30 karakter'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: 'Username hanya terdiri dari alfabet, nomor, titik dan underscore'
                            },
                            remote: {
                                message: "Username telah terdaftar dalam database",
                                url: "<?php echo base_url('signup/ajax_cek_username'); ?>",
                                type: "post",
                                delay: 1000
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'E-Mail harus diisi'
                            },
                            emailAddress: {
                                message: 'E-Mail tidak valid'
                            },
                            remote: {
                                message: "E-mail telah terdaftar dalam database",
                                url: "<?php echo base_url('signup/ajax_cek_email'); ?>",
                                type: "post",
                                delay: 1000
                            }
                        }
                    },
                    nohp: {
                        message: 'Nomor telepon tidak valid',
                        validators: {
                            notEmpty: {
                                message: 'Nomor telepon harus diisi'
                            },
                            numeric: {
                                message: 'Nomor telepon harus berbentuk angka'
                            }
                        }
                    },
                    nis: {
                        message: 'NIS tidak valid',
                        validators: {
                            notEmpty: {
                                message: 'NIS harus diisi'
                            },
                            numeric: {
                                message: 'NIS harus berbentuk angka'
                            }
                        }
                    },
                    nisn: {
                        message: 'NISN tidak valid',
                        validators: {
                            notEmpty: {
                                message: 'NISN harus diisi'
                            },
                            numeric: {
                                message: 'NISN harus berbentuk angka'
                            }
                        }
                    },
                    nohp_ortu: {
                        message: 'Nomor telepon tidak valid',
                        validators: {
                            notEmpty: {
                                message: 'Nomor telepon harus diisi'
                            },
                            numeric: {
                                message: 'Nomor telepon harus berbentuk angka'
                            }
                        }
                    },
                    katasandi: {
                        validators: {
                            notEmpty: {
                                message: 'Password harus diisi'
                            },
                            different: {
                                field: 'username',
                                message: 'Password tidak boleh sama dengan nama pengguna'
                            }
                        }
                    },
                    konfirmasi: {
                        validators: {
                            notEmpty: {
                                message: 'Konfirmasi Password harus diisi'
                            },
                            identical: {
                                field: 'katasandi',
                                message: 'Konfirmasi Password harus sama dengan Password yang dimasukkan'
                            }
                        }
                    }
                }
            });
    });
</script>

</body>
</html>