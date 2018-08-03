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
                <h4 class="title">Rekapitulasi AGCU Kelas</h4>
                <p class="category">Rekapitulasi analisis AGCU Kelas</p>
              </div>
              <div class="content">
                <div class="row">

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

  // activate Nestable for list 1
  // $('#nestable').nestable({ group: 1, maxDepth: 2 }).on('change', updateOutput);
  
  // activate Nestable per id_mapel
  <?php foreach ($list_mapel as $init_mapel) {
    ?>
    $('<?php echo "#nestable_".$init_mapel->id_mapel;?>').nestable({ 
      group: 1, 
      maxDepth: 3,
      enableHMove: false 
    }).on('change', updateOutput);

    // updateOutput($('<?php echo "#nestable_".$init_mapel->id_mapel;?>').data('output', $('#nestable-output')));
    <?php
  }?>

  // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));

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
