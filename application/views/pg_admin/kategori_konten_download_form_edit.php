<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>
<script>
    $(function () {
        $("#kelas").change(function () {
            $("#mapel").prop('disabled', false);
            $("#mapel").attr('disabled', false);
            $("#mapel").load("ajax_mapel/" + $("#kelas").val());
        });
    });
</script>
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
                                <h4 class="title">Edit Kategori Download Konten </h4>
                            </div>
                            <div class="content">
                                <div class="row">

                                    <form action="<?php echo base_url("pg_admin/kategori_konten_download/proses_update"); ?>"
                                          method="post" enctype="multipart/form-data">
                                        <div class="col-md-12">

                                            <div class="form-group" hidden>
                                                <label>Id</label>
                                                <input type="text" value="<?php echo $carikonten->id?>" name="id" class="form-control" required/>
                                            </div>


                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" value="<?php echo $carikonten->kategori_konten_download?>" name="judul_kategori" class="form-control" required/>
                                            </div>

                                            <div class="form-group">
                                                <label>Gambar</label>
                                                <input type="file" name="gambar" required/>
                                            </div>


                                            <br>&nbsp;
                                            <br>&nbsp;
                                            <input type="submit" class="btn btn-primary" value="Edit '<?php echo $carikonten->kategori_konten_download ?>'"/>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end .container-fluid -->
        </div> <!-- end .content -->

        <?php $this->load->view("pg_admin/inc/footer.php"); ?>
    
    <script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }




</script>

</html>
