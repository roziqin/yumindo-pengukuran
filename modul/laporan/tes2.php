<?php

$tgl = $_GET['tanggal'];

$filename = "laporan_Penjualan_Detail-".$tgl.".xls";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header('Content-Disposition: attachment; filename='.$filename);
include 'data-detail.php';
exit;

?>