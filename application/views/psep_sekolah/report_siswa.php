<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val());
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Report AGCU Siswa</h4>
                <p class="category">Report analisis AGCU siswa</p>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-lg-offset-3 col-md-offset-3 col-lg-6 col-md-6 col-xs-12 col-sm-12">
                    <select class="form-control" id="kelas">
						<option  value="" disabled="" selected="">-- Pilih Kelas --</option>
						<?php
							foreach($datakelas as $kelas){
						?>
								<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
						<?php
							}
						?>
					</select>
					
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<td>No. </td>
								<td>Nama Siswa</td>
								<td>Kelas</td>
								<td>Aksi</td>
							</tr>
						</thead>
						<tbody id="listsiswa">
							<tr>
								<td colspan="4"> Pilih Kelas Untuk Menampilkan Data Siswa</td>
							</tr>
						</tbody>
					</table>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

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


</html>
