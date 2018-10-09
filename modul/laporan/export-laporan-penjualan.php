<?php

// Database Connection
include "../../include/koneksi.php";

// Fetch Record from Database

$tgl = $_GET['tanggal'];
$output = "";

// Get The Field Name
$bb="Bulan";
$aa="Omset";

/*for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
*/
$output .= '"'.$bb.'",';
$output .= '"'.$aa.'",';
$output .="\n";

// Get Records from the table
$text_line = explode(":",$_GET['tanggal']);
$tgl1=$text_line[0];
$tgl2=$text_line[1];
$query=mysql_query("SELECT laporan_omset_bulan, sum(laporan_omset_jumlah) as total from laporan_omset where laporan_omset_bulan between '$tgl1' and '$tgl2' group by laporan_omset_bulan order by laporan_omset_bulan ASC");
while ($datatea=mysql_fetch_array($query)) {

	$t = $datatea["laporan_omset_bulan"];
	$bersih = $datatea["total"];


	$output .='"'.$t.'",';
	$output .='"'.$bersih.'",';

	$output .="\n";
}

// Download the file

$filename = "laporan_Penjualan-".$tgl.".xls";
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>