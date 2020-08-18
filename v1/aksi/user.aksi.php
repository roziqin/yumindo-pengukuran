<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
	

	if(isset($_POST['tambah'])){
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		$role = $_POST['role'];
		$tglbooking = date('Y-m-d', strtotime($_POST['tanggal'] . ' +0 day'));
		
		$a="INSERT into users_lain(name,email,alamat,telepon,role)values('$nama','$email','$alamat','$telepon','$role')";
		$b=mysql_query($a);
		
		if($b){
		    echo ("<script>location.href='../admin.php?menu=inputpelanggan&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
		
		
	}
	if(isset($_POST['booking'])){
		$nama = $_POST['nama'];
		$tglbooking = date('Y-m-d', strtotime($_POST['tanggal'] . ' +0 day'));
		
		
        $c="INSERT into booking_pengukuran(booking_pengukuran_pelanggan,booking_pengukuran_tanggal,booking_pengukuran_tanggal_booking,booking_pengukuran_user,booking_pengukuran_status)values('$nama','$tgl','$tglbooking','0','Booking')";
		mysql_query($c);

		echo mysql_error();
		
		if($c){
		    echo ("<script>location.href='../admin.php?menu=inputbooking&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
		
		
	}
	if (isset($_POST['edituser'])) {
		# code...
		$nama=$_POST['nama'];
	$username=$_POST['username'];
	$email=$_POST['username']."@gmail.com";
	$password=md5($_POST['password']);
	$jenis=$_POST['jenis'];

	
		$id=$_POST['id'];

	
		$a="UPDATE users_lain set name='$nama',username='$username', email='$email' where id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if ($password == '') {
			# code...
		} elseif ($password == NULL) {
			# code...
		} else {
			# code...
			mysql_query("UPDATE users set password='$password' where id='$id'");
		}
		
		if($b){
		   echo ("<script>location.href='../admin.php?menu=user&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}
	
if(isset($_POST['tambahuser'])){
		$nama=$_POST['nama'];
	$username=$_POST['username'];
	$email=$_POST['username']."@gmail.com";
	$password=md5($_POST['password']);
	$jenis=$_POST['jenis'];
	
	$qn= "SELECT * FROM roles_lain where roles_nama='$jenis'";
        $rn=mysql_query($qn);
        $dn=mysql_fetch_array($rn);
        $idrole = $dn['roles_id'];

		$a="INSERT into users_lain(name,username,email,password,role)values('$nama','$username','$email','$password','$idrole')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../admin.php?menu=user&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['edit'])) {
		# code...
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		
	$id=$_POST['id'];

	
		$id=$_POST['id'];
		$a="UPDATE users_lain set name='$nama',email='$email',alamat='$alamat',telepon=$telepon where id='$id'";
		$b=mysql_query($a);
		echo mysql_error();

		
		
		if($b){
		   echo ("<script>location.href='../admin.php?menu=inputpelanggan&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}