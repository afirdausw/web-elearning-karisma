<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>
<script>
    $(function () {
        $("#kelas").change(function () {
            document.location = '<?php echo base_url('pg_admin/banksoal/filter') ?>/' + $(this).val() + '/';
            $("#mapel").load("banksoal/ajax_mapel/" + $(this).val());


        });

        $("#mapel").change(function () {
// 		$("#list-soal").load("banksoal/ajax_soal/" + $("#kelas").val() + "/" + $("#mapel").val());
            document.location = '<?php echo base_url('pg_admin/banksoal/filter') ?>/' + $("#kelas").val() + '/' + $(this).val() + '/';

        });
        $("#topik").change(function () {
            document.location = '<?php echo base_url('pg_admin/banksoal/filter') ?>/' + $("#kelas").val() + '/' + $("#mapel").val() + '/' + $(this).val() + '/';


// 		$("#list-soal").load("banksoal/ajax_soal_by_topik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
// 		$("#list_modal").load("banksoal/ajax_soal_modal_by_topik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
        });
    })
    ;
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
                        <div id="my_datatables">

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                            </div>
                            <div class="content">
                                <a class="btn btn-primary"
                                   href="<?php echo base_url(); ?>pg_admin/banksoal/excelupload">Upload Excel Bank
                                    Soal</a>
                                <a class="btn btn-primary" href="<?php echo base_url(); ?>pg_admin/banksoal/tambah">Tambah
                                    Bank Soal</a>
                                <!--                                <a class="btn btn-primary" href="banksoal/duplikat">Duplikat Bank Soal</a>-->
                                <!-- TABLE UNTUK BANK SOAL -->
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <tr>
                                            <td>
                                                <select id="kelas" class="form-control">
                                                    <option value="">Pilih Kelas...</option>
                                                    <?php
                                                    foreach ($select_options_kelas as $item) {
                                                        ?>
                                                        <option <?php if (isset($kelas)) {
                                                            echo($kelas == $item->id_kelas ? "selected" : "");
                                                        } ?> value="<?php echo $item->id_kelas; ?>"
                                                             data-kelas="<?php echo $item->alias_kelas; ?>"> <?php echo $item->alias_kelas; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="mapel" class="form-control">
                                                    <option value="">Pilih Mata Pelajaran...</option>
                                                    <?php
                                                    foreach ($select_options_mapel as $item) {
                                                        ?>
                                                        <option <?php if (isset($mapel)) {
                                                            echo($mapel == $item->id_mapel ? "selected" : "");
                                                        } ?> value="<?php echo $item->id_mapel; ?>"
                                                             data-kelas="<?php echo $item->nama_mapel; ?>"> <?php echo $item->nama_mapel; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                          
                                        </tr>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Topik</th>
                                            <th>Pembahasan</th>
                                            <th>Pelajaran</th>
                                            <th>Bobot Soal</th>
                                            <th>Kunci Jawaban</th>
                                            <th>Operasi</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list-soal">
                                        <?php
                                        foreach ($data_soal as $data) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data->alias_kelas; ?></td>
                                                <td><?php echo $data->topik; ?> ...</td>
                                                <td>
                                                    <?php
                                                    if ($data->pembahasan_teks !== "" AND $data->pembahasan_video !== "") {
                                                        ?>
                                                        <a href=""><span
                                                                    class="label label-success">Pembahasan Teks</span></a>
                                                        <a href=""><span
                                                                    class="label label-warning">Pembahasan Video</span></a>
                                                        <?php
                                                    } elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video !== "") {
                                                        ?>
                                                        <a href=""><span
                                                                    class="label label-warning">Pembahasan Video</span></a>
                                                        <?php
                                                    } elseif ($data->pembahasan_teks !== "" AND $data->pembahasan_video == "") {
                                                        ?>
                                                        <a href=""><span
                                                                    class="label label-success">Pembahasan Teks</span></a>
                                                        <?php
                                                    } elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video == "") {

                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->nama_mapel;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->bobot_soal;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->kunci;
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#myModal<?php echo $data->id_banksoal; ?>">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>pg_admin/banksoal/edit/<?php echo $data->id_banksoal; ?>">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>pg_admin/banksoal/hapus/<?php echo $data->id_banksoal; ?>"
                                                       onclick="return confirm('Apakah anda yakin untuk menghapus');">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    echo $pagination;
                                    ?>
                                </div>
                                <!-- END TABLE BANK SOAL -->


                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
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
<div id="list_modal">
    <?php
    $no = 1;
    foreach ($data_soal as $data) {
        ?>
        <div class="modal fade" id="myModal<?php echo $data->id_banksoal; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modalsoal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Pertanyaan</p>
                        <p><?php echo $data->pertanyaan; ?></p><br>
                        <p>Jawaban</p>
                        <?php if ($data->kunci == 1){ ?>
                            <p><?php echo $data->jawab_1; ?></p><br>
                        <?php } elseif ($data->kunci == 2) { ?>
                            <p><?php echo $data->jawab_2; ?></p><br>
                        <?php } elseif ($data->kunci == 3) { ?>
                            <p><?php echo $data->jawab_3; ?></p><br>
                        <?php }
                        elseif ($data->kunci == 4){ ?>
                        <p><?php echo $data->jawab_4;
                            } ?></p><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php
        $no++;
    }
    ?>
</div>


<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

</html>
