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
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h5>Ketentuan</h5>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li>File yang akan di-import dapat berupa file <strong>*.xls</strong> atau <strong>*.csv</strong></li>
                                    <li>Pastikan format tabel excel sesuai dengan <i>template</i> yang telah disediakan <a href="<?php echo base_url().'assets/template/data_siswa.xls'?>" class="label label-primary">DI SINI</a></li>
                                <li>Data akan di-import mulai dari baris kedua sampai baris terakhir
                                    <li>Tidak boleh ada kolom/baris yang <strong>tersembunyi</strong> atau <strong>di-hidden</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <form action="<?php echo base_url();?>pg_admin/Latihansoal/upload/" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Import file CSV/XLS</label>

                            <input type="file" name="import_data" id="import_data" class="form-control">
                        </div>
                        <button type="submit" name="form_submit" value="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-import"></i> Import</button>

                    </div>

                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="my_datatables">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Latihan Soal</h4>
                            <p class="category">Daftar Sub-materi yang memiliki Soal Latihan</p>
                        </div>
                        <div class="content">
                            <div class="table-responsive">
                                <table id="my_datatable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Materi Pembelajaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                        $no = 1;
                        foreach ($table_data as $item)
                        {
                      ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $item->alias_kelas; ?></td>
                                            <td><?php echo $item->nama_mapel; ?></td>
                                            <td>
                                                <?php echo $item->nama_sub_materi; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo site_url() . "pg_admin/latihansoal/detail/$item->id_sub_materi";?>" class="btn btn-sm btn-fill btn-info">
                                                Lihat Daftar Soal <span class="glyphicon glyphicon-arrow-right"></span>
                                            </a>
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
    </div> <!-- end .container-fluid -->
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
