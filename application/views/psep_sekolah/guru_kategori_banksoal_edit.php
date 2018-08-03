<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
    $(function(){
        $("#kelas").change(function(){
            $("#mapel").load("../pilihmapel/" + $("#kelas").val());
        });
    });
</script>
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

                            </div>
                            <div class="content">
                                <form action="../proseseditkategori" method="post">
                                    <input type="hidden" name="id_kategori" value="<?php echo $datakategori->id_kategori_bank_soal; ?>" />
                                    <div class="col-md-6" hidden>
                                        <input name="kelas" id="kelas" type="text" value="<?php echo $idkelas ?>">
                                    </div>
                                    <div class="col-md-6" hidden >
                                        <input name="mapel" id="mapel" type="text" value="<?php echo $idmapel ?>">
                                    </div>
                                    Nama Kategori :
                                    <input type="text" name="nama_kastegori" class="form-control" value="<?php echo $datakategori->nama_kategori;?>" required></input>
                                    <p>&nbsp;
                                    <p><input type="submit" class="btn btn-primary" value="simpan"/>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end .content -->

        <?php include "footer.php"; ?>

    </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

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
