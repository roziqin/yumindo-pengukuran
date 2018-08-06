<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php
    $kid = $_GET['id'];
	$sqlte1="SELECT * from klinik where klinik_id='$kid' ";
	$queryte1=mysql_query($sqlte1);
	$data=mysql_fetch_array($queryte1);
    ?>
      <h1>
    	Barang Klinik <?php echo $data['klinik_nama']; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Barang</h3>
							<a href="?menu=addbarang" class="btn btn-primary">Tambah Barang</a>
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama Produk</th>
			                  <th>Harga Beli</th>
			                  <th>Harga Jual</th>
			                  <th>Stok</th>
			                  <th>Nama Farmasi</th>
			                  <th>Kandungan</th>
						      <th>Actions</th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$idklinik = $_GET['id'];
			                	$sqlte1="SELECT * from barang, farmasi where barang_farmasi=farmasi_id and barang_klinik='$kid' ";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr>
										<td><?php echo $datatea["barang_nama"]; ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_beli"]); ?></td>
										<td>Rp. <?php echo format_rupiah($datatea["barang_harga_jual"]); ?></td>
										<td><?php echo $datatea["barang_stok"]; ?></td>
										<td><?php echo $datatea["farmasi_nama"]; ?></td>
										<td><?php echo $datatea["barang_kandungan"]; ?></td>
										<td>
											<a href="home.php?menu=editbarang&id=<?php echo $datatea["barang_id"]; ?>" class="btn btn-primary">Edit</a>
											<a href="modul/barang/deletebarang.php?id=<?php echo $datatea["barang_id"]; ?>&idklinik=<?php echo $idklinik; ?>" class="btn btn-danger">Delete</a>
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