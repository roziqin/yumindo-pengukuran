<?php
session_start();
  include"../include/koneksi.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
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
      
      $tanggal = $data['pengukuran_tanggal'];
    }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Print style -->
<link rel="stylesheet" href="../dist/css/print.css">
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10px;">
    <div class="wrapper">
<table  width="100%" border="0"  style='font-size: 13px;'>
  <tr>
    <th colspan="4">FORM PENGUKURAN YUMINDO</th>
  </tr>
  <tr>
    <td width="10%">Tanggal</td>
    <td width="3%">:</td>
    <td width="42%"><?php echo $tanggal;?></td>
    <td  align="right" width="45%">Petugas : <?php echo $user; ?></td>
  </tr>
  <tr>
    <td>Nama Customer</td>
    <td>:</td>
    <td><?php echo $pelanggan;?></td>
    <td  align="right"></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?php echo $alamat;?></td>
    <td align="right" width="55"></td>
  </tr>
  <tr>
    <td>No Telp</td>
    <td>:</td>
    <td><?php echo $notelp;?></td>
    <td align="right" width="55"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td>:</td>
    <td><?php echo $email;?></td>
    <td align="right" width="55"></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style='font-size: 13px;' class="print">
  <tr>
    <th rowspan="2" width="280px">Ruang</th>
    <th rowspan="2">Jenis<br>G/V/BL</th>
    <th rowspan="2">Kode<br>Bahan</th>
    <th rowspan="2" width="150px">model</th>
    <th rowspan="2">Jumlah</th>
    <th rowspan="2">KT/E</th>
    <th colspan="2">Rel/Alat</th>
    <th colspan="2">Ukuran</th>
  </tr>
  <tr>
    <th>Warna</th>
    <th>Ukuran</th>
    <th>P</th>
    <th>L</th>
  </tr>
   <?php
    $no=1;
    $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$t' ORDER BY pengukuran_detail_id ASC";
      $queryte1=mysql_query($sqlte1);
      while ($datatea=mysql_fetch_array($queryte1)) {
      ?>
        <tr>
          <td style="text-align: left;"><?php echo $datatea["pengukuran_detail_ruang"]; ?></td>
          <td><?php echo $datatea["jenis_nama"]; ?></td>
          <td><?php echo $datatea["kain_nama"]; ?></td>
          <td><?php echo $datatea["model_nama"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_jumlah"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_kt"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_alat_warna"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_alat_ukuran"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_tinggi"]; ?></td>
          <td><?php echo $datatea["pengukuran_detail_lebar"]; ?></td>
        </tr>
      <?php
      
      
      $no=$no+1;
    }         
  ?>
  <!--
  <tr>
    <th align="left" scope="row">Subtotal </th>
    <td>:</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo $subtotal; ?></td>
  </tr>
  -->
</table>
<table style="font-size: 13px;">
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
</div>
</body>
</html>
