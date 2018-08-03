<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Item Soal"?></h4>
                
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pertanyaan<span class="text-danger">*</span></label>
                        <?php echo form_error('isi_soal', '<div class="text-danger">', '</div>'); ?>
                        <textarea name="isi_soal" id="tinymce_soal" class="form-control tinymce_textarea" style="height:200px;"><?php echo set_value('isi_soal', isset($data) ? html_entity_decode($data->isi_soal) : '');?></textarea>
                      </div>
                    </div>
                  </div>
          
                  <div class="row">
                    <div class="col-md-6">
                      <label>Kunci Jawaban<span class="text-danger">*</span></label>
                      <select data-placeholder="Kunci Jawaban" name="kunci_jawaban" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                        <option value=""></option>
                        <option <?php echo set_select('kunci_jawaban', '1', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '1' ? TRUE : FALSE)) );?> value="1">Jawaban 1</option>
                        <option <?php echo set_select('kunci_jawaban', '2', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '2' ? TRUE : FALSE)) );?> value="2">Jawaban 2</option>
                        <option <?php echo set_select('kunci_jawaban', '3', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '3' ? TRUE : FALSE)) );?> value="3">Jawaban 3</option>
                        <option <?php echo set_select('kunci_jawaban', '4', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '4' ? TRUE : FALSE)) );?> value="4">Jawaban 4</option>
                        <option <?php echo set_select('kunci_jawaban', '5', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '5' ? TRUE : FALSE)) );?> value="5">Jawaban 5</option>
                      </select>
                    </div>
  			          </div>

                  <div class="row">
                    <div class="col-md-12">
                      <label>Pilihan Jawaban<span class="text-danger">*</span></label>

                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_jawab_1">Jawaban 1</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_2">Jawaban 2</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_3">Jawaban 3</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_4">Jawaban 4</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_5">Jawaban 5</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tab-content">
                        <div id="tab_jawab_1" class="tab-pane fade in active">
                          <div class="form-group">
                            <?php echo form_error('jawab_1', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_1" id="tinymce_jawab_1" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_1', isset($data) ? html_entity_decode($data->jawab_1) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_2" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_2', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_2" id="tinymce_jawab_2" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_2', isset($data) ? html_entity_decode($data->jawab_2) : '');?></textarea>
                            <!-- <input type="text" name="jawab_2" class="form-control" placeholder="Jawaban 2" value="<?php echo set_value('jawab_2', isset($data) ? $data->jawab_2 : '');?>" required="required"> -->
                          </div>
                        </div>
                        <div id="tab_jawab_3" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_3', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_3" id="tinymce_jawab_3" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_3', isset($data) ? html_entity_decode($data->jawab_3) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_4" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_4', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_4" id="tinymce_jawab_4" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_4', isset($data) ? html_entity_decode($data->jawab_4) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_5" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_5', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_5" id="tinymce_jawab_5" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_5', isset($data) ? html_entity_decode($data->jawab_5) : '');?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

				          <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pembahasan</label>
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#tab_pembahasan_teks">Teks</a></li>
                          <li><a data-toggle="tab" href="#tab_pembahasan_video">Video</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="tab_pembahasan_teks" class="tab-pane fade in active">
                            <div class="form-group">
                              <textarea name="pembahasan" id="pembahasan_teks" class="form-control tinymce_textarea" rows="10"><?php echo set_value('pembahasan', isset($data) ? html_entity_decode($data->pembahasan) : '');?></textarea>
                            </div>
                          </div>
                          <div id="tab_pembahasan_video" class="tab-pane fade ">
                            <div class="form-group">
                              <input type="url" name="pembahasan_video" id="pembahasan_video" class="form-control" placeholder="URL Video" value="<?php echo set_value('pembahasan_video', isset($data->pembahasan_video) ? $data->pembahasan_video : '');?>"></input>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  
				          <!-- hidden input for id sub materi -->
                  <input type="hidden" name="sub_materi_id" class="form-control" value="<?php echo set_value('sub_materi_id', isset($data->sub_materi_id) ? $data->sub_materi_id : '');?>">
				  
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="window.history.back();"><i class="fa fa-times"></i> Cancel</button>
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
</html>
