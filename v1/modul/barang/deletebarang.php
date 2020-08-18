<?php
include "../../include/koneksi.php";
$idklinik = $_GET['idklinik'];

$sql="DELETE from barang where barang_id='$_GET[id]'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}
	
	echo ("<script>location.href='../../home.php?menu=barangklinik&id=$idklinik'</script>");
	
	
?>