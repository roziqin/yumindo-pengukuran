<?php
	$nama_host="localhost";
	$user_db="root";
	$pass="";
	$nama_db="devyumindobaru";

	$koneksi=mysql_connect($nama_host,$user_db,$pass);

	if ($koneksi) {
		mysql_select_db($nama_db);
		# code...
	}else{
		echo "error1";
	}
?>