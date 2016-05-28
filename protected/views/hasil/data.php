<ul class="nav nav-pills">
                                <li class="active"><a href="#home-pills" data-toggle="tab">Rekapitulasi Seluruh Suara</a>
                                </li>
								  <li><a href="#profile-pills" data-toggle="tab">Rekapitulasi Suara Tiap Fakultas</a>
                                </li>
								  <li><a href="#messages-pills " data-toggle="tab">Rekapitulasi Suara Tiap TPS</a>
                                </li>
</ul>
<div class="tab-content">
                                <div class="tab-pane fade in active" id="home-pills">
                                    
								  <p>
									<?php 
									
									$label=array();
							$nilai=array();
							$jumlah=0;	$data=Kandidat::model()->getHasilKandidat();
							foreach($data as $i=>$ii)
							{
								$label[$i]=$ii['nama_kandidat'];
								$nilai[$i]=(int)$ii['hasil'];
								
								$jumlah+=$nilai[$i];
								
							}


									
									$form=$this->beginWidget('CActiveForm', array(
											'id'=>'tinstrument-form',
											'enableAjaxValidation'=>false,
										)); ?>
									

							<?php
							if($now>$model['start_time'] && $now<$model['end_time']) {	
							echo " <META HTTP-EQUIV = 'Refresh' Content = '7'>";
							 
							echo "<div class='alert alert-danger'>";
							echo "<h4 style='text-align:center'>Saat Ini Sistem Tidak Dapat Melakukan Rekapitulasi Suara. Karena Proses Pemilihan Masih Berlangsung</h4>";
							echo "</div>";
							}else{
							$this->widget('application.extensions.highcharts.HighchartsWidget', array(
							   'options'=>array(
								 'chart'=> array('defaultSeriesType'=>'column'),
								'colors'=>array('#DDDF00','#D11F00','#DAAF00'),
								  'title' => array('text' => 'Rekapitulasi Seluruh Suara'),
								  'legend'=>array('enabled'=>false),
								  'xAxis'=>array('categories'=>$label,
										'title'=>array('text'=>'<b>Kandidat</b>'),),
								  'yAxis'=> array(
										'min'=> 0,
										'title'=> array(
										'text'=>'<b>Hasil  Suara</b>'
										),
									),
								  'series' => array(
									 array('data' => $nilai)
								  ),
								  'tooltip' => array('formatter' => 'js:function(){ return "<b>"+this.point.name+"</b> :"+this.y; }'),
								  'tooltip' => array(
									'formatter' => 'js:function() {return "<b>"+ this.x +"</b><br/>"+"Jumlah : "+ this.y; }'
								  ),
								  'plotOptions'=>array('pie'=>(array(
												'allowPointSelect'=>true,
												'showInLegend'=>true,
												'cursor'=>'pointer',
											)
										)                       
									),
								  'credits'=>array('enabled'=>false),
							   )
							));

							

										$bb=array();
										$nilaiPie=array();
										foreach($data as $i=>$ii){
													$nilaiPie[$i]=(float)($nilai[$i]/$jumlah)*100;
													$bb[$i]=array($label[$i],$nilaiPie[$i]);
											//$bb[$i]=array($ii['aa'],(int)$ii['count(id)']);
										}
										$this->widget('application.extensions.highcharts.HighchartsWidget', array(
										   'options'=>array(
											  'series' => array(
												 array('type'=>'pie',
													   'data' => $bb
													  )
											  ),
											  'title'=>'<b>Persentase Seluruh Suara</b>',
											  'tooltip' => array(
												'formatter' => 'js:function(){ return "<b>"+this.point.name+"</b> :"+this.y +" %"; }'
											  ),
											  'plotOptions'=>array('pie'=>(array(
															'allowPointSelect'=>true,
															'showInLegend'=>true,
															'cursor'=>'pointer',
														)
													)                       
												),
											  'credits'=>array('enabled'=>false),
										   )
										));

										}
										$this->endWidget(); ?>

							</p>
							
							<?php 
							$pemilihVote=Pemilih::model()->getPemilihByVote();
							$pemilihNotVote=Pemilih::model()->getPemilihByNotVote();
							$total=$pemilihVote+$pemilihNotVote;
							
							$pemilihVote_2=($pemilihVote/$total)*100;
							$pemilihNotVote_2=($pemilihNotVote/$total)*100;
							$total_2=$pemilihVote_2+$pemilihNotVote_2;
							?>
										<table class="table table-hover table-striped table-bordered" width="40%"  >
											<thead>
											<tr>
												<th width="32%" align="center"></th>
												<th width="28%" style="text-align:center">Jumlah</th>
												<th width="28%" style="text-align:center">Persentase %</th>
											</tr>
											</thead>
											<tbody>
											
												<tr><th>Jumlah Pemilih yang Menggunakan Hak Pilih</th><td style="text-align:center"><?php echo $pemilihVote; ?></td><td style="text-align:center"><?php echo $pemilihVote_2; ?> %</td></tr>
												<tr><th >Jumlah Pemilih yang Tidak Menggunakan Hak Pilih (Abstain)</th><td style="text-align:center"><?php echo $pemilihNotVote; ?></td><td style="text-align:center"><?php echo $pemilihNotVote_2; ?> %</td></tr>
												<tr><th >Jumlah Pemilih Terdaftar</th><td style="text-align:center"><?php echo $total; ?></td><td style="text-align:center"><?php echo $total_2; ?>  %</td></tr>
												</tbody>
											</table>
							
							</div>
                                <div class="tab-pane fade" id="profile-pills">
                                    <center>
									<script type="text/javascript">
		
			/**
			 * Visualize an HTML table using Highcharts. The top (horizontal) header 
			 * is used for series names, and the left (vertical) header is used 
			 * for category names. This function is based on jQuery.
			 * @param {Object} table The reference to the HTML table to visualize
			 * @param {Object} options Highcharts options
			 */
			Highcharts.visualize = function(table, options) {
				// the categories
				options.xAxis.categories = [];
				$('tbody th', table).each( function(i) {
					options.xAxis.categories.push(this.innerHTML);
				});
				
				// the data series
				options.series = [];
				$('tr', table).each( function(i) {
					var tr = this;
					$('th, td', tr).each( function(j) {
						if (j > 0) { // skip first column
							if (i == 0) { // get the name and init the series
								options.series[j - 1] = { 
									name: this.innerHTML,
									data: []
								};
							} else { // add values
								options.series[j - 1].data.push(parseFloat(this.innerHTML));
							}
						}
					});
				});
				
				var chart = new Highcharts.Chart(options);
			}
				
			// On document ready, call visualize on the datatable.
			$(document).ready(function() {			
				var table = document.getElementById('datatable'),
				options = {
					   chart: {
					      renderTo: 'container',
					      defaultSeriesType: 'column'
					   },
					   title: {
					      text: 'Rekapitulasi Suara Tiap Fakultas'
					   },
					   xAxis: {
					     title: {
					         text: '<b>Fakultas</b>'
					      }
					   },
					   yAxis: {
					      title: {
					         text: '<b>Hasil Suara</b>'
					      }
					   },
					   tooltip: {
					      formatter: function() {
					         return '<b>'+ this.series.name +'</b><br/>'+
					            this.y +' '+ this.x.toLowerCase();
					      }
					   }
					};
				
			      					
				Highcharts.visualize(table, options);
			});
				
		</script>
							<?php if( $now>$model['start_time'] && $now<$model['end_time']) {	
							echo " <META HTTP-EQUIV = 'Refresh' Content = '7'>";
							 
							echo "<div class='alert alert-danger'>";
							echo "<h4 style='text-align:center'>Saat Ini Sistem Tidak Dapat Melakukan Rekapitulasi Suara. Karena Proses Pemilihan Masih Berlangsung</h4>";
							echo "</div>";
							}else{?>
									<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
									<?php }?>
									</center>
										<table class="table table-hover table-striped table-bordered" width="" style="margin-top:10px"  >
											<thead>
											<tr>
												<th width="" align="center" rowspan="2" align="center" valign="center">Fakultas</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih yang Menggunakan Hak Pilih</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih yang Tidak Menggunakan Hak Pilih (Abstain)</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih Terdaftar</th>
											</tr>
											<tr>
												<th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th><th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th><th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th>
											</tr>
											</thead>
											<tbody>
												<?php 
												$pemilihVote=Pemilih::model()->getPemilihByVoteFak();
													foreach($pemilihVote as $ii):
													$pemilihVote2=Pemilih::model()->getPemilihByVoteFak2($ii['id_fakultas']);
													$vote=0;$notVote=0;
														foreach($pemilihVote2 as $jj):
																if($jj['status']==3){
																	$vote++;
																}else{
																	$notVote++;
																}
														endforeach;	
														$total=$vote+$notVote;			
												?>
													<tr>
													<th><?php echo $ii['fakultas']; ?></th><td style="text-align:center"><?php echo $vote; ?></td> <td><?php echo ($vote/$total)*100; ?> %</td>
													<td style="text-align:center"><?php echo $notVote; ?></td><td style="text-align:center"><?php echo ($notVote/$total)*100; ?> %</td>
													<td style="text-align:center"><?php echo $total ?></td><td style="text-align:center"><?php echo (($vote/$total)*100)+( ($notVote/$total)*100); ?> %</td>
													</tr>
												<?php endforeach;?>
											
											</tbody>
											</table>
												<table id="datatable" class="table table-hover table-striped" width="61%" align="center" style="visibility:hidden">
											<thead>
											<tr>
												<th width="28%">Fakultas</th>
												<?php foreach ($data as $k=>$kk){?>
												<th width="24%"><?php echo $label[$k];?></th>
												<?php }?>
											</tr>
											</thead>
											<tbody>
												
												<?php
												$col_fak=Kandidat::model()->getHasilKandidatByFak();
												foreach($col_fak as $r=> $rr){
													?>
													<tr>
														<th><div align="left"><?php echo $rr['fakultas'];?></div></th>
														<?php  
														$col_hasil=Kandidat::model()->getHasilKandidatByFak2($rr['id_fakultas']);
														foreach ($col_hasil as $s=>$ss){?>
															<td><?php echo $ss['hasil'];?></td>
														<?php }?>
													</tr>
													<?php
												}
												?>
												
											</tbody>
											</table>
									
                                </div>
                                <div class="tab-pane fade" id="messages-pills">
                                     <center>
									<script type="text/javascript">
		
			/**
			 * Visualize an HTML table using Highcharts. The top (horizontal) header 
			 * is used for series names, and the left (vertical) header is used 
			 * for category names. This function is based on jQuery.
			 * @param {Object} table The reference to the HTML table to visualize
			 * @param {Object} options Highcharts options
			 */
			Highcharts.visualize = function(table, options) {
				// the categories
				options.xAxis.categories = [];
				$('tbody th', table).each( function(i) {
					options.xAxis.categories.push(this.innerHTML);
				});
				
				// the data series
				options.series = [];
				$('tr', table).each( function(i) {
					var tr = this;
					$('th, td', tr).each( function(j) {
						if (j > 0) { // skip first column
							if (i == 0) { // get the name and init the series
								options.series[j - 1] = { 
									name: this.innerHTML,
									data: []
								};
							} else { // add values
								options.series[j - 1].data.push(parseFloat(this.innerHTML));
							}
						}
					});
				});
				
				var chart = new Highcharts.Chart(options);
			}
				
			// On document ready, call visualize on the datatable.
			$(document).ready(function() {			
				var table = document.getElementById('datatable2'),
				options = {
					   chart: {
					      renderTo: 'container2',
					      defaultSeriesType: 'column'
					   },
					   title: {
					      text: 'Rekapitulasi Suara Tiap TPS'
					   },
					   xAxis: {
					     title: {
					         text: '<b>TPS</b>'
					      }
					   },
					   yAxis: {
					      title: {
					         text: '<b>Hasil Suara</b>'
					      }
					   },
					   tooltip: {
					      formatter: function() {
					         return '<b>'+ this.series.name +'</b><br/>'+
					            this.y +' '+ this.x.toLowerCase();
					      }
					   }
					};
				
			      					
				Highcharts.visualize(table, options);
			});
				
		</script>
								<?php	if( $now>$model['start_time'] && $now<$model['end_time']) {	
							echo " <META HTTP-EQUIV = 'Refresh' Content = '7'>";
							 
							echo "<div class='alert alert-danger'>";
							echo "<h4 style='text-align:center'>Saat Ini Sistem Tidak Dapat Melakukan Rekapitulasi Suara. Karena Proses Pemilihan Masih Berlangsung</h4>";
							echo "</div>";
							}else{?>
									<div id="container2" style="width: 800px; height: 400px; margin: 0 auto"></div>
	
							<?php }?>
										
									</center>
                                  
								 <table class="table table-hover table-striped table-bordered" width="" style="margin-top:10px"  >
											<thead>
											<tr>
												<th width="" align="center" rowspan="2" align="center" valign="center">TPS</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih yang Menggunakan Hak Pilih</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih yang Tidak Menggunakan Hak Pilih (Abstain)</th>
												<th width="" style="text-align:center" colspan="2">Jumlah Pemilih Terdaftar</th>
											</tr>
											<tr>
												<th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th><th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th><th style="text-align:center">Jumlah</th><th style="text-align:center">Persentase (%)</th>
											</tr>
											</thead>
											<tbody>
												<?php 
												$pemilihVote=Pemilih::model()->getPemilihByVoteTPS();
													foreach($pemilihVote as $ii):
													$pemilihVote2=Pemilih::model()->getPemilihByVoteTPS2($ii['id_tps']);
													$vote=0;$notVote=0;
														foreach($pemilihVote2 as $jj):
																if($jj['status']==3){
																	$vote++;
																}else{
																	$notVote++;
																}
														endforeach;	
														$total=$vote+$notVote;			
												?>
													<tr>
													<th><?php echo $ii['nama_tps']; ?></th><td style="text-align:center"><?php echo $vote; ?></td> <td><?php echo ($vote/$total)*100; ?> %</td>
													<td style="text-align:center"><?php echo $notVote; ?></td><td style="text-align:center"><?php echo ($notVote/$total)*100; ?> %</td>
													<td style="text-align:center"><?php echo $total ?></td><td style="text-align:center"><?php echo (($vote/$total)*100)+( ($notVote/$total)*100); ?> %</td>
													</tr>
												<?php endforeach;?>
											
											</tbody>
											</table>
											<table id="datatable2" class="table table-hover table-striped" width="61%" align="center" style="visibility:hidden">
											<thead>
											<tr>
												<th width="28%">TPS</th>
												<?php 
												
												foreach ($data as $k=>$kk){?>
												<th width="24%"><?php echo $label[$k];?></th>
												<?php }?>
											</tr>
											</thead>
											<tbody>
												
												<?php
												$col_fak=Kandidat::model()->getHasilKandidatTPS();
												foreach($col_fak as $r=> $rr){
													?>
													<tr>
														<th><div align="left"><?php echo $rr['nama_tps'];?></div></th>
														<?php  
														$col_hasil=Kandidat::model()->getHasilKandidatByTPS($rr['id_tps']);
														foreach ($col_hasil as $s=>$ss){?>
															<td><?php echo $ss['hasil_suara'];?></td>
														<?php }?>
													</tr>
													<?php
												}
												?>
												
											</tbody>
											</table>
								  
                                </div>
                                
                            </div>