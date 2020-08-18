<?php
include "../include/koneksi.php";
$id = $_GET['id'];
if ($_GET['menu']=='transaksi') {
	$sql="DELETE from pengukuran_detail_temp where pengukuran_detail_temp_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../home.php?menu=home'</script>";
	
	}

} elseif ($_GET['menu']=='transaksipenawaran') {
	$idukur = $_GET['idukur'];
	$sql="DELETE from pengukuran_detail where pengukuran_detail_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		$sqlukur="SELECT SUM(pengukuran_detail_harga) as jumlah FROM pengukuran_detail WHERE pengukuran_id='$idukur'";
		$queryukur=mysql_query($sqlukur);
		$dataukur=mysql_fetch_array($queryukur);
		$total = $dataukur["jumlah"];

		mysql_query("UPDATE pengukuran SET pengukuran_total_harga='$total' WHERE pengukuran_id='$idukur'");
		echo "<script>location.href='../admin.php?menu=detail&id=$idukur'</script>";
	
	}

}

?>