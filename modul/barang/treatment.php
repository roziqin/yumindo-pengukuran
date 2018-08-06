<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Treatment</h3>
							<a href="?menu=addbarang" class="btn btn-primary">Tambah Barang</a>
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama treatment</th>
			                  <th>Harga Beli</th>
			                  <th>Harga Jual</th>
			                  <th>Komisi B.O</th>
			                  <th>Komisi Dokter</th>
						      <th>Actions</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte1="SELECT * from barang where barang_jenis='treatment' ";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr>
										<td><?php echo $datatea["barang_nama"]; ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_beli"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_jual"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_komisi"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_komisi_dokter"]); ?></td>
										<td>
											<a href="home.php?menu=editbarang&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Edit</a>
											<a href="modul/barang/deletebarang.php?id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-danger">Delete</a>
										</td>
									</tr>
								<?php
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