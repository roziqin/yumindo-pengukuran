<?php
include "../../include/koneksi.php";
if ($_GET['ket']=='pelanggan') {
	$sql="DELETE from users_lain where id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
	header("location:../../admin.php?menu=inputpelanggan&id=0");

}
if ($_GET['ket']=='user') {
	$sql="DELETE from users_lain where id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
	header("location:../../admin.php?menu=user&id=0");

}
if ($_GET['ket']=='booking') {
	$sql="DELETE from booking_pengukuran where booking_pengukuran_id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
	header("location:../../admin.php?menu=inputbooking&id=0");

}
	
?>