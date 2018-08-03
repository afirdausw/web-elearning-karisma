<div class="container">
					   <div class="row">
							<div id="pagination" class="soal-pagination">
								<nav class="text-center pagination-wrapper">
								  <div id="toggle_soal" class="pagination custom-pagination owl-carousel">
<!--                                        <li id="max_backward"></li>-->
<!--	                                    <li id="over_backward"></li>-->
									<!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									  <span class="sr-only">Previous</span>
									</a> -->
									<?php 
									$no = 1;
									foreach ($data_soal as $page) { ?>
										<!-- optional left control buttons --> 
										<span><a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>" data-nosoal="<?php echo $no;?>"><?php echo $no;?></a></span>
										<?php $no++; 
									} ?>
									<!-- <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									  <span class="sr-only">Next</span>
									</a> -->
<!--                                        <li id="over_forward"></li>-->
<!--                                        <li id="max_forward"></li>-->
								  </div>
								</nav>
							</div>
					   </div>
					</div>