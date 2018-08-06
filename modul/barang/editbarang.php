
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Edit Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

		<div class="box-body">
			<?php

			$id = $_GET['id'];
			$sqlte1="SELECT * from barang where barang_id='$id'";
			$queryte1=mysql_query($sqlte1);
			$datatea=mysql_fetch_array($queryte1);



			?>
		    <form action="aksi/barang.aksi.php" method="post">
			    <div class="form-group">
					<label>Nama Barang</label>
			      	<input type="hidden" name="id" value="<?php echo $datatea['barang_id'] ; ?>">
			      	<input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="<?php echo $datatea['barang_nama'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Klinik</label>
			        <select name="klinik" class="form-control" id="jenis" ">
			        <?php
	                	$sqlte1="SELECT * from klinik ";
						$queryte1=mysql_query($sqlte1);
						while ($data=mysql_fetch_array($queryte1)) {
							if ($datatea['barang_klinik']==$data['klinik_id']) {
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
					<label>Harga Beli</label>
			      <input type="text" name="hargabeli" class="form-control" placeholder="Harga Beli" id="price" value="<?php echo $datatea['barang_harga_beli'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Harga Jual</label>
			      <input type="text" name="hargajual" class="form-control" placeholder="Harga Jual" id="price1" value="<?php echo $datatea['barang_harga_jual'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Stok</label>
			      <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?php echo $datatea['barang_stok'] ; ?>">
			    </div>
			    <div class="form-group">
					<label>Batas Stok</label>
			      <input type="text" name="batasstok" class="form-control" placeholder="Batas Stok" value="<?php echo $datatea['barang_batas_stok'] ; ?>">
			    </div>
			    <div class="form-group">
			    	<label>Nama Farmasi</label>
			      	<select name="farmasi" class="form-control" id="farmasi" ">
			      	<?php
			      		
	                	$sqlte1="SELECT * from farmasi ";
						$queryte1=mysql_query($sqlte1);
						while ($data=mysql_fetch_array($queryte1)) {
							if ($datatea['barang_farmasi']==$data['farmasi_id']) {
								# code...
							?>
								<option value="<?php echo $data['farmasi_id']?>" selected><?php echo $data['farmasi_nama']?></option>
							<?php
							} else {

							?>
								<option value="<?php echo $data['farmasi_id']?>"><?php echo $data['farmasi_nama']?></option>
							<?php
							}
						}
			        ?>
				    </select>
			    </div>
			    <div class="form-group">			    	
					<label>Kandungan</label>
				    <textarea name="kandungan" class="form-control" placeholder="Kandungan"><?php echo $datatea['barang_kandungan'] ; ?></textarea>
			    </div>
			    <div class="form-group">
			      <input type="submit" class="btn btn-primary" value="save" name="edit">
			    </div>
		    </form>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>