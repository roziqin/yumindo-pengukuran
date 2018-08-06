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
		$d=$_POST['diskon'];
		$sql="SELECT * from barang where barang_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$id = $data['barang_id'];
		$jual = $data['barang_harga_jual'];
		$d=$_POST['diskon'];

		if ($d==0||$d=='') {
			# code...
			$diskon = $jumlah*($jual*$data['barang_diskon']/100);
		}else {
			$diskon = $jumlah*($jual*$d/100);
		}
		$komisi_bo = 0;
		$komisi_dokter = 0;
		$beli = $data['barang_harga_beli'];
		$harga = $jual*$jumlah;
		$user = $_SESSION['login_user'];
		$jenis = 0;
		$koadmin=0;
		$kobo=0;
		$kodokter=0;
		
		

		$sqlquery1=mysql_query("SELECT sum(transaksi_temp_jumlah) as jumlah from transaksi_temp where transaksi_temp_barang_id=$id");
		$sqldata1=mysql_fetch_array($sqlquery1);

		$selisih = $data['barang_stok'] - $jumlah - $sqldata1['jumlah'];

		if ($selisih<0 && $jenis!='treatment') {
			# code...

		    echo ("<script>location.href='../transaksiklinik.php?menu=stokkurang'</script>");
		} else {
			# code...
			$a="INSERT into transaksi_temp(transaksi_temp_no_nota,transaksi_temp_barang_id,transaksi_temp_harga_beli,transaksi_temp_harga_jual,transaksi_temp_jumlah,transaksi_temp_subtotal,transaksi_temp_keterangan,transaksi_temp_user_id,transaksi_temp_komisi_admin,transaksi_temp_komisi_bo,transaksi_temp_komisi_dokter,transaksi_temp_diskon)values('0','$id','$beli','$jual','$jumlah','$harga','','$user','$koadmin','$kobo','$kodokter','$diskon')";
			
			$b=mysql_query($a);
			echo mysql_error();
			if($b){
			    echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");
			}else{
			echo "<script type='text/javascript'>
				onload =function(){
				alert('Data gagal disimpan');
				}
				</script>";
			}
		}
		
	} elseif (isset($_POST['klinik'])) {
		# code...
		$_SESSION['kembalian'] = 0;
		$_SESSION['print'] = 'tidak';

		$admin = 0;
		$bo = 0;
		$dokter = 0;

		$member = $_POST['member_id'];
		if ($member==0) {
			# code...

		    	echo ("<script>location.href='../transaksi.php?menu=home'</script>");
		} else {
			# code...

			$user = $_SESSION['login_user'];
			$a="INSERT into member_temp(member_id,user_id,admin_id,bo_id,dokter_id,member_temp_ket)values('$member','$user','$admin','$bo','$dokter','klinik')";
			$b=mysql_query($a);
		    	echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");
			
		}
		
		
		
	} elseif (isset($_POST['member'])) {
		# code...
		$_SESSION['kembalian'] = 0;
		$_SESSION['print'] = 'tidak';

		$admin = 0;
		$bo = 0;
		$dokter = 0;

		$member = $_POST['member_id'];
		if ($member==0) {
			# code...

		    	echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");
		} else {
			# code...

			$user = $_SESSION['login_user'];
			$a="INSERT into member_temp(member_id,user_id,admin_id,bo_id,dokter_id,member_temp_ket)values('$member','$user','$admin','$bo','$dokter''member')";
			$b=mysql_query($a);
		    	echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");
			
		}
		
		
		
	} elseif (isset($_POST['editjumlah'])){
		$jumlah=$_POST['jumlah']; 
		$id = $_POST['id'];


		$sql="SELECT * from transaksi_temp where transaksi_temp_id = '$id' ";
		$result=mysql_query($sql);
		$data=mysql_fetch_array($result);
		$jual = $data['transaksi_temp_harga_jual'];
		$total = $jumlah*$jual;
		$barangid = $data['transaksi_temp_barang_id'];

		$sqlbarang="SELECT * from barang where barang_id = '$barangid' ";
		$resultbarang=mysql_query($sqlbarang);
		$databarang=mysql_fetch_array($resultbarang);

		$c = $data['transaksi_temp_diskon'];
		$jmldiskon = ($data['transaksi_temp_diskon']/$data['transaksi_temp_subtotal'])*100;
		if ($c==0||$c=='') {
			# code...
			$diskon = $jumlah*($jual*$databarang['barang_diskon']/100);
		}else {
			$diskon = $jumlah*($jual*$jmldiskon/100);
		}
		

		$a="UPDATE transaksi_temp set transaksi_temp_jumlah='$jumlah', transaksi_temp_diskon='$diskon', transaksi_temp_subtotal='$total' where transaksi_temp_id='$id'";
		$b=mysql_query($a);
		if($b){
		    echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['bayarsekarang'])){

		
		$user = $_SESSION['login_user'];
		$text_line = explode(".",$_POST['bayar']);
		$length=count($text_line);
		if ($length==1) {
			$bayar=$text_line[0];
			# code...
		}elseif ($length==2) {
			$bayar=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		$diskon=$_POST['diskon'];
		$subtotal=$_POST['subtotal'];
		$status=$_POST['status'];
		$kembalian = $bayar - ($subtotal - $diskon);

		if ($kembalian < 0) {
			# code...
		    echo ("<script>location.href='../transaksiklinik.php?menu=kurang'</script>");
		} else {
			# code...
			$ketmember = $_POST['keteranganmember'];
			$sqlte1="SELECT * from member_temp where user_id='$user'";
			$queryte1=mysql_query($sqlte1);
	    	$data=mysql_fetch_array($queryte1);
	    	$member = $data['member_id'];
	    	$admin = $data['admin_id'];
			$bo = $data['bo_id'];
			$dokter = $data['dokter_id'];


			$sql = "INSERT INTO transaksi (transaksi_tanggal,transaksi_bulan,transaksi_waktu,transaksi_member,transaksi_total,transaksi_bayar,transaksi_diskon,transaksi_user,transaksi_admin,transaksi_dokter,transaksi_bo,transaksi_status,transaksi_keterangan_member) VALUES ('$tgl','$bulan','$wkt','$member','$subtotal','$bayar','$diskon','$user','$admin','$dokter','$bo','$status','$ketmember')" ;
			mysql_query($sql);

	        $qn= "SELECT MAX( transaksi_id ) AS nota FROM transaksi where transaksi_user='$user'";
	        $rn=mysql_query($qn);
	        $dn=mysql_fetch_array($rn);
	        $no_not = $dn['nota'];
	        $_SESSION['no-nota-klinik'] = $no_not;
	        //echo $_SESSION['no-nota-klinik'];

	        $sql="SELECT * from transaksi_temp where transaksi_temp_user_id='$user'";
	        $query=mysql_query($sql);
	        while ($data1=mysql_fetch_array($query)) {

	        	$barang = $data1['transaksi_temp_barang_id'];
	        	$beli = $data1['transaksi_temp_harga_beli'];
	        	$jual = $data1['transaksi_temp_harga_jual'];
	        	$jumlah = $data1['transaksi_temp_jumlah'];
	        	$subtotal = $data1['transaksi_temp_subtotal'];
	        	$ket = $data1['transaksi_temp_keterangan'];
	        	$user = $data1['transaksi_temp_user_id'];
	        	$diskon = $data1['transaksi_temp_diskon'];

	        	$sql="SELECT * from barang where barang_id = '$barang' ";
				$result=mysql_query($sql);
				$data=mysql_fetch_array($result);
				
				
				$koadmin=0;
				$kobo=0;
				$kodokter=0;
				
	        	$a="INSERT into transaksi_detail(transaksi_detail_no_nota,transaksi_detail_barang_id,transaksi_detail_harga_beli,transaksi_detail_harga_jual,transaksi_detail_jumlah,transaksi_detail_subtotal,transaksi_detail_keterangan,transaksi_detail_user_id,transaksi_detail_komisi_admin,transaksi_detail_komisi_bo,transaksi_detail_komisi_dokter,transaksi_detail_diskon)values('$no_not','$barang','$beli','$jual','$jumlah','$subtotal','$ket','$user','$koadmin','$kobo','$kodokter','$diskon')";
				$b=mysql_query($a);
				echo mysql_error();

				//Select Stok Barang
				$sqlkem11="SELECT barang_stok from barang where barang_id='$barang'";
		        $querykem11=mysql_query($sqlkem11);
		        $datakem11=mysql_fetch_array($querykem11);
		        $jml_stok = $datakem11['barang_stok'] - $jumlah;
		        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$barang'");
		       
		        
		        


				
	        }
	        $_SESSION['kembalian'] = $kembalian;
	        $_SESSION['print'] = 'ya';

			mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
			mysql_query("DELETE from member_temp where user_id='$user'");

			echo ("<script>location.href='../transaksiklinik.php?menu=home&kem=$kembalian'</script>");

	        /*
			$a="INSERT into transaksi_temp(transaksi_temp_no_nota,transaksi_temp_barang_id,transaksi_temp_harga_beli,transaksi_temp_harga_jual,transaksi_temp_jumlah,transaksi_temp_subtotal,transaksi_temp_keterangan,transaksi_temp_user_id)values('0','$id','$beli','$jual','$jumlah','$harga','','$user')";
			$b=mysql_query($a);
			echo mysql_error();
			if($b){
				header('location:../transaksiklinik.php?menu=home');
			}else{
			echo "<script type='text/javascript'>
				onload =function(){
				alert('Data gagal disimpan');
				}
				</script>";
			}
			*/
		}
		
		
	} elseif (isset($_POST['ceknota'])) {
		# code...

		$nota = $_POST['nota'];
		
    	echo ("<script>location.href='../transaksiklinik.php?menu=nota&id=$nota'</script>");
		
	} else {

	}



