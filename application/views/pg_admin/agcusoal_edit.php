<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include "inc/html_header.php"; ?>
<div class="wrapper">
  <?php include "inc/sidebar.php"; ?>
  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo $page_title; ?></h4>
              </div>
              <div class="content">
                <form id="editSoal" role="form">
                  <input type="hidden" id="inputIdSoal" value="<?php echo $idsoal; ?>" />
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pertanyaan<span class="text-danger">*</span></label>
                        <?php echo form_error('isi_soal', '<div class="text-danger">', '</div>'); ?>
                        <textarea name="isi_soal" id="tinymce_soal" class="form-control tinymce_textarea" style="height:200px;"><?php echo $row->soal; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Pilihan Jawaban<span class="text-danger">*</span></label>
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_jawab_1">Jawaban 1</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_2">Jawaban 2</a></li>
                        <?php if($jumsoal >= 3) { ?>
                        <li><a data-toggle="tab" href="#tab_jawab_3">Jawaban 3</a></li>
                        <?php } ?>
                        <?php if($jumsoal >= 4) { ?>
                        <li><a data-toggle="tab" href="#tab_jawab_4">Jawaban 4</a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tab-content">
                        <div id="tab_jawab_1" class="tab-pane fade in active">
                          <div class="form-group">
                            <?php echo form_error('jawab_1', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_1" id="tinymce_jawab_1" class="form-control tinymce_textarea" style="height:150px;"><?php echo $row->jawab_a; ?></textarea>
                          </div>
                          <div class="form-group">
                            <select name="" id="inputSkorA" class="form-control" required="required">
                              <option value="0"<?php echo ($row->skor_a == 0 ? 'selected="selected"' : ''); ?>>0</option>
                              <option value="1"<?php echo ($row->skor_a == 1 ? 'selected="selected"' : ''); ?>>1</option>
                              <option value="2"<?php echo ($row->skor_a == 2 ? 'selected="selected"' : ''); ?>>2</option>
                              <option value="3"<?php echo ($row->skor_a == 3 ? 'selected="selected"' : ''); ?>>3</option>
                              <option value="4"<?php echo ($row->skor_a == 4 ? 'selected="selected"' : ''); ?>>4</option>
                              <option value="V"<?php echo ($row->skor_a == 'V' ? 'selected="selected"' : ''); ?>>V</option>
                              <option value="A"<?php echo ($row->skor_a == 'A' ? 'selected="selected"' : ''); ?>>A</option>
                              <option value="K"<?php echo ($row->skor_a == 'K' ? 'selected="selected"' : ''); ?>>K</option>
                            </select>
                          </div>
                        </div>
                        <div id="tab_jawab_2" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_2', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_2" id="tinymce_jawab_2" class="form-control tinymce_textarea" style="height:150px;"><?php echo $row->jawab_b; ?></textarea>
                          </div>
                          <div class="form-group">
                            <select name="" id="inputSkorB" class="form-control" required="required">
                              <option value="0"<?php echo ($row->skor_b == 0 ? 'selected="selected"' : ''); ?>>0</option>
                              <option value="1"<?php echo ($row->skor_b == 1 ? 'selected="selected"' : ''); ?>>1</option>
                              <option value="2"<?php echo ($row->skor_b == 2 ? 'selected="selected"' : ''); ?>>2</option>
                              <option value="3"<?php echo ($row->skor_b == 3 ? 'selected="selected"' : ''); ?>>3</option>
                              <option value="4"<?php echo ($row->skor_b == 4 ? 'selected="selected"' : ''); ?>>4</option>
                              <option value="V"<?php echo ($row->skor_b == 'V' ? 'selected="selected"' : ''); ?>>V</option>
                              <option value="A"<?php echo ($row->skor_b == 'A' ? 'selected="selected"' : ''); ?>>A</option>
                              <option value="K"<?php echo ($row->skor_b == 'K' ? 'selected="selected"' : ''); ?>>K</option>
                            </select>
                          </div>
                        </div>
                        <?php if($jumsoal >= 3) { ?>
                        <div id="tab_jawab_3" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_3', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_3" id="tinymce_jawab_3" class="form-control tinymce_textarea" style="height:150px;"><?php echo $row->jawab_c; ?></textarea>
                          </div>
                          <div class="form-group">
                            <select name="" id="inputSkorC" class="form-control" required="required">
                              <option value="0"<?php echo ($row->skor_c == 0 ? 'selected="selected"' : ''); ?>>0</option>
                              <option value="1"<?php echo ($row->skor_c == 1 ? 'selected="selected"' : ''); ?>>1</option>
                              <option value="2"<?php echo ($row->skor_c == 2 ? 'selected="selected"' : ''); ?>>2</option>
                              <option value="3"<?php echo ($row->skor_c == 3 ? 'selected="selected"' : ''); ?>>3</option>
                              <option value="4"<?php echo ($row->skor_c == 4 ? 'selected="selected"' : ''); ?>>4</option>
                              <option value="V"<?php echo ($row->skor_c == 'V' ? 'selected="selected"' : ''); ?>>V</option>
                              <option value="A"<?php echo ($row->skor_c == 'A' ? 'selected="selected"' : ''); ?>>A</option>
                              <option value="K"<?php echo ($row->skor_c == 'K' ? 'selected="selected"' : ''); ?>>K</option>
                            </select>
                          </div>
                        </div>
                        <?php } ?>
                        <?php if($jumsoal >= 4) { ?>
                        <div id="tab_jawab_4" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_4', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_4" id="tinymce_jawab_4" class="form-control tinymce_textarea" style="height:150px;"><?php echo $row->jawab_d; ?></textarea>
                          </div>
                          <div class="form-group">
                            <select name="" id="inputSkorD" class="form-control" required="required">
                              <option value="0"<?php echo ($row->skor_d == 0 ? 'selected="selected"' : ''); ?>>0</option>
                              <option value="1"<?php echo ($row->skor_d == 1 ? 'selected="selected"' : ''); ?>>1</option>
                              <option value="2"<?php echo ($row->skor_d == 2 ? 'selected="selected"' : ''); ?>>2</option>
                              <option value="3"<?php echo ($row->skor_d == 3 ? 'selected="selected"' : ''); ?>>3</option>
                              <option value="4"<?php echo ($row->skor_d == 4 ? 'selected="selected"' : ''); ?>>4</option>
                              <option value="V"<?php echo ($row->skor_d == 'V' ? 'selected="selected"' : ''); ?>>V</option>
                              <option value="A"<?php echo ($row->skor_d == 'A' ? 'selected="selected"' : ''); ?>>A</option>
                              <option value="K"<?php echo ($row->skor_d == 'K' ? 'selected="selected"' : ''); ?>>K</option>
                            </select>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="button" class="btn btn-danger pull-right" onclick="window.history.back();"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>
                <div class="footer">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <footer class="footer">
      <div class="container-fluid">
        
        <p class="copyright pull-right">
          &copy; <?php echo date("Y"); ?> <a href="http://lpi-hidayatullah.or.id">Lembaga Pendidikan Islam Hidayatullah</a>
        </p>
      </div>
    </footer>
  </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>
<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
function resetForm(form){
// clearing selects
$('.chosen-select').val('').trigger('chosen:updated');
}
</script>
<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
<script type="text/javascript">
var config = {
'.chosen-select'           : {},
'.chosen-select-deselect'  : {allow_single_deselect:true},
'.chosen-select-no-single' : {disable_search_threshold:10},
'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
'.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
$(selector).chosen(config[selector]);
}
</script>
<!-- TinyMCE - WYSIWYG plugin  -->
<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
<script type="text/javascript">
tinymce.init({
selector: '.tinymce_textarea',
skin: 'lightgray',
menubar: false,
plugins: [
"eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
"table contextmenu directionality emoticons paste textcolor responsivefilemanager",
"code fullscreen youtube autoresize"
],
toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
toolbar2: "| fontsizeselect | styleselect | eqneditor  link unlink anchor | image media youtube | forecolor backcolor | responsivefilemanager | code",
extended_valid_elements: "+iframe[src|width|height|name|align|class]",
image_advtab: true,
fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
relative_urls: false,
remove_script_host: false,
    //Filemanager
external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
filemanager_title: "Data Filemanager" ,
external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },

//integrating tinymce 4 and kcfinder
file_browser_callback: function(field, url, type, win) {
console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
tinyMCE.activeEditor.windowManager.open({
file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
title: 'KCFinder',
width: 700,
height: 300,
inline: true,
close_previous: false
}, {
window: win,
input: field
});
return false;
}
});
</script>
<!-- Manually open kcfinder -->
<script type="text/javascript">
function openKCFinder(field) {
console.log("OPENKCFINDER" + field);
window.KCFinder = {
callBack: function(url) {
// field.value = url; DEFAULT (Full URL)
field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
window.KCFinder = null;
}
};
window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=images&dir=images", 'kcfinder_textbox',
'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
'resizable=1, scrollbars=0, width=800, height=600'
);
}
</script>
<script>
  $(document).ready(function() {
    $('#editSoal').on('submit', (function(e) {
      e.preventDefault();

      var id = $('#inputIdSoal').val(),
          soal = $('#tinymce_soal').val(),
          jawabA = $('#tinymce_jawab_1').val(),
          skorA = $('#inputSkorA').val(),
          jawabB = $('#tinymce_jawab_2').val(),
          skorB = $('#inputSkorB').val(),
          jawabC = $('#tinymce_jawab_3').val(),
          skorC = $('#inputSkorC').val(),
          jawabD = $('#tinymce_jawab_4').val(),
          skorD = $('#inputSkorD').val();

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('pg_admin/agcu_soal/do_edit'); ?>',
        data: 'test=<?php echo $test_name; ?>&id=' + id + '&soal=' + soal + '&jawabA=' + jawabA + '&skorA=' + skorA + '&jawabB=' + jawabB + '&skorB=' + skorB + '&jawabC=' + jawabC + '&skorC=' + skorC + '&jawabD=' + jawabD + '&skorD=' + skorD,
        dataType: 'html',
        processData: false,
        success: function(res) {
          alert(res);
        }
      })
    }))
  })
</script>
</html>