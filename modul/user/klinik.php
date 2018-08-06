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
						<?php
						if ($_GET['id']!=0) {
							# code...
							if ($_GET['ket']=='klinik') {
								# code...
							?>
							<div class="box-header with-border">
								<h3 class="box-title">Edit Klinik</h3>
							</div>
							<div class="box-body">
								<?php

								$id = $_GET['id'];
								$sqlte1="SELECT * from klinik where klinik_id='$id'";
								$queryte1=mysql_query($sqlte1);
								$datatea=mysql_fetch_array($queryte1);

								?>
							    <form action="aksi/klinik.aksi.php" method="post">
						      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
									<div class="form-group">
										<label>Nama Klinik</label>
									    <input type="text" name="nama" class="form-control" autofocus value="<?php echo $datatea['klinik_nama'] ; ?>">
									</div>
									<div class="form-group">
										<label>Slug</label>
									    <input type="text" name="slug" class="form-control" value="<?php echo $datatea['klinik_slug'] ; ?>">
									</div>
									<div class="form-group">
									    <input type="submit" class="btn btn-primary" value="Edit" name="edit">
									</div>
								</form>
						    </div>

							<?php
							} else {
								# code...
							?>
							<div class="box-header with-border">
								<h3 class="box-title">Edit Klinik Cabang</h3>
							</div>
							<div class="box-body">
								<?php
								$idklinik = 0;
								$id = $_GET['id'];
								$sqlte1="SELECT * from klinik_cabang where klinik_cabang_id='$id'";
								$queryte1=mysql_query($sqlte1);
								$datatea=mysql_fetch_array($queryte1);
									$idklinik = $datatea['klinik_cabang_klinik_id'];
								
								?>
							    <form action="aksi/klinik.aksi.php" method="post">
						      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
									<div class="form-group">
										<label>Nama Klinik Cabang</label>
										<select name="klinik" class="form-control" id="jenis" ">
								        <?php
						                	$sqlte1="SELECT * from klinik ";
											$queryte1=mysql_query($sqlte1);
											while ($data=mysql_fetch_array($queryte1)) {
												if ($idklinik==$data['klinik_id']) {
													# code...
												?>
													<option value="<?php echo $data['klinik_id']?>" selected><?php echo $data['klinik_nama']?></option>
												<?php
												} else {

												?>
													<option value="<?php echo $data['klinik_id']?>"><?php echo $data['klinik_nama']?></option>
												<?php
												}
											}
								        ?>
									    </select>
									</div>
									<div class="form-group">
										<label>Alamat</label>
									    <input type="text" name="alamat" class="form-control" value="<?php echo $datatea['klinik_cabang_alamat'] ; ?>">
									</div>
									<div class="form-group">
										<?php if($id == 0) { ?>
									    <input type="submit" class="btn btn-primary" value="Tambah" name="tambahcabang">
									    <?php } else { ?>
									    <input type="submit" class="btn btn-primary" value="Edit" name="editcabang">

								    	<?php } ?>
									</div>
								</form>
						    </div>

							<?php
							}
							
						} else {
							# code...
						?>
						<div role="tabpanel">
		                    <!-- Nav tabs -->
		                    <ul class="nav nav-tabs" role="tablist">
		                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Klinik</a></li>
		                        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Cabang</a></li>
		                    </ul>

		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane active" id="tab1">
		                    		<br>
		                    		<div class="box-header with-border">
										<h3 class="box-title">Tambah Klinik</h3>
									</div>
									<div class="box-body">
										<?php

										$id = $_GET['id'];
										$sqlte1="SELECT * from klinik where klinik_id='$id'";
										$queryte1=mysql_query($sqlte1);
										$datatea=mysql_fetch_array($queryte1);

										?>
									    <form action="aksi/klinik.aksi.php" method="post">
								      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
											<div class="form-group">
												<label>Nama Klinik</label>
											    <input type="text" name="nama" class="form-control" autofocus value="<?php echo $datatea['klinik_nama'] ; ?>">
											</div>
											<div class="form-group">
												<label>Slug</label>
											    <input type="text" name="slug" class="form-control" value="<?php echo $datatea['klinik_slug'] ; ?>">
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
		                        <div role="tabpanel" class="tab-pane" id="tab2">
		                        	<br>
		                        	<div class="box-header with-border">
										<h3 class="box-title">Tambah Klinik Cabang</h3>
									</div>
									<div class="box-body">
										<?php
										$idklinik = 0;
										$id = $_GET['id'];
										$sqlte1="SELECT * from klinik_cabang where klinik_cabang_id='$id'";
										$queryte1=mysql_query($sqlte1);
										$datatea=mysql_fetch_array($queryte1);
										$idklinik = $datatea['klinik_cabang_klinik_id'];

										
										?>
									    <form action="aksi/klinik.aksi.php" method="post">
								      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
											<div class="form-group">
												<label>Nama Klinik Cabang</label>
												<select name="klinik" class="form-control" id="jenis" ">
										        <?php
								                	$sqlte1="SELECT * from klinik ";
													$queryte1=mysql_query($sqlte1);
													while ($data=mysql_fetch_array($queryte1)) {
														if ($idklinik==$data['klinik_id']) {
															# code...
														?>
															<option value="<?php echo $data['klinik_id']?>" selected><?php echo $data['klinik_nama']?></option>
														<?php
														} else {

														?>
															<option value="<?php echo $data['klinik_id']?>"><?php echo $data['klinik_nama']?></option>
														<?php
														}
													}
										        ?>
											    </select>
											</div>
											<div class="form-group">
												<label>Alamat</label>
											    <input type="text" name="alamat" class="form-control" value="<?php echo $datatea['klinik_cabang_alamat'] ; ?>">
											</div>
											<div class="form-group">
												<?php if($id == 0) { ?>
											    <input type="submit" class="btn btn-primary" value="Tambah" name="tambahcabang">
											    <?php } else { ?>
											    <input type="submit" class="btn btn-primary" value="Edit" name="editcabang">

										    	<?php } ?>
											</div>
										</form>
								    </div>
		                        </div>
		                    </div>
		                </div>
						<?php
						}
						
						?>

					</div>
				</div>
				<div class="col-md-8 col-md-offset-0">
					<div class="box box-primary">
						<div role="tabpanel">
		                    <!-- Nav tabs -->
		                    <ul class="nav nav-tabs" role="tablist">
		                        <li role="presentation" class="active"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Klinik</a></li>
		                        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Cabang</a></li>
		                    </ul>

		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div role="tabpanel" class="tab-pane active" id="tab3">
		                        	<br>
									<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
							                <thead>
							                <tr>
							                  <th>Nama Klinik</th>
							                  <th>Slug</th>
										      <th>Action</th>
							                </tr>
							                </thead>
							                <tbody>
						                	<?php
							                	$sqlte1="SELECT * from klinik ";
												$queryte1=mysql_query($sqlte1);
												while ($datatea=mysql_fetch_array($queryte1)) {
												?>
													<tr>
														<td><?php echo $datatea["klinik_nama"]; ?></td>
														<td><?php echo $datatea["klinik_slug"]; ?></td>
														<td>
															<a href="home.php?menu=klinik&ket=klinik&id=<?php echo $datatea["klinik_id"]; ?>" class="btn btn-primary">Edit</a>
															<a href="aksi/hapus.php?menu=klinik&id=<?php echo $datatea["klinik_id"]; ?>" class="btn btn-danger">Delete</a>

														</td>
													</tr>
												<?php
												}

							                ?>
							                </tbody>
							            </table>
									</div>
		                        </div>
		                        <div role="tabpanel" class="tab-pane" id="tab4">
		                        	<br>
									<div class="box-body">
										<table id="example11" class="table table-bordered table-striped">
							                <thead>
							                <tr>
							                  <th>Nama Klinik Cabang</th>
							                  <th>Alamat</th>
										      <th>Action</th>
							                </tr>
							                </thead>
							                <tbody>
						                	<?php
							                	$sqlte1="SELECT * from klinik_cabang, klinik WHERE klinik_cabang_klinik_id=klinik_id ";
												$queryte1=mysql_query($sqlte1);
												while ($datatea=mysql_fetch_array($queryte1)) {
												?>
													<tr>
														<td><?php echo $datatea["klinik_nama"]; ?></td>
														<td><?php echo $datatea["klinik_cabang_alamat"]; ?></td>
														<td>
															<a href="home.php?menu=klinik&ket=cabang&id=<?php echo $datatea["klinik_cabang_id"]; ?>" class="btn btn-primary">Edit</a>
															<a href="aksi/hapus.php?menu=cabang&id=<?php echo $datatea["klinik_cabang_id"]; ?>" class="btn btn-danger">Delete</a>

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
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>