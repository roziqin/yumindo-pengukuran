<?php
session_start();
include"../include/koneksi.php";
include "../include/fungsi_rupiah.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');





$t = $_GET['id'];
$sql="SELECT * from pengukuran, users_lain where pengukuran_user=id and pengukuran_id='$t' ";
$query=mysql_query($sql);
while ($data=mysql_fetch_array($query)) {
  $idpelanggan=$data['pengukuran_pelanggan'];
  $userpasang=$data['pengukuran_user_pasang'];
  
$sql3="SELECT * from  users_lain where id='$idpelanggan' ";
$query3=mysql_query($sql3);
$data3=mysql_fetch_array($query3);

$sql4="SELECT * from  users_lain where id='$userpasang' ";
$query4=mysql_query($sql4);
$data4=mysql_fetch_array($query4);

  $pelanggan=$data3['name'];
  $alamat=$data3['alamat'];
  $email=$data3['email'];
  $notelp=$data3['telepon'];
  $user=$data['name'];
  $id=$data['id'];
  $diskon = $data['pengukuran_diskon'];
  $totalharga = $data['pengukuran_total_harga'];
  $dp = $data['pengukuran_dp'];
  $sisa = $totalharga - $dp;
  $tanggal = date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day'));
  $tanggalpasang = $data['pengukuran_tanggal_deal'];

  $tanggalpasang = date('d-m-Y', strtotime($tanggalpasang . ' +14 day'));
  $ket = "";
  
  	$ket = "Pemasangan";

	$aid = $data['pengukuran_user'];
	$aa = "select * from users_lain where id='$aid'";
	$bb = mysql_query($aa) or die(mysql_error());
	$cc = mysql_fetch_array($bb);
	$id=$cc['name'];
	$iduser=$cc['id'];

}
$html = '
	
	<div style="width: 100%; display: inline-block;"><img src="logoyumindo.png" width="100px" height="auto" style="float: left;display: inline-block;"><div style="float: left; display: inline-block; width: 205px; padding-top: 20px;">Jalan Semanggi Timur Kav 1A, Jalan Soekarno Hatta, Jatimulyo, Kec. Lowokwaru, Kota Malang</div></div>
	<div style="clear: both;"></div>
	<table  width="100%" border="0"  style="font-size: 13px;"">
	  <tr>
	    <td>Nama Customer</td>
	    <td>:</td>
	    <td>'.$pelanggan.'</td>
	    <td  align="right" width="45%" style="font-size:24px; font-weight: 700;">Form '.$ket.'</td>
	  </tr>
	  <tr>
	    <td>Alamat</td>
	    <td>:</td>
	    <td>'.$alamat.'</td>
	    <td  align="right"></td>
	  </tr>
	  <tr>
	    <td>No Telp</td>
	    <td>:</td>
	    <td>'.$notelp.'</td>
	    <td  align="right"></td>
	  </tr>
	  <tr>
	    <td>Email</td>
	    <td>:</td>
	    <td>'.$email.'</td>
	    <td>
	  </tr>
	  <tr>
	    <td>Nama Pemasang</td>
	    <td>:</td>
	    <td>'.$data4["name"].'</td>
	    <td  align="right" ></td>
	  </tr>
	  <tr>
	    <td width="10%">Tanggal Pasang</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$tanggalpasang.'</td>
	    <td  align="right" ></td>
	  </tr>
	</table>

	<table width="100%" border="1"  style="font-size: 13px;border-spacing: 0;" class="print">
	  <tr style="text-align: center;">
	    <th rowspan="2" >Ruang</th>
	    <th rowspan="2">Jenis<br>G/V/BL</th>
	    <th rowspan="2">Kode<br>Bahan</th>
	    <th rowspan="2" >model</th>
	    <th colspan="2">Ukuran</th>
	    <th rowspan="2">Vol</th>
	    <th rowspan="2">Jml</th>
	    <th rowspan="2">KT/E</th>
	    <th colspan="3">Rel</th>
	  </tr>
	  <tr>
	    <th style="text-align:center;">T</th>
	    <th style="text-align:center;">L</th>
	    <th style="text-align:center;">Alat</th>
	    <th style="text-align:center;">Warna</th>
	    <th style="text-align:center;">Ukuran</th>
	  </tr>
	';
	$tot = 0;
	$sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$t' ORDER BY pengukuran_detail_id ASC";
	$queryte1=mysql_query($sqlte1);
	while ($datatea=mysql_fetch_array($queryte1)) {
		$tot+=$datatea["pengukuran_detail_harga"];
		$kode1="";
		if ($datatea["pengukuran_detail_kode_bahan_1"]!="") {
			# code...
			$kode1 = "/".$datatea["pengukuran_detail_kode_bahan_1"];
		}
		
		$alat2="";
		if ($datatea["pengukuran_detail_alat_2"]!="") {
			# code...
			$alat2 = "+".$datatea["pengukuran_detail_alat_2"];
		}

		$ukuranrel="";
		if ($datatea["pengukuran_detail_alat_1"]!="") {
			# code...
			$ukuranrel = $datatea["pengukuran_detail_alat_ukuran"];
		}
		$html.='
			<tr>
				<td style="text-align: left;">'.$datatea["pengukuran_detail_ruang"].'</td>
				<td style="text-align:center;">'.$datatea["jenis_nama"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_kode_bahan"].''.$kode1.'</td>
				<td style="text-align:center;">'.$datatea["model_nama"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_tinggi"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_lebar"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_volume"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_jumlah"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_kt"].'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_alat_1"].''.$alat2.'</td>
				<td style="text-align:center;">'.$datatea["pengukuran_detail_alat_warna"].'</td>
				<td style="text-align:center;">'.$ukuranrel.'</td>
			</tr>

		';
	}
	$html.='
		</table>
	';

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("formpasang-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>