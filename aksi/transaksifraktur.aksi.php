<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bulan=date('Y-m');
$wkt=date('G:i:s');

	if(isset($_POST['proses'])){
		$_SESSION['kembalian'] = 0;
		$jumlah=$_POST['jumlah'];
		$id = $_POST['id'];
		$sql="SELECT * from barang where barang_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$id = $data['barang_id'];
		$jual = $data['barang_harga_jual'];
		
		$beli = $data['barang_harga_beli'];
		$harga = $beli*$jumlah;
		$user = $_SESSION['login_user'];

		$sqlfarmasi="SELECT * from  farmasi_temp where user_id='$user'";
		$resultfarmasi=mysql_query($sqlfarmasi);
		$datafarmasi=mysql_fetch_array($resultfarmasi);
		

		$sqlquery1=mysql_query("SELECT sum(transaksi_fraktur_temp_jumlah) as jumlah from transaksi_fraktur_temp where transaksi_fraktur_temp_barang_id=$id");
		$sqldata1=mysql_fetch_array($sqlquery1);

		
		# code...
		$a="INSERT into transaksi_fraktur_temp(transaksi_fraktur_temp_fraktur_id,transaksi_fraktur_temp_barang_id,transaksi_fraktur_temp_harga_beli,transaksi_fraktur_temp_harga_jual,transaksi_fraktur_temp_jumlah,transaksi_fraktur_temp_subtotal,transaksi_fraktur_temp_user_id,transaksi_fraktur_temp_keterangan)values('0','$id','$beli','$jual','$jumlah','$harga','$user','')";
		
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../transaksifraktur.php?menu=home'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
		
		
	} elseif (isset($_POST['farmasi'])) {
		# code...
		$_SESSION['kembalian'] = 0;
		$_SESSION['print'] = 'tidak';

		$farmasi_id = $_POST['farmasi_id'];
		$klinik_id = $_POST['klinik_id'];
		$nofraktur = $_POST['nofraktur'];
		$tanggalterkirim = $_POST['tanggalterkirim'];
		$jatuhtempo = $_POST['jatuhtempo'];
		if ($farmasi_id==0) {
			# code...

		    	echo ("<script>location.href='../transaksifraktur.php?menu=home'</script>");
		} else {
			# code...

			$user = $_SESSION['login_user'];
			$a="INSERT into farmasi_temp(farmasi_id,user_id,no_fraktur,tanggal_terkirim,jatuh_tempo,klinik_id)values('$farmasi_id','$user','$nofraktur','$tanggalterkirim','$jatuhtempo','$klinik_id')";
			$b=mysql_query($a);
		    	echo ("<script>location.href='../transaksifraktur.php?menu=home'</script>");
			
		}
		
		
		
	} elseif (isset($_POST['editjumlah'])){
		$jumlah=$_POST['jumlah']; 
		$id = $_POST['id'];


		$sql="SELECT * from transaksi_fraktur_temp where transaksi_fraktur_temp_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$jual = $data['transaksi_fraktur_temp_harga_jual'];
		$beli = $data['transaksi_fraktur_temp_harga_beli'];
		$total = $jumlah*$beli;
		$barangid = $data['transaksi_fraktur_temp_barang_id'];

		$sqlbarang="SELECT * from barang where barang_id = '$barangid' ";
		$resultbarang=mysql_query($sqlbarang);
		$databarang=mysql_fetch_array($resultbarang);		
		
		$a="UPDATE transaksi_fraktur_temp set transaksi_fraktur_temp_jumlah='$jumlah', transaksi_fraktur_temp_subtotal='$total' where transaksi_fraktur_temp_id='$id'";
		$b=mysql_query($a);
		if($b){
		    echo ("<script>location.href='../transaksifraktur.php?menu=home'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['bayarsekarang'])){

		
		$user = $_SESSION['login_user'];
		$subtotal=$_POST['subtotal'];
		
		# code...
		$sqlte1="SELECT * from farmasi_temp where user_id='$user'";
		$queryte1=mysql_query($sqlte1);
    	$data=mysql_fetch_array($queryte1);
    	$farmasi = $data['farmasi_id'];
    	$nofraktur = $data['no_fraktur'];
		$tglterkirim = $data['tanggal_terkirim'];
		$jatuhtempo = $data['jatuh_tempo'];
		$klinik = $data['klinik_id'];


		$sql = "INSERT INTO transaksi_fraktur (transaksi_fraktur_tanggal,transaksi_fraktur_bulan,transaksi_fraktur_waktu,transaksi_fraktur_no,transaksi_fraktur_tanggal_terkirim,transaksi_fraktur_jatuh_tempo,transaksi_fraktur_klinik_id,transaksi_fraktur_farmasi,transaksi_fraktur_user_id,transaksi_fraktur_total,transaksi_fraktur_status,transaksi_fraktur_keterangan) VALUES ('$tgl','$bulan','$wkt','$nofraktur','$tglterkirim','$jatuhtempo','$klinik','$farmasi','$user','$subtotal','0','')" ;
		mysql_query($sql);
		echo mysql_error();
        $qn= "SELECT MAX( transaksi_fraktur_id ) AS nota FROM transaksi_fraktur where transaksi_fraktur_user_id='$user'";
        $rn=mysql_query($qn);
        $dn=mysql_fetch_array($rn);
        $no_not = $dn['nota'];
        $_SESSION['no-nota'] = $no_not;

        $sql="SELECT * from transaksi_fraktur_temp where transaksi_fraktur_temp_user_id='$user'";
        $query=mysql_query($sql);
        while ($data1=mysql_fetch_array($query)) {

        	$barang = $data1['transaksi_fraktur_temp_barang_id'];
        	$beli = $data1['transaksi_fraktur_temp_harga_beli'];
        	$jual = $data1['transaksi_fraktur_temp_harga_jual'];
        	$jumlah = $data1['transaksi_fraktur_temp_jumlah'];
        	$subtotal = $data1['transaksi_fraktur_temp_subtotal'];
        	$user = $data1['transaksi_fraktur_temp_user_id'];
        	$keterangan = $data1['transaksi_fraktur_temp_keterangan'];

        	$sql="SELECT * from barang where barang_id = '$barang' ";
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			

        	$a="INSERT into transaksi_fraktur_detail(transaksi_fraktur_detail_fraktur_id,transaksi_fraktur_detail_barang_id,transaksi_fraktur_detail_harga_beli,transaksi_fraktur_detail_harga_jual,transaksi_fraktur_detail_jumlah,transaksi_fraktur_detail_subtotal,transaksi_fraktur_detail_user_id,transaksi_fraktur_detail_keterangan)values('$no_not','$barang','$beli','$jual','$jumlah','$subtotal','$user','$keterangan')";
			$b=mysql_query($a);
			echo mysql_error();

			//Select Stok Barang
			$sqlkem11="SELECT barang_stok from barang where barang_id='$barang'";
	        $querykem11=mysql_query($sqlkem11);
	        $datakem11=mysql_fetch_array($querykem11);
	        	# code...
        	$jml_stok = $datakem11['barang_stok'] + $jumlah;

			$aaa="INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$barang','$datakem11[barang_stok]','$jumlah','$tgl','Tambah Stok (Fraktur)')";
        	mysql_query($aaa);
	        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$barang'");
	       
	        
	        


			
        }
        
        $_SESSION['kembalian'] = 0;
        $_SESSION['print'] = 'ya';

		mysql_query("DELETE from transaksi_fraktur_temp where transaksi_fraktur_temp_user_id='$user'");
		mysql_query("DELETE from farmasi_temp where user_id='$user'");

		echo ("<script>location.href='../transaksifraktur.php?menu=home&kem=0'</script>");

        /*
		$a="INSERT into transaksi_temp(transaksi_temp_no_nota,transaksi_temp_barang_id,transaksi_temp_harga_beli,transaksi_temp_harga_jual,transaksi_temp_jumlah,transaksi_temp_subtotal,transaksi_temp_keterangan,transaksi_temp_user_id)values('0','$id','$beli','$jual','$jumlah','$harga','','$user')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
			header('location:../transaksifraktur.php?menu=home');
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
		*/
	
	
		
	} elseif (isset($_POST['ceknota'])) {
		# code...

		$nota = $_POST['nota'];
		
    	echo ("<script>location.href='../transaksifraktur.php?menu=nota&id=$nota'</script>");
		
	} else {

	}



