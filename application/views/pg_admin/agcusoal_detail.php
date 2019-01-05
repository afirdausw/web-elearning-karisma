<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "inc/html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo $test_name; ?></h4>
                <p class="category">Daftar soal <?php echo $test_name; ?></p>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Soal</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;

                      foreach($table_data as $row) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['soal'] . "</td>";
                        echo "</tr>";

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
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <footer class="footer">
      <div class="container-fluid">
        
        <p class="copyright pull-right">
          &copy; <?php echo date("Y"); ?> <a href="http://lpi-hidayatullah.or.id">Lembaga Pendidikan Islam Hidayatullah</a>
        </p>
      </div>
    </footer>

  </div>
</div>

<?php include "alert_modal.php"; ?>
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
