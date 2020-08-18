<?php
include "../../include/koneksi.php";
$sql="DELETE from farmasi where farmasi_id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
		header("location:../../home.php?menu=farmasi&id=0");
	
?>