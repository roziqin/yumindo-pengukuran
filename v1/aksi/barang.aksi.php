<?php
session_start();
include "../include/koneksi.php";
	$nama=$_POST['nama'];
	$klinik=$_POST['klinik'];
	$stok=$_POST['stok'];
	$farmasi=$_POST['farmasi'];
	$kandungan=$_POST['kandungan'];
	$batasstok=$_POST['batasstok'];
	
	date_default_timezone_set('Asia/jakarta');
	$tgl=date('Y-m-j');
	$wkt=date('G:i:s');
	$wkt1=date('h:i:sa');
	$tgl2= $tgl." ".$wkt1;




	$text_line = explode(".",$_POST['hargabeli']);
	$length=count($text_line);
	if ($length==1) {
		$hargabeli=$text_line[0];
		# code...
	}elseif ($length==2) {
		$hargabeli=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$hargabeli=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	$text_line = explode(".",$_POST['hargajual']);
	$length=count($text_line);
	if ($length==1) {
		$hargajual=$text_line[0];
		# code...
	}elseif ($length==2) {
		$hargajual=$text_line[0]."".$text_line[1];
		# code...
	}elseif ($length==3) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2];
	}elseif ($length==4) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
	}elseif ($length==5) {
		# code...
		$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
	}

	

	if(isset($_POST['tambah'])){
	
		//echo $klinik. " ". $farmasi;
		$a="INSERT into barang(barang_nama,barang_klinik,barang_harga_beli,barang_harga_jual,barang_stok,barang_farmasi,barang_kandungan,barang_batas_stok)values('$nama','$klinik','$hargabeli','$hargajual','$stok','$farmasi','$kandungan','$batasstok')";
		$b=mysql_query($a);
		echo mysql_error();
		
		if($b){

	        echo ("<script>location.href='../home.php?menu=addbarang'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	} elseif (isset($_POST['edit'])) {
		# code...
		
		$id = $_POST['id'];
		$user = $_SESSION['login_user'];


		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$beliawal = $datatea['barang_harga_beli'];
		$jualawal = $datatea['barang_harga_jual'];

		
		$a="UPDATE barang set barang_nama='$nama',barang_klinik='$klinik',barang_harga_beli='$hargabeli',barang_harga_jual='$hargajual', barang_stok='$stok', barang_farmasi='$farmasi', barang_kandungan='$kandungan', barang_batas_stok='$batasstok' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();

		$sql = "INSERT into log_harga(barang_id,harga_beli_awal,harga_beli_baru,harga_jual_awal,harga_jual_baru,user,tanggal)values('$id','$beliawal','$hargabeli','$jualawal','$hargajual','$user','$tgl2')";
		$c=mysql_query($sql);
		if($c){

		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		echo mysql_error();
		if($b){
			
	        echo ("<script>location.href='../home.php?menu=barangklinik&id=$klinik'</script>");
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}

	} elseif (isset($_POST['editharga'])) {
		# code...
		$text_line = explode(".",$_POST['harga']);
		$length=count($text_line);
		if ($length==1) {
			$hargajual=$text_line[0];
			# code...
		}elseif ($length==2) {
			$hargajual=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$hargajual=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		$id = $_POST['id'];
		$diskon = $_POST['diskon'];
		$user = $_SESSION['login_user'];


		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$beliawal = $datatea['barang_harga_beli'];
		$jualawal = $datatea['barang_harga_jual'];
		$jenis = $datatea['barang_jenis'];

		if ($jenis=="obat") {
			# code...
			$komisidokter = $hargajual*0.03;
			$komisibo = $hargajual*0.01;
			
			$a="UPDATE barang set barang_harga_jual='$hargajual', barang_komisi='$komisibo', barang_komisi_dokter='$komisidokter', barang_diskon='$diskon' where barang_id='$id'";

		} else {

			$a="UPDATE barang set barang_harga_jual='$hargajual',barang_diskon='$diskon' where barang_id='$id'";
		}
		
		$b=mysql_query($a);
		echo mysql_error();

		$sql = "INSERT into log_harga(barang_id,harga_beli_awal,harga_beli_baru,harga_jual_awal,harga_jual_baru,user,tanggal)values('$id','0','0','$jualawal','$hargajual','$user','$tgl2')";
		$c=mysql_query($sql);
		if($c){

		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		echo mysql_error();
		if($b){
			if ($jenis == 'obat') {
				# code...

		        echo ("<script>location.href='../home.php?menu=lihatobat'</script>");
			} else {
				# code...

		        echo ("<script>location.href='../home.php?menu=lihattreatment'</script>");
			}
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}

	} elseif (isset($_POST['rusak'])) {
		# code...
		
		$id=$_POST['id'];
		$ket=$_POST['keterangan'];

		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$stok_barang = $datatea['barang_stok'] - $stok;
		$awal = $datatea['barang_stok'];
		$user = $_SESSION['login_user'];
		$a="INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$id','$awal','$stok','$tgl','$ket')";
		mysql_query($a);

		$a="UPDATE barang set barang_stok='$stok_barang' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){

	        echo ("<script>location.href='../home.php?menu=stok&id=0'</script>");
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
	} elseif (isset($_POST['tambah_stok'])) {
		# code...
		
		$id=$_POST['id'];

		$sqlte1="SELECT * from barang where barang_id='$id'";
		$queryte1=mysql_query($sqlte1);
		$datatea=mysql_fetch_array($queryte1);
		$stok_barang = $datatea['barang_stok'] + $stok;
		$awal = $datatea['barang_stok'];
		$user = $_SESSION['login_user'];
		$a="INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$id','$awal','$stok','$tgl','Tambah Stok')";
		mysql_query($a);

		$a="UPDATE barang set barang_stok='$stok_barang' where barang_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){

	        echo ("<script>location.href='../home.php?menu=stok&id=0'</script>");
			
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
	}




