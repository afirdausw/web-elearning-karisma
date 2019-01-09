<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>

<div class="wrapper">
    <?php include "inc/sidebar.php"; ?>

    <div class="main-panel">
        <?php include "inc/navbar.php"; ?>


        <style>
            input.onoffswitch-checkbox {
                position: absolute;
            }

            .onoffswitch-label {
                display: block;
                overflow: hidden;
                cursor: pointer;
                width: 85px;
                border: 2px solid #999999;
                border-radius: 20px;
                position: relative;
            }

            .onoffswitch-inner {
                display: block;
                width: 200%;
                margin-left: -100%;
                transition: margin 0.3s ease-in 0s;
            }

            .onoffswitch-inner:before, .onoffswitch-inner:after {
                display: block;
                float: left;
                width: 50%;
                height: 25px;
                padding: 0;
                line-height: 25px;
                font-size: 11px;
                color: white;
                font-family: Trebuchet, Arial, sans-serif;
                font-weight: bold;
                box-sizing: border-box;
            }

            .onoffswitch-inner:before {
                content: "PREMIUM";
                padding-left: 20px;
                background-color: #34A7C1;
                color: #FFFFFF;
            }

            .onoffswitch-inner:after {
                content: "FREE";
                padding-left: 28px;
                background-color: #EEEEEE;
                color: #999999;
                text-align: left;
            }

            .onoffswitch-switch {
                display: block;
                width: 20px;
                height: 20px;
                margin: 2.5px;
                background: #FFFFFF;
                position: relative;
                top: 0;
                bottom: 0;
                right: 0px;
                border: 2px solid #999999;
                border-radius: 20px;
                transition: all 0.3s ease-in 0s;
            }

            .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
                margin-left: 0;
            }

            .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
                right: 0px;
            }
        </style>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah_materi/' . $idkelas . '/' . $idmapel . '/' . $idmapok) ?>"
                                   class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah
                                    Konten</a>
                                <h4 class="title"><a
                                            href="<?php echo site_url('pg_admin/materi_pokok/mapel/' . $idkelas . '/' . $idmapel) ?>"
                                            class="btn btn-success"><i class="fa fa-arrow-left"></i></a> Semua Materi
                                </h4>
                                <p class="category">Daftar Sub-materi per Materi Pokok</p>
                            </div>
                            <div class="content">
                                <table id="my_datatable" class="table table-striped table-hover">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Urutan</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Materi Pokok</th>
                                        <th class="text-center">Materi Pembelajaran</th>
                                        <th class="text-center">Konten</th>
<!--                                        <th class="text-center">Tipe</th>-->
                                        <th class="text-center">Daftar Soal</th>
                                        <th class="text-center" style="width:80px;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_tabel as $row) {
                                        if ($row->id_sub_materi != '') {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <a class="sort-link" href="#"><i class="fa fa-chevron-up"></i></a>
                                                    <a class="sort-link" href="#"><i class="fa fa-chevron-down"></i></a>
                                                </td>
                                                <td><?= $row->alias_kelas ?></td>
                                                <td><?= $row->nama_mapel ?></td>
                                                <td><?= $row->nama_materi_pokok ?></td>
                                                <td><?= $row->nama_sub_materi ?></td>
                                                <td><?= ($row->kategori == 1 ? "<span class='glyphicon glyphicon-file'></span> Teks" : ($row->kategori == 2 ? "<span class='glyphicon glyphicon-play-circle'></span> Video" : ($row->kategori == 3 ? "<span class='glyphicon glyphicon-star'></span> Soal" : '-'))) ?></td>
<!--
                                                <td class="text-center">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox"
                                                               name="status_materi_<?= $row->id_sub_materi ?>"
                                                               class="onoffswitch-checkbox"
                                                               id="myonoffswitch<?= $row->id_sub_materi ?>" <?= $row->status_materi == 1 ? 'checked' : '' ?>
                                                               onchange="if (this.checked === false){ ajaxStatusMateri(<?= $row->id_sub_materi ?>, 0); } else { ajaxStatusMateri(<?= $row->id_sub_materi ?>, 1); }">
                                                        <label class="onoffswitch-label"
                                                               for="myonoffswitch<?= $row->id_sub_materi ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </td>
-->
                                                <td class="text-center">
                                                    <?php if ($row->kategori == 3) { ?>
                                                        <a href="<?= base_url() . "pg_admin/latihansoal/detail/" . $row->id_sub_materi ?>"
                                                           class="btn btn-sm btn-fill btn-info">Lihat <span
                                                                    class='glyphicon glyphicon-arrow-right'></span></a>
                                                    <?php } else { ?>
                                                        <span style="color:red;"><i
                                                                    class="glyphicon glyphicon-remove"></i></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url() ?>pg_admin/materi/manajemen/ubah/<?= $idkelas  ?>/<?= $idmapel  ?>/<?= $idmapok ?>?id=<?= $row->id_sub_materi ?>"
                                                       class="btn btn-warning btn-xs" title="Ubah"><span
                                                                class="glyphicon glyphicon-pencil"></span></a>

                                                    <?php
                                                    if ($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin") {
                                                        ?>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                                title="Hapus" data-number="<?= $i ?>"
                                                                value="<?= $row->id_sub_materi ?>" data-toggle="modal"
                                                                data-target="#deleteRow_modal"><i
                                                                    class="glyphicon glyphicon-trash"></i></button>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end .container-fluid -->
        </div> <!-- end .content -->

        <?php include "inc/footer.php"; ?>

    </div>
</div>

<!-- =========================== Delete Transaksi Confirmation Modal =========================== -->
<div id="deleteRow_modal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
                <h4 class="modal-title" id="deleteRow_label"><i class="glyphicon glyphicon-warning-sign text-danger"></i> Konfirmasi Hapus</h4>
            </div>
            <div class="modal-footer well">
                <div class="container-fluid">
                    <form action="<?php echo $form_action . 'proses_hapus';?>" method="post">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="form-inline">
                                    <input type='hidden' name="hidden_row_id" id="hidden_row_id"/>
                                </div>
                                <p class='text-center'> Apakah anda ingin menghapus data <span class="number"><span></p>
                            </div>
                        </div>
                        <button type="submit" name="deleteRow_submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ya</button>
                        <a class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-share-alt"></i> Tidak</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript'); ?>"></script>
<script src="<?php echo base_url('assets/plugin/bootstrap-3/js/bootstrap.min.js" type="text/javascript'); ?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js'); ?>"></script>
<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>
<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js') ?>"></script>

<script type="text/javascript">
    function ajaxPage(urlLink) {
        $.ajax({
            url: urlLink,
            beforeSend: function () {
                NProgress.start();
                //$("#containerajax").html('<div class="text-center"><img src="<?php echo base_url() . 'assets/img/table_loading.gif'; ?>"></div>');
            },
            success: function (data) {
                NProgress.done();
                $("#containerajax").html(data)
            }
        });
        return false;
    }

    function ajaxStatusMateri(targetName, val) {
        $.post("<?=base_url('pg_admin/materi/ajax_status_materi');?>",
            {
                target_name: targetName, state: val
            },
            function (data, status) {
                console.log("\nStatus: " + status + "\nData: " + data);
            });
    }

</script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>


<!-- JS Function for this Modal -->
<script type="text/javascript">
    $('#deleteRow_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rownumber = button.data('number') // Extract info from data-* attributes
        var id = button.attr('value')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.number').text("#" + rownumber + "?")
        modal.find('input[name=hidden_row_id]').val(id)
    })
</script>

</html>
