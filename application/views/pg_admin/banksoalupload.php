<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
    $(function () {
        $("#kelas").change(function () {
            $("#mapel").load("pilihmapel/" + $("#kelas").val());
        });
        $("#mapel").change(function () {
            $("#kategori").load("pilihkategori/" + $("#mapel").val());
        });

    });
</script>
<div class="wrapper">
    <?php include "inc/sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>


        <div class="content">
            <div class="container-fluid">

                <?php echo $this->session->flashdata('alert'); ?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h5>Ketentuan</h5>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li>File yang akan di-import dapat berupa file <strong>*.xls</strong> atau <strong>*.csv</strong>
                                    </li>
                                    <li>Pastikan format tabel excel sesuai dengan <i>template</i> yang telah disediakan
                                        <a href="<?php echo base_url() . 'assets/template/banksola.xlsx' ?>"
                                           class="label label-primary">DI SINI</a></li>
                                    <li>Data akan di-import mulai dari baris kedua sampai baris terakhir
                                    <li>Tidak boleh ada kolom/baris yang <strong>tersembunyi</strong> atau <strong>di-hidden</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <form action="<?php echo base_url(); ?>pg_admin/Banksoal/upload/" method="post"
                          enctype="multipart/form-data">

                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h5>Import</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <?php echo form_error('nama_mapel', '<div class="text-danger">', '</div>'); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Kelas <span class="text-danger">*</span></label>
                                                <select data-placeholder="Pilih Kelas..." class="form-control" id="kelas" style="width: 100%;" tabindex="2" required="required">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($select_options_mapel as $item) {
                                                        ?>
                                                        <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Mata Pelajaran <span class="text-danger">*</span></label>
                                                <select class="form-control" id="mapel" name="nama_mapel" style="width: 100%;" data-placeholder="Pilih Mata Pelajaran..." required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Kategori <span class="text-danger">*</span></label>
                                                <select class="form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori..." required>
                                                    <option value="0">Uncategorized</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Tipe Soal <span class="text-danger">*</span></label>
                                                <select class="form-control" id="mapel" name="tipe" style="width: 100%;" data-placeholder="Pilih Kategori..." required>
                                                    <option value="main">Main Class</option>
                                                    <option value="open">Open Class</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Import file CSV/XLS</label>

                                        <input type="file" name="import_data" id="import_data" class="form-control">
                                    </div>
                                    <button type="submit" name="form_submit" value="submit"
                                            class="btn btn-primary pull-right"><i
                                                class="glyphicon glyphicon-import"></i> Import Bank Soal
                                    </button>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include "inc/footer.php"; ?>

    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>



<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

</html>
