<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/html_header.php"); ?>

<div class="wrapper">
    <?php $this->load->view("pg_admin/sidebar.php"); ?>

    <div class="main-panel">
        <?php $this->load->view("pg_admin/navbar.php"); ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">

                                <h4 class="title">Semua Transaksi</h4>
                                <p class="category">Daftar Transaksi Pembelian Hak Akses Mata Pelajaran</p>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table id="my_datatable" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No Transaksi</th>
                                            <th>Nama User</th>
                                            <th>Total Bayar</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $status = [
                                            1 => [
                                                "tipe" => "success",
                                                "teks" => "Pesanan Selesai",
                                            ],
                                            0 => [
                                                "tipe" => "danger",
                                                "teks" => "Belum Di Bayar",
                                            ],
                                            2 => [
                                                "tipe" => "warning",
                                                "teks" => "Menunggu Konfirmasi Admin",
                                            ],
                                            3 => [
                                                "tipe" => "default",
                                                "teks" => "Tiket Sudah Expired",
                                            ],
                                        ];

                                        ?>
                                        <?php
                                        $no = 1;
                                        foreach ($table_data as $item) {

                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>#<?= str_pad($item->id_transaksi, 10, "0", STR_PAD_LEFT) ?></td>
                                                <td><?= $item->nama_siswa ?></td>
                                                <td>Rp. <?= money($item->jumlah_total) ?></td>
                                                <td><?= $item->created_at ?></td>
                                                <td>
                                                    <span class="label label-<?= $status[$item->status]['tipe'] ?>"><?= $status[$item->status]['teks'] ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="button-group">
                                                        <a href="<?= base_url('pg_admin/transaksi/detail/' . $item->id_transaksi) ?>"
                                                           class="btn btn-primary btn-xs" title="Detail Transaksi"><i
                                                                    class="glyphicon glyphicon-eye-open"></i></a>
                                                    </div>
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

        <?php $this->load->view("pg_admin/footer.php"); ?>

    </div> <!-- end .main-panel -->
</div>

<?php $this->load->view("pg_admin/alert_modal.php"); ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript'); ?>"></script>
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
