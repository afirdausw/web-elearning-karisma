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
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="header">
								<h4 class="title">Manajemen Akun Guru</h4>
							</div>
							<div class="content">
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
										<table id="my_datatable" class="table table-striped table-hover">
											<thead>
												<tr>
													<th>No. </th>
													<th>Nama Guru</th>
													<th>Username</th>
													<th>Email</th>
													<th>Sekolah</th>
													<th>Identitas</th>
													<th>status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$no = 1;
													foreach($dataguru as $guru){
												?>
													<tr>
														<td><?php echo $no;?></td>
														<td><?php echo $guru->nama;?></td>
														<td><?php echo $guru->username;?></td>
														<td><?php echo $guru->email;?></td>
														<td>
														(<?php echo $guru->jenjang;?>) <?php echo $guru->nama_sekolah;?>
														<br><?php echo $guru->nama_kota;?> - <?php echo $guru->nama_provinsi;?>							
														</td>
														<td>
															<a href="<?php echo base_url("assets/uploads/identitas/".$guru->kartu_identitas);?>" target="_BLANK">Identitas</a>
														</td>
														<td>
															<?php
																if($guru->status == 0){
																	echo "Menunggu Verifikasi";
																}elseif($guru->status == 1){
																	echo "Aktif";
																}elseif($guru->status == 3){
																	echo "Banned";
																}
															?>
														</td>
														<td>
															<?php
																if($guru->status == 0){
															?>
																<a href="<?php echo base_url("pg_admin/akun_psep/verifikasi_guru/".$guru->id_login_sekolah);?>" class="btn btn-success">
																	<i class="fa fa-check" aria-hidden="true"></i>
																</a>
															<?php
																}elseif($guru->status == 1){
																	echo "-";
																}elseif($guru->status == 3){
																	echo "Banned";
																}
															?>
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
					</div>
				</div>
			</div> <!-- end .container-fluid -->
		</div> <!-- end .content -->

		<?php include "inc/footer.php"; ?>
<!-- PLUGINS FUNCTION -->
 <!-- Nestable plugin  -->
<script type="text/javascript">
$(document).ready(function()
{
		var parentTab = $('ul.nav.nav-tabs li:first-child ul.dropdown-menu li:first-child a');
		parentTab.click(function() {
			$('.nav-pills.nav-stacked li:first-child a').trigger('click');
		});
		parentTab.trigger('click');
	// console.log("opo:" + opo);

	//disable all update button
	$("button[name*='map-']").prop('disabled', true);

	$("button[name*='map-']").click(function(e){
			var target_name = e.target.name;
			var target_val = e.target.value;
			var id = parseInt(target_name.replace(/map-/g, ''))
			// console.log("TRGET_name= " + e.target.name);
			// console.log("TRGET_val = " + e.target.value);
			// console.log("parseInt= " + i);
			// console.log("isNan&= " + isNaN(target_name));
			if(id == target_val)
			{ 
				sendAjaxPost(target_val, $('#nestable_' + id)); 
			}
			
			//disable update button        
			$("button[name='"+target_name+"']").prop('disabled', true);
	});

	var sendAjaxPost = function(id, e)
	{
		// var target_id = e.length ? e : e.target.id;
			var target_id = e;
			$.post("<?=base_url('pg_admin/dashboard/ajax_handler');?>",
			{
				id_mapel: id, 
				json: window.JSON.stringify(target_id.nestable('serialize'))
			},
			function(data, status){
					console.log("\nStatus: " + status + "\nData: " + data);
			});
	}

	var disableButton = function(target_id)
	{
			console.log("target_id :" + target_id);
			target_name = target_id.replace(/nestable_/g, 'map-');
			console.log("target_name :" + target_name);
			$('button[name='+target_name+']').prop('disabled', false);
	}

	var updateOutput = function(e)
	{
			var list   = e.length ? e : $(e.target),
					output = list.data('output'),
					target_id = e.length ? e : e.target.id;
			if (window.JSON) {
					console.log(target_id);
					disableButton(target_id);
					// output.val(target_id + ": \n" + window.JSON.stringify(list.nestable('serialize')));//, null, 2));
			} else {
					output.val('JSON browser support required for this demo.');
			}
	};

	// activate Nestable for list 1
	// $('#nestable').nestable({ group: 1, maxDepth: 2 }).on('change', updateOutput);
	
	

	//23 Agustus

	$('.nestable-menu').on('click', function(e)
	{
			var target = $(e.target),
					action = target.data('action');
			if (action === 'expand-all') {
					$('.dd').nestable('expandAll');
			}
			if (action === 'collapse-all') {
					$('.dd').nestable('collapseAll');
			}
	});

	$("[id*='demo-']").on('click', function(e)
	{
		var e_id = $(this).attr('id');
		var element = $("[id^='"+e_id+"'");

		var ids = e_id.split('-');
		var id_sub = ids[1];

		console.log(id_sub);

		$.post("<?php echo base_url('pg_admin/dashboard/ajax_set_demo'); ?>",
			{
				id: id_sub, 
			},
			function(data, status) {
					console.log("\nStatus: " + status + "\nData: " + data);
					if(data == 1)
					{
						console.log(element);
						if(element.hasClass('btn-fill')) {
							element.removeClass('btn-fill');
						}
						else {
							element.addClass('btn-fill');
						}
					}
			})

	});

});
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
