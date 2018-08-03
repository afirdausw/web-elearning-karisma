<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
    <?php include "sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>
                <?php

                foreach ($data_table as $datanya) {

                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Edit Profil</h4>
                                </div>
                                <div class="content">
                                    <form method="post" action="<?php echo $form_action ?>"
                                          enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-md-4 col-lg-4" style="padding-left: 6px;">
                                                    Nama Test
                                                    <input value="<?php echo $datanya->nama_profil; ?>" type="text"
                                                           class="form-control" name="nama"/>
                                                    <input value="<?php echo $datanya->id_tryout; ?>" type="hidden"
                                                           class="form-control" name="id_tryout"/>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    Penyelenggara
                                                    <input value="<?php echo $datanya->penyelenggara; ?>" type="text"
                                                           class="form-control" name="penyelenggara"/>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    Biaya Test
                                                    <input value="<?php echo $datanya->biaya; ?>" type="text"
                                                           class="form-control" name="biaya"/>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    Tanggal Acara
                                                    <input value="<?php echo $datanya->tgl_acara; ?>" type="text"
                                                           class="form-control" name="tanggal" id="datepicker"/>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    Jam Acara
                                                    <input value="<?php echo $datanya->jam_acara; ?>" type="text"
                                                           class="form-control" name="jam"/>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    Jenjang Kelas
                                                    <select data-placeholder="Pilih Kelas..." name="kelas"
                                                            class="form-control" style="width: 100%;" tabindex="2"
                                                            required="required">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($select_options as $item) { ?>
                                                            <option <?= $datanya->id_kelas == $item->id_kelas ? ' selected ' : '' ?>
                                                                    value="<?php echo $item->id_kelas ?>"> <?php echo $item->alias_kelas ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-6">
                                                <div class="col-lg-12">
                                                    Tipe Profil
                                                    <select name="tipe" class="form-control">
                                                        <option value="0">Try Out Reguler</option>
                                                        <option value="1">CBT Contest</option>
                                                        <option value="2">UTS</option>
                                                        <option value="3">UAS</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-12">
                                                    Banner Test
                                                    <input type="file" name="banner"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                Keterangan
                                                <textarea name="keterangan" class="form-control"><?php echo $datanya->keterangan; ?></textarea>
                                            </div>
                                            <div class="col-md-4 col-lg-4" style="display: none;">

                                            </div>
                                            <div class="col-md-4" style="display: none;">
                                                <div class="form-group">
                                                    <label>Tanggal Post <span class="text-danger">*</span></label>
                                                    <?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>
                                                    <input class="form-control" type="date" id="tanggal_post"
                                                           name="tanggal_post"
                                                           value="<?php echo set_value('tanggal_post', (!isset($data) ? date('Y-m-d') : (($data->tanggal != 0) ? $data->tanggal : date('Y-m-d')))); ?>"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-4" style="display: none;">
                                                <div class="form-group">
                                                    <label>Waktu Post <span class="text-danger">*</span></label>
                                                    <?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?>
                                                    <input class="form-control" type="time" id="waktu_post"
                                                           name="waktu_post"
                                                           value="<?php echo set_value('waktu_post', (!isset($data) ? date('H:i') : (($data->waktu != 0) ? $data->waktu : date('H:i')))); ?>"
                                                           required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="Simpan Profil" name="form_submit"
                                               class="btn btn-primary"/>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php

                } // Penutup Data Table foreach

                ?>
            </div>
        </div> <!-- end .content -->

        <?php include "footer.php"; ?>

    </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>
</body>


<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript'); ?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

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


<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>

</html>
