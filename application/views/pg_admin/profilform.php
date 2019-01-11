<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<div class="wrapper">
    <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

    <div class="main-panel">
        <?php $this->load->view("pg_admin/inc/navbar.php"); ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Tambah Profil</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="<?php echo $form_action ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-md-4 col-lg-4" style="padding-left: 6px;">
                                                Nama Test
                                                <input required type="text" class="form-control" name="nama"/>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                Penyelenggara
                                                <input required type="text" class="form-control" name="penyelenggara"/>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                Biaya Test
                                                <input required required type="number" min=0 step=1 class="form-control" name="biaya"/>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                Tanggal Acara
                                                <input required type="text" class="form-control" name="tanggal" id="datepicker"/>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                Jumlah Jam Berlangsungnya Acara
                                                <input required type="number" min=0 step=0.01 class="form-control" name="jam"/>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                Jenjang Kelas
                                                <select data-placeholder="Pilih Kelas..." name="kelas"
                                                        class="form-control" style="width: 100%;" tabindex="2"
                                                        required="required">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($select_options as $item) { ?>
                                                        <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data->id_kelas) ? FALSE : ($data->kelas == $item->id_kelas ? TRUE : FALSE))); ?>
                                                                value="<?php echo $item->id_kelas ?>"> <?php echo $item->alias_kelas ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-lg-12">
                                            <div class="col-md-6 col-lg-6">
                                                Tipe Profil
                                                <select required name="tipe" class="form-control">
                                                    <option value="0">Try Out Reguler</option>
                                                    <option value="1">CBT Contest</option>
                                                    <option value="2">UTS</option>
                                                    <option value="3">UAS</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                Banner Test
                                                <input  type="file" name="banner"/>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                Keterangan
                                                <textarea required name="keterangan" class="form-control"></textarea>
                                            </div>
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
            </div>
        </div> <!-- end .content -->

        <?php $this->load->view("pg_admin/inc/footer.php"); ?>
<?php $this->load->view("pg_admin/alert_modal.php"); ?>


<!-- JS Function for this Modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();

    });
</script>
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
