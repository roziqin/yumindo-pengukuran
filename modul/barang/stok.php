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
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
						<?php

						$id = $_GET['id'];
						$sqlte3="SELECT * from barang, klinik where barang_klinik=klinik_id and barang_id='$id'";
						$queryte3=mysql_query($sqlte3);
						$data3=mysql_fetch_array($queryte3);

						?>

				    	<?php if($_GET['ket'] == 'tambah') {?>
							<h3 class="box-title">Tambah Stok <?php echo $data3['klinik_nama']; ?></h3>
						<?php } else { ?>
							<h3 class="box-title">Barang Rusak <?php echo $data3['klinik_nama']; ?></h3>
						<?php } ?>
						</div>
						<div class="box-body">
					    <form action="aksi/barang.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Barang</label>
							    <input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="<?php echo $data3['barang_nama'] ; ?>" disabled>
							</div>
							<div class="form-group">
								<label>Jumlah Stok</label>
							    <input type="text" name="stok" class="form-control" placeholder="Jumlah Stok" value="0">
							</div>
							<div class="form-group">
							<?php if($id == 0) { ?>
						    <?php } else { 
						    	if($_GET['ket'] == 'tambah') {?>
								    <input type="submit" class="btn btn-primary" value="Tambah Stok" name="tambah_stok">
							    <?php } else { ?>
									<div class="form-group">
										<label>Keterangan Rusak</label>
									    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Rusak">
									</div>
								    <input type="submit" class="btn btn-primary" value="Update" name="rusak">
						    	<?php } ?>
					    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
	    		<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Stok Obat</h3>
						</div>
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
							<?php
								$aktif = "active";
								$sqlte1="SELECT * from klinik order by klinik_id";
								$queryte1=mysql_query($sqlte1);
								while ($datat=mysql_fetch_array($queryte1)) {

								?>
									<li class="<?php echo $aktif;?>"><a href="#<?php echo $datat['klinik_slug'];?>" data-toggle="tab"><?php echo $datat['klinik_nama'];?></a></li>
								<?php
								$aktif = "";
								}
							?>
							</ul>
							<div class="tab-content">
							<?php

								$aktif = "active";
								$sqlte1="SELECT * from klinik order by klinik_id";
								$queryte1=mysql_query($sqlte1);
								$n = 1;
								while ($datatea=mysql_fetch_array($queryte1)) {
									$kid = $datatea['klinik_id'];
									
								?>
									<div class="tab-pane <?php echo $aktif;?>" id="<?php echo $datatea['klinik_slug'];?>">
										<table id="example1<?php echo $n ; ?>" class="table table-bordered table-striped">
							                <thead>
								                <tr>
								                  <th>Nama Obat</th>
								                  <th width="60px">Stok</th>
											      <th width="200px">Actions</th>
								                </tr>
							                </thead>
							                <tbody>
							                <?php
							                
							                	$sqlte="SELECT * from barang where barang_klinik='$kid' ";
												$queryte=mysql_query($sqlte);
												while ($data=mysql_fetch_array($queryte)) {
												?>
													<tr>
														<td><?php echo $data["barang_nama"]; ?></td>
														<td><?php echo $data["barang_stok"]; ?></td>
														<td>
															<a href="home.php?menu=stok&ket=tambah&id=<?php echo $data["barang_id"]; ?>" class="btn btn-primary">Tambah Stok</a>
															<a href="home.php?menu=stok&ket=rusak&id=<?php echo $data["barang_id"]; ?>" class="btn btn-danger">Barang Rusak</a>
														</td>
													</tr>
												<?php
												}
											
							                ?>
							                </tbody>
							            </table>
									</div>

									<!-- /.tab-pane -->
								<?php
									$aktif = "";
									$n++;
								}

							?>
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- nav-tabs-custom -->
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>