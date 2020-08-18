<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Member
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-4 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Tambah Farmasi</h3>
						</div>
						<div class="box-body">
						<?php

						$id = $_GET['id'];
						$sqlte1="SELECT * from farmasi where farmasi_id='$id'";
						$queryte1=mysql_query($sqlte1);
						$datatea=mysql_fetch_array($queryte1);

						?>
					    <form action="aksi/farmasi.aksi.php" method="post">
				      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
							<div class="form-group">
								<label>Nama Farmasi</label>
							    <input type="text" name="nama" class="form-control" autofocus value="<?php echo $datatea['farmasi_nama'] ; ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>
							    <input type="text" name="alamat" class="form-control" value="<?php echo $datatea['farmasi_alamat'] ; ?>">
							</div>
							<div class="form-group">
								<?php if($id == 0) { ?>
							    <input type="submit" class="btn btn-primary" value="Tambah" name="tambah">
							    <?php } else { ?>
							    <input type="submit" class="btn btn-primary" value="Edit" name="edit">

						    	<?php } ?>
							</div>
						</form>
					    </div>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">List Farmasi</h3>
						</div>
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>Nama</th>
				                  <th>Alamat</th>
							      <th>Action</th>
				                </tr>
				                </thead>
				                <tbody>
			                	<?php
				                	$sqlte1="SELECT * from farmasi ";
									$queryte1=mysql_query($sqlte1);
									while ($datatea=mysql_fetch_array($queryte1)) {
									?>
										<tr>
											<td><?php echo $datatea["farmasi_nama"]; ?></td>
											<td><?php echo $datatea["farmasi_alamat"]; ?></td>
											<td>
												<a href="home.php?menu=farmasi&id=<?php echo $datatea["farmasi_id"]; ?>" class="btn btn-primary">Edit</a>
												<a href="modul/user/deletefarmasi.php?id=<?php echo $datatea["farmasi_id"]; ?>" class="btn btn-danger">Delete</a>

											</td>
										</tr>
									<?php
									}

				                ?>
				                </tbody>
				            </table>
						</div>
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>