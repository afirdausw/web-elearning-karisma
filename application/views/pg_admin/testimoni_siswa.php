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
								<h4 class="title">Tambah Instruktur</h4>
								<?php echo validation_errors(); ?>
							</div>
							<div class="content">
								<form method="post" action="<?= base_url('pg_admin/testimoni_siswa/add_testimonial')?>" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Username Siswa<span class="text-danger">*</span></label>
												<select name="id_siswa" id="id_siswa" class="form-control">
													<option selected="" disabled="">-- Pilih Siswa --</option>
													<?php 
														foreach ($siswa as $key) {
															?>
																<option value="<?= $key->id_login; ?>"><?= $key->username; ?></option>
															<?php
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Tanggapan<span class="text-danger">*</span></label>
												<textarea name="tanggapan_siswa" id="tanggapan_siswa" class="form-control"
														  placeholder="Tanggapan Siswa tentang Karisma Academy"
														  required="required"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end .content -->

		<?php include "inc/footer.php"; ?>

	</div>
</div>

<?php include "alert/alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery-1.12.4.min.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-3/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/plugins/nestable/js/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-checkbox-radio-switch/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/bootstrap-notify/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/light-bootstrap-dashboard/js/light-bootstrap-dashboard.js');?>"></script>

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

});
</script>


</html>
