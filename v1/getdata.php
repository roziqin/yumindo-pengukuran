<?php
session_start();
include "include/koneksi.php";



if ($_GET["ket"]=="model") {
	$idjenis = $_GET["id"];
$sql="SELECT * from jenis where jenis_id='$idjenis'";
$query=mysql_query($sql);
$data=mysql_fetch_array($query);
	# code...
	if ($data["jenis_ket_model"]==1) {
		$id = $_GET['id'];
		 
		echo "<label>Model</label><select name='model' id='model' class='form-control' onchange='javascript:rubahbahan()'><option value='0'>-- Pilih Model --</option>";
		 
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
						echo "<option value='$datatea[model_id]'>$datatea[model_nama]</option>";
					} 
				} elseif ($data['jenis_nama']=='Vitras') {
          if ($datatea['model_nama']=='Papan'||$datatea['model_nama']=='Drappery') {
          
          } else {
            echo "<option value='$datatea[model_id]'>$datatea[model_nama]</option>";
          } 
        } else {
					if ($datatea['model_nama']=='Papan'||$datatea['model_nama']=='Drappery'||$datatea['model_nama']=='Jam Pasir') {
					
					} else {
						echo "<option value='$datatea[model_id]'>$datatea[model_nama]</option>";
					}					
				}
			}			
		}
		echo "</select>";
	} else {
		echo "<label>Bahan</label><select name='bahan' id='bahan' class='form-control' onchange='javascript:tampilform(this)'><option value='0'>-- Pilih Bahan --</option>";
		$jenid = $_GET["id"];        	
		$sqlte1="SELECT * from kain WHERE kain_jenis='$jenid'";
		$queryte1=mysql_query($sqlte1);
		while ($datatea=mysql_fetch_array($queryte1)) {
			# code...
			echo "<option value='$datatea[kain_id]'>$datatea[kain_nama]</option>";
		}
		echo '</select>

	    <input type="hidden" name="model" class="form-control" id="model" value="0">
		';

	}
} elseif ($_GET["ket"]=="bahan") {
	echo "<label>Bahan</label><select name='bahan' id='bahan' class='form-control' onchange='javascript:tampilform(this)'><option value='0'>-- Pilih Bahan --</option>";
	$jenid = $_GET["id"];        	
	$sqlte1="SELECT * from kain WHERE kain_jenis='$jenid'";
	$queryte1=mysql_query($sqlte1);
	while ($datatea=mysql_fetch_array($queryte1)) {
		# code...
		echo "<option value='$datatea[kain_id]'>$datatea[kain_nama]</option>";
	}
	echo "</select>";
} elseif ($_GET["ket"]=="tampilform") {
	# code...
	$idjenis = $_GET["jenis"];
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
	echo '<div class="clear"></div>
	<div class="col-md-2 col-md-offset-0 col-custom-left form-group">
        <label>Ruang</label>
          <input type="text" name="ruang" class="form-control" id="ruang">
      </div>
      <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
        <label>Kode Bahan</label>
          <input type="text" name="kodebahan" class="form-control" id="kodebahan">
      </div>
      <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
      ';         
      if ($data['jenis_nama']=="Gorden & Vitras") {
        # code...
      echo'
        <label>Kode Bahan Vitras</label>
          <input type="text" name="kodebahan1" class="form-control" id="kodebahan1">
      ';
      } else {
      echo '
        <label>Kode Bahan Vitras</label>
        <input type="text" name="kodebahan1" class="form-control" id="kodebahan1" value="" disabled>
      
      ';
      }
      echo '
      </div>
      <div class="col-md-2 col-md-offset-0 col-custom-left form-group" style="min-height: 55.8px;">
      ';
      if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif'||$data['jenis_nama']=='Kaca Film') {
      echo'
        <label>Harga Bahan</label>
        <input type="text" name="hargabahan" class="form-control" id="hargabahan" value="" disabled>
      ';
      } else {
      echo'
        <label>Harga Bahan</label>
          <input type="text" name="hargabahan" class="form-control" id="hargabahan">
      ';           
      }
      echo'
      </div>

      <div class="clear"></div>
      <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
        <label>Tinggi</label>
          <input type="number" name="panjang" class="form-control" id="tinggi" placeholder="Tinggi" maxlength="5" value="100">
      </div>
      <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
        <label>Lebar</label>
          <input type="number" name="lebar" class="form-control" id="lebar" placeholder="Lebar" maxlength="5" value="100">
      </div>
      ';
      if ($data['jenis_nama']=='Lain-lain') {
        echo '
      <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
        <label>Volume</label>
          <input type="number" name="volume" class="form-control" id="volume" placeholder="Volume" maxlength="5" value="100">
      </div>
        ';
      } else {
        echo '
      <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
        <label>Volume</label>
          <input type="number" name="volume" class="form-control" id="volume" placeholder="" maxlength="5" value="" disabled>
      </div>
        ';
      }
      echo '
      <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
        <label>Jumlah</label>
          <input type="text" name="jumlah" class="form-control" id="jumlah" value="1">
      </div>
      
      ';
      if ($data['jenis_nama']=='Gorden & Vitras'||$data['jenis_nama']=='Vitras'||$data['jenis_nama']=='Gorden'||$data['jenis_nama']=='Poni Polos'||$data['jenis_nama']=='Poni Motif') {

          if ($data['jenis_nama']=='Gorden & Vitras'){
          echo'
            <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
              <label>KT/E</label>
              <select class="form-control" name="kt">
                <option value="G:KT/V:E">G:KT/V:E</option>
                <option value="G:KT/V:KT">G:KT/V:KT</option>
                <option value="G:E/V:E">G:E/V:E</option>
                <option value="G:E/V:KT">G:E/V:KT</option>
              </select>
            </div>
            <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
              <label>Rel Alat Gorden</label>
              <select class="form-control" name="relalat1">
                <option value="" >Pilih Alat Rel 1</option>
                <option value="Rolet">Rolet</option>
                <option value="Delux">Delux</option>
                <option value="Lengkung">Lengkung</option>
              </select>
            </div>
            <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
              <label>Rel Alat Vitras</label>
              <select class="form-control" name="relalat2">
                <option value="" >Pilih Alat Rel 2</option>
                <option value="Rolet">Rolet</option>
                <option value="Delux">Delux</option>
                <option value="Lengkung">Lengkung</option>
              </select>
            </div>

          ';
          } else {
          echo'
            <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
              <label>KT/E</label>
              <select class="form-control" name="kt">
                <option value="KT">KT</option>
                <option value="E">E</option>
              </select>
            </div>
            <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
              <label>Rel Alat</label>
              <select class="form-control" name="relalat1">
                <option value="" >Pilih Alat Rel 1</option>
                <option value="Rolet">Rolet</option>
                <option value="Delux">Delux</option>
                <option value="Lengkung">Lengkung</option>
              </select>
            </div>
            <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
              <label>Rel Alat 2</label>
              <input type="text" name="relalat2" class="form-control"  value="" disabled>
        	</div>
          ';
          }
          echo '
          <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
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
          ';
    	} else{
    	echo '

        <div class="col-md-1 col-md-offset-0 col-custom-left form-group">
          <label>KT/E</label>
          <input type="text" name="kt" class="form-control"  value="" disabled>
    	</div>
        <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
          <label>Rel Alat</label>
          <input type="text" name="relalat1" class="form-control"  value="" disabled>
    	</div>
        <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
          <label>Rel Alat 2</label>
          <input type="text" name="relalat2" class="form-control"  value="" disabled>
    	</div>
        <div class="col-md-2 col-md-offset-0 col-custom-left form-group">
          <label>Rel/Alat Warna</label>
          <input type="text" name="relwarna" class="form-control"  value="" disabled>
    	</div>
    	';
	    }
      if ($_GET['idukur']==0) {
        $nameinput="inputpengukuran";
      } else {
        $nameinput="tambahpengukuran";
      }
      
	    echo'
    	<input type="hidden" name="kualitas" class="form-control"  value="Premium">
		<div class="col-md-1 col-md-offset-0 col-custom-left form-group">
		    <input type="submit" class="btn btn-success pull-right btn-lg" value="Input" name="'.$nameinput.'" style="font-size: 14px; margin-top: 20px">
		</div>
    	';
      
}

 
?>