<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>
<script>
$(function(){
	$("#kelas").change(function(){
	    $("#mapel").load("banksoal/ajax_mapel/" + $(this).val());
	    
		var _kelas = $(this).find(':selected').data('kelas'),
			_table = $('#my_datatable').DataTable();

		_table.columns(0).search(_kelas).draw();
	});

	$("#mapel").change(function(){
// 		$("#list-soal").load("banksoal/ajax_soal/" + $("#kelas").val() + "/" + $("#mapel").val());
		$("#topik").load("banksoal/ajax_topik/" + $("#mapel").val());
		$("#list_modal").load("banksoal/ajax_soal_modal/" + $("#kelas").val() + "/" + $("#mapel").val());
		
		var _kelas = $('#kelas').find(':selected').data('kelas'),
		    _mapel = $(this).find(':selected').data('mapel'),
			_table = $('#my_datatable').DataTable();

		_table.columns(0).search(_kelas).draw();
		_table.columns(3).search(_mapel).draw();
	});
	$("#topik").change(function(){
		var _kelas = $('#kelas').find(':selected').data('kelas'),
		    _mapel = $('#mapel').find(':selected').data('mapel'),
		    _topik = $(this).find(':selected').val(),
			_table = $('#my_datatable').DataTable();

		_table.columns(0).search(_kelas).draw();
		_table.columns(3).search(_mapel).draw();
		_table.columns(1).search(_topik).draw();

// 		$("#list-soal").load("banksoal/ajax_soal_by_topik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
// 		$("#list_modal").load("banksoal/ajax_soal_modal_by_topik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
	});
});
</script>
<div class="wrapper">
  <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/inc/navbar.php");?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              </div>
              <div class="content">
				<a class="btn btn-primary" href="banksoal/tambah">Tambah Bank Soal</a>
				<a class="btn btn-primary" href="banksoal/duplikat">Duplikat Bank Soal</a>
                <!-- TABLE UNTUK BANK SOAL -->
				<div  class="table-responsive">
				<table class="table table-stripped">
					<tr>
					<td>
						<select id="kelas" class="form-control">
							<option value="">Pilih Kelas...</option>
							  <?php 
							  foreach ($select_options_kelas as $item) { 
							  ?>
							  <option value="<?php echo $item->id_kelas; ?>" data-kelas="<?php echo $item->alias_kelas; ?>"> <?php echo $item->alias_kelas; ?> </option>
							  <?php } ?>
						</select>
					</td>
					<td>
						<select id="mapel" class="form-control">
							<option value="">Pilih Mata Pelajaran...</option>
						</select>
					</td>
					<td>
						<select id="topik" class="form-control">
							<option value="">Pilih Topik...</option>
						</select>
					</td>
					</tr>
				</table>
				</div>
				<div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Kelas</th>
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
							<td><?php echo $data->alias_kelas; ?></td>
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
									echo $data->nama_mapel;
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
								<a href="banksoal/edit/<?php echo $data->id_banksoal;?>">
								<span class="glyphicon glyphicon-pencil"></span> 
								</a>
								<a href="banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
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

				
                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
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
          <p>Pertanyaan</p><br>
		<p><?php echo $data->pertanyaan; ?></p><br>
          <p>Jawaban</p><br>
          <p><?php echo $data->pertanyaan; ?></p><br>
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


<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>

</html>
