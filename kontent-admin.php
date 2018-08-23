<?php
        $_SESSION['print'] = "tidak";
date_default_timezone_set('Asia/jakarta');
if ($_GET['menu']=='home') {
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Dashboard
		    <small><?php echo $tgl ; ?></small>
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			<?php 
			$iduser = $_SESSION['login_user'];
			$query=mysql_query("SELECT count(pengukuran_id) as jumlah, sum(pengukuran_total_harga) as total from pengukuran where pengukuran_tanggal='$tgl1' group by pengukuran_tanggal ");
			$datatea=mysql_fetch_array($query);

			?>
	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Transaksi</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
		              	<?php
		              	if ($_SESSION['role']=='admin'||$_SESSION['role']=='owner') {
		              		include('modul/dashboard.php');
		              		# code...
		              	} elseif ($_SESSION['role']=='potong-jahit') {
		              	?>
		              		<table id="dashtable1" class="table table-bordered table-striped ">
				                <thead>
				                <tr>
				                  <th >Tanggal Mulai Proses</th>
				                  <th width="25%">Nama Pelanggan</th>
				                  <th>Status</th>
				                </tr>
				                </thead>
				                <tbody>
				                <?php
				                	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id order by pengukuran_id DESC ";
									$queryte=mysql_query($sqlte);
									while ($data=mysql_fetch_array($queryte)) {

					                	$sqlte1="SELECT name as nama_user from pengukuran, users_lain where pengukuran_user=id ";
										$queryte1=mysql_query($sqlte1);
										$data1=mysql_fetch_array($queryte1);	

										if ($data["pengukuran_status"]=='Mulai Potong' || $data["pengukuran_status"]=='Proses Potong' || $data["pengukuran_status"]=='Selesai Potong' || $data["pengukuran_status"]=='Proses Jahit' || $data["pengukuran_status"]=='Selesai Jahit') {
					
									?>
										<tr>
											<td><a href="?menu=detailpotong&id=<?php echo $data['pengukuran_id'];?>"><?php echo date('d-m-Y', strtotime($data["pengukuran_tanggal_deal"] . ' +0 day')); ?></a></td>
											<td><a href="?menu=detailpotong&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
											<td><a href="?menu=detailpotong&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["pengukuran_status"]; ?></a></td>
											<!--
											<td>
								                <form action="aksi/transaksi.aksi.php" method="post">
									                <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
								                	<input type="submit" class="btn btn-primary" value="Proses" name="prosesukur">
												</form>
											</td>
											-->
											
										</tr>

									<?php
										}
									}

				                ?>
				                </tbody>
				            </table>

		              	<?php
		              		# code...
		              	} elseif ($_SESSION['role']=='steamer-finising') {
		              	?>
		              		<table id="dashtable1" class="table table-bordered table-striped ">
				                <thead>
				                <tr>
				                  <th >Tanggal Mulai Proses</th>
				                  <th width="25%">Nama Pelanggan</th>
				                  <th>Status</th>
				                </tr>
				                </thead>
				                <tbody>
				                <?php
				                	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id order by pengukuran_id DESC ";
									$queryte=mysql_query($sqlte);
									while ($data=mysql_fetch_array($queryte)) {

					                	$sqlte1="SELECT name as nama_user from pengukuran, users_lain where pengukuran_user=id ";
										$queryte1=mysql_query($sqlte1);
										$data1=mysql_fetch_array($queryte1);

										if ($data["pengukuran_status"]=='Selesai Jahit' || $data["pengukuran_status"]=='Proses Steamer' || $data["pengukuran_status"]=='Selesai Steamer' || $data["pengukuran_status"]=='Proses Finishing' || $data["pengukuran_status"]=='Selesai Finishing') {
									?>
										<tr>
											<td><a href="?menu=detailsteamer&id=<?php echo $data['pengukuran_id'];?>"><?php echo date('d-m-Y', strtotime($data["pengukuran_tanggal_deal"] . ' +0 day')); ?></a></td>
											<td><a href="?menu=detailsteamer&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
											<td><a href="?menu=detailsteamer&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["pengukuran_status"]; ?></a></td>
											<!--
											<td>
								                <form action="aksi/transaksi.aksi.php" method="post">
									                <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
								                	<input type="submit" class="btn btn-primary" value="Proses" name="prosesukur">
												</form>
											</td>
											-->
											
										</tr>

									<?php
										}
									}

				                ?>
				                </tbody>
				            </table>

		              	<?php
		              		# code...
		              	} elseif ($_SESSION['role']=='pengukur') {
		              	?>
		              		
							<!-- Custom Tabs -->
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#Pengukuran" data-toggle="tab">Pengukuran</a></li>
									<li><a href="#Pemasangan" data-toggle="tab">Pemasangan</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="Pengukuran">
										<table id="dashtable3" class="table table-bordered table-striped ">
							                <thead>
							                <tr>
							                  <th width="150px">Tanggal Booking</th>
							                  <th >Nama Pelanggan</th>
							                  <th>Status</th>
							                  <th></th>
							                </tr>
							                </thead>
							                <tbody>
							                <?php
							                	$sqlte="SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id and booking_pengukuran_status='Follow Up' order by booking_pengukuran_id DESC ";
												$queryte=mysql_query($sqlte);
												while ($data=mysql_fetch_array($queryte)) {


								                	$sqlte1="SELECT name as nama_user from booking_pengukuran, users_lain where booking_pengukuran_user=id ";
													$queryte1=mysql_query($sqlte1);
													$data1=mysql_fetch_array($queryte1);
												?>
													<tr>
														<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?></a></td>
														<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
														<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo $data["booking_pengukuran_status"]; ?></a></td>
														<td>
															<a href="?menu=detailbooking&id=<?php echo $data["booking_pengukuran_id"]; ?>" class="btn btn-primary">Proses</a>
														</td>
														<!--
														<td>
											                <form action="aksi/transaksi.aksi.php" method="post">
												                <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
											                	<input type="submit" class="btn btn-primary" value="Proses" name="prosesukur">
															</form>
														</td>
														-->
														
													</tr>

												<?php
												}

							                ?>
							                </tbody>
							            </table>

									</div>
									<div class="tab-pane" id="Pemasangan">
								    	<table id="dashtable8" class="table table-bordered table-striped ">
								            <thead>
								            <tr>
								              <th >Tanggal Mulai Pasang</th>
								              <th width="25%">Nama Pelanggan</th>
								              <th>Status</th>
								            </tr>
								            </thead>
								            <tbody>
								            <?php
								            	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Selesai Finishing' order by pengukuran_id DESC ";
												$queryte=mysql_query($sqlte);
												while ($data=mysql_fetch_array($queryte)) {

													  $tanggalpasang = $data['pengukuran_tanggal_deal'];

													  $tanggalpasang1 = date('d-m-Y', strtotime($tanggalpasang . ' +14 day'));

								                	$sqlte1="SELECT name as nama_user from pengukuran, users_lain where pengukuran_user=id ";
													$queryte1=mysql_query($sqlte1);
													$data1=mysql_fetch_array($queryte1);
												?>
													<tr>
														<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $tanggalpasang1; ?></a></td>
														<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
														<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["pengukuran_status"]; ?></a></td>
													</tr>

												<?php
												}


								            ?>
								            </tbody>
								        </table>

									</div>
								</div>
							</div>

		              	<?php
		              		# code...
		              	}

		              	?>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='pemasangan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Pemasangan
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Pemasangan</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
	              	
	              		<table id="example1" class="table table-bordered table-striped ">
				                <thead>
				                <tr>
				                  <th >Tanggal Mulai Pasang</th>
				                  <th width="25%">Nama Pelanggan</th>
				                  <th>Status</th>
				                </tr>
				                </thead>
				                <tbody>
				                <?php
				                	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Selesai Finishing' order by pengukuran_tanggal DESC ";
									$queryte=mysql_query($sqlte);
									while ($data=mysql_fetch_array($queryte)) {

										  $tanggalpasang = $data['pengukuran_tanggal_deal'];

										  $tanggalpasang1 = date('d-m-Y', strtotime($tanggalpasang . ' +14 day'));

					                	$sqlte1="SELECT name as nama_user from pengukuran, users_lain where pengukuran_user=id ";
										$queryte1=mysql_query($sqlte1);
										$data1=mysql_fetch_array($queryte1);
									?>
										<tr>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $tanggalpasang1; ?></a></td>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["pengukuran_status"]; ?></a></td>
										</tr>

									<?php
									}

									$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id order by pengukuran_tanggal DESC ";
									$queryte=mysql_query($sqlte);
									while ($data=mysql_fetch_array($queryte)) {

										  $tanggalpasang = $data['pengukuran_tanggal_deal'];

										  $tanggalpasang1 = date('d-m-Y', strtotime($tanggalpasang . ' +14 day'));

					                	$sqlte1="SELECT name as nama_user from pengukuran, users_lain where pengukuran_user=id ";
										$queryte1=mysql_query($sqlte1);
										$data1=mysql_fetch_array($queryte1);

									?>
										<tr>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $tanggalpasang1; ?></a></td>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
											<td><a href="?menu=detailpemasangan&id=<?php echo $data['pengukuran_id'];?>"><?php echo $data["pengukuran_status"]; ?></a></td>
											
											
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='booking') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Booking Pengukuran
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			<?php 
			$iduser = $_SESSION['login_user'];
			$query=mysql_query("SELECT count(pengukuran_id) as jumlah, sum(pengukuran_total_harga) as total from pengukuran where pengukuran_tanggal='$tgl1' group by pengukuran_tanggal ");
			$datatea=mysql_fetch_array($query);

			?>
	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Booking</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
		            	<table id="example7" class="table table-bordered table-striped ">
			                <thead>
			                <tr>
			                  <th width="100px">Tanggal Booking</th>
			                  <th width="25%">Nama Pelanggan</th>
			                  <th>Email</th>
						      <th>Alamat</th>
			                  <th>Telepon</th>
			                  <th>Petugas</th>
			                  <th>Status</th>
			                  <th></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte="SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id order by booking_pengukuran_tanggal DESC ";
								$queryte=mysql_query($sqlte);
								while ($data=mysql_fetch_array($queryte)) {

				                	$sqlte1="SELECT name as nama_user from booking_pengukuran, users_lain where booking_pengukuran_user=id ";
									$queryte1=mysql_query($sqlte1);
									$data1=mysql_fetch_array($queryte1);
								?>
									<tr>
										<td><?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?></td>
										<td><?php echo $data["name"]; ?></td>
										<td><?php echo $data["email"]; ?></td>
										<td><?php echo $data["alamat"]; ?></td>
										<td><?php echo $data["telepon"]; ?></td>
										<td><?php echo $data1["nama_user"]; ?></td>
										<td><?php echo $data["booking_pengukuran_status"]; ?></td>
										<td>
											<a href="?menu=detailbooking&id=<?php echo $data["booking_pengukuran_id"]; ?>" class="btn btn-primary">Follow Up</a>
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php


} elseif ($_GET['menu']=='orderbahan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Order Bahan
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			<?php 
			$iduser = $_SESSION['login_user'];
			$query=mysql_query("SELECT count(pengukuran_id) as jumlah, sum(pengukuran_total_harga) as total from pengukuran where pengukuran_tanggal='$tgl1' group by pengukuran_tanggal ");
			$datatea=mysql_fetch_array($query);

			?>
	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Transaksi</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
		            	<table id="example1" class="table table-bordered table-striped ">
			                <thead>
			                <tr>
			                  <th width="100px">Tanggal</th>
			                  <th width="25%">Nama Pelanggan</th>
						      <th>Alamat</th>
			                  <th>Status</th>
			                  <th></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php
			                	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_user=id order by pengukuran_tanggal DESC ";
								$queryte=mysql_query($sqlte);
								while ($data=mysql_fetch_array($queryte)) {

									$idpel = $data["pengukuran_pelanggan"];
				                	$sqlte1="SELECT * from users_lain where id='$idpel' ";
									$queryte1=mysql_query($sqlte1);
									$data1=mysql_fetch_array($queryte1);
								?>
									<tr>
										<td><?php echo date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day')); ?></td>
										<td><?php echo $data1["name"]; ?></td>
										<td><?php echo $data1["alamat"]; ?></td>
										<td><?php echo $data["pengukuran_status"]; ?></td>
										<td>
											<a href="?menu=detailorderbahan&id=<?php echo $data["pengukuran_id"]; ?>" class="btn btn-primary">Detail</a>
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php


} elseif ($_GET['menu']=='detail') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table class="custom1">
								<tr>
									<td width="100px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $data["email"]; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td>:</td>
									<td><?php echo $data["telepon"]; ?></td>
								</tr>
								<tr>
									<td>Total Harga</td>
									<td>:</td>
									<td>Rp <?php echo format_rupiah($data["pengukuran_total_harga"]); ?></td>
								</tr>
								<?php
								if ($data["pengukuran_status"]=="Penawaran") {
									# code...
								?>
									<tr>
										<td>Diskon</td>
										<td>:</td>
										<td>	
											<div class="form-group">
											    <input type="text" name="diskon" class="form-control" id="diskon" value="<?php echo $data['pengukuran_diskon'] ; ?>">
											</div>
										</td>
									</tr>

									<tr>
										<td></td>
										<td></td>
										<td>
											<div class="form-group">
												<?php
												$persen='';
												$tunai='';
												if ($data['pengukuran_ket_diskon']=='Prosentase') {
													# code...
													$persen='selected';
												} elseif ($data['pengukuran_ket_diskon']=='Tunai') {
													# code...
													$tunai='selected';
												}
												
												?>
												<select class="form-control" name="diskonket">
													<option value="">-- Pilih Jenis Diskon --</option>
													<option value="Prosentase" <?php echo $persen; ?> >Prosentase</option>
													<option value="Tunai" <?php echo $tunai; ?> >Tunai</option>
												</select>
											</div>
										</td>
									</tr>
									<?php
									if ($_SESSION['role']=="admin") {
										# code...
										if ($data["pengukuran_kualitas"]=="Premium") {
											$pre = "selected";
										} elseif ($data["pengukuran_kualitas"]=="Gold") {
											$gold = "selected";
										} else {
											$silver = "selected";
										}
										?>
											<tr>
												<td>Kualitas</td>
												<td>:</td>
												<td>
													<div class="form-group">
														<select class="form-control" name="kualitas">
															<option value="Premium" <?php echo $pre ;?> >Premium</option>
															<option value="Gold" <?php echo $gold ;?> >Gold</option>
															<option value="Silver" <?php echo $silver ;?> >Silver</option>
														</select>
													</div>
												</td>
											</tr>
											<tr>
												<td>Dp</td>
												<td>:</td>
												<td>

									                <input type="hidden" name="id" class="form-control" value="<?php echo $data['pengukuran_id']; ?>">
									                <input type="text" name="dp" class="form-control" style="text-align: right; margin-top: 10px; height: auto;" value="0" id="price">
												</td>
											</tr>
											<tr>
												<td>Bank Transfer</td>
												<td>:</td>
												<td>
													<?php
													$bca='';
													$mandiri='';
													$bri='';
													if ($data["pengukuran_bank"]=='BCA') {
														# code...
														$bca='checked';
													} elseif ($data['pengukuran_bank']=='Mandiri') {
														# code...
														$mandiri='checked';
													} elseif ($data['pengukuran_bank']=='BRI') {
														# code...
														$bri='checked';
													}  else {
														# code...
														echo"aa";
													}
													
													?>
													<div class="radio">
								                      <label>
								                        <input type="radio" name="bank" value="BCA" <?php echo $bca; ?>>BCA 
								                      </label>
								                      <label>
								                        <input type="radio" name="bank" value="Mandiri" <?php echo $mandiri; ?>>Mandiri 
								                      </label>
								                      <label>
								                        <input type="radio" name="bank" value="BRI" <?php echo $bri; ?>>BRI 
								                      </label>
								                    </div>
												</td>
											</tr>
											<tr>
												<td>PPN 10%</td>
												<td>:</td>
												<td>
													<div class="checkbox">
								                      <label>
								                      	<?php

								                      	if ($data['pengukuran_ppn']=='ya') {
								                      		# code...
							                      		?>
									                        <input type="checkbox" name="ppn" value="ya" checked> 
							                      		<?php
								                      	} else {
								                      		# code...
							                      		?>
									                        <input type="checkbox" name="ppn" value="ya"> 
								                        <?php
								                      	}
								                      	
								                      	?>
								                      </label>
								                    </div>
												</td>
											</tr>
											
											<tr>
												<td colspan="2"></td>
												<td>
												    <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="negoharga" style="    padding: 5px 16px;font-size: 13px; margin-top: 10px;">
												</td>
											</tr>
											<tr>
												<td colspan="2"></td>
												<td>
												    <a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Penawaran</a>
												</td>
											</tr>
										<?php
									} else {
										# code...
									}
									

									
								} elseif ($data["pengukuran_status"]=="Selesai Pemasangan" || $data["pengukuran_status"]=='Selesai Finishing') {

								  $totalharga = $data['pengukuran_total_harga'];
								  $dp = $data['pengukuran_dp_awal'];
								  $diskon = $data['pengukuran_diskon'];
								  $sisa = $totalharga - $dp - $diskon;
								?>
									<tr>
										<td>Diskon</td>
										<td>:</td>
										<td>Rp <?php echo format_rupiah($diskon); ?></td>
									</tr>
									<tr>
										<td>Dp</td>
										<td>:</td>
										<td>Rp <?php echo format_rupiah($data["pengukuran_dp"]); ?></td>
									</tr>
									<tr>
										<td>Sisa</td>
										<td>:</td>
										<td>Rp <?php echo format_rupiah($sisa); ?></td>
									</tr>
									<tr>
										<td>Status</td>
										<td>:</td>
										<td><?php echo $data["pengukuran_status"]; ?></td>
									</tr>
									<tr>
										<td>Bayar</td>
										<td>:</td>
										<td>
											<input type="hidden" name="sisa" class="form-control" value="<?php echo $sisa; ?>">
											<input type="hidden" name="status" class="form-control" value="<?php echo $data['pengukuran_status']; ?>">
											<input type="hidden" name="diskon" class="form-control" value="<?php echo $data['pengukuran_diskon']; ?>">
											<input type="hidden" name="dp" class="form-control" value="<?php echo $data['pengukuran_dp']; ?>">
							                <input type="hidden" name="id" class="form-control" value="<?php echo $data['pengukuran_id']; ?>">
							                <input type="text" name="bayar" class="form-control" style="text-align: right; margin-top: 10px; height: auto;" value="0" id="price">
										</td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td>
										    <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="pelunasan" style="    padding: 5px 16px;font-size: 13px; margin-top: 10px;">

										    <a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;margin-right: 20px;">Download Tagihan</a>
										</td>
									</tr>
								<?php

								} else {
								?>	
									
									<tr>
										<td>Dp</td>
										<td>:</td>
										<td>Rp <?php echo format_rupiah($data["pengukuran_dp"]); ?></td>
									</tr>
									<tr>
										<td>Status</td>
										<td>:</td>
										<td><?php echo $data["pengukuran_status"]; ?></td>
									</tr>

									<tr>
										<td colspan="2">
											<?php

											if ($data["pengukuran_status"]=='Selesai Pemasangan' || $data["pengukuran_status"]=='Selesai Finishing'){
												
												?>
											    <input type="hidden" name="tagihan" class="form-control" id="status" value="Lunas">
											    <input type="hidden" name="status" class="form-control" id="status" value="Lunas">
				                      			<input type="submit" class="btn btn-success" value="Lunas" name="gantistatuslunas" style="padding: 5px 16px;font-size: 13px;margin: 10px auto 0px	;">
											<?php
											}
											?>
										</td>
										<td>

										    <a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Invoice</a>
										</td>
									</tr>
								<?php
								}
								?>
							</table>

							<?php include "table-kualitas.php" ; ?>
						</form>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
						<a href="tambahtransaksi.php?menu=home&idukur=<?php echo $_GET['id']; ?>" class="btn btn-primary pull-right btn-lg" style="margin-bottom: 15px;font-size: 12px;">Tambah</a>
		              	<table id="listbarang" class="table table-bordered table-striped custom1">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="150px">Ruang</th>
		                      <th rowspan="2">Jenis<br>G/V/BL</th>
		                      <th rowspan="2">Kode<br>Bahan</th>
		                      <th rowspan="2">model</th>
		                      <th rowspan="2">Jumlah</th>
		                      <th rowspan="2">KT/E</th>
		                      <th colspan="2">Rel/Alat</th>
		                      <th colspan="2">Ukuran</th>
		                      <th rowspan="2" >Total<br>Harga</th>
		                      <th rowspan="2" ></th>
		                    </tr>
		                    <tr>
		                      <th>Warna</th>
		                      <th>Ukuran</th>
		                      <th>T</th>
		                      <th>L</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {
								$kode1="";
								if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
									# code...
									$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
								}
		                      ?>
		                        <tr>
		                          <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
		                          <td><?php echo $datatea["jenis_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kode_bahan"].''.$kode1; ?></td>
		                          <td><?php echo $datatea["model_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_alat_warna"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_alat_ukuran"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
		                          <td style="text-align: right;"><?php echo 'Rp. '. format_rupiah($datatea["pengukuran_detail_harga"]); ?></td>
			                      <td>
			                      	<?php
			                    		if ($data["pengukuran_status"]=="Penawaran") {
			                    			# code...
			                    		?>
			                    			<a href="aksi/hapus.php?menu=transaksipenawaran&id=<?php echo $datatea["pengukuran_detail_id"]; ?>&idukur=<?php echo $datatea["pengukuran_id"]; ?>" class="btn btn-danger"><i class='fa fa-trash'></i></a>
					                      	<a href="?menu=edittransaksi&id=<?php echo $datatea['pengukuran_detail_id'] ?>&idukur=<?php echo $_GET['id']; ?>" class="btn btn-success pull-right btn-lg" style="font-size: 12px;">Edit</a>
			                    		<?php
			                    		}
			                      	?>
			                      </td>
		                        </tr>
		                      <?php
		                      }
		                      echo mysql_error();
		                      ?>

		                    </tbody>
		                </table>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php
} elseif ($_GET['menu']=='edittransaksi') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Edit transaksi</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);
						?>
						<br><br>
						<table class="custom1" >
							<tr>
								<td width="100px">Nama</td>
								<td width="20px">:</td>
								<td><?php echo $data["name"]; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo $data["email"]; ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?php echo $data["alamat"]; ?></td>
							</tr>
						</table>
						<div class="clear"></div>
						<hr>
						<br>
						<a href="?menu=detail&id=<?php echo $_GET['id']; ?>" class="btn btn-danger pull-right" style="margin-top: 20px;">Kembali</a>
				        <?php
				        $id = $_GET["id"];
				        $idukur = $_GET["idukur"];
				        $sqledit="SELECT * from pengukuran_detail where pengukuran_detail_id='$id'";
				        $queryedit=mysql_query($sqledit);
				        $dataedit=mysql_fetch_array($queryedit);

				        $idjenis = $dataedit["pengukuran_detail_jenis"];
				        $idbahan = $dataedit["pengukuran_detail_bahan"];
				        $idmodel = $dataedit["pengukuran_detail_model"];

				        $sql="SELECT * from jenis where jenis_id='$idjenis'";
				        $query=mysql_query($sql);
				        $data=mysql_fetch_array($query);
				        $jenisnama=$data['jenis_nama'];

				        $sql2="SELECT * FROM model WHERE model_id='$idmodel'";
				        $query2=mysql_query($sql2);
				        $data2=mysql_fetch_array($query2);
				        echo mysql_error();

				        $sql3="SELECT * FROM kain where kain_id='$idbahan'";
				        $query3=mysql_query($sql3);
				        $data3=mysql_fetch_array($query3);
				              ?>
				                <form action="aksi/transaksi.aksi.php" method="post">
				              <input type="hidden" name="idukur" class="form-control" id="" value="<?php echo $idukur;?>">
				              <input type="hidden" name="idtemp" class="form-control" id="" value="<?php echo $id;?>">
				              <input type="hidden" name="jenis" class="form-control" id="" value="<?php echo $idjenis;?>">
				          <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
				          <?php
				          /*
				          if ($jenisnama=="Gorden"||$jenisnama=="Vitras"||$jenisnama=="Gorden & Vitras") {
				            # code...
				          ?>
				            <label>Jenis</label>
				            <select class="form-control" name="jenis">
				              <option value="" >Pilih Jenis</option>
				              <?php
				              $selected = "";

				              $sqljenis = "SELECT * FROM jenis";
				              $queryjenis = mysql_query($sqljenis);
				              while ($datajenis = mysql_fetch_array($queryjenis)) {
				                # code...
				                if ($datajenis["jenis_nama"]=="Gorden"||$datajenis["jenis_nama"]=="Vitras"||$datajenis["jenis_nama"]=="Gorden & Vitras") {
				                  if ($dataedit["pengukuran_detail_jenis"]==$datajenis['jenis_id']) {
				                   # code...
				                    $selected = "selected";
				                  } else {
				                    $selected = "";
				                  } 
				                  echo "<option value='".$datajenis['jenis_id']."' ".$selected.">".$datajenis['jenis_nama']."</option>";      
				                }
				              }
				              ?>
				            </select>/
				            <?php
				          } else {
				          ?>
				            <label>Jenis: <?php echo $data['jenis_nama'];?></label>
				          <?php
				          }
				          */
				          ?>
				          <label>Jenis: <?php echo $data['jenis_nama'];?></label>
				          </div>
				          <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
				            <label>Model</label>
				            <select class="form-control" name="model">
				            <?php
				            $sqlte1="SELECT * from model";
				            $queryte1=mysql_query($sqlte1);
				            while ($datatea=mysql_fetch_array($queryte1)) {
				              
				              # code...
				              if ($datatea["model_id"]==0) {
				                # code...
				              } else {
				                # code...
				                $sql="SELECT * from jenis where jenis_id='$idjenis'";
				                $query=mysql_query($sql);
				                $data=mysql_fetch_array($query);
				                
				                if ($data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {
				                  # code...
				                  if ($datatea['model_nama']=='Triplet') {
				                  
				                  } else {
				                    $selected="";
				                    if($idmodel==$datatea["model_id"]){
				                      $selected="selected";
				                    }
				                    ?>
				                    <option value="<?php echo $datatea["model_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["model_nama"]; ?></option>
				                    <?php
				                  } 
				                } else {
				                  if ($datatea['model_nama']=='Papan'||$datatea['model_nama']=='Drappery') {
				                  } else {
				                    $selected="";
				                    if($idmodel==$datatea["model_id"]){
				                      $selected="selected";
				                    }
				                    ?>
				                    <option value="<?php echo $datatea["model_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["model_nama"]; ?></option>
				                    <?php
				                  }
				                } 
				              } 
				            }
				            ?>
				            </select>
				          </div>
				          <div class="col-md-12 col-md-offset-0 col-custom-left form-group">
				            <label>Bahan</label>
				            <select class="form-control" name="bahan">
				            <?php
				            $sqlte1="SELECT * from kain WHERE kain_jenis='$idjenis'";
				            $queryte1=mysql_query($sqlte1);
				            while ($datatea=mysql_fetch_array($queryte1)) {
				             
				            $selected="";
				            if($idbahan==$datatea["kain_id"]){
				              $selected="selected";
				            }
				              # code...
				            ?>
				                <option value="<?php echo $datatea["kain_id"]; ?>" <?php echo $selected; ?> ><?php echo $datatea["kain_nama"]; ?></option>
				            <?php              
				            }
				            ?>
				            </select>
				          </div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Ruang</label>
				              <input type="text" name="ruang" class="form-control" id="ruang" value="<?php echo $dataedit["pengukuran_detail_ruang"];?>">
				          </div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Kode Bahan</label>
				              <input type="text" name="kodebahan" class="form-control" id="kodebahan" value="<?php echo $dataedit["pengukuran_detail_kode_bahan"];?>">
				          </div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				          <?php         
				          if ($data['jenis_nama']=="Gorden & Vitras") {
				            # code...
				          ?>
				            <label>Kode Bahan Vitras</label>
				              <input type="text" name="kodebahan1" class="form-control" id="kodebahan1" value="<?php echo $dataedit["pengukuran_detail_kode_bahan_1"];?>">
				          <?php
				          } else {
				          ?>
				          <input type="hidden" name="kodebahan1" class="form-control" id="kodebahan1" value="<?php echo $dataedit["pengukuran_detail_kode_bahan_1"];?>">
				          <?php
				          }

				          ?>
				          </div>
							<div class="col-md-6 col-md-offset-0 col-custom-left form-group" style="min-height: 55.8px;">
							<?php
							if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif'||$data['jenis_nama']=='Kaca Film') {
							?>
								<input type="hidden" name="hargabahan" class="form-control" id="hargabahan" value="<?php echo $dataedit["pengukuran_detail_harga_bahan"];?>">
							<?php
							} else {
							?>
								<label>Harga Bahan</label>
							    <input type="text" name="hargabahan" class="form-control" id="hargabahan" value="<?php echo $dataedit["pengukuran_detail_harga_bahan"];?>">
							<?php						
							}
							?>
							</div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Jumlah</label>
				              <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?php echo $dataedit["pengukuran_detail_jumlah"];?>">
				          </div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Tinggi</label>
				              <input type="number" name="panjang" class="form-control" id="tinggi" placeholder="Tinggi" maxlength="5" value="<?php echo $dataedit["pengukuran_detail_tinggi"];?>">
				          </div>
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Lebar</label>
				              <input type="number" name="lebar" class="form-control" id="lebar" placeholder="Lebar" maxlength="5" value="<?php echo $dataedit["pengukuran_detail_lebar"];?>">
				          </div>
				          <?php
				            
				            if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {

				              if ($data['jenis_nama']=='Gorden & Vitras'){
				              ?>
				                <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				                  <label>KT/E</label>
				                  <select class="form-control" name="kt">
				                  <?php
				                  $selected = "";
				                  $ktarray=array("G:KT/V:E","G:KT/V:KT","G:E/V:E","G:E/V:KT");
				                  for ($i=0; $i < count($ktarray) ; $i++) { 
				                    if ($dataedit["pengukuran_detail_kt"]==$ktarray[$i]) {
				                         # code...
				                        $selected = "selected";
				                      } else {
				                        $selected = "";
				                      }
				                    echo "<option value='".$ktarray[$i]."' ".$selected.">".$ktarray[$i]."</option>";
				                  }
				                  ?>
				                  </select>
				                </div>
				                <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				                  <label>Rel Alat Gorden</label>
				                  <select class="form-control" name="relalat1">
				                    <option value="" >Pilih Alat Rel 1</option>
				                    <?php
				                    $selected = "";
				                    $rel1array=array("Rolet","Delux","Lengkung");
				                    for ($i=0; $i < count($rel1array) ; $i++) {
				                      if ($dataedit["pengukuran_detail_alat_1"]==$rel1array[$i]) {
				                         # code...
				                        $selected = "selected";
				                      } else {
				                        $selected = "";
				                      } 
				                      echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
				                    }
				                    ?>
				                  </select>
				                </div>
				                <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				                  <label>Rel Alat Vitras</label>
				                  <select class="form-control" name="relalat2">
				                    <option value="" >Pilih Alat Rel 2</option>
				                    <?php
				                    $selected = "";
				                    $rel1array=array("Rolet","Delux","Lengkung");
				                    for ($i=0; $i < count($rel1array) ; $i++) {
				                      if ($dataedit["pengukuran_detail_alat_2"]==$rel1array[$i]) {
				                         # code...
				                        $selected = "selected";
				                      } else {
				                        $selected = "";
				                      } 
				                      echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
				                    }
				                    ?>
				                  </select>
				                </div>

				              <?php
				              } else {
				              ?>
				                <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				                  <label>KT/E</label>
				                  <select class="form-control" name="kt">
				                  <?php
				                  $selectedkt = "";
				                  $selectede = "";
				                  if ($dataedit["pengukuran_detail_kt"]=="KT") {
				                   # code...
				                    $selectedkt = "selected";
				                  } elseif ($dataedit["pengukuran_detail_kt"]=="E") {
				                    $selectede = "selected";
				                  }

				                  ?>
				                    <option value="KT" <?php echo $selectedkt; ?>>KT</option>
				                    <option value="E" <?php echo $selectede; ?>>E</option>
				                  </select>
				                </div>
				                <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				                  <label>Rel Alat</label>
				                  <select class="form-control" name="relalat1">
				                    <option value="" >Pilih Alat Rel 1</option>
				                    <?php
				                    $selected = "";
				                    $rel1array=array("Rolet","Delux","Lengkung");
				                    for ($i=0; $i < count($rel1array) ; $i++) {
				                      if ($dataedit["pengukuran_detail_alat_1"]==$rel1array[$i]) {
				                         # code...
				                        $selected = "selected";
				                      } else {
				                        $selected = "";
				                      } 
				                      echo "<option value='".$rel1array[$i]."' ".$selected.">".$rel1array[$i]."</option>";
				                    }
				                    ?>
				                  </select>
				                </div>

				                <input type="hidden" name="relalat2" class="form-control" value="">
				              <?php
				              }
				              ?>
				          
				          <div class="col-md-6 col-md-offset-0 col-custom-left form-group">
				            <label>Rel/Alat Warna</label>
				            <select class="form-control" name="relwarna">
				              <option value="">Pilih Warna</option>
				              <?php
				              $selected = "";
				              $warnaarray=array("Putih","Coklat Kayu","Gold","Silver","Black","Lengkuy");
				              for ($i=0; $i < count($warnaarray) ; $i++) {
				                if ($dataedit["pengukuran_detail_alat_warna"]==$warnaarray[$i]) {
				                 # code...
				                  $selected = "selected";
				                } else {
				                  $selected = "";
				                }   
				                echo "<option value='".$warnaarray[$i]."' ".$selected.">".$warnaarray[$i]."</option>";
				              }
				              ?>
				            </select>
				          </div>
				          <?php
				          }
				          ?>
				            <input type="hidden" name="kualitas" class="form-control" value="<?php echo $dataedit["pengukuran_detail_kualitas"];?>">
				          <div class="form-group">
				              <input type="submit" class="btn btn-success pull-right btn-lg" value="Edit" name="editpengukurandetail" style="font-size: 14px;">
				          </div>
				        </form>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	</div>
	<?php

} elseif ($_GET['menu']=='detailpemasangan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Pemasangan
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);



					  $tanggalpasang = $data['pengukuran_tanggal_deal'];

					  $tanggalpasang1 = date('d-m-Y', strtotime($tanggalpasang . ' +14 day'));
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table>
								<tr>
									<td width="100px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $data["email"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td>:</td>
									<td><?php echo $data["telepon"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_status"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Tanggal Pasang</td>
									<td>:</td>
									<td><?php echo $tanggalpasang1; ?></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan="2">
										
									    <input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
									<?php
									if ($data["pengukuran_status"]=='Selesai Finishing') {
										# code...
									?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Proses Pemasangan">
		                      			<input type="submit" class="btn btn-success" value="Proses Pemasangan" name="gantistatuspasang" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Proses Pemasangan'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Selesai Pemasangan">
		                      			<input type="submit" class="btn btn-success" value="Selesai Pemasangan" name="gantistatuspasang" style="margin: 0px auto;">
									<?php
									}
									?>
									
									</td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="2">
										<a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-left btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Invoice</a><br>
									    <a href="pdf/save-pdf-pemasangan.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Form Pemasangan</a>
									</td>
								</tr>
							
							</table>
						</form>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
		              	<table id="listbarang" class="table table-bordered table-striped custom1">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="200px">Ruang</th>
		                      <th rowspan="2">Jenis<br>G/V/BL</th>
		                      <th rowspan="2">Kode<br>Bahan</th>
		                      <th rowspan="2">model</th>
		                      <th colspan="2">Ukuran</th>
		                      <th rowspan="2">Jumlah</th>
		                      <th rowspan="2">KT/E</th>
		                      <th colspan="2">Rel/Alat</th>
		                    </tr>
		                    <tr>
		                      <th>T</th>
		                      <th>L</th>
		                      <th>Warna</th>
		                      <th>Ukuran</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {
								$kode1="";
								if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
									# code...
									$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
								}
		                      ?>
		                        <tr>
		                          <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
		                          <td><?php echo $datatea["jenis_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kode_bahan"].''.$kode1; ?></td>
		                          <td><?php echo $datatea["model_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_alat_warna"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_alat_ukuran"]; ?></td>
		                        </tr>
		                      <?php
		                      }
		                      echo mysql_error();
		                      ?>

		                    </tbody>
		                </table>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='detailsteamer') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);

						$tanggaldeal = $data['pengukuran_tanggal_deal'];

						$tanggaldeal = date('d-m-Y', strtotime($tanggaldeal . ' +10 day'));
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table>
								<tr>
									<td width="100px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
								</tr>
								<tr>
									<td>Kualitas</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_kualitas"]; ?></td>
									<td>
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_status"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Tanggal Selesai</td>
									<td>:</td>
									<td><?php echo $tanggaldeal; ?></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan="2">
										
									    <input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
									<?php
									if ($data["pengukuran_status"]=='Selesai Jahit') {
										# code...
									?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Proses Steamer">
		                      			<input type="submit" class="btn btn-success" value="Proses Steamer" name="gantistatusjahit" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Proses Steamer'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Selesai Steamer">
		                      			<input type="submit" class="btn btn-success" value="Selesai Steamer" name="gantistatusjahit" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Selesai Steamer') {
										# code...
									?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Proses Finishing">
		                      			<input type="submit" class="btn btn-success" value="Proses Finishing" name="gantistatusjahit" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Proses Finishing'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Selesai Finishing">
		                      			<input type="submit" class="btn btn-success" value="Selesai Finishing" name="gantistatusjahit" style="margin: 0px auto;">
									<?php
									}
									?>
									
									</td>
								</tr>
								<tr>
									<td colspan="2">
									</td>
									<td colspan="2">
										<a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-left btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Invoice</a><br>
									    <a href="pdf/save-pdf-jahit.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-left btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Form Jahit</a>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
		              	<table id="listbarang" class="table table-bordered table-striped custom1">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="200px">Ruang</th>
		                      <th rowspan="2">Jenis<br>G/V/BL</th>
		                      <th rowspan="2">Kode<br>Bahan</th>
		                      <th rowspan="2">Model</th>
		                      <th rowspan="2">KT/E</th>
		                      <th colspan="2">Ukuran</th>
		                      <th rowspan="2">Jumlah</th>
		                    </tr>
		                    <tr>
		                      <th>T</th>
		                      <th>L</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {
		                      	$kode1="";
								if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
									# code...
									$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
								}
		                      ?>
		                        <tr>
		                          <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
		                          <td><?php echo $datatea["jenis_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kode_bahan"].''.$kode1; ?></td>
		                          <td><?php echo $datatea["model_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
		                        </tr>
		                      <?php
		                      }
		                      echo mysql_error();
		                      ?>

		                    </tbody>
		                </table>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='detailpotong') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);

						$tanggaldeal = $data['pengukuran_tanggal_deal'];

						$tanggaldeal = date('d-m-Y', strtotime($tanggaldeal . ' +10 day'));
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table>
								<tr>
									<td width="100px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Kualitas</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_kualitas"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_status"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Tanggal Selesai</td>
									<td>:</td>
									<td><?php echo $tanggaldeal; ?></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan="2">
										
									    <input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
									<?php
									if ($data["pengukuran_status"]=='Mulai Potong') {
										# code...
									?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Proses Potong">
		                      			<input type="submit" class="btn btn-success" value="Proses Pemotongan" name="gantistatuspotong" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Proses Potong'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Selesai Potong">
		                      			<input type="submit" class="btn btn-success" value="Selesai Pemotongan" name="gantistatuspotong" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Selesai Potong'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Proses Jahit">
		                      			<input type="submit" class="btn btn-success" value="Proses Jahit" name="gantistatuspotong" style="margin: 0px auto;">
									<?php
									} elseif ($data["pengukuran_status"]=='Proses Jahit'){
										# code...
										?>
									    <input type="hidden" name="status" class="form-control" id="status" value="Selesai Jahit">
		                      			<input type="submit" class="btn btn-success" value="Selesai Jahit" name="gantistatuspotong" style="margin: 0px auto;">
									<?php
									}
									?>
									
									</td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="2">
										<a href="pdf/save-pdf-penawaran.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-left btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Invoice</a><br>
									    <a href="pdf/save-pdf-jahit.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Form Jahit</a>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
		              	<table id="listbarang" class="table table-bordered table-striped custom1">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="200px">Ruang</th>
		                      <th rowspan="2">Jenis<br>G/V/BL</th>
		                      <th rowspan="2">Kode<br>Bahan</th>
		                      <th rowspan="2">Model</th>
		                      <th rowspan="2">KT/E</th>
		                      <th rowspan="2">Jumlah</th>
		                      <th colspan="2">Ukuran</th>
		                    </tr>
		                    <tr>
		                      <th>T</th>
		                      <th>L</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {
		                      	$kode1="";
								if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
									# code...
									$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
								}
		                      ?>
		                        <tr>
		                          <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
		                          <td><?php echo $datatea["jenis_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kode_bahan"].''.$kode1; ?></td>
		                          <td><?php echo $datatea["model_nama"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
		                          <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
		                        </tr>
		                      <?php
		                      }
		                      echo mysql_error();
		                      ?>

		                    </tbody>
		                </table>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='detailorderbahan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table>
								<tr>
									<td width="100px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $data["email"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td>:</td>
									<td><?php echo $data["telepon"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_status"]; ?></td>
									<td> 
									    <input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
		                      			<input type="submit" class="btn btn-success" value="Mulai Pemotongan" name="gantistatusmulaipotong" style="margin: 0px auto;">
		                      		</td>
								</tr>
								<tr>
									<td>Kualitas</td>
									<td>:</td>
									<td><?php echo $data["pengukuran_kualitas"]; ?></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td>
									    <a href="pdf/order-bahan.php?id=<?php echo $data['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Order Bahan</a>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<!-- /.box-header -->
					<?php
						if ($data["pengukuran_kualitas"]=='Premium') {
							# code...
							$ketkualitas = 3;
						} elseif ($data["pengukuran_kualitas"]=='Gold') {
							# code...
							$ketkualitas = 2.6;
						} else {
							# code...
							$ketkualitas = 2.3;
						}
						
	                    $sqlte8="SELECT pengukuran_detail_kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan";
						$queryte8=mysql_query($sqlte8);
						while ($datatea8=mysql_fetch_array($queryte8)) {
							
						}
					?>
		            <div class="box-body" style="overflow-x: auto;">
		              	<table id="listbarang" class="table table-bordered table-striped custom1">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="200px">Ruang</th>
		                      <th colspan="2" style="text-align: center;">Ukuran</th>
		                      <th rowspan="2" width="40px">Jumlah</th>
		                      <?php
			                    $databahan1[][]= array();
				            	$yy = 0;
			                    $sqlte7="SELECT pengukuran_detail_kode_bahan_1, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan_1";
								$queryte7=mysql_query($sqlte7);
								while ($datatea7=mysql_fetch_array($queryte7)) {
									if ($datatea7["pengukuran_detail_kode_bahan_1"]!='') {
										# code...

				                      $databahan1[$yy][0] = $datatea7["pengukuran_detail_kode_bahan_1"]; 
										$yy++;	
				                      echo '<th rowspan="2" width="40px">'.$datatea7["pengukuran_detail_kode_bahan_1"].'</th>';
									
									}
								}
								$jb1 = count($databahan1);

								$databahan[][]= array();
				            	$y = 0;
			                    $sqlte8="SELECT pengukuran_detail_kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan";
								$queryte8=mysql_query($sqlte8);
								while ($datatea8=mysql_fetch_array($queryte8)) {

									if ($datatea8["pengukuran_detail_kode_bahan"]!='') {
										$databahan[$y][0] = $datatea8["pengukuran_detail_kode_bahan"]; 
										$y++;	
				                      echo '<th rowspan="2" width="40px">'.$datatea8["pengukuran_detail_kode_bahan"].'</th>';
				                  }
								
								}
								$jb = count($databahan);

								$datajumlahbahan[][]= array();
				            	$y1 = 0;
			                    $sqlta="SELECT order_bahan_kode_bahan_1, SUM(order_bahan_jumlah_kode_bahan_1) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_kode_bahan_1";
								$queryta=mysql_query($sqlta);
								while ($dataa=mysql_fetch_array($queryta)) {

									if ($dataa["order_bahan_kode_bahan_1"]!='') {
										$datajumlahbahan[$y1][0] = $dataa["order_bahan_kode_bahan_1"];
										$datajumlahbahan[$y1][1] = $dataa["jumlah"]; 
										$y1++;	
				                  }
								
								}
								$djb = count($datajumlahbahan);

								$datajumlahbahan[][]= array();
				            	$y11 = 0;
			                    $sqlta1="SELECT order_bahan_kode_bahan_2, SUM(order_bahan_jumlah_kode_bahan_2) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_kode_bahan_2";
								$queryta1=mysql_query($sqlta1);
								while ($dataa1=mysql_fetch_array($queryta1)) {

									if ($dataa1["order_bahan_kode_bahan_2"]!='') {
										$datajumlahbahan1[$y11][0] = $dataa1["order_bahan_kode_bahan_2"];
										$datajumlahbahan1[$y11][1] = $dataa1["jumlah"]; 
										$y11++;	
				                  }
								
								}
								$djb1 = count($datajumlahbahan1);


								$datajumlahrel[][]= array();
				            	$z1 = 0;
			                    $sqltb="SELECT order_bahan_rel_alat_1, SUM(order_bahan_jumlah_rel_alat_1) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_rel_alat_1";
								$queryb=mysql_query($sqltb);
								while ($datab=mysql_fetch_array($queryb)) {

									if ($datab["order_bahan_rel_alat_1"]!='') {
										$datajumlahrel[$z1][0] = $datab["order_bahan_rel_alat_1"];
										$datajumlahrel[$z1][1] = $datab["jumlah"]; 
										$z1++;	
				                  }
								
								}
								$djr = count($datajumlahrel);

								$datajumlahrel1[][]= array();
				            	$z11 = 0;
			                    $sqltb1="SELECT order_bahan_rel_alat_2, SUM(order_bahan_jumlah_rel_alat_2) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_rel_alat_2";
								$queryb1=mysql_query($sqltb1);
								while ($datab1=mysql_fetch_array($queryb1)) {

									if ($datab1["order_bahan_rel_alat_2"]!='') {
										$datajumlahrel1[$z11][0] = $datab1["order_bahan_rel_alat_2"];
										$datajumlahrel1[$z11][1] = $datab1["jumlah"]; 
										$z11++;	
				                  }
								
								}
								$djr1 = count($datajumlahrel1);

								/*
								$datarel[][]= array();
				            	$yyy = 0;
			                    $sqlte5="SELECT pengukuran_detail_alat_1 from pengukuran_detail where pengukuran_id='$idnot' GROUP BY pengukuran_detail_alat_1";
								$queryte5=mysql_query($sqlte5);
								while ($datatea5=mysql_fetch_array($queryte5)) {

									if ($datatea5["pengukuran_detail_alat_1"]!='') {
										$datarel[$yyy][0] = $datatea5["pengukuran_detail_alat_1"]; 
										$yyy++;	
				                      echo '<th rowspan="2" width="40px">'.$datatea5["pengukuran_detail_alat_1"].'</th>';
				                  }
								
								}
								$jr = count($datarel);

								$datarel1[][]= array();
				            	$yyyy = 0;
			                    $sqlte4="SELECT pengukuran_detail_alat_2 from pengukuran_detail where pengukuran_id='$idnot' GROUP BY pengukuran_detail_alat_2";
								$queryte4=mysql_query($sqlte4);
								while ($datatea4=mysql_fetch_array($queryte4)) {

									if ($datatea4["pengukuran_detail_alat_2"]!='') {
										$datarel1[$yyyy][0] = $datatea4["pengukuran_detail_alat_2"]; 
										$yyyy++;	
				                      echo '<th rowspan="2" width="40px">'.$datatea4["pengukuran_detail_alat_2"].'</th>';
				                  }
								
								}
								$jr1 = count($datarel1);
								*/

								?>
							  <th colspan="3" style="text-align: center;">Rel</th>
		                      <th rowspan="2" width="100px">Status</th>
		                      <th rowspan="2" width="100px">Action</th>
		                    </tr>
		                    <tr>
		                      <th style="text-align: center;" width="40px">Tinggi</th>
		                      <th style="text-align: center;" width="40px">Lebar</th>
		                      <th style="text-align: center;" width="40px">Rolet</th>
		                      <th style="text-align: center;" width="40px">Delux</th>
		                      <th style="text-align: center;" width="40px">Lengkung</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                    if ($data["pengukuran_kualitas"]=='Premium') {
		                    	# code...
		                    	$t = 3;
		                    } elseif ($data["pengukuran_kualitas"]=='Gold') {
		                    	$t = 2.6;
		                    }else {
		                    	# code...
		                    	$t = 2.3;
		                    }

			            	$datajenis[][]= array();
			            	$z = 0;
		                    $sqlte9="SELECT jenis_nama from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY jenis_id";
		                      $queryte9=mysql_query($sqlte9);
		                      while ($datatea9=mysql_fetch_array($queryte9)) {
		                      	$datajenis[$z][0] = $datatea9["jenis_nama"]; 
		                      	$z++;
		                      }

		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {

			                      $sqlte2="SELECT * from order_bahan where order_bahan_detail_pengukuran_id='$datatea[pengukuran_detail_id]'";
			                      $queryte2=mysql_query($sqlte2);
			                      $data2=mysql_fetch_array($queryte2);
			                      if ($data2['order_bahan_lebar']!=0) {
			                      	# code...
			                      	$panjang = $data2['order_bahan_lebar'];
			                      } else {
			                      	# code...
			                      	$panjang = $datatea["pengukuran_detail_lebar"]*$t;
			                      }
		                      
		                      ?>
		                        <tr>
	                        	<form action="aksi/transaksi.aksi.php" method="post">
		                          <td><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
		                          <td style="text-align: center;"><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
		                          <td style="text-align: center;"><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
		                          <td style="text-align: center;"><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
		                        <?php
		                        $kk = 0;
		                        while ($kk < $jb1) {
		                        	# code...
		                        	if ($databahan1[$kk][0]==$datatea["pengukuran_detail_kode_bahan_1"]) {
		                        		# code...
		                        	?>
		                        	<td>
		                        		<input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
									    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $datatea['pengukuran_detail_id']; ?>">
									    <input type="hidden" name="kodebahan1" class="form-control" id="kodebahan1" value="<?php echo $datatea['pengukuran_detail_kode_bahan_1']; ?>">
									    <?php
									    	if ($data2['order_bahan_kode_bahan_2']!='' ) {
			                      			?>
			                      				
										    <input type="text" name="jumlah_1" class="form-control" id="jumlah_1" value="<?php echo $data2["order_bahan_jumlah_kode_bahan_2"] ;?>" style="max-width: 100px;">

			                      			<?php
			                      			} else {
			                      			?>

										    <input type="text" name="jumlah_1" class="form-control" id="jumlah_1" value="<?php echo $datatea['pengukuran_detail_lebar']*$ketkualitas*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">

			                      			<?php
			                      			}
									    ?>
									</td>
		                        	<?php
		                        	} else {
		                        		if ($yy!=0) {
		                        			
		                        		echo '<td><input type="hidden" name="jumlah1" class="form-control" id="jumlah1" value="" style="max-width: 100px;"><input type="hidden" name="kodebahan1" class="form-control" id="kodebahan1" value="" style="max-width: 100px;"></td>';
		                        	
            		                  	}
		                        	}
		                        	$kk++;
		                        }

		                        $k = 0;
		                        while ($k < $jb) {
		                        	# code...
		                        	if ($databahan[$k][0]==$datatea["pengukuran_detail_kode_bahan"]) {
		                        		# code...
		                        	?>
		                        	<td>
		                        		<input type="hidden" name="idpengukuran" class="form-control" id="idpengukuran" value="<?php echo $data['pengukuran_id']; ?>">
									    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $datatea['pengukuran_detail_id']; ?>">
									    <input type="hidden" name="kodebahan" class="form-control" id="kodebahan" value="<?php echo $datatea['pengukuran_detail_kode_bahan']; ?>">
		                        		<?php
									    	if ($data2['order_bahan_kode_bahan_1']!='' ) {
			                      			?>
			                      				
										    <input type="text" name="jumlah" class="form-control" id="jumlah_1" value="<?php echo $data2["order_bahan_jumlah_kode_bahan_1"] ;?>" style="max-width: 100px;">

			                      			<?php
			                      			} else {
			                      			?>

										    <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?php echo $datatea['pengukuran_detail_lebar']*$ketkualitas*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">

			                      			<?php
			                      			}
									    ?>

									</td>
		                        	<?php
		                        	} else {
		                        		if ($y!=0) {
		                        			echo "<td></td>";
            		                  	}
		                        	}
		                        	$k++;
		                        }

		                        if ("Rolet"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat1" class="form-control" id="relalat1" value="<?php echo 'Rolet';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_1']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $data2["order_bahan_jumlah_rel_alat_1"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} elseif ("Rolet"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat2" class="form-control" id="relalat2" value="<?php echo 'Rolet';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_2']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlahrelalat2" value="<?php echo $data2["order_bahan_jumlah_rel_alat_2"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlah" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} else {
	                        		echo "<td></td>";
	                        	
	                        	}

		                        if ("Delux"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat1" class="form-control" id="relalat1" value="<?php echo 'Delux';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_1']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $data2["order_bahan_jumlah_rel_alat_1"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} elseif ("Delux"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat2" class="form-control" id="relalat2" value="<?php echo 'Delux';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_2']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlahrelalat2" value="<?php echo $data2["order_bahan_jumlah_rel_alat_2"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlah" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} else {
	                        		echo "<td></td>";
	                        	
	                        	}

		                        if ("Lengkung"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat1" class="form-control" id="relalat1" value="<?php echo 'Lengkung';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_1']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $data2["order_bahan_jumlah_rel_alat_1"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat1" class="form-control" id="jumlahrelalat1" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} elseif ("Lengkung"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	?>
	                        	<td>
								    <input type="hidden" name="relalat2" class="form-control" id="relalat2" value="<?php echo 'Lengkung';?>">
	                        		<?php
	                        		if ($data2['order_bahan_rel_alat_2']!='' ) {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlahrelalat2" value="<?php echo $data2["order_bahan_jumlah_rel_alat_2"] ;?>" style="max-width: 100px;">
	                        		<?php
			                      	} else {
			                      	?>
	                        		<input type="text" name="jumlahrelalat2" class="form-control" id="jumlah" value="<?php echo $datatea['pengukuran_detail_lebar']*$datatea["pengukuran_detail_jumlah"] ;?>" style="max-width: 100px;">
	                        		<?php } ?>
								</td>
	                        	<?php
	                        	} else {
	                        		echo "<td></td>";
	                        	
	                        	}
		                        ?>

		                          <td style="text-align: center;"><?php echo $data2["order_bahan_status"]; ?></td>
		                          <td>
		                      			<?php 
		                      			if ($data2['order_bahan_kode_bahan_1']!='' ) {
		                      				# code...
		                      			?>
										    <input type="hidden" name="idorder" class="form-control" id="idpengukuran" value="<?php echo $data2['order_bahan_id']; ?>">
			                      			<input type="submit" class="btn btn-primary" value="Cek" name="cekorderbahan" style="margin: 0px auto;">
		                      			<?php
		                      			} else {
		                      			?>
			                      			<input type="submit" class="btn btn-success" value="Proses" name="orderbahan" style="margin: 0px auto;">
		                      			<?php
		                      			}

		                      			?>
		                      		</td>
			                      </form>
		                        </tr>
		                      <?php
		                      }
		                      echo mysql_error();
		                      ?>
		                      <tr>
		                      	<td colspan="4">Jumlah</td>
		                      	<?php
		                      	
		                      	for ($i=0; $i < $jb1; $i++) { 
		                      		# code...
		                      		for ($j=0; $j < $djb1 ; $j++) { 
		                      			# code...
		                      			if ($databahan1[$i][0]==$datajumlahbahan1[$j][0]) {
		                        		?>
			                        	<td>
			                        		<?php echo $datajumlahbahan1[$j][1]; ?>
										</td>
			                        	<?php	
		                        		}
		                      		}
		                      	}

		                      	for ($i=0; $i < $jb; $i++) { 
		                      		# code...
		                      		for ($j=0; $j < $djb ; $j++) { 
		                      			# code...
		                      			if ($databahan[$i][0]==$datajumlahbahan[$j][0]) {
		                        		?>
			                        	<td>
			                        		<?php echo $datajumlahbahan[$j][1]; ?>
										</td>
			                        	<?php	
		                        		}
		                      		}
		                      	}

                      			$jmlrolet = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Rolet"==$datajumlahrel[$j][0]) {
	                        			$jmlrolet += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Rolet"==$datajumlahrel1[$j][0]) {
	                        			$jmlrolet += $datajumlahrel1[$j][1];
	                        		}	
	                      		}

	                      		?>
	                        	<td>
	                        		<?php echo $jmlrolet; ?>
								</td>
	                        	<?php	
                        		
                      			$jmldelux = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Delux"==$datajumlahrel[$j][0]) {
	                        			$jmldelux += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Delux"==$datajumlahrel1[$j][0]) {
	                        			$jmldelux += $datajumlahrel1[$j][1];
	                        		}	
	                      		}
	                      		?>
	                        	<td>
	                        		<?php echo $jmldelux; ?>
								</td>
	                        	<?php	

	                        	$jmllengkung = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Lengkung"==$datajumlahrel[$j][0]) {
	                        			$jmllengkung += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Lengkung"==$datajumlahrel1[$j][0]) {
	                        			$jmllengkung += $datajumlahrel1[$j][1];
	                        		}	
	                      		}
	                      		?>
	                        	<td>
	                        		<?php echo $jmllengkung; ?>
								</td>
		                      	
		                      </tr>
		                    </tbody>
		                </table>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

} elseif ($_GET['menu']=='detailbooking') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Booking
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Data Pelanggan</h3>
						<?php
                    	$idnot = $_GET['id'];
						$sqlte="SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id and booking_pengukuran_id=$idnot ";
						$queryte=mysql_query($sqlte);
						$data=mysql_fetch_array($queryte);

						$sqlte1="SELECT * from users_lain where id='$data[booking_pengukuran_user]'";
						$queryte1=mysql_query($sqlte1);
						$data1=mysql_fetch_array($queryte1);

						$sqlte2="SELECT * from pengukuran where pengukuran_pelanggan='$data[booking_pengukuran_pelanggan]'";
						$queryte2=mysql_query($sqlte2);
						$data2=mysql_fetch_array($queryte2);
						?>
						<br><br>

		                <form action="aksi/transaksi.aksi.php" method="post">	
							<table>
								<tr>
									<td>Tanggal</td>
									<td>:</td>
									<td><?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?></td>
								</tr>
								<tr>
									<td width="150px">Nama</td>
									<td width="20px">:</td>
									<td><?php echo $data["name"]; ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $data["email"]; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $data["alamat"]; ?></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td>:</td>
									<td><?php echo $data["telepon"]; ?></td>
								</tr>
								<tr>
									<td>Status</td>
									<td>:</td>
									<td><?php echo $data["booking_pengukuran_status"]; ?></td>
								</tr>
								<?php
								if ($_SESSION['role']=='admin'||$_SESSION['role']=='owner') {
									# code...

									if ($data["booking_pengukuran_status"]=="Booking") {
										# code...
									?>	
									<input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
									<input type="hidden" name="idpelanggan" class="form-control" value="<?php echo $data['booking_pengukuran_pelanggan']; ?>">
									<tr>
										<td>Tanggal Booking</td>
										<td>:</td>
										<td>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask="" value="<?php echo date('d-m-Y', strtotime($data['booking_pengukuran_tanggal_booking'] . ' +0 day')); ?>">
								                </div>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td>
										    <input type="submit" class="btn btn-success pull-right btn-lg" value="Proses Folow Up" name="gantistatusbooking" style="    padding: 5px 16px;font-size: 13px; margin-top: 10px;">
										</td>
									</tr>
									<?php
									} else {
									?>	
									<input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
									<tr>
										<td>Tanggal Booking</td>
										<td>:</td>
										<td>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</div>
													<input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask="" value="<?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?>">
								                </div>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2"></td>
										<td>
										    <input type="submit" class="btn btn-success pull-right btn-lg" value="Ganti Tanggal" name="gantitanggalbooking" style="    padding: 5px 16px;font-size: 13px; margin-top: 10px;">
										</td>
									</tr>
									<?php
									if ($data['booking_pengukuran_status']=='Follow Up') {
										?>
									<tr>
										<td colspan="2"></td>
										<td><br>
									        <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
											<input type="hidden" name="idpelanggan" class="form-control" value="<?php echo $data['booking_pengukuran_pelanggan']; ?>">
						                	<input type="submit" class="btn btn-primary pull-right" value="Proses Pengukuran" name="prosesukur">
									
										</td>
									</tr>
									<?php
									}
									
									}
								} elseif ($_SESSION['role']=='pengukur') {
									# code...
								?>
									<tr>
										<td>Petugas</td>
										<td>:</td>
										<td><?php echo $data1["name"]; ?></td>
									</tr>
									<?php 
									if ($data["booking_pengukuran_status"]=="Follow Up") {
									?>
									<tr>
										<td colspan="2"></td>
										<td>
											<form action="aksi/transaksi.aksi.php" method="post">
								                <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
												<input type="hidden" name="idpelanggan" class="form-control" value="<?php echo $data['booking_pengukuran_pelanggan']; ?>">
							                	<input type="submit" class="btn btn-primary" value="Proses" name="prosesukur">
											</form>
										</td>
									</tr>

								<?php
									} else {
									?>

									<td colspan="2">
									    <a href="pdf/save-pdf-ukur.php?id=<?php echo $data2['pengukuran_id'];?>" target="_blank" class="btn btn-primary pull-right btn-lg"  style="padding: 5px 16px;font-size: 13px; margin-top: 10px;">Download Form Ukur</a>
									</td>

									<?php
									}
								}
								
								?>
							</table>
						</form>
					</div>
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='inputpengukuran') {
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Dashboard
		    <small><?php echo $tgl ; ?></small>
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			<?php 
			$iduser = $_SESSION['login_user'];
			$query=mysql_query("SELECT count(pengukuran_id) as jumlah, sum(pengukuran_total_harga) as total from pengukuran where pengukuran_tanggal='$tgl1' group by pengukuran_tanggal ");
			$datatea=mysql_fetch_array($query);

			?>
	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Input Pengukuran</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
					<table id="example1" class="table table-bordered table-striped ">
		                <thead>
		                <tr>
		                  <th >Tanggal Booking</th>
		                  <th width="25%">Nama Pelanggan</th>
		                  <th>Status</th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php
		                	$sqlte="SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id order by booking_pengukuran_tanggal DESC ";
							$queryte=mysql_query($sqlte);
							while ($data=mysql_fetch_array($queryte)) {

			                	$sqlte1="SELECT name as nama_user from booking_pengukuran, users_lain where booking_pengukuran_user=id ";
								$queryte1=mysql_query($sqlte1);
								$data1=mysql_fetch_array($queryte1);
							?>
								<tr>
									<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?></a></td>
									<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo $data["name"]; ?></a></td>
									<td><a href="?menu=detailbooking&id=<?php echo $data['booking_pengukuran_id'];?>"><?php echo $data["booking_pengukuran_status"]; ?></a></td>
									<!--
									<td>
						                <form action="aksi/transaksi.aksi.php" method="post">
							                <input type="hidden" name="id" class="form-control" value="<?php echo $data['booking_pengukuran_id']; ?>">
						                	<input type="submit" class="btn btn-primary" value="Proses" name="prosesukur">
										</form>
									</td>
									-->
									
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='inputbooking') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Booking
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-4 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Booking</h3>
					</div>
					<div class="box-body">
					<?php

					$id = $_GET['id'];
					$sqlte1="SELECT * from users_lain, booking_pengukuran where id=booking_pengukuran_pelanggan and id='$id'";
					$queryte1=mysql_query($sqlte1);
					$datatea=mysql_fetch_array($queryte1);
					
					$d=date_create($datatea['booking_pengukuran_tanggal_booking']);
					$datebooking = date_format($d,'d-m-Y');

					$sqlte2="SELECT * from roles_lain where roles_nama='pelanggan'";
					$queryte2=mysql_query($sqlte2);
					$data2=mysql_fetch_array($queryte2);


					?>
				    <form action="aksi/user.aksi.php" method="post">
			      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
						<div class="form-group">
							<label>Nama Pelanggan</label>
							<select class="form-control select2" name="nama">
								<?php
									$sqltepel="SELECT * from users_lain, roles_lain where role=roles_id and roles_nama='pelanggan' ORDER BY id DESC";
									$querytepel=mysql_query($sqltepel);
									while($datapel=mysql_fetch_array($querytepel)) {
										echo "<option value='".$datapel["id"]."'>".$datapel["name"]." - ".$datapel["alamat"]."</option>";
									}

								?>
							</select>
						</div>
						<div class="form-group">
							<label>Tanggal Booking</label>
							<div class="input-group">
								<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="tanggal" id="datemask" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask="" value="">
			                </div>
						</div>

						<?php if($id == 0) { ?>
						<div class="form-group">
						    <input type="submit" class="btn btn-primary" value="Booking" name="booking">
						</div>
					    <?php } else { ?>
						<div class="form-group">
						    <input type="submit" class="btn btn-primary" value="Edit" name="edit">
						</div>
				    	<?php } ?>
					</form>
				    </div>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Booking</h3>
					</div>
					<div class="box-body">
					<table id="dashtable1" class="table table-bordered table-striped ">
			            <thead>
				            <tr>
								<th width="100px">Tanggal Booking</th>
								<th width="25%">Nama Pelanggan</th>
								<th>Alamat</th>
								<th>Status</th>
								<th></th>
							</tr>
			            </thead>
			            <tbody>
			            <?php
			            	$sqlte="SELECT * from booking_pengukuran, users_lain where booking_pengukuran_pelanggan=id order by booking_pengukuran_id DESC ";
							$queryte=mysql_query($sqlte);
							while ($data=mysql_fetch_array($queryte)) {

			                	$sqlte1="SELECT name as nama_user from booking_pengukuran, users_lain where booking_pengukuran_user=id";
								$queryte1=mysql_query($sqlte1);
								$data1=mysql_fetch_array($queryte1);
								if ($data['booking_pengukuran_status']=='Booking' || $data['booking_pengukuran_status']=='Follow Up') {
							?>
								<tr>
									<td><?php echo date('d-m-Y', strtotime($data["booking_pengukuran_tanggal_booking"] . ' +0 day')); ?></td>
									<td><?php echo $data["name"]; ?></td>
									<td><?php echo $data["alamat"]; ?></td>
									<td><?php echo $data["booking_pengukuran_status"]; ?></td>
									<td>
										<a href="?menu=detailbooking&id=<?php echo $data["booking_pengukuran_id"]; ?>" class="btn btn-primary">Follow Up</a>
										<a href="modul/user/deleteuser.php?id=<?php echo $data["booking_pengukuran_id"]; ?>&ket=booking" class="btn btn-danger">Delete</a>
									</td>
								</tr>

							<?php
								}
							}

			            ?>
			            </tbody>
			        </table>
					</div>
				</div>
			</div>

	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='inputpelanggan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Pelanggan
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-4 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Pelanggan</h3>
					</div>
					<div class="box-body">
					<?php

					$id = $_GET['id'];
					$sqlte1="SELECT * from users_lain, booking_pengukuran where id=booking_pengukuran_pelanggan and id='$id'";
					$queryte1=mysql_query($sqlte1);
					$datatea=mysql_fetch_array($queryte1);
					
					$d=date_create($datatea['booking_pengukuran_tanggal_booking']);
					$datebooking = date_format($d,'d-m-Y');

					$sqlte2="SELECT * from roles_lain where roles_nama='pelanggan'";
					$queryte2=mysql_query($sqlte2);
					$data2=mysql_fetch_array($queryte2);


					?>
				    <form action="aksi/user.aksi.php" method="post">
			      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
						<div class="form-group">
							<label>Nama</label>
						    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $datatea['name'] ; ?>">
						</div>
						<div class="form-group">
							<label>Email</label>
						    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $datatea['email'] ; ?>">
						</div>
						<div class="form-group">
							<label>Alamat</label>
						    <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo $datatea['alamat'] ; ?>">
						</div>
						<div class="form-group">
							<label>Telepon</label>
						    <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $datatea['telepon'] ; ?>">
						    <input type="hidden" name="role" class="form-control"  value="<?php echo $data2['roles_id'] ; ?>">
						</div>
						<?php if($id == 0) { ?>

						<div class="form-group">
						    <input type="submit" class="btn btn-primary" value="Tambah" name="tambah">
						</div>
					    <?php } else { ?>
						<div class="form-group">
						    <input type="submit" class="btn btn-primary" value="Edit" name="edit">
						</div>
				    	<?php } ?>
					</form>
				    </div>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List Pelanggan</h3>
					</div>
					<div class="box-body">
						<table id="table19" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>Nama</th>
			                  <th>Email</th>
						      <th>Alamat</th>
						      <th>Telepon</th>
						      <th></th>
			                </tr>
			                </thead>
			                <tbody>
		                	<?php
			                	$sqlte1="SELECT * from users_lain, roles_lain where role=roles_id and roles_nama='pelanggan' order by id DESC";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
								?>
									<tr>
										<td><?php echo $datatea["id"]; ?></td>
										<td><?php echo "<a href='?menu=detailpelanggan&id=".$datatea["id"]."'>".$datatea["name"]."</a>"; ?></td>
										<td><?php echo "<a href='?menu=detailpelanggan&id=".$datatea["id"]."'>".$datatea["email"]."</a>"; ?></td>
										<td><?php echo "<a href='?menu=detailpelanggan&id=".$datatea["id"]."'>".$datatea["alamat"]."</a>"; ?></td>
										<td><?php echo "<a href='?menu=detailpelanggan&id=".$datatea["id"]."'>".$datatea["telepon"]."</a>"; ?></td>
										<td>
											<a href="?menu=inputpelanggan&id=<?php echo $datatea["id"]; ?>" class="btn btn-primary">Edit</a>
											<a href="modul/user/deleteuser.php?id=<?php echo $datatea["id"]; ?>&ket=pelanggan" class="btn btn-danger">Delete</a>
										
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
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='detailpelanggan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Pelanggan
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">	        
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Progres Pengerjaan</h3>
					</div>
					<!-- /.box-header -->
		            <div class="box-body" style="overflow-x: auto;">
					<?php
					$idpelanggan=$_GET['id'];
                	$sqlte1="SELECT * from users_lain, pengukuran where id=pengukuran_pelanggan and id='$idpelanggan'";
					$queryte1=mysql_query($sqlte1);
					$data=mysql_fetch_array($queryte1);
					if ($data["pengukuran_status"]=="Booking") {
						# code...
						$booking="now";
					} elseif ($data["pengukuran_status"]=="Follow Up") {
						# code...
						$follow="now";
					} elseif ($data["pengukuran_status"]=="Pengukuran") {
						# code...
						$pengukuran="now";
					} elseif ($data["pengukuran_status"]=="Penawaran") {
						# code...
						$penawaran="now";
					} elseif ($data["pengukuran_status"]=="Order Bahan"||$data["pengukuran_status"]=="Deal") {
						# code...
						$order="now";
					} elseif ($data["pengukuran_status"]=="Potong"||$data["pengukuran_status"]=="Mulai Potong"||$data["pengukuran_status"]=="Proses Potong"||$data["pengukuran_status"]=="Selesai Potong") {
						# code...
						$potong="now";
					} elseif ($data["pengukuran_status"]=="Jahit"||$data["pengukuran_status"]=="Proses Jahit"||$data["pengukuran_status"]=="Selesai Jahit" ) {
						# code...
						$jahit="now";
					} elseif ($data["pengukuran_status"]=="Proses Steamer"||$data["pengukuran_status"]=="Selesai Steamer") {
						# code...
						$steamer="now";
					} elseif ($data["pengukuran_status"]=="Proses Finishing"||$data["pengukuran_status"]=="Selesai Finishing") {
						# code...
						$finishing="now";
					} elseif ($data["pengukuran_status"]=="Proses Pemasangan"||$data["pengukuran_status"]=="Selesai Pemasangan") {
						# code...
						$pemasangan="now";
					} elseif ($data["pengukuran_status"]=="Lunas") {
						# code...
						$selesai="now";
					}  else {
						# code...
					}
					
					?>
						<table class="custom1">
							<tr>
								<td width="100px">Nama</td>
								<td width="20px">:</td>
								<td><?php echo $data["name"]; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo $data["email"]; ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?php echo $data["alamat"]; ?></td>
							</tr>
							<tr>
								<td>No Telp</td>
								<td>:</td>
								<td><?php echo $data["telepon"]; ?></td>
							</tr>
							<tr>
								<td>Status</td>
								<td>:</td>
								<td><?php echo $data["pengukuran_status"]; ?></td>
							</tr>
						</table>
						<div class="box-progres">
							<hr>
							<div class="progres <?php echo $order ;?>" id="OrderBahan">Order Bahan</div>
							<div class="progres <?php echo $potong ;?>" id="Pemotongan">Pemotongan</div>
							<div class="progres <?php echo $jahit ;?>" id="Jahit">Penjahitan</div>
							<div class="progres <?php echo $steamer ;?>" id="Steamer">Steamer</div>
							<div class="progres <?php echo $finishing ;?>" id="Finishing">Finishing</div>
							<div class="progres <?php echo $pemasangan ;?>" id="Pemasangan">Pemasangan</div>
							<div class="progres <?php echo $selesai;?>" id="Selesai">Selesai</div>
						</div>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



}  elseif ($_GET['menu']=='hitungharga') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	   
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Hitung Harga</h3>
					</div>
					<div class="box-body">
					<?php include 'hitungharga1.php'; ?>
				    </div>
				</div>
			</div>

	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='user') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
	<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Detail Transaksi
	      </h1>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
			
	        <div class="col-md-4 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah User</h3>
					</div>
					<div class="box-body">
					<?php

					$id = $_GET['id'];
					$sqlte1="SELECT * from users_lain, roles_lain where roles_id=role and id='$id'";
					$queryte1=mysql_query($sqlte1);
					$datatea=mysql_fetch_array($queryte1);

					?>
				    <form action="aksi/user.aksi.php" method="post">
			      	<input type="hidden" name="id" value="<?php echo $id ; ?>">
						<div class="form-group">
							<label>Nama</label>
						    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $datatea['name'] ; ?>">
						</div>
						<div class="form-group">
							<label>Username</label>
						    <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $datatea['username'] ; ?>">
						</div>
						<div class="form-group">
							<label>Password</label>
						    <input type="password" name="password" class="form-control" placeholder="password" value="">
						</div>
					    <div class="form-group">
					    	<label>Posisi</label>
					        <select name="jenis" class="form-control">
				        	<?php if($id == 0) { ?>
				                <option value="admin">Admin</option>
				                <option value="pengukur">Tukang Ukur</option>
				                <option value="potong-jahit">Tukang Potong & Jahit</option>
				                <option value="steamer-finising">Tukang Steamer & Finishing</option>
			                <?php } else { 
			                	if($datatea['roles_nama'] == 'admin') {?>

				                <option value="admin" selected>Admin</option>
				                <option value="pengukur">Tukang Ukur</option>
				                <option value="potong-jahit">Tukang Potong & Jahit</option>
				                <option value="steamer-finising">Tukang Steamer & Finishing</option>

				                <?php } elseif($datatea['roles_nama'] == 'pengukur') { ?>
				                <option value="admin">Admin</option>
				                <option value="pengukur" selected>Tukang Ukur</option>
				                <option value="potong-jahit">Tukang Potong & Jahit</option>
				                <option value="steamer-finising">Tukang Steamer & Finishing</option>

				                <?php } elseif($datatea['roles_nama']=='potong-jahit') { ?>
				                <option value="admin">Admin</option>
				                <option value="pengukur">Tukang Ukur</option>
				                <option value="potong-jahit" selected>Tukang Potong & Jahit</option>
				                <option value="steamer-finising">Tukang Steamer & Finishing</option>

				                <?php } else { ?>
				                <option value="admin">Admin</option>
				                <option value="pengukur">Tukang Ukur</option>
				                <option value="potong-jahit">Tukang Potong & Jahit</option>
				                <option value="steamer-finising" selected>Tukang Steamer & Finishing</option>
				                <?php } ?>
			                <?php } ?>
				            </select>
					    </div>
						<div class="form-group">
						<?php if($id == 0) { ?>
						    <input type="submit" class="btn btn-primary" value="Tambah" name="tambahuser">
					    <?php } else { ?>
						    <input type="submit" class="btn btn-primary" value="Edit" name="edituser">

				    	<?php } ?>
						</div>
					</form>
				    </div>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">List User</h3>
					</div>
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th>Nama</th>
			                  <th>Username</th>
						      <th>Posisi</th>
						      <th></th>
			                </tr>
			                </thead>
			                <tbody>
		                	<?php
			                	$sqlte1="SELECT * from users_lain, roles_lain where role=roles_id";
								$queryte1=mysql_query($sqlte1);
								while ($datatea=mysql_fetch_array($queryte1)) {
									if ($datatea["roles_nama"]!='pelanggan') {
										# code...

										?>
											<tr>
												<td><?php echo $datatea["name"]; ?></td>
												<td><?php echo $datatea["username"]; ?></td>
												<td><?php echo $datatea["roles_display"]; ?></td>
												<td>
													<a href="admin.php?menu=user&id=<?php echo $datatea["id"]; ?>" class="btn btn-primary">Edit</a>
													<a href="modul/user/deleteuser.php?id=<?php echo $datatea["id"]; ?>&ket=user" class="btn btn-danger">Delete</a>
												
												</td>
											</tr>
										<?php
									}
									
								
								}

			                ?>
			                </tbody>
			            </table>
					</div>
				</div>
			</div>

	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='laporan') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
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
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Laporan Penjualan</h3>
						
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
		            <form action="aksi/laporan.aksi.php" method="post">
		              	<div class="form-group col-md-2 col-md-offset-0">
		              		<label>Filter Tanggal : </label>
		              		
					        <select name="bulan-1" class="form-control">
				                <option value="00">Pilih Bulan</option>
		              			<option value="01">Januari</option>
		              			<option value="02">Februari</option>
		              			<option value="03">Maret</option>
		              			<option value="04">April</option>
		              			<option value="05">Mei</option>
		              			<option value="06">Juni</option>
		              			<option value="07">Juli</option>
		              			<option value="08">Agustus</option>
		              			<option value="09">September</option>
		              			<option value="10">Oktober</option>
		              			<option value="11">November</option>
		              			<option value="12">Desember</option>
			                </select>
		                </div>
		              	<div class="form-group col-md-2 col-md-offset-0">
		              	<label>&nbsp; </label>
			                <select name="tahun-1" class="form-control">
				                <option value="">Pilih Tahun</option>
				                <option value="2018">2018</option>
				                <option value="2019">2019</option>
				                <option value="2020">2020</option>
				                <option value="2021">2021</option>
				                <option value="2017">2022</option>
			                </select>
		              	</div>
		              	<div class="form-group col-md-1 col-md-offset-0" style="text-align: center;margin-top: 30px;">
		              	<label>sd.</label>
		              		
		              	</div>
		              	<div class="form-group col-md-2 col-md-offset-0">
		              		<label>&nbsp; </label>
		              		
					        <select name="bulan-2" class="form-control">
				                <option value="00">Pilih Bulan</option>
		              			<option value="01">Januari</option>
		              			<option value="02">Februari</option>
		              			<option value="03">Maret</option>
		              			<option value="04">April</option>
		              			<option value="05">Mei</option>
		              			<option value="06">Juni</option>
		              			<option value="07">Juli</option>
		              			<option value="08">Agustus</option>
		              			<option value="09">September</option>
		              			<option value="10">Oktober</option>
		              			<option value="11">November</option>
		              			<option value="12">Desember</option>
			                </select>
		                </div>
		              	<div class="form-group col-md-2 col-md-offset-0">
		              	<label>&nbsp; </label>
			                <select name="tahun-2" class="form-control">
				                <option value="">Pilih Tahun</option>
				                <option value="2018">2018</option>
				                <option value="2019">2019</option>
				                <option value="2020">2020</option>
				                <option value="2021">2021</option>
				                <option value="2017">2022</option>
			                </select>
		              	</div>
		              	<div class="form-group col-md-2 col-md-offset-0">
		              		<label> &nbsp;</label><br>
					    	<input type="submit" class="btn btn-primary" value="Proses" name="bulanan">
					    </div>
	              	</form>
	              	<?php 
	              	if ($_GET['tanggal']!='') {
	              		# code...
						$text_line = explode("-",$_GET['tanggal']);
						$bulan = $text_line[0];
						$tahun = $text_line[1];
						$tahun1 = $text_line[1];
						$bln1 = $bulan - 1;
						if ($bln1==0) {
							# code...
							$bln1=12;
							$tahun1 = $tahun1 - 1;
						}
						if ($bln1<10) {
							# code...
							$bln1 = '0'.$bln1;
						}
	              		$tgl1=$tahun1.'-'.$bln1."-01";
	              		$tgl2=$tahun.'-'.$bulan.'-31';
	              		$t = $_GET['tanggal'];
              		?>
              		<table id="example2" class="table table-bordered table-striped">
		                <thead>
		                <tr>
		                  <th>Bulan</th>
		                  <!--<th>Total</th>
		                  <th>Diskon</th>-->
		                  <th>Omset</th>
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
		                	$query=mysql_query("SELECT pengukuran_bulan, sum(pengukuran_total_harga) as total, sum(pengukuran_diskon) as diskon from pengukuran where pengukuran_tanggal_deal between '%$tgl1%' and '%$tgl2%' group by pengukuran_bulan order by pengukuran_bulan ASC");
								while ($datatea=mysql_fetch_array($query)) {

								$t = $datatea["pengukuran_bulan"];
								$bersih = $datatea["total"] - $datatea["diskon"];
							
							?>
								<tr>
									<td><a href="?menu=laporandetail&tanggal=<?php echo $t; ?>"><?php echo $t; ?></a></td>
									<?php /*
									<td>Rp. <?php echo format_rupiah($datatea["total"]); ?></td>
									<td>Rp. <?php echo format_rupiah($datatea["diskon"]); ?></td>
									*/ ?>
									<td><a href="?menu=laporandetail&tanggal=<?php echo $t; ?>">Rp. <?php echo format_rupiah($bersih); ?></a></td>
								</tr>
							<?php
							}
						}

		                ?>
		                </tbody>
		            </table>
              		<?php
	              	} else {
	              		# code...
	              	}
	              	
	              	?>
		            </div>
		            <!-- /.box-body -->
				</div>
			</div>

	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}  elseif ($_GET['menu']=='laporandetail') {
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
	$tgl1=date('Y-m-d');
	?>
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
	      <div class="row">
			
	        <div class="col-md-12 col-md-offset-0">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Laporan Penjualan Detail</h3>
						
					</div>
					<!-- /.box-header -->
		            <div class="box-body">
		            <?php 
	              	$tgl = $_GET['tanggal'];
              		?>
              		<table id="" class="table table-bordered table-striped">
		                <thead>
		                <tr>
		                  <th>Tanggal</th>
		                  <th>Nama Pelanggan</th>
		                  <th>Keterangan</th>
		                  <th style="text-align: right;">Jumlah</th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php
			                $jml=0;
		                	$query=mysql_query("SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_tanggal_deal LIKE '%$tgl%'");
								while ($datatea=mysql_fetch_array($query)) {
								$jml+=$datatea["pengukuran_dp_awal"];
							?>
								<tr>
									<td><?php echo $datatea['pengukuran_tanggal_deal']; ?></td>
									<td><?php echo $datatea["name"]; ?></td>
									<td>DP</td>
									<td style="text-align: right;">Rp. <?php echo format_rupiah($datatea["pengukuran_dp_awal"]); ?></td>
								</tr>
							<?php
							}

							$query=mysql_query("SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_tanggal_lunas LIKE '%$tgl%'");
								while ($datatea=mysql_fetch_array($query)) {
								$jml+=$datatea["pengukuran_pelunasan"];
							?>
								<tr>
									<td><?php echo $datatea['pengukuran_tanggal_lunas']; ?></td>
									<td><?php echo $datatea["name"]; ?></td>
									<td>Pelunasan</td>
									<td style="text-align: right;">Rp. <?php echo format_rupiah($datatea["pengukuran_pelunasan"]); ?></td>
								</tr>
							<?php
							}
		                ?>
		            		<tr>
		            			<th colspan="3" style="border-top: 2px solid #000;">Total</th>
		            			<th style="text-align: right;border-top: 2px solid #000;">Rp. <?php echo format_rupiah($jml); ?></th>
		            		</tr>
		                </tbody>
		            </table>
              		</div>
		            <!-- /.box-body -->
				</div>
			</div>

	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	  </div>



	<?php

}

?>