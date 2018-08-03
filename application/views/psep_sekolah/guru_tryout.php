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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Daftar Try Out</h4>

                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table id="my_datatable" class="table table-striped table-hover">
                                        <thead align="center" >
                                        <tr >
                                            <th>#</th>
                                            <!--                        <th>Jenjang Pendidikan</th>-->
                                            <th>Tingkatan Kelas</th>
                                            <th>Alias kelas</th>

                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                        $no = 1;
                                        foreach ($carikelas as $kelas) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <!--                          <td>--><?php //echo $item->jenjang
                                                ?><!--</td>-->
                                                <td><?php echo $kelas->kelas_id ?></td>
                                                <td><?php echo $kelas->alias_kelas ?></td>

                                                <td class="text-center">
                                                    <div class="button-group">
                                                        <a href="<?php echo 'tryout_guru/kelas/'.$kelas->kelas_id ?>"
                                                           class="btn btn-primary btn-xs" title="Try Out Tiap kelas"><i
                                                                class="glyphicon glyphicon-arrow-right"></i></a>

                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
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
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript'); ?>"></script>
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


</html>
