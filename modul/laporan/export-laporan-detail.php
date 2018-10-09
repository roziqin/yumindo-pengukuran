<?php

// Database Connection
include "../../include/koneksi.php";

// Fetch Record from Database

$tgl = $_GET['tanggal'];
$output = "";

// Get The Field Name
$bb="Tanggal";
$aa="Nama Pelanggan";
$dd="Jumlah";

/*for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
*/
$output .= '"'.$bb.'",';
$output .= '"'.$aa.'",';
$output .= '"'.$dd.'",';
$output .="\n";

// Get Records from the table
$jml=0;
$query=mysql_query("SELECT * from laporan_omset, pengukuran, users_lain where laporan_omset_bulan='$tgl' and laporan_omset_pengukuran_id=pengukuran_id and id=pengukuran_pelanggan ");
	while ($datatea=mysql_fetch_array($query)) {
		$jml+=$datatea["laporan_omset_jumlah"];

	$output .='"'.$datatea['laporan_omset_tanggal'].'",';
	$output .='"'.$datatea["name"].'",';
	$output .='"'.$datatea["laporan_omset_jumlah"].'",';

	$output .="\n";
}
$output .= '"Total",';
$output .= '"",';
$output .= '"'.$jml.'",';
$output .="\n";
// Download the file

$filename = "laporan_Penjualan_Detail-".$tgl.".xls";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;

?>