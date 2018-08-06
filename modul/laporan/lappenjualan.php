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
							<h3 class="box-title">Obat/Treatment yang terjual</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
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

		              	<div class="clear"></div>
		              	<?php

			                if ($_GET['tanggal']=='') {
			                	# code...
			                } else {
			                	$text_line = explode(":",$_GET['tanggal']);
								$tgl11=$text_line[0];
								$tgl22=$text_line[1];
			                	echo "<h3>Laporan Penjualan per tanggal: ".$tgl11." sd ".$tgl22."</h3>";
			                }
		                ?>
		              	<br>
			              <table id="laporan" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama Obat/Treatment</th>
			                  <th>Jumlah yg Terjual</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php

			                if ($_GET['tanggal']=='') {
			                	# code...
			                } else {
			                	$text_line = explode(":",$_GET['tanggal']);
								$tgl1=$text_line[0];
								$tgl2=$text_line[1];

			                	$query=mysql_query("SELECT transaksi_tanggal, barang_nama,sum(transaksi_detail_jumlah) as jumlah from transaksi, transaksi_detail, barang where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_tanggal between '$tgl1' and '$tgl2' group by transaksi_detail_barang_id order by barang_id ASC");
								while ($datatea=mysql_fetch_array($query)) {

								?>
									<tr>
										<td><?php echo $datatea["barang_nama"]; ?></td>
										<td><?php echo $datatea["jumlah"]; ?></td>
									</tr>
								<?php
								}
							}

			                ?>
			                </tbody>
			              </table>
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