<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH."views/pg_admin/inc/html_header.php";

?>

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

    <?php include APPPATH."views/pg_admin/inc/sidebar.php"; ?>



    <div class="main-panel">

        <?php include APPPATH."views/pg_admin/inc/navbar.php"; ?>





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

                                        <a href="<?php echo base_url() . 'assets/template/contohsiswa.xlsx' ?>"

                                           class="label label-primary">DI SINI</a></li>

                                    <li>Data akan di-import mulai dari baris kedua sampai baris terakhir

                                    <li>Tidak boleh ada kolom/baris yang <strong>tersembunyi</strong> atau <strong>di-hidden</strong>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>





                    <form action="<?php echo base_url(); ?>pg_admin/siswa/upload/" method="post"

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

                                            <div class="col-md-12">

                                                <label>Kelas <span class="text-danger">*</span></label>

                                                <select data-placeholder="Pilih Kelas..." class="form-control" id="kelas" name="kelas" style="width: 100%;" tabindex="2" required="required">

                                                    <option value=""></option>

                                                    <?php

                                                    foreach ($select_options_mapel as $item) {

                                                        ?>

                                                        <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>

                                                    <?php } ?>

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

                                                class="glyphicon glyphicon-import"></i> Import Siswa

                                    </button>



                                </div>

                            </div>

                    </form>

                </div>

            </div>

        </div>



        <?php include APPPATH."views/pg_admin/inc/footer.php"; ?>


</html>

