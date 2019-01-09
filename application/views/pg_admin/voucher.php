<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>

<script>
    $(function(){
        $("#pilihpaket").change(function(){
            $("#pilihdurasi").load("voucher/durasi/" + $("#pilihpaket").val());
        });
        $("#pilihkelas").change(function(){
            $("#list-voucher").load("voucher/daftar/" + $("#pilihdurasi").val() + "/" + $("#pilihkelas").val());
        });
    });
</script>

<div class="wrapper">
    <?php include "inc/sidebar.php"; ?>

    <div class="main-panel">
        <?php include "inc/navbar.php"; ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">


                            <table class="table table-striped table-hover">

                                <form action="voucher/export" method="post" target="_blank">


                                    <tr>
                                        <td>
                                        <div class="col-md-5">
                                            <div class="form-group">

                                            <label>Voucher</label>
                                            <input type="text" name="voucher" id="voucher" class="form-control" placeholder="voucher" value=""  tabindex="1">

                                        </td> 
                                            </div>

                                        </div>

                                    </tr>

                                    <td>
                                        <input type="submit" class="btn btn-danger" value="Submit" />
                                    </td>



                                </form>
                            </table>

                            <div class="content">
                                <div class="table-responsive">
                                    <table id="my_datatable" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Voucher</th>
                                            <th>Durasi</th>
                                            <th>Status</th>
                                            <th>Start</th>
                                            <th>Expired</th>

                                        </tr>
                                        </thead>
                                        <tbody id="list-voucher">
                                        <?php
                                        $no = 1;
                                        foreach ($table_data as $item)
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $item->kode_voucher;?></td>
                                            <td><?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium';?></td>
                                            <td><?php echo $item->durasi;?> bulan</td>
                                            <td><?php echo $item->alias_kelas;?></td>
                                            <!-- <td><?php echo ($item->tipe == 0) ? $item->alias_kelas : 'Semua Kelas';?></td> -->
                                            <td><?php echo $item->ket;?></td>
                                            <td><?php
                                                if(strpos($item->status, '0')!==FALSE){
                                                    echo "Available";
                                                }else{
                                                    echo "Activated";
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            $no++;
                                            }
                                            ?>

                                            </td>
                                        </tr>
                                        <?php
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

        <?php include "inc/footer.php"; ?>

    </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/plugin/bootstrap-3/bootstrap.min.js" type="text/javascript');?>"></script>

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
