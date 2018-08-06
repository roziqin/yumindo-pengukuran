<?php
session_start();
  include"../include/koneksi.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
$aa = "select * from users where id='$aid'";
  $bb = mysql_query($aa) or die(mysql_error());
  $cc = mysql_fetch_array($bb);
  $id=$cc['name'];
  $iduser=$cc['id'];
  

      $t = $_SESSION['no-nota'];
  
    $sql="SELECT * from transaksi_fraktur, farmasi where transaksi_fraktur_farmasi=farmasi_id and transaksi_fraktur_id='$t' ";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      $farmasi=$data['farmasi_nama'];
      $nofraktur=$data['transaksi_fraktur_no'];
      $tanggalterkirim=$data['transaksi_fraktur_tanggal_terkirim'];
      $jatuhtempo=$data['transaksi_fraktur_jatuh_tempo'];
      $tanggal = $data['transaksi_fraktur_tanggal'];
      $tran_tot = $data['transaksi_fraktur_total'];
    }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Print style -->
<link rel="stylesheet" href="dist/css/print.css">
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10px;">
    <div class="wrapper">
<img src="../dist/img/logo_png.png" style=" width: 100px;
    margin: 0 auto 10px;
    display: block;">
<table  width="100%" border="0"  style='font-size: 13px;'>
  <tr>
    <th colspan="4">Jl. Trunojoyo No. 43 - Gondanglegi Malang</th>
  </tr>
  <tr>
    <th colspan="4">Tlp 0341 - 8571808</th>
  </tr>
  <tr>
    <th colspan="4"><?php echo $tgl." - ".$wkt; ?></th>
  </tr>
  <tr>
    <td width="100">Farmasi</td>
    <td width="10">:</td>
    <td ><?php echo $farmasi;?></td>
    <td  align="right"></td>
  </tr>
  <tr>
    <td>No Fraktur</td>
    <td>:</td>
    <td><?php echo $nofraktur;?></td>
    <td  align="right"><?php echo $t; ?></td>
  </tr>
  <tr>
    <td>Tanggal Terkirim</td>
    <td>:</td>
    <td><?php echo $tanggalterkirim;?></td>
    <td align="right" width="55"></td>
  </tr>
  <tr>
    <td>Jatuh Tempo</td>
    <td>:</td>
    <td><?php echo $jatuhtempo;?></td>
    <td align="right" width="55"></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style='font-size: 13px;'>
  <tr>
    <td align="center">Barang</td>
    <td width="24" align="center">Jml.</td>
    <td width="60" align="center">Harga</td>
    <td width="60" align="center">Subtotal</td>
  </tr>
   <?php
    $no=1;
    $sql="SELECT * from transaksi_fraktur_detail,barang WHERE transaksi_fraktur_detail_barang_id=barang_id and transaksi_fraktur_detail_fraktur_id='$t'";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      
		  
      $barang=$data['barang_nama'];
      $jumlah=$data['transaksi_fraktur_detail_jumlah'];
      $harga=$data['transaksi_fraktur_detail_harga_beli'];
      $tot=$jumlah*$harga;

      echo "

      <tr>
        <td>".$barang."</td>
        <td align='center'>".$jumlah."</td>
        <td align='right'>".$harga."</td>
        <td align='right'>".$tot."</td>
      </tr>
      ";
      
      $no=$no+1;
    }         
  ?>
  <tr>
    <td colspan="4"><hr color="black"></td>
  </tr>
  <!--
  <tr>
    <th align="left" scope="row">Subtotal </th>
    <td>:</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?php echo $subtotal; ?></td>
  </tr>
  -->
  <tr>
    <th align="left" scope="row" colspan="2">Total</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo $tran_tot ; ?></td>
  </tr>
  <tr>
    <th colspan="4">TERIMA KASIH</th>
  </tr>
</table>
</div>
</body>
</html>
