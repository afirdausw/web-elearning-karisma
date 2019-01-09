<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/jquery-ui.css');?>">
<style>
	/*untuk spinner*/
	#nprogress .spinner{
		top: 0;
		right: 0;

		width:100%;
		height:100%;

		background:rgba(255,255,255,0.5);

		opacity:1;
		transition: opacity 0.2s ease-in-out;
	}

	#nprogress .spinner-icon {
		border-top-color: #1BBC9B;
		border-left-color: #1BBC9B;

		width: 5%;
		height: 11%;
		border-width: 8px;
		margin: 20% 50%;
	}

	#nprogress {
		pointer-events: all;
	}

	#nprogress .bar{
		display:none;
	}
</style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
$(function(){

	NProgress.configure({
   		showSpinner: true
	});
	
	$("#kelas").change(function(){
        NProgress.start();
		$("#mapel").load("../pilihmapel/" + $("#kelas").val());
	});
	
	$("#mapel").change(function(){
        NProgress.start();
		$("#topik").load("../pilihtopik/" + $("#mapel").val());
		
		$("#soal").load("../pilihsoalbymapel/" + $("#mapel").val());
		$("#kategoribanksoal").load("../pilihkategori/" + $("#mapel").val());
	});
	
	$("#topik").change(function(){
        NProgress.start();
		$("#soal").load("../pilihsoalbytopik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
	});
	
	$("#kategoribanksoal").change(function(){
        //NProgress.start();
		$("#soal").load("../pilihsoalbykategori/" + $("#kategoribanksoal").val()+'/'+ $('#mapel').val()+'/'+$('#kelas').val()+'/1');
	});
});
</script>
<div class="wrapper">
  <?php include "inc/sidebar.php"; ?>

  <div class="main-panel">
    <?php include "inc/navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Tambah Profil</h4>
              </div>
              <div class="content">
			  <form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">
<!--					<input type="submit" value="Simpan Profil" name="form_submit" class="btn btn-primary"/>-->
					<p><input type="hidden" name="idprofil" value="<?php echo $idprofil; ?>" />
					<div class="row">
						<table class="table" style="background-color: #EDEDED">
							<tr>
								<td class="text-center">Tampil Soal</td>
								<td class="text-center">Tanggal Tes</td>
								<td class="text-center">Jam</td>
								<td class="text-center">Nama Kategori</td>
								<td class="text-center">Waktu</td>
								<td class="text-center">Ketuntasan</td>
								<td class="text-center">Mata Pelajaran</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="random" class="form-control"/> Random</td>
								<td><input type="text" name="tanggal" class="form-control" id="datepicker" /></td>
								<td><input type="text" name="jam" class="form-control" /></td>
								<td><input type="text" name="nama" class="form-control" /></td>
								<td><input type="text" name="waktu" class="form-control" /></td>
								<td><input type="text" name="ketuntasan" class="form-control" /></td>
<!--								<td><input type="text" name="mata_pelajaran" class="form-control" /></td>-->
                                <td><select name="mata_pelajaran" class="form-control">
                                        <option>-- Pilih Mapel --</option>
                                        <?php
                                          foreach ($datamapel as $mapel){
                                          ?>
                                        <option value="<?php echo $mapel->id_mapel?>"> <?php echo $mapel->nama_mapel ?> </option>

                                        <?php
                                          }

                                        ?>
                                    </select></td>
							</tr>
						</table>
<!--						<table class="table table-stripped table-hover">-->
<!--							<tr>-->
<!--								<td colspan="2" style="text-align: center;">-->
<!--									Kelas-->
<!--									<select id="kelas" name="selectkelas" class="form-control">-->
<!--										<option>-- Pilih Kelas --</option>-->
<!--										--><?php
//										foreach($datakelas as $kelas){
//										?>
<!--											<option value="--><?php //echo $kelas->id_kelas?><!--">--><?php //echo $kelas->alias_kelas; ?><!--</option>-->
<!--										--><?php
//										}
//										?>
<!--									</select>-->
<!--								</td>-->
<!--								<td colspan="3" style="text-align: center;">-->
<!--									Mata Pelajaran-->
<!--									<select id="mapel" name="selectmapel" class="form-control">-->
<!--										<option>-- Pilih Mata Pelajaran --</option>-->
<!--									</select>-->
<!--								</td>-->
<!--								<td colspan="2" style="text-align: center;">-->
<!--									Kategori Soal-->
<!--									<select name="kategoribanksoal" id="kategoribanksoal" class="form-control">-->
<!--										-->
<!--									</select>-->
<!--								</td>-->
<!--								<!---->
<!--								<td colspan="2" style="text-align: center;">-->
<!--									Topik-->
<!--									<select id="topik" name="selecttopik" class="form-control">-->
<!--										<option value="semua">-- Pilih Topik --</option>-->
<!--									</select>-->
<!--								</td>-->
<!--								-->
<!--							</tr>-->
<!--						</table>-->
<!--												-->
<!--						<table class="table table-stripped table-hover">-->
<!--							<thead>-->
<!--								<tr>-->
<!--									<th>No</th>-->
<!--									<th>Kelas</th>-->
<!--									<th>Pertanyaan</th>-->
<!--									<th>Pembahasan</th>-->
<!--									<th>Mata Pelajaran</th>-->
<!--									<th>Bobot</th>-->
<!--									<th>Kunci</th>-->
<!--									<th>Pilih</th>-->
<!--								<tr>-->
<!--							</thead>-->
<!--							<tbody id="soal">-->
<!--								-->
<!--							</tbody>-->
<!--						</table>-->
<!--						<div id="pagging"></div>-->
					</div>
					<input type="submit" value="Simpan Profil" name="form_submit" class="btn btn-primary"/>
				</form>
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
 <script src="<?php echo base_url('assets/plugin/bootstrap-3/js/bootstrap.min.js" type="text/javascript');?>"></script>

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
<script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.js');?>"></script>
<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js') ?>"></script>
<script>
$( function() {
$("#datepicker").datepicker({
	dateFormat: "yy-mm-dd"
});
} );
</script>
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
