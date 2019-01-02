<?php
$judul_tab = "Sign Up";
include(APPPATH.'views/pg_user/inc/header.php');
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-xs-12 col-center daftar">
                <h2>Daftar</h2>
                <p>Silahkan Daftar di <b>KARISMA ACADEMY</b></p>
                <p>Sudah punya akun Karisma Academy? Masuk <a href="<?php echo base_url() . 'login' ?>">di sini</a></p>
                <br>
                <button class="btn btn-primary btn-block">
                    <i class="fa fa-facebook"></i>&emsp; Daftar dengan Facebook
                </button>
                <button class="btn btn-danger btn-block">
                    <i class="fa fa-google-plus"></i>&emsp; Daftar dengan Google
                </button>
                <div class="line-text">
                    <span>atau</span>
                </div>

                <form action="<?= base_url('signup/save') ?>" method="post" id="form-signup"
                      enctype="multipart/form-data">
                    <input type="hidden" name="mapel_id"
                           value="<?= isset($_GET['mapel_id']) ? $_GET['mapel_id'] : 0 ?>">
                    <label>Nama Lengkap</label>
                    <div class="form-group has-feedback">
                        <span class="ti-id-badge form-control-feedback"></span>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <label>Username</label>
                    <div class="form-group has-feedback">
                        <span class="ti-user form-control-feedback"></span>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <label>Email</label>
                    <div class="form-group has-feedback">
                        <span class="ti-email form-control-feedback"></span>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <label>Password</label>
                    <span class="nb-text">*Minimal 6 karakter</span>
                    <div class="form-group has-feedback">
                        <span class="ti-lock form-control-feedback"></span>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <br>
                    <p>Dengan menekan Daftar Akun, saya menkonfirmasi telah menyetujui</p>
                    <p><a href="#">Syarat dan Ketentuan</a>, serta <a href="#">Kebijakan Privasi</a> Karisma Academy</p>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Daftar Akun</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include(APPPATH.'views/pg_user/inc/footer.php'); ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/js/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/js/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
    var formSignUp = $('#form-signup');

    formSignUp.validate({
        errorClass: 'text-danger',
        rules: {
            'nama': {
                required: true,
            },
            'username': {
                required: true,
            },
            'email': {
                required: true,
                validateEmail: true,
            },
            'password': {
                required: true,
            }
        },
        messages: {
            'nama': {
                required: 'Nama Harus Di Isi',
            },
            'username': {
                required: 'Username Harus Di Isi',
            },
            'email': {
                required: 'Email Harus Di Isi',
                validateEmail: 'Format Email Tidak Sah',
            },
            'password': {
                required: 'Password Harus Di Isi',
            }
        }
    });
</script>
</body>
</html>