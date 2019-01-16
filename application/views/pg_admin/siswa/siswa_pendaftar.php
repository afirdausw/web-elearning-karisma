<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>


<script>
    $("#pilihprovinsi").change(function(){
        $("#pilihkota").load("pg_admin/siswa/kota/" + $("#pilihprovinsi").val());
    });

    $("#pilihkota").change(function(){
        $("#btnTambahSekolah").prop('disabled', false);
        $("#pilihsekolah").load("pg_admin/siswa/sekolah/" + $("#pilihkota").val());
    });

    $(function(){
        $("#kelas").change(function(){
            $("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val() +"/"+ $("#sekolah").val());
        });
    });

</script>

<div class="wrapper">
    <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

    <div class="main-panel">
        <?php $this->load->view("pg_admin/inc/navbar.php"); ?>

        <div class="content">
            <div class="container-fluid">
                <?php echo $this->session->flashdata('alert');?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah Siswa</a>
                                <h4 class="title">Semua Pendaftar</h4>
                                <p class="category">Daftar siswa pendaftar</p>

                            </div>

                            <table class="table table-striped table-hover">

                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="provinsi" placeholder="Pilih Provinsi..." name="provinsi" class="chosen-select form-control" onchange="fetch_select_kota(this.value)" style="width: 100%;" tabindex="1" required="required">
                                                <option value="" disabled selected>-- Pilih Provinsi --</option>
                                                <?php
                                                foreach ($select_provinsi as $provinsi)
                                                { ?>
                                                    <option value="<?php echo $provinsi->id_provinsi?>"><?php echo $provinsi->nama_provinsi;?></option>
                                                    <?php
                                                } ?>
                                            </select>

                                </td>

                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="kota" data-placeholder="Pilih Kota/Kabupaten..." name="kota" class="form-control chosen-select" onchange="fetch_select_sekolah(this.value)" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                                                <option value="" disabled selected>-- Pilih Kota/Kabupaten --</option>
                                                <?php
                                                foreach ($select_kota as $kota)
                                                { ?>
                                                    <option value="<?php echo $kota->id_kota?>"><?php echo $kota->nama_kota;?></option>
                                                    <?php
                                                } ?>
                                            </select>

                                </td>

                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="sekolah" data-placeholder="Pilih Sekolah..." name="sekolah" class="form-control chosen-select" onchange="fetch_select_kelas(this.value)" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                                                <option value="" disabled selected>-- Pilih Sekolah --</option>
                                                <?php
                                                foreach ($select_sekolah as $opt) { ?>
                                                    <option <?php echo set_select('sekolah', $opt->id_sekolah, (!isset($data_siswa->sekolah_id) ? FALSE : ($data_siswa->sekolah_id == $opt->id_sekolah ? TRUE : FALSE)) );?>
                                                        value="<?php echo $opt->id_sekolah ?>"> <?php echo $opt->nama_sekolah ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                </td>

                                <td>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="kelas" data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="form-control chosen-select" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                                                <option value="" disabled selected>-- Pilih Kelas --</option>
                                                <?php
                                                foreach ($select_kelas as $item) { ?>
                                                    <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data_siswa->id_kelas) ? FALSE : ($data_siswa->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
                                                        value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                </td>

                        </div>

                    </div>

                    </form>
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

        <?php $this->load->view("pg_admin/inc/footer.php"); ?>
<?php  $this->load->view("pg_admin/alert/alert_modal.php"); ?>
</html>
