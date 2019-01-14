<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/inc/html_header.php"); ?>

<div class="wrapper">
  <?php $this->load->view("pg_admin/inc/sidebar.php"); ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/inc/navbar.php"); ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah Konten</a>
                <h4 class="title">Semua Materi</h4>
                <p class="category">Daftar Sub-materi per Materi Pokok</p>
              </div>
              <div class="content">
								<div id="containerajax">
								
									<?php $this->load->view("pg_admin/materi_ajaxpage.php"); ?>

								</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/inc/footer.php"); ?>

<?php $this->load->view("pg_admin/alert_modal.php"); ?>

<script type="text/javascript">
	function ajaxPage(urlLink)
	{  
		$.ajax({
			url:urlLink,
			beforeSend: function() {
				NProgress.start();
				//$("#containerajax").html('<div class="text-center"><img src="<?php echo base_url().'assets/pg_user/images/icon/table_loading.gif'; ?>"></div>');
			},
			success:function(data) {
				NProgress.done(); 
				$("#containerajax").html(data)
			}
		});
		return false;
	}

  function ajaxStatusMateri(targetName, val)
  {
      $.post("<?=base_url('pg_admin/materi/ajax_status_materi');?>",
      {
        target_name: targetName, state: val
      },
      function(data, status){
          console.log("\nStatus: " + status + "\nData: " + data);
      });
  }

</script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/plugins/bootstrap-3/plugins/light-bootstrap-dashboard/js/light-bootstrap-dashboard.js');?>"></script>


<!--  Datatables Plugin -->
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/plugins.js'); ?>"></script>

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
