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
                                <a  href="<?php echo site_url('psep_sekolah/guru_banksoal/tambah') ?>"
                                   class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah
                                    Bank Soal</a>
<!--                                <a style="margin-right: 12px " href="--><?php //echo site_url('guru_banksoal/duplikat') ?><!--"-->
<!--                                   class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Duplikat-->
<!--                                    Bank Soal</a> -->
                                <h4 class="title">Data Bank Soal</h4>

                            </div>
                            <div class="content">

                                <div class="table-responsive">
                                    <table id="my_datatable" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Topik</th>
                                            <th>Pembahasan</th>
                                            <th>Pelajaran</th>
                                            <th>Bobot Soal</th>
                                            <th>Kunci Jawaban</th>
                                            <th>Operasi</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list-soal">
                                        <?php
                                        foreach($data_soal as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $data->topik; ?> ...</td>
                                                <td>
                                                    <?php
                                                    if($data->pembahasan_teks !== "" AND $data->pembahasan_video !== ""){
                                                        ?>
                                                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                                                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                                                        <?php
                                                    }elseif($data->pembahasan_teks == "" AND $data->pembahasan_video !== ""){
                                                        ?>
                                                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                                                        <?php
                                                    }elseif($data->pembahasan_teks !== "" AND $data->pembahasan_video == ""){
                                                        ?>
                                                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                                                        <?php
                                                    }elseif($data->pembahasan_teks == "" AND $data->pembahasan_video == ""){

                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->nama_mapel . " - " . $data->alias_kelas;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->bobot_soal;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $data->kunci;
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#myModal<?php echo $data->id_banksoal; ?>">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </a>
                                                    <a href="guru_banksoal/edit/<?php echo $data->id_banksoal;?>">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="guru_banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END TABLE BANK SOAL -->

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

<div id="list_modal">
    <?php
    $no=1;
    foreach($data_soal as $data){
        ?>
        <div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modalsoal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Pertanyaan</p>
                        <p><?php echo $data->pertanyaan; ?></p><br>
                        <p>Jawaban</p>
                        <?php if($data->kunci == 1){ ?>
                            <p><?php echo $data->jawab_1; ?></p><br>
                        <?php }elseif($data->kunci == 2){ ?>
                            <p><?php echo $data->jawab_2; ?></p><br>
                        <?php }elseif($data->kunci == 3){ ?>
                            <p><?php echo $data->jawab_3; ?></p><br>
                        <?php }elseif($data->kunci == 4){ ?>
                        <p><?php echo $data->jawab_4; }?></p><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php
        $no++;
    }
    ?>
</div>



</html>
