<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Laporan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Fraktur</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
				            <!--
				            <form action="aksi/laporan.aksi.php" method="post">
				              	<div class="form-group col-md-4 col-md-offset-0">
				              		<label>Filter Tanggal : </label>
				              		<div class="input-group">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right" id="reservation" name="tanggal" value="<?php echo $_GET['tanggal'];?>">
					                </div>
				              	</div>
				              	<div class="form-group col-md-2 col-md-offset-0">
				              		<label> &nbsp;</label><br>
							    	<input type="submit" class="btn btn-primary" value="Proses" name="penjualan">
							    </div>
			              	</form>
							-->
			              	<div class="clear"></div>
			              	<div role="tabpanel">
			                    <!-- Nav tabs -->
			                    <ul class="nav nav-tabs" role="tablist">
			                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Belum Dibayar</a></li>
			                        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Lunas</a></li>
			                    </ul>

			                    <!-- Tab panes -->
			                    <div class="tab-content">
			                        <div role="tabpanel" class="tab-pane active" id="tab1">
			                    		<br>
							            <table id="example3" class="table table-bordered table-striped">
							                <thead>
							                <tr>
							                  <th>Jatuh Tempo</th>
							                  <th>Nama Farmasi</th>
							                  <th>Nama Klinik</th>
							                  <th>Jumlah yg dibayar</th>
							                  <th>Status</th>
							                  <th></th>
							                </tr>
							                </thead>
							                <tbody>
							                <?php

							            
							                	$query=mysql_query("SELECT transaksi_fraktur_id, transaksi_fraktur_jatuh_tempo, transaksi_fraktur_total, transaksi_fraktur_status, farmasi_nama, klinik_nama from transaksi_fraktur, farmasi, klinik, klinik_cabang where transaksi_fraktur_farmasi=farmasi_id and transaksi_fraktur_klinik_id=klinik_cabang_id and klinik_id=klinik_cabang_klinik_id and transaksi_fraktur_status='0'");
												while ($datatea=mysql_fetch_array($query)) {
													if ($datatea["transaksi_fraktur_status"]==0) {
														# code...
														$status = "Belum Dibayar";
													} else {
														# code...
														$status = "Lunas";
													}
													

													$tgl1=date('Y-m-j');
													$tgl2 = date("Y-m-j", strtotime($datatea["transaksi_fraktur_jatuh_tempo"]));

													$diff = abs(strtotime($tgl1) - strtotime($tgl2));

													//echo strtotime($tgl1)." - ".strtotime($tgl2)." - ".$diff."<br>";
													//$diff="";
													$years = floor($diff / (365*60*60*24));
													$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
													$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

													$jmlhari = $days + ($months*30);

													if ($jmlhari<=15) {
												?>
													<tr class="attention">
														<td><?php echo $datatea["transaksi_fraktur_jatuh_tempo"]; ?></td>
														<td><?php echo $datatea["farmasi_nama"]; ?></td>
														<td><?php echo $datatea["klinik_nama"]; ?></td>
														<td>Rp. <?php echo format_rupiah($datatea["transaksi_fraktur_total"]); ?></td>
														<td><?php echo $status; ?></td>
														<td>
															<a href="home.php?menu=lapfrakturdetail&id=<?php echo $datatea["transaksi_fraktur_id"]; ?>" class="btn btn-primary">Detail</a></td>
													</tr>
												<?php
													} else {
												?>
													<tr>
														<td><?php echo $datatea["transaksi_fraktur_jatuh_tempo"]; ?></td>
														<td><?php echo $datatea["farmasi_nama"]; ?></td>
														<td><?php echo $datatea["klinik_nama"]; ?></td>
														<td>Rp. <?php echo format_rupiah($datatea["transaksi_fraktur_total"]); ?></td>
														<td><?php echo $status; ?></td>
														<td>
															<a href="home.php?menu=lapfrakturdetail&id=<?php echo $datatea["transaksi_fraktur_id"]; ?>" class="btn btn-primary">Detail</a></td>
													</tr>
												<?php
													}
												}
											//}

							                ?>
							                </tbody>
							            </table>        
			                        </div>
			                        <div role="tabpanel" class="tab-pane" id="tab2">
			                        	<br>
			                        	<table id="example4" class="table table-bordered table-striped">
							                <thead>
							                <tr>
							                  <th>Jatuh Tempo</th>
							                  <th>Nama Farmasi</th>
							                  <th>Nama Klinik</th>
							                  <th>Jumlah yg dibayar</th>
							                  <th>Status</th>
							                  <th></th>
							                </tr>
							                </thead>
							                <tbody>
							                <?php

							            
							                	$query=mysql_query("SELECT transaksi_fraktur_id, transaksi_fraktur_jatuh_tempo, transaksi_fraktur_total, transaksi_fraktur_status, farmasi_nama, klinik_nama from transaksi_fraktur, farmasi, klinik where transaksi_fraktur_farmasi=farmasi_id and transaksi_fraktur_klinik_id=klinik_id and transaksi_fraktur_status='1'");
												while ($datatea=mysql_fetch_array($query)) {
													if ($datatea["transaksi_fraktur_status"]==0) {
														# code...
														$status = "Belum Dibayar";
													} else {
														# code...
														$status = "Lunas";
													}
													

												?>
													<tr>
														<td><?php echo $datatea["transaksi_fraktur_jatuh_tempo"]; ?></td>
														<td><?php echo $datatea["farmasi_nama"]; ?></td>
														<td><?php echo $datatea["klinik_nama"]; ?></td>
														<td>Rp. <?php echo format_rupiah($datatea["transaksi_fraktur_total"]); ?></td>
														<td><?php echo $status; ?></td>
														<td>
															<a href="home.php?menu=lapfrakturdetail&id=<?php echo $datatea["transaksi_fraktur_id"]; ?>" class="btn btn-primary">Detail</a></td>
													</tr>
												<?php
												}
											//}

							                ?>
							                </tbody>
							            </table>
			                        </div>
			                    </div>
			                </div>
			              	<br>
			            </div>
			            <!-- /.box-body -->
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>