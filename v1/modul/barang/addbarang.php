<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    	Tambah Barang
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

		<div class="box-body">
		    <form action="aksi/barang.aksi.php" method="post">
			    <div class="form-group">
			    	<label>Nama Barang</label>
			      <input type="text" name="nama" class="form-control" placeholder="Nama Barang">
			    </div>
			    <div class="form-group">
			    	<label>Klinik</label>
			        <select name="klinik" class="form-control" id="jenis" ">
			        <?php
	                	$sqlte1="SELECT * from klinik ";
						$queryte1=mysql_query($sqlte1);
						while ($datatea=mysql_fetch_array($queryte1)) {
						?>
							<option value="<?php echo $datatea['klinik_id']?>"><?php echo $datatea['klinik_nama']?></option>
						<?php
						}
			        ?>
		            </select>
			    </div>
			    <div class="form-group">
			    	<label>Harga Beli</label>
			      <input type="text" name="hargabeli" class="form-control" placeholder="Harga Beli" id="price" value="0">
			    </div>
			    <div class="form-group">
			    	<label>Harga Jual</label>
			      <input type="text" name="hargajual" class="form-control" placeholder="Harga Jual" id="price1">
			    </div>
			    <div class="form-group">
			    	<label>Stok</label>
			      <input type="text" name="stok" class="form-control" placeholder="Stok">
			    </div>
			    <div class="form-group">
			    	<label>Batas Stok</label>
			      <input type="text" name="batasstok" class="form-control" placeholder="Batas Stok">
			    </div>
			    <div class="form-group">
			    	<label>Nama Farmasi</label>
			      	<select name="farmasi" class="form-control" id="farmasi" ">
			        <?php
	                	$sqlte1="SELECT * from farmasi ";
						$queryte1=mysql_query($sqlte1);
						while ($datatea=mysql_fetch_array($queryte1)) {
						?>
							<option value="<?php echo $datatea['farmasi_id']?>"><?php echo $datatea['farmasi_nama']?></option>
						<?php
						}
			        ?>
		            </select>
			    </div>
			    <div class="form-group">			    	
					<label>Kandungan</label>
				    <textarea name="kandungan" class="form-control" placeholder="Kandungan"></textarea>
			    </div>
			    <div class="form-group">
			      <input type="submit" class="btn btn-primary" value="save" name="tambah">
			    </div>
		    </form>
		</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>