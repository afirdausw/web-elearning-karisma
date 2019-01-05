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
                <?php echo $this->session->flashdata('alert'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">EQ Test</h4>
                            </div>
                            <div class="content">    
                                
                                        <table  id="my_datatable" class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>id eq test</th>
                                                <th>Soal</th>
                                                <th>Jawab A</th>
                                                <th>Jawab B</th>
                                                <th>Jawab C</th>
                                                <th>Jawab D</th>
                                                <th>Skor A</th>
                                                <th>Skor B</th>
                                                <th>Skor C</th>
                                                <th>Skor D</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($eq_test as $eqtest){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $eqtest->id_soal_eq;?>
                                                </td>
                                                <td>
    												<?php
													$soal = html_entity_decode($eqtest->soal);
													$panjangKataSoal = strlen($soal);

													if($panjangKataSoal > 20){
														echo substr($soal, 0, 20)."....<a data-toggle='modal' data-target='#soal_lengkap_".$eqtest->id_soal_eq."' style='cursor:pointer;'> Selengkapnya</a>";
														?>
														<div id="soal_lengkap_<?=$eqtest->id_soal_eq;?>" class="modal  fade" role="dialog" data-backdrop="false">
															<div class="modal-dialog modal-lg">

																<!-- Modal content-->
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">EQ Test Soal No. #<?=$eqtest->id_soal_eq?></h4>
																	</div>
																	<div class="modal-body">
																		<?=$soal?>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																	</div>
																</div>

															</div>
														</div>
														<?php
													}else{
														echo $soal;
													} ?>
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
                                                    <?php echo $eqtest->jawab_d;?>
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
                                                    <?php echo $eqtest->skor_d;?>
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
        </div> <!-- end .content -->

        <?php include "inc/footer.php"; ?>

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
