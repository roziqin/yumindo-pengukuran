<?php
session_start();
include"../include/koneksi.php";
include "../include/fungsi_rupiah.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-d');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
$aa = "select * from users_lain where id='$aid'";
$bb = mysql_query($aa) or die(mysql_error());
$cc = mysql_fetch_array($bb);
$id=$cc['name'];
$iduser=$cc['id'];



$t = $_SESSION['no-id'];
$sql="SELECT * from pengukuran, users_lain where pengukuran_user=id and pengukuran_id='$t' ";
$query=mysql_query($sql);
while ($data=mysql_fetch_array($query)) {
  $pelanggan=$data['pengukuran_nama'];
  $alamat=$data['pengukuran_alamat'];
  $email=$data['pengukuran_email'];
  $notelp=$data['pengukuran_telepon'];
  $user=$data['name'];
  $id=$data['id'];
  
  $tanggal = date('d-m-Y', strtotime($data["pengukuran_tanggal"] . ' +0 day'));
}
$html = '
	<table  width="100%" border="0"  style="font-size: 13px;"">
	  <tr>
	    <th colspan="4" style="text-align: center;">FORM PESANAN KONSUMEN YUMINDO</th>
	  </tr>
	  <tr>
	    <td width="10%">Tanggal</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$tanggal.'</td>
	    <td  align="right" width="45%">Petugas : '.$user.'</td>
	  </tr>
	  <tr>
	    <td>Nama Customer</td>
	    <td>:</td>
	    <td>'.$pelanggan.'</td>
	    <td  align="right"></td>
	  </tr>
	  <tr>
	    <td>Alamat</td>
	    <td>:</td>
	    <td>'.$alamat.'</td>
	    <td align="right" ></td>
	  </tr>
	  <tr>
	    <td>No Telp</td>
	    <td>:</td>
	    <td>'.$notelp.'</td>
	    <td align="right" ></td>
	  </tr>
	  <tr>
	    <td>Email</td>
	    <td>:</td>
	    <td>'.$email.'</td>
	    <td align="right" ></td>
	  </tr>
	  <tr>
	    <td colspan="4"><hr></td>
	  </tr>
	</table>

	<table width="100%" border="0"  style="font-size: 13px;" class="print">
	  <tr style="text-align: center;">
	    <th rowspan="2" width="280px">Ruang</th>
	    <th rowspan="2">Jenis<br>G/V/BL</th>
	    <th rowspan="2">Kode<br>Bahan</th>
	    <th rowspan="2" width="150px">model</th>
	    <th rowspan="2">Jumlah</th>
	    <th rowspan="2">KT/E</th>
	    <th colspan="2">Rel/Alat</th>
	  </tr>
	  <tr>
	    <th>Warna</th>
	    <th>Ukuran</th>
	';
	$sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$t' ORDER BY pengukuran_detail_id ASC";
	$queryte1=mysql_query($sqlte1);
	while ($datatea=mysql_fetch_array($queryte1)) {
		$html.='
			<tr>
				<td style="text-align: left;">'.$datatea["pengukuran_detail_ruang"].'</td>
				<td>'.$datatea["jenis_nama"].'</td>
				<td>'.$datatea["kain_nama"].'</td>
				<td>'.$datatea["model_nama"].'</td>
				<td>'.$datatea["pengukuran_detail_jumlah"].'</td>
				<td>'.$datatea["pengukuran_detail_kt"].'</td>
				<td>'.$datatea["pengukuran_detail_alat_warna"].'</td>
				<td>'.$datatea["pengukuran_detail_alat_ukuran"].'</td>
			</tr>

		';
	}
	$html.='
		</table>
		<table style="font-size: 13px;">
		  <tr>
		    <td colspan="2"><hr></td>
		  </tr>
		  <tr>
		    <td width="50%">Saya telah memahami dan menyetujui ukuran, bahan, dan model tersebut di atas</td>
		    <td ></td>
		  </tr>
		  <tr>
		    <td><br>Pemesan<br><br><br><br><br><br></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td>
		      Catatan<br>
		      *Biaya pengukuran kota Malang Rp 50.000 yang dibayarkan saat pengukuran (luar kota penyesuaian)
		      *Biaya tersebut dipotongkan jika ada DP
		      *hasil pengukuran adalah hak dari Yumindo Garden
		    </td>
		    <td></td>
		  </tr>
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
$dompdf->stream("formpesanan-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>