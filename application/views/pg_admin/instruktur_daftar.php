<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>


<script>
    // $("#pilihprovinsi").change(function(){
    //     $("#pilihkota").load("pg_admin/siswa/kota/" + $("#pilihprovinsi").val());
    // });

    // $("#pilihkota").change(function(){
    //     $("#btnTambahSekolah").prop('disabled', false);
    //     $("#pilihsekolah").load("pg_admin/siswa/sekolah/" + $("#pilihkota").val());
    // });

    // $(function(){
    //     $("#kelas").change(function(){
    //         $("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val() +"/"+ $("#sekolah").val());
    //     });
    // });
</script>

<div class="wrapper">
    <?php include "sidebar.php"; ?>

    <div class="main-panel">
        <?php include "navbar.php"; ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert');?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <a href="<?=site_url("pg_admin/{$basic_info['slug']}/manajemen/tambah") ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah <?="{$basic_info['title']}"?></a>
                                <h4 class="title">Semua <?="{$basic_info['title']}"?></h4>
                                <p class="category">Daftar semua <?="{$basic_info['slug']}"?></p>

                            </div>

                            <table class="table table-striped table-hover">
                            </table>

                    <div class="content">
                        <div class="row">
                            <div class="">


                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Email</th>
                                        <th>HP</th>
                                        <th class="text-center">Telp. Orang Tua</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody id="listsiswa">
                                    <tr>
                                        <td colspan="7"> Pilih Kelas Untuk Menampilkan Data Siswa</td>
                                    </tr>
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



<script type="text/javascript">
    function fetch_select_kota(val)
    {
        if($("#provinsi option:selected").val() != '') {
            $("#kota").attr('disabled', false);
            $("#btnTambahSekolah").attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('pg_admin/agcu/ajax_select_kota')?>",
                data: { id:val },
                success: function(response){
                    document.getElementById('kota').innerHTML=response;
                    $("#kota").trigger("chosen:updated");
                }
            });
        }
        else {
            $("#kota").attr('disabled', 'disabled');
        }
    }

    function fetch_select_sekolah(val)
    {
        $('#hidden_id_kota').val(val);
        if($("#kota option:selected").val() != '') {
            $("#sekolah").attr('disabled', false);
            $("#btnTambahSekolah").attr('disabled', false);
            $.ajax({
                type: 'POST',
                url: "<?=base_url('pg_admin/agcu/ajax_select_sekolah')?>",
                data: { id:val },
                success: function(response){
                    document.getElementById('sekolah').innerHTML=response;
                    $("#sekolah").trigger("chosen:updated");
                }
            });
        }
        else {
            $("#sekolah").attr('disabled', 'disabled');
            $("#btnTambahSekolah").attr('disabled', 'disabled');
        }
    }

    function fetch_select_kelas(val)
    {
        if($("#sekolah option:selected").val() != '') {
            $("#kelas").attr('disabled', false);
            $.ajax({
                type: 'POST',
                url: "<?=base_url('pg_admin/agcu/ajax_select_kelas')?>",
                data: { id:val },
                success: function(response){
                    document.getElementById('kelas').innerHTML=response;

                    $("#kelas").trigger("chosen:updated");
                }
            });
        }
        else {
            $("#kelas").attr('disabled', 'disabled');
        }
    }




</script>


<!-- JS Function for this Modal -->



</html>
