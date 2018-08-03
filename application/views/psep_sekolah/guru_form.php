<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
    $(function () {
//	$("#kelas").change(function(){
//		$("#mapel").load("ajax_mapel/" + $("#kelas").val());
//	});
    });
</script>
<div class="wrapper">
    <?php include "sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Register Guru <?php echo $sekolah->nama_sekolah; ?></h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <?php
                                    foreach ($cariguru as $guru) {
                                        ?>
                                        <form action="<?php echo $action ?>"
                                              method="post" enctype="multipart/form-data">
                                            <input readonly type="hidden" name="id_guru"
                                                   value="<?php echo $guru->id_login_sekolah ?>"
                                                   class="form-control"/>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input value="<?= $guru->nama ?>" type="text" name="nama"
                                                           class="form-control"
                                                           required/>
                                                </div>
                                                <!--                        <div class="form-group">-->
                                                <!--                            <label>Kelas</label>-->
                                                <!--                            <select class="form-control" id="kelas" name="kelas">-->
                                                <!--                                <option  value="" disabled="" selected="">-- Pilih Kelas --</option>-->
                                                <!--                                --><?php
                                                //                                foreach($datakelas as $kelas){
                                                //
                                                ?>
                                                <!--                                    <option value="-->
                                                <?php //echo $kelas->id_kelas;
                                                ?><!--">-->
                                                <?php //echo $kelas->alias_kelas;
                                                ?><!--</option>-->
                                                <!--                                    --><?php
                                                //                                }
                                                //
                                                ?>
                                                <!--                            </select>-->
                                                <!--                        </div>-->
                                                <div class="form-group">
                                                    <label>Mata Pelajaran</label>
                                                    <div style="margin: 5px;" class="row">


                                                        <?php

                                                        $mapel_guru = explode(',', $guru->id_mapel);
                                                        foreach ($mapel as $key => $item) {
                                                            if (count($item) > 0) {
                                                                ?>

                                                                <div class="col-lg-12 col-md-12">
                                                                    <h6><?php echo $key; ?></h6>
                                                                </div>
                                                                <?php
                                                                foreach ($item as $v => $value) {
                                                                    ?>
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <input type="checkbox" <?= (in_array($value['id_mapel'], $mapel_guru) ? " checked " : "") ?>
                                                                               value="<?php echo $value['id_mapel']; ?>"
                                                                               name="mapel[]"> <?php echo $key; ?>
                                                                        - <?php echo $value['kelas']; ?>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input value="<?= $guru->email ?>" type="text" name="email"
                                                           class="form-control" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input value="<?= $guru->username ?>" type="text" name="username"
                                                           class="form-control" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        <?= isset($act) && $act == 'insert' ? ' required ' : '' ?>/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ulangi Password</label>
                                                    <input type="password" name="repassword" class="form-control"
                                                        <?= isset($act) && $act == 'insert' ? ' required ' : '' ?>/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kartu Identitas (KTP / SIM / KTA)</label>
                                                    <input type="file" name="identitas"
                                                        <?= isset($act) && $act == 'insert' ? ' required ' :'' ?>/>
                                                </div>
                                                <br>&nbsp;
                                                <br>&nbsp;
                                                <input type="submit" class="btn btn-primary" value="Registrasi Akun"/>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    ?>
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

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>


</html>
