<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>

<div class="wrapper">
    <?php include "sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Kelas" ?></h4>
                                <!-- <p class="category">24 Hours performance</p> -->
                            </div>
                            <div class="content">
                                <form method="post" action="<?php echo $form_action ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenjang<span class="text-danger">*</span></label>
                                                <input type="text" name="jenjang" id="jenjang" class="form-control"
                                                       onKeyUp="setAlias();" placeholder="Jenjang Pendidikan"
                                                       value="<?php echo set_value('jenjang', isset($data) ? $data->jenjang : ''); ?>"
                                                       required="required">
                                                <?php echo form_error('jenjang', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tingkatan Kelas<span class="text-danger">*</span></label>
                                                <input type="text" name="tingkatan_kelas" id="tingkatan_kelas"
                                                       class="form-control" onKeyUp="setAlias();"
                                                       placeholder="Tingkatan Kelas"
                                                       value="<?php echo set_value('tingkatan_kelas', isset($data) ? $data->tingkatan_kelas : ''); ?>"
                                                       required="required">
                                                <?php echo form_error('tingkatan_kelas', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alias Kelas<span class="text-danger">*</span></label>
                                                <input type="text" name="alias_kelas" id="alias_kelas"
                                                       class="form-control" placeholder="Alias Kelas"
                                                       value="<?php echo set_value('alias_kelas', isset($data) ? $data->alias_kelas : ''); ?>"
                                                       required="required">
                                                <?php echo form_error('alias_kelas', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gambar_mapel">Gambar Thumbnail</label>
                                                <input type="file" id="" class="form-control" name="gambar_kelas"
                                                       accept="image/*" <?php if ($page_title != "Ubah Kelas") {
                                                    echo "required='required'";
                                                } ?>>
                                            </div>
                                        </div>
                                        <?php if ($page_title == "Ubah Kelas") { ?>
                                            <div class="col-md-6">
                                                <label for="gambar_mapel">Gambar Thumbnail Sekarang</label>
                                                <img src="<?= (isset($data->gambar_kelas) ? (!empty($data->gambar_kelas) ? base_url() . 'image/kelas/' . $data->gambar_kelas : base_url() . 'assets/img/no-image.jpg') : base_url() . 'assets/img/no-image.jpg') ?>"
                                                     alt="Gambar Kelas" style="display:block;max-width: 10vw;">
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Deskripsi Kelas<span class="text-danger">*</span></label>
                                                <textarea class="tinymce_textarea"
                                                          name="deskripsi_kelas"><?php echo set_value('deskripsi_kelas', isset($data) ? $data->deskripsi_kelas : ''); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="form_submit" value="submit"
                                                    class="btn btn-primary"><i class="fa fa-check"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-danger pull-right"
                                                    onclick="window.history.back();"><i class="fa fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end .content -->

        <?php include "inc/footer.php"; ?>

    </div>
</div> <!-- end .wrapper -->

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js'); ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js'); ?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js'); ?>"></script>


<!-- TinyMCE - WYSIWYG plugin  -->
<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '.tinymce_textarea',
        skin: 'lightgray',
        menubar: false,
        max_height: 300,
        plugins: [
            "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager",
            "code fullscreen youtube autoresize"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen",
        toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor youtube | forecolor backcolor | code",
        extended_valid_elements: "+iframe[src|width|height|name|align|class]",
        fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
        relative_urls: false,
        remove_script_host: false,

    });
</script>


<!-- CUSTOM JS FUNCTION -->

<script type="text/javascript">
    function setAlias() {
        var jenjang = document.getElementById('jenjang').value;
        var tingkatan = document.getElementById('tingkatan_kelas').value;
        var alias = document.getElementById('alias_kelas');

        alias.value = jenjang + " kelas " + tingkatan;
    }
</script>

</html>
