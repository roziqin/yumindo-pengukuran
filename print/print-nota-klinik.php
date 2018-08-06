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
  
    

      $t = $_SESSION['no-nota-klinik'];

    $sql="SELECT * from transaksi, klinik, klinik_cabang where transaksi_member=klinik_cabang_id and klinik_id=klinik_cabang_klinik_id and transaksi_id='$t' ";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      $pelanggan=$data['klinik_nama'];
      $idmember=$data['klinik_cabang_id'];
      $alamat=$data['klinik_cabang_alamat'];
      $type=$data['transaksi_status'];
      if ($type==0) {
        # code...
        $type='Cash';
      } else {
        $type='Debet';
      }
      $tanggal = $data['transaksi_tanggal'];
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
    <td width="60">Klinik</td>
    <td width="10">:</td>
    <td ><?php echo $pelanggan;?></td>
    <td  align="right">K - <?php echo $idmember; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?php echo $alamat;?></td>
    <td  align="right"><?php echo $t; ?></td>
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
    $sql="SELECT * from transaksi,transaksi_detail,barang,klinik, klinik_cabang WHERE transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_member=klinik_cabang_id and klinik_id=klinik_cabang_klinik_id and transaksi_id='$t'";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      
		  
      $barang=$data['barang_nama'];
      $jumlah=$data['transaksi_detail_jumlah'];
      $diskon=$data['transaksi_detail_diskon'];
      $harga=$data['transaksi_detail_harga_jual'];
      $tot=$jumlah*$harga;
      $tran_tot = $data['transaksi_total'] - $data['transaksi_diskon'];
      $bayar = $data['transaksi_bayar'];
      $kembalian = $bayar - $tran_tot;

      echo "

      <tr>
        <td>".$barang."</td>
        <td align='center'>".$jumlah."</td>
        <td align='right'>".$harga."</td>
        <td align='right'>".$tot."</td>
      </tr>
      ";
      if ($diskon!=0) {
        # code...
        echo "

      <tr>
        <td></td>
        <td align='center'>Diskon</td>
        <td align='right'></td>
        <td align='right' style='font-size: 15px;'>".$diskon."</td>
      </tr>
      ";

      }
      
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
    <th align="left" scope="row" colspan="2">Bayar</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo $bayar ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Kembalian</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo $kembalian ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Type Pembayaran</th>
    <td align="left">&nbsp;</td>
    <td align="right"><?php echo $type ; ?></td>
  </tr>
  <tr>
    <th colspan="4">BARANG YANG SUDAH DIBELI<br>TIDAK DAPAT DIKEMBALIKAN<br>TERIMA KASIH</th>
  </tr>
</table>
</div>
</body>
</html>
