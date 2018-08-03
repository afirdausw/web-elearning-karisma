<?php include('header_dashboard-siswa.php'); ?>
<script>
  function supports_media_source()
  {
      "use strict";
      var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
          hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
      return (hasWebKit || hasMediaSource);
  }
</script>


<div class="breadcrumb-container">
  <ol class="breadcrumb">
    <li class=""><a href="<?php echo base_url('user/dashboard')?>">Dashboard</a></li>
    <li class="active">Analisis Tryout</li>
  </ol>
</div>

<!--<div class="container-fluid akun-container">-->
	<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
	    <section class="tryout">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
              <div class="panel panel-default panel-tryout">
                <div class="panel-body">
                  <h2 class="lbl-tryout text-center">Try Out 1 Kelas 12</h2>
                  <h6 class="lbl-act-progress text-center">Aktifitas Progress</h6>
                  <div id="chart-container"></div>
                  <h6 class="lbl-list-materi text-center">Daftar Semua Materi</h6>
                  <ul class="list-unstyled list-materi">
                    <li><span class="glyphicon glyphicon-chevron-right"></span><span>Fisika</span>
                      <div class="progress progress-materi">
                        <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;" class="progress-bar"><span class="sr-only">70% Complete</span></div>
                      </div>
                    </li>
                    <li><span class="glyphicon glyphicon-chevron-right"></span><span>Matematika</span>
                      <div class="progress progress-materi">
                        <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;" class="progress-bar"><span class="sr-only">70% Complete</span></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
              <div class="col-xs-12">
                <ul class="list-unstyled tryout-info">
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <span class="glyphicon glyphicon-user"></span><span>Total Peserta: 2</span>
                  </li>
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <span class="glyphicon glyphicon-book"></span><span>Total Soal: 6</span>
                  </li>
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <span class="glyphicon glyphicon-check"></span><span>Benar: 3</span>
                  </li>
                </ul>
              </div>
              <div class="col-xs-12">
                <ul class="list-unstyled score-info">
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><img src="data:image/png;base64,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" alt="Trophy" class="img-responsive img-trophy">
                    <h4 class="lbl-score">Tertinggi</h4><br>
                    <p class="detail-score">
                      <label>Nilai</label><span>: &nbsp;&nbsp;</span><span>66.67</span>
                    </p>
                    <p class="detail-score">
                      <label>Skor</label><span>: &nbsp;&nbsp;</span><span>66.67%</span>
                    </p>
                  </li>
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><img src="data:image/png;base64,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" alt="Trophy" class="img-responsive img-trophy">
                    <h4 class="lbl-score">Anda</h4><br>
                    <p class="detail-score">
                      <label>Nilai</label><span>: &nbsp;&nbsp;</span><span>50</span>
                    </p>
                    <p class="detail-score">
                      <label>Skor</label><span>: &nbsp;&nbsp;</span><span>50%</span>
                    </p>
                  </li>
                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><img src="data:image/png;base64,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" alt="Trophy" class="img-responsive img-trophy">
                    <h4 class="lbl-score">Terendah</h4><br>
                    <p class="detail-score">
                      <label>Nilai</label><span>: &nbsp;&nbsp;</span><span>50</span>
                    </p>
                    <p class="detail-score">
                      <label>Skor</label><span>: &nbsp;&nbsp;</span><span>50%</span>
                    </p>
                  </li>
                </ul>
              </div>
              <div class="col-xs-12">
                <div role="tabpanel" class="content-info">
                  <ul role="tablist" class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#result" aria-controls="result" role="tab" data-toggle="tab">Hasil Tes</a></li>
                    <li role="presentation"><a href="#rank" aria-controls="rank" role="tab" data-toggle="tab">Rangking</a></li>
                    <li role="presentation"><a href="#graphic" aria-controls="graphic" role="tab" data-toggle="tab">Grafik</a></li>
                  </ul>
                  <div class="tab-content">
                    <div role="tabpanel" id="result" class="tab-pane active">
                      <div class="panel panel-default panel-content">
                        <div class="panel-heading">
                          <h5 class="label-heading">
                            <span class="glyphicon glyphicon-file"></span><span>Analisis Pelajaran</span>
                          </h5>
                        </div>
                        <div class="panel-body">
                          <table class="table table-hover table-content">
                            <thead>
                              <tr>
                                <th>Try Out</th>
                                <th>Jml Soal</th>
                                <th>Benar</th>
                                <th>Salah</th>
                                <th>Nilai</th>
                                <th>Skor</th>
                                <th>Tuntas</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Fisika</td>
                                <td>4</td>
                                <td>2</td>
                                <td>2</td>
                                <td>50</td>
                                <td>50%</td>
                                <td><span class="glyphicon glyphicon-thumbs-down"></span></td>
                              </tr>
                              <tr>
                                <td>Matematika</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td>50</td>
                                <td>50%</td>
                                <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="panel panel-default panel-content">
                        <div class="panel-heading">
                          <h5 class="label-heading">
                            <span class="glyphicon glyphicon-time"></span><span>Analisis Waktu</span>
                          </h5>
                        </div>
                        <div class="panel-body">
                          <table class="table table-hover table-content">
                            <thead>
                              <tr>
                                <th>Try Out</th>
                                <th>Jumlah Soal</th>
                                <th>Disediakan</th>
                                <th>Dikerjakan</th>
                                <th>Rata-rata</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Fisika</td>
                                <td>4</td>
                                <td>01:00:00</td>
                                <td>00:00:10</td>
                                <td>00:00:03</td>
                              </tr>
                              <tr>
                                <td>Matematika</td>
                                <td>2</td>
                                <td>01:00:00</td>
                                <td>00:00:09</td>
                                <td>00:00:05</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="lbl-section text-center">
                        <h4>Analisis Topik</h4>
                      </div>
                      <div class="panel panel-default panel-content">
                        <div class="panel-heading">
                          <h5 class="label-heading">
                            <span class="glyphicon glyphicon-th-large"></span></span><span>Fisika</span>
                          </h5>
                        </div>
                        <div class="panel-body">
                          <table class="table table-hover table-content">
                            <thead>
                              <tr>
                                <th>Topik / Indikator</th>
                                <th>Skor</th>
                                <th>Ketuntasan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Materi Gravitasi</td>
                                <td>0%</td>
                                <td><span class="glyphicon glyphicon-thumbs-down"></span></td>
                              </tr>
                              <tr>
                                <td>Materi Gravitasi</td>
                                <td>0%</td>
                                <td><span class="glyphicon glyphicon-thumbs-down"></span></td>
                              </tr>
                              <tr>
                                <td>Aplikasi Hukum Newton</td>
                                <td>100%</td>
                                <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                              </tr>
                              <tr>
                                <td>Besaran dan Satuan</td>
                                <td>100%</td>
                                <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="panel panel-default panel-content">
                        <div class="panel-heading">
                          <h5 class="label-heading">
                            <span class="glyphicon glyphicon-th-large"></span></span><span>Matematika</span>
                          </h5>
                        </div>
                        <div class="panel-body">
                          <table class="table table-hover table-content">
                            <thead>
                              <tr>
                                <th>Topik / Indikator</th>
                                <th>Skor</th>
                                <th>Ketuntasan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Penambahan</td>
                                <td>100%</td>
                                <td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                              </tr>
                              <tr>
                                <td>Perkalian</td>
                                <td>0%</td>
                                <td><span class="glyphicon glyphicon-thumbs-down"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" id="rank" class="tab-pane">...</div>
                    <div role="tabpanel" id="graphic" class="tab-pane">...</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
	<!--</div>-->
<!--</div>-->

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
 
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/highcharts/themes/grid.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
         $('#chart-container').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.y} soal</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: false,
                      format: '{series.name}: <b>{point.y} soal</b>'
                  },
                  showInLegend: true
              }
          },
          series: [{
              name: 'Jumlah',
              colorByPoint: true,
              data: [
              {
                  name: 'Soal Selesai',
                  y: 10
              }, {
                  name: 'Sisa Soal',
                  y: 5
              }]
          }]
        });
        
        $('.highcharts-background').attr('fill', 'transparent');
        $('.highcharts-background').attr('stroke', 'transparent');
        
        
        $('.highcharts-background').attr('height', '250');
        $('.highcharts-root').attr('height', '250');
        $('.highcharts-credits').css({'display':'none'});
      });
  </script>
  <!-- JS Function for this Modal -->
 
  </body>
</html>