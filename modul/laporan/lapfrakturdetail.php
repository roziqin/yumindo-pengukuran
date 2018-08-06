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
							<h3 class="box-title">Detail Fraktur</h3>
							
						</div>
						<!-- /.box-header -->
			            <div class="box-body">
			            <?php 
		              		$id = $_GET['id'];
		              		$query = mysql_query("SELECT * FROM transaksi_fraktur, farmasi, klinik_cabang, klinik where transaksi_fraktur_farmasi=farmasi_id and transaksi_fraktur_klinik_id=klinik_cabang_id and klinik_id=klinik_cabang_klinik_id and transaksi_fraktur_id='$id'");
		              		$data1 = mysql_fetch_array($query);
		              		
	              		?>
	              		<a href="?menu=lapfraktur" class="btn btn-success pull-right">Kembali</a>
	              		<table class="custom">
	              			<tr>
			              		<td>No Fraktur</td><td> : </td><td><?php echo $data1['transaksi_fraktur_no'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Nama Farmasi</td><td> : </td><td><?php echo $data1['farmasi_nama'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Nama Klinik</td><td> : </td><td><?php echo $data1['klinik_nama']." - ".$data1['klinik_cabang_alamat'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Jatuh Tempo</td><td> : </td><td><?php echo $data1['transaksi_fraktur_jatuh_tempo'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Tanggal Terkirim</td><td> : </td><td><?php echo $data1['transaksi_fraktur_tanggal_terkirim'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Tanggal Masuk</td><td> :</td><td> <?php echo $data1['transaksi_fraktur_tanggal'];?></td>
	              			</tr>
	              			<tr>
			              		<td>Jumlah yang harus dibayar</td><td> : </td><td><b>Rp. <?php echo format_rupiah($data1['transaksi_fraktur_total']);?></b></td>
	              			</tr>
	              			<?php
	              			if ($data1['transaksi_fraktur_status']==0) {
	              				# code...
              				?>

		              			<form action="aksi/laporan.aksi.php" method="post">
		              				<input type="hidden" name="id" value="<?php echo $id; ?>">
			              			<tr>
			              				<td>Status</td><td> : </td>
			              				<td>
			              					<select class="form-control select2" name="member_id" style="width: 100%;">
												<option value="0">Belum Dibayar</option>
												<option value="1">Lunas</option>
											</select>
			              				</td>
			              			</tr>
					              	<tr>
					              		<td colspan="3"><input type="submit" class="btn btn-primary pull-right" value="Proses" name="laporanfraktur">Proses</td>
								    </tr>
				              	</form>
              				<?php
	              			} else {
	              				# code...
              				?>
		              			<tr>
				              		<td>Status</td><td> : </td><td><b>Lunas</b></td>
		              			</tr>
              				<?php
	              			}
	              			

	              			?>
	              		</table>
	              		
	              		<table id="" class="table table-bordered table-striped">
	              			<thead>
	              			<tr>
	              				<th>Nama Obat</th>
	              				<th>Harga Beli</th>
	              				<th>Jumlah</th>
	              				<th>Total</th>
	              			</tr>
	              			</thead>
			                <tbody>
	              			<?php
	              					
								$query1=mysql_query("SELECT * FROM transaksi_fraktur_detail, barang where transaksi_fraktur_detail_barang_id=barang_id and transaksi_fraktur_detail_fraktur_id='$id' ");
								
								while ($data=mysql_fetch_array($query1)) {
								?>
									<tr>
										<td><?php echo $data['barang_nama']; ?></td>
										<td>Rp. <?php echo format_rupiah($data['transaksi_fraktur_detail_harga_beli']); ?></td>
										<td><?php echo $data['transaksi_fraktur_detail_jumlah']; ?></td>
										<td>Rp. <?php echo format_rupiah($data['transaksi_fraktur_detail_subtotal']); ?></td>
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