<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>

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
                            <div class="header">
                                <a href="<?php echo site_url('pg_admin/mapel/manajemen/tambah/' . $kelas) ?>"
                                   class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah
                                    Mapel</a>
                                <h4 class="title">
                                    <a href="<?php echo site_url('pg_admin/kelas') ?>"
                                       class="btn btn-success"><i class="fa fa-arrow-left"></i></a> Semua Mata Pelajaran
                                </h4>
                                <p class="category">Daftar Mata Pelajaran per Tingkatan Kelas</p>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <table id="my_datatable" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Harga</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        if (count($table_data) > 0) {
                                            foreach ($table_data as $item) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $item->alias_kelas ?></td>
                                                    <td><?php echo $item->nama_mapel ?></td>
                                                    <td>Rp. <?php echo money($item->harga) ?></td>
                                                    <td class="text-center">
                                                        <div class="button-group">
                                                            <a href="<?php echo $form_action . 'manajemen/ubah/' . $kelas . '?id=' . $item->id_mapel ?>"
                                                               class="btn btn-warning btn-xs" title="Ubah"><i
                                                                        class="glyphicon glyphicon-pencil"></i></a>
                                                            <a href="<?php echo base_url('pg_admin/materi_pokok/mapel/' . $kelas . '/' . $item->id_mapel) ?>"
                                                               class="btn btn-primary btn-xs" title="Materi Pokok"><i
                                                                        class="glyphicon glyphicon-arrow-right"></i></a>
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                    title="Hapus" data-number="<?php echo $no ?>"
                                                                    value="<?php echo $item->id_mapel ?>"
                                                                    data-toggle="modal" data-target="#deleteRow_modal">
                                                                <i class="glyphicon glyphicon-remove"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
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

        <?php include "inc/footer.php"; ?>

<?php include "alert_modal.php"; ?>
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
