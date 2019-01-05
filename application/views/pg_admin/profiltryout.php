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
                <h4 class="title">Profil Try Out</h4>
              </div>
              <div class="content">
					<div class="col-md-6 col-lg-6">
						<a href="tryout/manajemen/tambahprofil" class="btn btn-primary">Tambah Profil Try Out</a>
					</div>
					<div class="col-md-6 col-lg-6" style="text-align: right; font-style: italic;">
						Halaman ini digunakan untuk mengatur soal yang akan
						dimasukkan/dihilangkan dari Kategori Profil Tes.
						Untuk menambah, mengubah, dan menghapus Data Soal ada di menu Bank Soal.
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Profil Tes</th>
								<th>Kategori</th>
								<th>Tanggal Acara</th>
								<th>Biaya Daftar</th>
								<th>Jenjang Kelas</th>
								<th>Banner</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<style>
							.kat td{
								font-weight:bold;
							}
						</style>
						<tbody>
							<?php
								$no = 1; 
								foreach ($table_data as $item) 
								{
									$no++;
							  ?>
								<tr class="kat">
									<td><?php echo $item->id_tryout;?></td>
									<td><?php echo $item->nama_profil;?>
									<p>
									<?php
										if($item->tipe == 1 && $item->status == 0){
											echo "<a href='tryout/aktifcbt/$item->id_tryout'>Aktifkan PopUp dan Pendaftaran</a>";
										}elseif($item->tipe == 1 && $item->status == 1){
											echo "<a href='tryout/nonaktifcbt/$item->id_tryout'>Nonaktifkan PopUp dan Pendaftaran</a>";
										}
									?>
									</td>
									<td>
										<a href="tryout/manajemen/tambahkategori/<?php echo $item->id_tryout;?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i></a>
									</td>
									<td>
										<?php echo $item->tgl_acara;?>
										<br>
										Jam <?php echo $item->jam_acara;?>
									</td>
									<td>Rp. <?php echo $item->biaya;?>,-</td>
									<td><?php echo $item->alias_kelas;?></td>
									<td>
									<?php 
									if($item->banner !== ""){
									?>
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalbanner<?php echo $item->id_tryout;?>">
									 <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
									</button>
									<?php
									}
									?>
									</td>
									<td class="text-center">
										<div class="button-group">
										  <a href="tryout/manajemen/editprofil/<?php echo $item->id_tryout;?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
										  
										  <?php
									      if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
										  ?>
										  <a href="tryout/manajemen/hapusprofil/<?php echo $item->id_tryout;?>" class="btn btn-danger btn-xs" title="Hapus"><i class="glyphicon glyphicon-remove"></i></a>
										  <?php
										  }
										  ?>
										</div>
									 </td>
								</tr>
								</strong>
								<?php
									foreach($table_kategori as $kategori){
										if($item->id_tryout == $kategori->id_profil){
								?>
									<tr>
										<td></td>
										<td><i><?php echo $kategori->nama_kategori;?></i></td>
										<td colspan="4">
										<span class="label label-success">waktu: <?php echo $kategori->durasi;?> menit</span> 
										<span class="label label-warning">jumlah: <?php echo $kategori->jumlah_soal;?> soal</span> 
										<span class="label label-info">ketuntasan: <?php echo $kategori->ketuntasan;?> </span> 
										<?php
											if($kategori->status == '0'){
												echo ' <a href="tryout/manajemen/aktivasi/'.$kategori->id_kategori.'"><span class="label label-default">Non Aktif</span></a>';
											}else{
												echo ' <a href="tryout/manajemen/nonaktif/'.$kategori->id_kategori.'"><span class="label label-primary">Aktif</span></a>';
											}
										?>
										</td>
										<td><a href="tryout/ambilbanksoalfilter/<?php echo $kategori->id_kategori;?>" class="btn btn-danger"><span class="glyphicon glyphicon-cog"></span> Manage Soal</a></td>
										<td class="text-center">
											<a href="tryout/manajemen/editkategori/<?php echo $kategori->id_kategori;?>">
											<span class="glyphicon glyphicon-pencil"></span> 
											</a>
											
											<?php
											if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
											?>
											<a href="tryout/manajemen/hapuskategori/<?php echo $kategori->id_kategori;?>" onclick="return confirm('Apakah anda yakin untuk menghapus kategori <?php echo $kategori->nama_kategori; ?>');">
											<span class="glyphicon glyphicon-trash"></span>
											</a>
											<?php
										    }
										    ?>
											
										</td>
									</tr>
								<?php
								}else{
									
								}
								?>
								<?php
									}
								?>
							  <?php
								}
							  ?>
						</tbody>
					</table>
					
					<div class="text-center">
						<ul class="pagination pagination-lg">

							<?php 
								$halget = 0;
								$limit_show = 2;
								if(isset($_GET["page"])){
									$halget = $_GET["page"];
								}



								if(isset($_GET["page"])){
									if($halget != 1){
										?>
										<li class="previous">
											<a href="?page=<?php echo 1;?>">
											<span class='glyphicon glyphicon-fast-backward'></span>
											</a>
										</li>
										<li class="previous">
											<a href="?page=<?php echo $halget-1;?>">
												<span class='glyphicon glyphicon-step-backward'></span>
											</a>
										</li>
										<?php
									}							
								}
							?>
							<?php

								for($i=1; $i<=$jumhal;$i++){
									$show_pagging = 0;

									if($i==$halget){
										$show_pagging += 1;
									}else if($i <= $halget AND $i >= $halget-$limit_show){
										$show_pagging += 1;
									}else if($i >= $halget AND $i <= $halget+$limit_show){
										$show_pagging += 1;
									}

									if($show_pagging == 1){
										if(isset($_GET["page"]) AND $halget != $i){
											echo "<li>";
											echo "<a ";
											echo "href='?page=$i'";
										}else if(!isset($_GET["page"]) AND $i != 1){
											echo "<li>";
											echo "<a ";
											echo "href='?page=$i'";
										}else{
											echo "<li class='active'>";
											echo "<a ";
											echo "";

										}
										echo ">$i</a>";
										echo "</li>";
									}
								}
							?>
							<?php
								if($halget != $jumhal){
									?>
									<li class="next">
										<a href="?page=<?php echo $halget+1;?>">
											<span class='glyphicon glyphicon-step-forward'></span>
										</a>
									</li>
									<li class="next">
										<a href="?page=<?php echo $jumhal;?>">
											<span class='glyphicon glyphicon-fast-forward'></span>
										</a>
									</li>
									<?php
								}
							?>
						</ul>
					</div>
					
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

<?php
$no = 1; 
foreach ($table_data as $item) 
{ ?>
	
		<div class="modal fade" id="modalbanner<?php echo $item->id_tryout;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo $item->nama_profil;?></h4>
					</div>
					<div class="modal-body">
<?php
	if($item->banner !== "-"){
		?>
				<img src="<?php echo base_url('assets/uploads/banner/'.$item->banner);?>" class="img img-responsive"/>
		<?php
	}else{ ?>
				<img src="<?php echo base_url('assets/uploads/banner/default.png');?>" class="img img-responsive" style="width:20%;margin:0 auto;"/>
	<?php
	}
	?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
<?php
}
?>

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
