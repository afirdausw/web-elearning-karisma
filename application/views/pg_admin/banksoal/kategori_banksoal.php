<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../pilihmapel/" + $("#kelas").val());
	});
	
	$("#mapel").change(function(){
		$("#topik").load("../pilihtopik/" + $("#mapel").val());
		
		$("#soal").load("../pilihsoalbymapel/" + $("#mapel").val());
	});
	
	$("#topik").change(function(){
		$("#soal").load("../pilihsoalbytopik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
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
                <h4 class="title">Tambah Profil</h4>
              </div>
              <div class="content">
				<a class="btn btn-primary" href="tambahkategori">Tambah Kategori</a>
				<table  id="my_datatable"  class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Kelas</td>
							<td>Mata Pelajaran</td>
							<td>Nama Kategori</td>
							<td>Operasi</td>
						</tr>
					</thead>
					
					<tbody>
						<?php
							foreach($kategoribanksoal as $kategori){
						?>
							<tr>
								<td><?php echo $kategori->alias_kelas; ?></td>
								<td><?php echo $kategori->nama_mapel; ?></td>
								<td><?php echo $kategori->nama_kategori; ?></td>
								<td>
								<a href="editkategori/<?php echo $kategori->id_kategori_bank_soal;?>">Edit</a> | 
								
								<?php
								if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
								?>
								<a onclick="return confirm('Apakah anda yakin inign menghapus kategori <?php echo $kategori->nama_kategori; ?>?')" href="hapuskategori/<?php echo $kategori->id_kategori_bank_soal;?>">Hapus</a>
								<?php
								}
								?>
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
              </div>
            </div>
          </div>
			
          </div>
        </div>
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>


<?php $this->load->view("pg_admin/alert/alert_modal.php"); ?>
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
