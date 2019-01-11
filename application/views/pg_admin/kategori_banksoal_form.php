<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("pilihmapel/" + $("#kelas").val());
	});
});
</script>
<div class="wrapper">
  <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/inc/navbar.php"); ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
            <div class="card">
              <div class="header">
                
              </div>
              <div class="content">
				<form action="proseskategori" method="post">
					Kelas : 
					<select name="kelas" class="form-control" id="kelas" required>
					<option value="">--- pilih kelas ---</option>
					<?php
						foreach($datakelas as $kelas){
					?>
						<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
						}
					?>
					</select>
					Mata Pelajaran : 
					<select class="form-control" name="mapel" id="mapel" required>
					</select>
					Nama Kategori :
					<input type="text" name="nama_kastegori" class="form-control" required></input>
					<p>&nbsp;
					<p><input type="submit" class="btn btn-primary" value="simpan"/>
				</form>
              </div>
            </div>
          </div>
			
          </div>
        </div>
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>
<?php $this->load->view("pg_admin/alert_modal.php"); ?>
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
