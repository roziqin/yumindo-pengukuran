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
							<h3 class="box-title">Detail Gaji Pegawai	</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
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
		              		$tgl1=$tahun1.'-'.$bln1."-26";
		              		$tgl2=$tahun.'-'.$bulan.'-25';
		              		$id = $_GET['id'];
		              		$query = mysql_query("SELECT * FROM users where id='$id'");
		              		$data1 = mysql_fetch_array($query);
		              		
	              		?>
	              		<p>Nama Pegawai : <?php echo $data1['name'];?></p>
	              		<p>Jabatan : <?php echo $data1['role'];?></p>
	              		<p>Gaji Pokok : Rp. <?php echo format_rupiah($data1['gaji']);?></p>
	              		<?php
	              		if ($data1['role'] == 'admin') {
		              		$query1=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
								<p>Komisi Obat : Rp.<?php echo format_rupiah($data['obat']); ?></p>
							<?php
							}
							$query1=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
								<p>Komisi Tindakan : Rp.<?php echo format_rupiah($data['treatment']); ?></p>

							<?php
							}
	              		} elseif ($data1['role'] == 'bo') {
		              		$query1=mysql_query("SELECT  sum(transaksi_detail_komisi_bo) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
							
									<p>Komisi Obat : Rp.<?php echo format_rupiah($data['obat']); ?></p>


							<?php
							}
							$query1=mysql_query("SELECT  sum(transaksi_detail_komisi_bo) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
									<p>Komisi Tindakan : Rp.<?php echo format_rupiah($data['treatment']); ?></p>

							<?php
							}
	              		} elseif ($data1['role'] == 'dokter') {
		              		$query1=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
									<p>Komisi Obat : Rp.<?php echo format_rupiah($data['obat']); ?></p>

							<?php
							}
							$query1=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
							
							while ($data=mysql_fetch_array($query1)) {
							?>
									<p>Komisi Tindakan : Rp.<?php echo format_rupiah($data['treatment']); ?></p>

							<?php
							}
	              		}
	              		?>
	              		<table id="example2" class="table table-bordered table-striped">
	              			<thead>
	              			<tr>
	              				<th>Tanggal</th>
	              				<th>Nama Obat / Treatmen</th>
	              				<th>Jumlah Komisi</th>
	              			</tr>
	              			</thead>
			                <tbody>
	              			<?php
	              				if ($data1['role'] == 'admin') {
				              		$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_admin as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['obat']; ?></td>
										</tr>

									<?php
									}
									$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_admin as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['treatment']; ?></td>
										</tr>

									<?php
									}
			              		} elseif ($data1['role'] == 'bo') {
				              		$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_bo as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['obat']; ?></td>
										</tr>

									<?php
									}
									$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_bo as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['treatment']; ?></td>
										</tr>

									<?php
									}
			              		} elseif ($data1['role'] == 'dokter') {
				              		$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_dokter as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['obat']; ?></td>
										</tr>

									<?php
									}
									$query1=mysql_query("SELECT transaksi_tanggal, barang_nama, transaksi_detail_komisi_dokter as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
									
									while ($data=mysql_fetch_array($query1)) {
									?>
										<tr>
											<td><?php echo $data['transaksi_tanggal']; ?></td>
											<td><?php echo $data['barang_nama']; ?></td>
											<td><?php echo $data['treatment']; ?></td>
										</tr>

									<?php
									}
			              		} 
		              		?>
		              		</tbody>
	              		</table>
	              		<?php } ?>
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