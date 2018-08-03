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
                                <h4 class="title">LS Test</h4>
                            </div>
                            <div class="content">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>ls test</h4>
                                    </div>
                                    <div class="panel-body">
                                        <table  id="my_datatable" class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>id eq test</th>
                                                <th>Soal</th>
                                                <th>Jawab A</th>
                                                <th>Jawab B</th>
                                                <th>Jawab C</th>
                                                <th>Skor A</th>
                                                <th>Skor B</th>
                                                <th>Skor C</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($ls_test as $eqtest){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $eqtest->id_soal_ls;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->soal;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->jawab_a;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->jawab_b;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->jawab_c;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->skor_a;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->skor_b;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $eqtest->skor_c;?>
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                <?php

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
