<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
    $(function () {
        $("#kelas").change(function () {
            $("#mapel").load("/psep_sekolah/guru/ajax_mapel/" + $("#kelas").val());
        });
    });
</script>
<div class="wrapper">
    <?php include "sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>

        <div class="content">
            <div class="container-fluid akun-container">
                <?php echo $this->session->flashdata('alert'); ?>
                <div class="col-lg-12">
                    <div class="row row-login well">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Data Guru <?php ?></h4>
                            </div>


                            <div class="row" style="padding: 15px">
                                <div class="col-sm-3">
                                    <div class="profil-detail">
                                        <div class="picture">
                                            <?php
                                            $foto = $cariguru->kartu_identitas ? $cariguru->kartu_identitas : 'default.png';
                                            ?>
                                            <img src="<?php echo base_url('assets/uploads/identitas/' . $foto); ?>"
                                                 width="376" height="500" alt="Foto Profil Siswa LPIH"
                                                 class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row ptb0rl10">
                                        <div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-credit-card"
                                                                            aria-hidden="true"></span>
                                            <strong>Nama</strong></div>
                                        <div class="col-sm-8 p10 bgw"><?php echo $cariguru->nama ? $cariguru->nama : 'No name' ?></div>
                                    </div>
                                    <div class="row ptb0rl10">
                                        <div class="col-sm-4 p10"><span class="glyphicon glyphicon-envelope"
                                                                        aria-hidden="true"></span>
                                            <strong>Email</strong></div>
                                        <div class="col-sm-8 p10"><?php echo $cariguru->email ? $cariguru->email : '-' ?></div>
                                    </div>
                                    <div class="row ptb0rl10">
                                        <div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-user"
                                                                            aria-hidden="true"></span>
                                            <strong>Username</strong></div>
                                        <div class="col-sm-8 p10 bgw"><?php echo $cariguru->username ? $cariguru->username : '-'; ?></div>
                                    </div>


                                    <div class="row ptb0rl10">
                                        <div class="col-sm-4 p10"><span class="glyphicon glyphicon-education"
                                                                        aria-hidden="true"></span>
                                            <strong>Sekolah</strong></div>
                                        <div class="col-sm-8 p10"><?php echo $sekolah->nama_sekolah ? $sekolah->nama_sekolah : '-'; ?></div>
                                    </div>
                                    <div class="row ptb0rl10">
                                        <div class="col-sm-4 p10"><span class="glyphicon glyphicon-education"
                                                                        aria-hidden="true"></span>
                                            <strong>Mata Pelajaran Dan Kelas Yang Di ampu</strong></div>
                                        <div class="col-sm-8 p10">
                                            <?php foreach ($carimapel as $key => $value) {
                                                ?>
                                                <div class="row ptb0rl10">
                                                    <div class="col-sm-12 p10 bgw">
                                                       <?php echo $value->nama_mapel ? $value->nama_mapel : '-'; ?> - <?php echo $value->alias_kelas ? $value->alias_kelas : '-'; ?></div>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row ptb0rl10">
                                        <div class="col-sm-12 p10">&nbsp;</div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div> <!-- end .container-fluid -->
        </div> <!-- end .content -->

        <?php include "footer.php"; ?>


    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript'); ?>"></script>

<!--  Nestable Plugin    -->


<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>


</html>
