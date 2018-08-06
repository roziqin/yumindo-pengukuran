<!-- Custom Tabs -->
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#Booking" data-toggle="tab">Booking</a></li>
		<li><a href="#Pengukuran" data-toggle="tab">Pengukuran</a></li>
		<li><a href="#Penawaran" data-toggle="tab">Penawaran</a></li>
		<li><a href="#Orderbahan" data-toggle="tab">Order Bahan</a></li>
		<li><a href="#Pemotongan" data-toggle="tab">Pemotongan & Jahit</a></li>
		<li><a href="#Finishing" data-toggle="tab">Finishing</a></li>
		<li><a href="#Pemasangan" data-toggle="tab">Pemasangan</a></li>
		<li><a href="#Penagihan" data-toggle="tab">Penagihan</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="Booking">
			<table id="dashtable1" class="table table-bordered table-striped ">
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
					}

	            ?>
	            </tbody>
	        </table>
	    </div>
	    <!-- /.tab-pane -->
		<div class="tab-pane" id="Penawaran">
	    	<table id="dashtable2" class="table table-bordered table-striped ">
            <thead>
            <tr>
              <th width="100px">Tanggal</th>
              <th width="25%">Nama Pelanggan</th>
              <th>Email</th>
		      <th>Alamat</th>
              <th>Telepon</th>
              <th>Petugas</th>
              <th>Status</th>
              <th width="150px">Total Harga</th>
              <th width="150px">Dp</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_user=id order by pengukuran_id DESC ";
				$queryte=mysql_query($sqlte);
				while ($data=mysql_fetch_array($queryte)) {

					$idpel = $data["pengukuran_pelanggan"];
                	$sqlte1="SELECT * from users_lain where id='$idpel' ";
					$queryte1=mysql_query($sqlte1);
					$data1=mysql_fetch_array($queryte1);
					if ($data['pengukuran_status']=='Penawaran' || $data['pengukuran_status']=='Deal') {

				?>
					<tr>
						<td><?php echo date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day')); ?></td>
						<td><?php echo $data1["name"]; ?></td>
						<td><?php echo $data1["email"]; ?></td>
						<td><?php echo $data1["alamat"]; ?></td>
						<td><?php echo $data1["telepon"]; ?></td>
						<td><?php echo $data["name"]; ?></td>
						<td><?php echo $data["pengukuran_status"]; ?></td>
						<td>Rp <?php echo format_rupiah($data["pengukuran_total_harga"]); ?></td>
						<td>Rp <?php echo format_rupiah($data["pengukuran_dp"]); ?></td>
						<td>
							<a href="?menu=detail&id=<?php echo $data["pengukuran_id"]; ?>" class="btn btn-primary">Detail</a>
						</td>
					</tr>

				<?php
					}
				}

            ?>
            </tbody>
        </table>

		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="Pengukuran">
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
		<!-- /.tab-pane -->
		<div class="tab-pane" id="Orderbahan">
			<table id="dashtable4" class="table table-bordered table-striped ">
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
            	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_user=id and pengukuran_status='Deal' order by pengukuran_id DESC ";
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
		<!-- /.tab-pane -->
		<div class="tab-pane" id="Pemotongan">
			<table id="dashtable5" class="table table-bordered table-striped ">
	            <thead>
		            <tr>
			            <th width="200px">Tanggal Mulai Proses</th>
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

		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="Finishing">
			<table id="dashtable6" class="table table-bordered table-striped ">
	            <thead>
	            <tr>
	              <th width="200px">Tanggal Mulai Proses</th>
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

		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="Penagihan">
	    	<table id="dashtable7" class="table table-bordered table-striped ">
            <thead>
            <tr>
              <th width="100px">Tanggal</th>
              <th width="25%">Nama Pelanggan</th>
              <th>Email</th>
		      <th>Alamat</th>
              <th width="130px">Telepon</th>
              <th>Petugas</th>
              <th>Status</th>
              <th width="150px">Total Tagihan</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_user=id order by pengukuran_id DESC ";
				$queryte=mysql_query($sqlte);
				while ($data=mysql_fetch_array($queryte)) {

					$idpel = $data["pengukuran_pelanggan"];
                	$sqlte1="SELECT * from users_lain where id='$idpel' ";
					$queryte1=mysql_query($sqlte1);
					$data1=mysql_fetch_array($queryte1);
					if ($data['pengukuran_status']=='Selesai Pemasangan' || $data['pengukuran_status']=='Lunas') {

				?>
					<tr>
						<td><?php echo date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day')); ?></td>
						<td><?php echo $data1["name"]; ?></td>
						<td><?php echo $data1["email"]; ?></td>
						<td><?php echo $data1["alamat"]; ?></td>
						<td><?php echo $data1["telepon"]; ?></td>
						<td><?php echo $data["name"]; ?></td>
						<td><?php echo $data["pengukuran_status"]; ?></td>
						<td>Rp <?php echo format_rupiah($data["pengukuran_total_harga"]-$data["pengukuran_dp"]); ?></td>
						<td>
							<a href="?menu=detail&id=<?php echo $data["pengukuran_id"]; ?>" class="btn btn-primary">Detail</a>
						</td>
					</tr>

				<?php
					}
				}

            ?>
            </tbody>
        </table>

		</div>
		<!-- /.tab-pane -->
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
	            	$sqlte="SELECT * from pengukuran, users_lain where pengukuran_pelanggan=id and pengukuran_status='Deal' order by pengukuran_id DESC ";
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
		<!-- /.tab-pane -->
	</div>
	<!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
