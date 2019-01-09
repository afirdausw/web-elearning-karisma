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
                <h4 class="title">Manage Soal</h4>
              </div>
              <div class="content">
				<form method="post" action="<?php echo $form_action?>">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Pertanyaan</th>
								<th>Pembahasan</th>
								<th>Pelajaran</th>
								<th>Topik</th>
								<th>Bobot</th>
								<th>Kunci</th>
								<th>Pilih</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($data_table as $item){
							?>
							<tr>
								<td><?php echo $no++ ;?></td>
								<td><?php
									$strp_str = strip_tags($item->pertanyaan);
									if (strlen($strp_str) > 20){
										echo substr($strp_str, 0, 17) . '...';
										?>
											<a data-toggle="modal" data-target="#soal_p_<?php echo $item->id_banksoal ;?>" href="#soal_p_<?php echo $item->id_banksoal ;?>" style="cursor:pointer;">selengkapnya</a>
											<!-- Modal Pertanyan-->
											<div id="soal_p_<?php echo $item->id_banksoal ;?>" class="modal fade" data-backdrop="false" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Soal #<?php echo $item->id_banksoal ;?></h4>
														</div>
														<div class="modal-body">
															<?php echo $item->pertanyaan ;?>
														</div>
														<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
														</div>
													</div>
												</div>
											</div>

										<?php
									}else{
										echo $strp_str;
									}
									?>
								</td>
								<td>
									<?php 
									if($item->pembahasan_teks!=""){ ?>
										<span class="label label-success" data-toggle="modal" data-target="#pemb_t_<?php echo $item->id_banksoal ;?>" style="cursor:pointer;">Pembahasan Teks</span>

										<!-- Modal Pembahasan-->
										<div id="pemb_t_<?php echo $item->id_banksoal ;?>" class="modal fade" role="dialog" data-backdrop="false" >
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Pembahasan Teks Soal #<?php echo $item->id_banksoal ;?></h4>
													</div>
													<div class="modal-body">
														<?php echo $item->pembahasan_teks ;?>
													</div>
													<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
													</div>
												</div>
											</div>
										</div>
									<?php }
									if($item->pembahasan_video!=""){  ?>
										<span class="label label-warning" data-toggle="modal" data-target="#pemb_v_<?php echo $item->id_banksoal ;?>" style="cursor:pointer;">Pembahasan Video</span>

										<!-- Modal Pembahasan-->
										<div id="pemb_v_<?php echo $item->id_banksoal ;?>" class="modal fade" role="dialog" data-backdrop="false" >
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Pembahasan Video Soal #<?php echo $item->id_banksoal ;?></h4>
													</div>
													<div class="modal-body text-center">
														<a href="<?php echo $item->pembahasan_video ;?>">Video</a> (<?php echo $item->pembahasan_video ;?>)
													</div>
													<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
								</td>
								<td><?=$item->nama_mapel?></td>
								<td><?php echo $item->topik ;?></td>
								<td><?php echo $item->bobot_soal ;?></td>
								<td><?php echo $item->kunci ;?></td>
								<td><input type="checkbox" name="pilih[]" value="<?php echo $item->id_banksoal ;?>"/></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="8"><input type="submit" class="btn btn-danger" name="form_submit" value="hapus"></input></td>
							</tr>
						</tbody>
					</table>
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
