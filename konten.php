<?php
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('j - m - Y');
      $user = $_SESSION['login_user'];
	if ($_GET['menu']=='home') {
		$sql="SELECT * from pelanggan_temp where pelanggan_temp_user='$user'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);

		
		# code...
		?>
			<div class="box box-success">
	            <div class="box-header with-border">
	                <h3 class="box-title">Pilih Jenis</h3>
	            </div>
	            <div class="box-body">
	            	<?php

                	$sqlte1="SELECT * from jenis";
					$queryte1=mysql_query($sqlte1);
					while ($datatea=mysql_fetch_array($queryte1)) {
						if ($datatea["jenis_nama"]=="Gorden"||$datatea["jenis_nama"]=="Vitras"||$datatea["jenis_nama"]=="Gorden & Vitras"||$datatea["jenis_nama"]=="Poni Polos"||$datatea["jenis_nama"]=="Poni Motif") {
							# code...
						?>
			                <div class="col-md-3 col-md-offset-0 with-border barang">
			                	<a href="home.php?menu=model&id=<?php echo $datatea["jenis_id"]; ?>"><?php echo $datatea["jenis_nama"]; ?></a>
			                </div>
						<?php
						} elseif ($datatea["jenis_nama"]=="Lain-lain") {
						?>
			                <div class="col-md-3 col-md-offset-0 with-border barang">
			                	<a href="home.php?menu=lain&id=<?php echo $datatea["jenis_id"]; ?>&model=0&bahan=0"><?php echo $datatea["jenis_nama"]; ?></a>
			                </div>
						<?php
						
						} else {
							# code...
						?>
			                <div class="col-md-3 col-md-offset-0 with-border barang">
			                	<a href="home.php?menu=bahan&id=<?php echo $datatea["jenis_id"]; ?>&model=0"><?php echo $datatea["jenis_nama"]; ?></a>
			                </div>
						<?php
						}
						
					}
	            	?>
	            </div>
	        </div>

	    <?php	

	} elseif ($_GET['menu']=='model') {
        $_SESSION['print'] = "tidak";
	?>
		<div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Pilih Model</h3>
            </div>
            <div class="box-body">
            	<?php

            	$sqlte1="SELECT * from model";
				$queryte1=mysql_query($sqlte1);
				while ($datatea=mysql_fetch_array($queryte1)) {
					
					# code...
					if ($datatea["model_id"]==0) {
						# code...
					} else {
						# code...
						$idjenis = $_GET["id"];
						$sql="SELECT * from jenis where jenis_id='$idjenis'";
						$query=mysql_query($sql);
						$data=mysql_fetch_array($query);
						
						if ($data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {
							# code...
							if ($datatea['model_nama']=='Triplet') {
							
							} else {
								?>
					                <div class="col-md-3 col-md-offset-0 with-border barang">
					                	<a href="home.php?menu=lain&id=<?php echo $_GET["id"]; ?>&model=<?php echo $datatea["model_id"]; ?>"><?php echo $datatea["model_nama"]; ?></a>
					                </div>
								<?php
							} 
						} else {
							if ($datatea['model_nama']=='Papan'||$datatea['model_nama']=='Drappery') {
							
							} else {
								?>
					                <div class="col-md-3 col-md-offset-0 with-border barang">
					                	<a href="home.php?menu=bahan&id=<?php echo $_GET["id"]; ?>&model=<?php echo $datatea["model_id"]; ?>"><?php echo $datatea["model_nama"]; ?></a>
					                </div>
								<?php
							}
							
							
						}
						

					}
					
				}
            	?>
            </div>
        </div>

    <?php
	} elseif ($_GET['menu']=='sukses') {
		
	?>
		<div class="box box-success">
            
            <div class="box-body" style="text-align: center;">
            	<h3 style="margin-bottom: 30px;" class="box-title" >Transaksi Berhasil</h3>
				<a style="margin-bottom: 30px;" href="pdf/save-pdf.php" class="btn btn-primary" target="_blank">Download Penawaran</a>
            </div>
        </div>

    <?php
	} elseif ($_GET['menu']=='bahan') {
	?>
		<div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Pilih Bahan</h3>
            </div>
            <div class="box-body">
            	<?php
            	
            		# code...
            	$jenid = $_GET["id"];
            	
            	
            	$sqlte1="SELECT * from kain WHERE kain_jenis='$jenid'";
				$queryte1=mysql_query($sqlte1);
				while ($datatea=mysql_fetch_array($queryte1)) {
					
					# code...
				?>
	                <div class="col-md-3 col-md-offset-0 with-border barang">
	                	<a href="home.php?menu=lain&id=<?php echo $_GET["id"]; ?>&model=<?php echo $_GET["model"]; ?>&bahan=<?php echo $datatea["kain_id"]; ?>"><?php echo $datatea["kain_nama"]; ?></a>
	                </div>
				<?php
				
					
				}
            	?>
            </div>
        </div>

    <?php
	}  elseif ($_GET['menu']=='lain') {
	?>
		<div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Lain</h3>
            </div>
            <div class="box-body">
            	<?php

				$idjenis = $_GET["id"];
				$idbahan = $_GET["bahan"];
				$idmodel = $_GET["model"];

				$sql="SELECT * from jenis where jenis_id='$idjenis'";
				$query=mysql_query($sql);
				$data=mysql_fetch_array($query);

				$sql2="SELECT * FROM model WHERE model_id='$idmodel'";
				$query2=mysql_query($sql2);
				$data2=mysql_fetch_array($query2);
				echo mysql_error();

				$sql3="SELECT * FROM kain where kain_id='$idbahan'";
				$query3=mysql_query($sql3);
				$data3=mysql_fetch_array($query3);
            	?>
                <form action="aksi/transaksi.aksi.php" method="post">
					    <input type="hidden" name="jenis" class="form-control" id="" value="<?php echo $_GET['id'];?>">
					    <input type="hidden" name="bahan" class="form-control" id="" value="<?php echo $_GET['bahan'];?>">
					    <input type="hidden" name="model" class="form-control" id="" value="<?php echo $_GET['model'];?>">
					<div class="col-md-12 col-md-offset-0 col-custom-left form-group">
						<label>Jenis: <?php echo $data['jenis_nama'];?></label>
					</div>
					<div class="col-md-12 col-md-offset-0 col-custom-left form-group">
						<label>Model: <?php echo $data2['model_nama'];?></label>
					</div>
					<div class="col-md-12 col-md-offset-0 col-custom-left form-group">
						<label>Bahan: <?php echo $data3['kain_nama'];?></label>
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Ruang</label>
					    <input type="text" name="ruang" class="form-control" id="ruang">
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Kode Bahan</label>
					    <input type="text" name="kodebahan" class="form-control" id="kodebahan">
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
					<?php					
					if ($data['jenis_nama']=="Gorden & Vitras") {
						# code...
					?>
						<label>Kode Bahan Vitras</label>
					    <input type="text" name="kodebahan1" class="form-control" id="kodebahan1">
					<?php
					} else {
					?>
						<label>Kode Bahan Vitras</label>
						<input type="text" name="kodebahan1" class="form-control" id="kodebahan1" value="" disabled>
					
					<?php
					}
					?>
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group" style="min-height: 55.8px;">
					<?php
					if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif'||$data['jenis_nama']=='Kaca Film') {
					?>
						<label>Harga Bahan</label>
						<input type="text" name="hargabahan" class="form-control" id="hargabahan" value="" disabled>
					<?php
					} else {
					?>
						<label>Harga Bahan</label>
					    <input type="text" name="hargabahan" class="form-control" id="hargabahan">
					<?php						
					}
					?>
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Jumlah</label>
					    <input type="text" name="jumlah" class="form-control" id="jumlah" value="1">
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Tinggi</label>
					    <input type="number" name="panjang" class="form-control" id="tinggi" placeholder="Tinggi" maxlength="5" value="100">
					</div>
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Lebar</label>
					    <input type="number" name="lebar" class="form-control" id="lebar" placeholder="Lebar" maxlength="5" value="100">
					</div>
					<?php
						if ($data['jenis_nama']=='Lain-lain') {
						?>
							<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
								<label>Volume</label>
							    <input type="number" name="volume" class="form-control" id="volume" placeholder="Volume" maxlength="5" value="100">
							</div>
						<?php
						} else {
						?>
							<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
								<label>Volume</label>
							    <input type="number" name="volume" class="form-control" id="volume" placeholder="" maxlength="5" value="0" disabled>
							</div>
						<?php
						}
						if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {

							if ($data['jenis_nama']=='Gorden & Vitras'){
							?>
								<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
									<label>KT/E</label>
									<select class="form-control" name="kt">
										<option value="G:KT/V:E">G:KT/V:E</option>
										<option value="G:KT/V:KT">G:KT/V:KT</option>
										<option value="G:E/V:E">G:E/V:E</option>
										<option value="G:E/V:KT">G:E/V:KT</option>
									</select>
								</div>
								<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
									<label>Rel Alat Gorden</label>
									<select class="form-control" name="relalat1">
										<option value="" >Pilih Alat Rel 1</option>
										<option value="Rolet">Rolet</option>
										<option value="Delux">Delux</option>
										<option value="Lengkung">Lengkung</option>
									</select>
								</div>
								<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
									<label>Rel Alat Vitras</label>
									<select class="form-control" name="relalat2">
										<option value="" >Pilih Alat Rel 2</option>
										<option value="Rolet">Rolet</option>
										<option value="Delux">Delux</option>
										<option value="Lengkung">Lengkung</option>
									</select>
								</div>

							<?php
							} else {
							?>
								<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
									<label>KT/E</label>
									<select class="form-control" name="kt">
										<option value="KT">KT</option>
										<option value="E">E</option>
									</select>
								</div>
								<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
									<label>Rel Alat</label>
									<select class="form-control" name="relalat1">
										<option value="" >Pilih Alat Rel 1</option>
										<option value="Rolet">Rolet</option>
										<option value="Delux">Delux</option>
										<option value="Lengkung">Lengkung</option>
									</select>
								</div>
							    <input type="hidden" name="relalat2" class="form-control"  value="">

							<?php
							}
							?>
					
					<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Rel/Alat Warna</label>
						<select class="form-control" name="relwarna">
							<option value="">Pilih Warna</option>
							<option value="Putih">Putih</option>
							<option value="Coklat Kayu">Coklat Kayu</option>
							<option value="Gold">Gold</option>
							<option value="Silver">Silver</option>
							<option value="Black">Black</option>
							<option value="Lengkuy">Lengkuy</option>
						</select>
					</div>
					<?php
					}
					?>
				    <input type="hidden" name="kualitas" class="form-control"  value="Premium">
					<div class="form-group">
					    <input type="submit" class="btn btn-success pull-right btn-lg" value="Input" name="inputpengukuran" style="font-size: 14px;">
					</div>
				</form>

            </div>
        </div>
		
	<?php
	}  elseif ($_GET['menu']=='nego') {
	?>
		<div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Nego Harga</h3>
            </div>
            <div class="box-body">
                <form action="aksi/transaksi.aksi.php" method="post">
					<div class="form-group">
						<label>Diskon (%)</label>
					    <input type="text" name="diskon" class="form-control" id="diskon" value="0">
					</div>
					<div class="form-group">
						<label>Kualitas</label>
						<select class="form-control" name="kualitas">
							<option value="Premium">Premium</option>
							<option value="Gold">Gold</option>
							<option value="Silver">Silver</option>
						</select>
					</div>
					<div class="form-group">
					    <input type="submit" class="btn btn-success pull-right btn-lg" value="Input" name="negoharga">
					</div>
				</form>

            </div>
        </div>
		
	<?php
	} elseif ($_GET['menu']=='cart') {
	?>
		<div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List Pengukuran</h3>
            </div>
            <div class="box-body">
            	<table id="listbarang" class="table table-bordered table-striped custom1">
                    <thead>
                    <tr>
                      <th>Ruang</th>
                      <th>Jenis</th>
                      <th>Harga</th>
                      <th ></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      
                      $sqlte1="SELECT * from pengukuran_detail_temp, jenis, kain, model where pengukuran_detail_temp_jenis=jenis_id and pengukuran_detail_temp_bahan=kain_id and pengukuran_detail_temp_model=model_id and pengukuran_detail_temp_user='$user' ORDER BY pengukuran_detail_temp_id ASC";
                      $queryte1=mysql_query($sqlte1);
                      while ($datatea=mysql_fetch_array($queryte1)) {
                      ?>
                        <tr>
                          <td><?php echo $datatea["pengukuran_detail_temp_ruang"]; ?></td>
                          <td><?php echo $datatea["jenis_nama"]; ?></td>
                          <td>Rp <?php echo format_rupiah($datatea["pengukuran_detail_temp_harga"]); ?></td>
                          <td>
                            <a href="aksi/hapus.php?menu=transaksi&id=<?php echo $datatea["pengukuran_detail_temp_id"]; ?>" class="btn btn-danger"><i class='fa fa-trash'></i></a>
                          </td>
                        </tr>
                      <?php
                      }
                      echo mysql_error();

                    $sql="SELECT SUM(pengukuran_detail_temp_harga) AS subtotal FROM pengukuran_detail_temp where pengukuran_detail_temp_user='$user' ";
                    $result=mysql_query($sql);
                    $data=mysql_fetch_array($result); 
                    $total1 = $data['subtotal'];

                    $sql11="SELECT * FROM pelanggan_temp where pelanggan_temp_user='$user' ";
                    $result11=mysql_query($sql11);
                    $data11=mysql_fetch_array($result11); 
                    $diskon = $total1*($data11['pelanggan_temp_diskon']/100);
                    
                    $tot = $total1 - $diskon;
                      ?>

                    </tbody>
                </table>
                <hr>
                <form action="aksi/transaksi.aksi.php" method="post" class="custom-form">
                	<div class="col-md-6 col-md-offset-0 col-custom-left form-group">
						<label>Total</label>
		                <input type="hidden" name="subtotal" class="form-control" value="<?php echo $tot; ?>">
		                <input type="text" name="" class="form-control" style="text-align: right; margin-bottom: 20px; font-size: 24px; height: auto;" value="Rp <?php echo format_rupiah($tot); ?>" disabled>
						<label>Uang DP</label>
		                <input type="text" name="dp" class="form-control" style="text-align: right; margin-bottom: 20px; font-size: 24px; height: auto;" value="0" id="price">
		            </div>
                  	<div class="form-group">
                    	<input type="submit" class="btn btn-success pull-right btn-lg" value="Proses" name="prosessekarang">
                  		<a href="?menu=nego" class="btn btn-info pull-right btn-lg" >Nego Harga</a>
	                </div>
                </form>
            </div>
        </div>

    <?php
	}


	?>