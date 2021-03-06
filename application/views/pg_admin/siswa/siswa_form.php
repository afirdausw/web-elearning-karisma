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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Siswa" ?></h4>
                            </div>
                            <div class="content">
                                <form method="post" action="<?php echo $form_action ?>">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>NISN<span class="text-danger">*</span></label>
                                                <input type="text" name="nisn" id="nisn" class="form-control"
                                                       placeholder="NISN"
                                                       value="<?php echo set_value('nisn', (isset($data_siswa->NISN) ? $data_siswa->NISN : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('nisn', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>NIS<span class="text-danger">*</span></label>
                                                <input type="text" name="nis" id="nis" class="form-control"
                                                       placeholder="NIS"
                                                       value="<?php echo set_value('nis', (isset($data_siswa->NIS) ? $data_siswa->NIS : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('nis', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Lengkap<span class="text-danger">*</span></label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                       placeholder="Nama Lengkap"
                                                       value="<?php echo set_value('nama', (isset($data_siswa->nama_siswa) ? $data_siswa->nama_siswa : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('nama', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Email<span class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                       placeholder="Email"
                                                       value="<?php echo set_value('email', (isset($data_siswa->email) ? $data_siswa->email : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Username<span class="text-danger">*</span></label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                       placeholder="Username"
                                                       value="<?php echo set_value('username', (isset($data_siswa->username) ? $data_siswa->username : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Password<span class="text-danger">*</span></label>
                                                <input type="password" name="password" id="password"
                                                       class="form-control" placeholder="password"
                                                       required="required">
                                                <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon<span class="text-danger">*</span></label>
                                                <input type="number" name="telepon" id="telepon" class="form-control"
                                                       placeholder="Nomor Telepon"
                                                       value="<?php echo set_value('telepon', (isset($data_siswa->telepon) ? $data_siswa->telepon : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('telepon', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon Orang Tua<span class="text-danger">*</span></label>
                                                <input type="number" name="telepon_ortu" id="telepon_ortu"
                                                       class="form-control" placeholder="Nomor Telepon"
                                                       value="<?php echo set_value('telepon_ortu', (isset($data_siswa->telepon_ortu) ? $data_siswa->telepon_ortu : '')); ?>"
                                                       required="required">
                                                <?php echo form_error('telepon_ortu', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-offset-1 col-md-5">
                                            <div class="form-group">
                                                <label>Alamat<span></label>
                                                <textarea name="alamat" id="alamat" class="form-control"
                                                          placeholder="Alamat"
                                                          required="required"><?php echo set_value('alamat', (isset($data_siswa->alamat) ? $data_siswa->alamat : '')); ?></textarea>
                                                <?php echo form_error('alamat', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Asal Sekolah<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select data-placeholder="Pilih Sekolah..." id="sekolah"
                                                            name="sekolah" class="chosen-select"
                                                            onchange="fetch_select_kelas(this.value)"
                                                            style="width: 100% !important;" tab-index="6">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($select_sekolah as $opt) { ?>
                                                            <option <?php echo set_select('sekolah', $opt->id_sekolah, (!isset($data_siswa->sekolah_id) ? FALSE : ($data_siswa->sekolah_id == $opt->id_sekolah ? TRUE : FALSE))); ?>
                                                                    value="<?php echo $opt->id_sekolah ?>"> <?php echo $opt->nama_sekolah ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="input-group-btn">
                          <span id="btnTambahSekolah" class="btn btn-default" title="Tambah sekolah baru"
                                data-toggle="modal" data-target="#modalTambahSekolah">
                            <i class="glyphicon glyphicon-plus"></i>
                          </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kelas<span class="text-danger">*</span></label>
                                                <select data-placeholder="Pilih Kelas..." name="kelas" id="kelas"
                                                        class="chosen-select" style="width: 100%;" tab-index="8">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($select_options as $item) { ?>
                                                        <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data_siswa->id_kelas) ? FALSE : ($data_siswa->kelas == $item->id_kelas ? TRUE : FALSE))); ?>
                                                                value="<?php echo $item->id_kelas ?>"> <?php echo $item->alias_kelas ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="form_submit" value="submit"
                                                    class="btn btn-primary"><i class="fa fa-check"></i> Submit
                                            </button>
                                            <a class="btn btn-danger pull-right"
                                               href="<?php echo site_url('pg_admin/siswa/pendaftar') ?>"><i
                                                        class="fa fa-times"></i> Cancel</></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end .content -->

        <?php $this->load->view("pg_admin/inc/footer.php"); ?>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
    function resetForm(form) {
        // clearing selects
        $('.chosen-select').val('').trigger('chosen:updated');
    }
</script>


<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery-chosen/js/chosen.jquery.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
<script type="text/javascript">
    $('#modalTambahSekolah').on('shown.bs.modal', function () {
        $('.modal-chosen-select', this).chosen('destroy').chosen();
    });
</script>
<script type="text/javascript">
    function fetch_select_sekolah(val) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('pg_admin/siswa/ajax_select_sekolah')?>",
            data: {id: val},
            success: function (response) {
                document.getElementById('sekolah').innerHTML = response;
                $("#sekolah").trigger("chosen:updated");
            }
        });
    }

    function fetch_select_kelas(val) {
        console.log("val -> " + val);
        $.ajax({
            type: 'POST',
            url: "<?=base_url('pg_admin/siswa/ajax_select_kelas')?>",
            data: {id: val},
            success: function (response) {
                document.getElementById('kelas').innerHTML = response;

                $("#kelas").trigger("chosen:updated");
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#formTambahSekolah');
        form.submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: {
                    id_kota: $('#select_kota').val(),
                    jenjang: $('#select_jenjang').val(),
                    sekolah: $('#tambah_sekolah').val(),
                    email: $('#email_sekolah').val(),
                    telepon: $('#telepon_sekolah').val(),
                    alamat: $('#alamat_sekolah').val()
                },
                success: function (response) {
                    if (response != 0) {
                        fetch_select_sekolah("");
                        $("#alertDangerTambahSekolah").slideUp();
                        $("#alertSuccessTambahSekolah").slideDown().delay(5000).slideUp();
                    }
                    else {
                        $("#alertSuccessTambahSekolah").slideUp();
                        $("#alertDangerTambahSekolah").slideDown().delay(5000).slideUp();
                    }
                }
            })

        });
    });
</script>

</html>
