<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Rekam Medis Pasien
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

		<div class="container-fluid spark-screen">
	    	<div class="row">
	    		<div class="col-md-12 col-md-offset-0">
					<div class="box box-primary">
					<?php 
					$id = $_GET['id'];
					if($id == 0) { ?>
						<div class="box-header with-border">
							<h3 class="box-title">List Pasien</h3>
						</div>
						<div class="box-body">
							<table id="example3" class="table table-bordered table-striped">
				                <thead>
				                <tr>
				                  <th>Nama</th>
				                  <th>Alamat</th>
							      <th>Tgl Lahir</th>
							      <th>No. Hp</th>
							      <th>Gender</th>
							      <th>Action</th>
				                </tr>
				                </thead>
				                <tbody>
			                	<?php
				                	$sqlte1="SELECT * from member ";
									$queryte1=mysql_query($sqlte1);
									while ($datatea=mysql_fetch_array($queryte1)) {
										$gender='';
										if ($datatea["member_gender"]==0) {
											# code...
											$gender='Perempuan';
										} else {
											$gender='Laki - Laki';
										}
									?>
										<tr>
											<td><?php echo $datatea["member_nama"]; ?></td>
											<td><?php echo $datatea["member_alamat"]; ?></td>
											<td><?php echo $datatea["member_tgl_lahir"]; ?></td>
											<td><?php echo $datatea["member_hp"]; ?></td>
											<td><?php echo $gender; ?></td>
											<td>
												<a href="home.php?menu=pasien&id=<?php echo $datatea["member_id"]; ?>" class="btn btn-primary">Detail</a>
												
											</td>
										</tr>
									<?php
									}

				                ?>
				                </tbody>
				            </table>
						</div>
					    <?php } else { ?>
					    <div class="box-header with-border">
			                <div class="col-md-5 col-md-offset-0">
								<h3 class="box-title">Data Pasien</h3>
							</div>
			                <div class="col-md-7 col-md-offset-0">
								<h3 class="box-title">Input Data Rekam Medik</h3>
							</div>
						</div>
						<div class="box-body">
						<?php
		              		$id = $_GET['id'];
		              		$query = mysql_query("SELECT * FROM member where member_id='$id'");
		              		$data1 = mysql_fetch_array($query);
		              		if ($data1['member_gender']==0) {
		              			# code...
		              			$gender = "Perempuan";
		              		} else {
		              			# code...
		              			$gender = "Laki - Laki";
		              		}
		              		

						?>
			                <div class="col-md-5 col-md-offset-0">
								<table>
									<tr>
										<td><p>Nama Pasien</p></td>
										<td width="20px" style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_nama'];?></p></td>
									</tr>
									<tr>
										<td><p>Alamat</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_alamat'];?></p></td>
									</tr>
									<tr>
										<td><p>Tanggal</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_tgl_lahir'];?></p></td>
									</tr>
									<tr>
										<td><p>Gender</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $gender;?></p></td>
									</tr>
									<tr>
										<td><p>Pekerjaan</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_pekerjaan'];?></p></td>
									</tr>
									<tr>
										<td><p>Riwayat Perawatan Sebelumnya</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_riwayat_perawatan_sebelumnya'];?></p></td>
									</tr>
									<tr>
										<td><p>Riwayat Alergi</p></td>
										<td style="text-align: center;"><p> : </p></td>
										<td><p><?php echo $data1['member_riwayat_alergi'];?></p></td>
									</tr>	
								</table>
							</div>
			                <div class="col-md-7 col-md-offset-0">

						        <form action="aksi/pasien.aksi.php" method="post" class="rekam_medik">
							    <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id']; ?>" >
				                	<table>
										<tr>
											<td><p>Diagnosa</p></td>
											<td width="20px" style="text-align: center;"><p> : </p></td>
											<td><textarea name="diagnosa" class="form-control"></textarea></td>
										</tr>
										<tr>
											<td><p>Obat</p></td>
											<td style="text-align: center;"><p> : </p></td>
											<td><textarea name="obat" class="form-control"></textarea></td>
										</tr>
										<tr>
											<td><p>Treatment</p></td>
											<td style="text-align: center;"><p> : </p></td>
											<td><textarea name="treatment" class="form-control"></textarea></td>
										</tr>
										<tr>
											<td colspan="3">
											    <input type="submit" class="btn btn-primary pull-right" value="Proses" name="proses">
										    </td>
										</tr>
									</table>
								</form>
			                </div>

			                <div class="col-md-12 col-md-offset-0">
							<hr>
							</div>

			                <div class="col-md-12 col-md-offset-0">
								<table id="example1" class="table table-bordered table-striped">
					                <thead>
					                <tr>
										<th>Tanggal</th>
										<th>Dokter</th>
										<th>Diagnosa</th>
										<th>Obat</th>
										<th>Treatment</th>
					                </tr>
					                </thead>
					                <tbody>
					                	<?php
					                	$pasien = $_GET['id'];
					                	$sqlte1="SELECT * from rekam_medik, users where rekam_dokter=id and rekam_pasien='$pasien' ";
										$queryte1=mysql_query($sqlte1);
										while ($datatea=mysql_fetch_array($queryte1)) {

										?>
										<tr>
											<td><?php echo $datatea['rekam_tanggal'];?></td>
											<td><?php echo $datatea['name'];?></td>
											<td><?php echo $datatea['rekam_diagnosa'];?></td>
											<td><?php echo $datatea['rekam_obat'];?></td>
											<td><?php echo $datatea['rekam_treatment'];?></td>
										</tr>


										<?php
										}

					                	?>
				                	</tbody>
			                	</table>
		                	</div>
						</div>
					    <?php } ?>
					</div>
				</div>
	    	</div>
	    	<!-- /.row -->
    	</div>
    </section>
    <!-- /.content -->
  </div>