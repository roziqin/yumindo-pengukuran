<?php
session_start();
  include"../include/koneksi.php";
  include "../include/fungsi_rupiah.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$wkt=date('G:i:s');

  $id = $_GET['id'];

  $text_line = explode("-",$_GET['tanggal']);
  $bulan = $text_line[0];
  $tahun = $text_line[1];
  
  $tahun1 = $text_line[1];
  $bln1 = $bulan - 1;
  if ($bln1==0) {
    # code...
    $bln1=12;
    $tahun1 = $tahun1 - 1;
  }
  if ($bln1<10) {
    # code...
    $bln1 = '0'.$bln1;
  }

  if ($bln1 = '01') {
    # code...
    $namabulan = 'JANUARI';
  } elseif ($bln1 = '02') {
    # code...
    $namabulan = 'FEBRUARI';
  } elseif ($bln1 = '03') {
    # code...
    $namabulan = 'MARET';
  } elseif ($bln1 = '04') {
    # code...
    $namabulan = 'APRIL';
  } elseif ($bln1 = '05') {
    # code...
    $namabulan = 'MEI';
  } elseif ($bln1 = '06') {
    # code...
    $namabulan = 'JUNI';
  } elseif ($bln1 = '07') {
    # code...
    $namabulan = 'JULI';
  } elseif ($bln1 = '08') {
    # code...
    $namabulan = 'AGUSTUS';
  } elseif ($bln1 = '09') {
    # code...
    $namabulan = 'SEPTEMBER';
  } elseif ($bln1 = '10') {
    # code...
    $namabulan = 'OKTOBER';
  } elseif ($bln1 = '11') {
    # code...
    $namabulan = 'NOVEMBER';
  } else {
    # code...
    $namabulan = 'DESEMBER';
  }
  
  $tgl1=$tahun1.'-'.$bln1."-26";
  $tgl2=$tahun.'-'.$bulan.'-25';
          

  $sql = mysql_query("SELECT * from users where id='$id'");
  $data = mysql_fetch_array($sql);
  $nama=$data['name'];
  $jabatan=$data['role'];
  
  $gaji = $data['gaji'];
  $komisiobat = 0;
  $komisitindakan = 0;

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
<img src="../dist/img/logo_png.png" style=" width: 100px;
    margin: 0 auto 10px;
    display: block;">
<table  width="100%" border="0"  style='font-size: 13px;'>
  <tr>
    <th colspan="4">DAFTAR PENERIMAAN JASA PEGAWAI</th>
  </tr>
  <tr>
    <th colspan="4">BULAN <?php echo $namabulan.' - '.$tahun; ?></th>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style='font-size: 13px;'>
  <tr>
    <td width="120">Nama Pegawai</td>
    <td width="10">:</td>
    <td ><?php echo $nama;?></td>
  </tr>
  <tr>
    <td width="60">Jabatan</td>
    <td width="10">:</td>
    <td ><?php echo $jabatan;?></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" class="table1" style='font-size: 13px;'>
  <tr>
    <th width="20">No</th>
    <th width="200">Keterangan</th>
    <th>Jumlah</th>
  </tr>
  <tr>
    <td >1</td>
    <td >Gaji Pokok</td>
    <td >Rp. <?php echo format_rupiah($data['gaji']);?></td>
  </tr>
  <?php
  if ($data['role'] == 'admin') {
            $query1=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisiobat = $data['obat'];
    ?>
      <tr>
        <td >2</td>
        <td >Komisi Obat</td>
        <td >Rp. <?php echo format_rupiah($data['obat']);?></td>
      </tr>
    <?php
    }
    $query1=mysql_query("SELECT sum(transaksi_detail_komisi_admin) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_admin='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisitindakan = $data['treatment'];
    ?>
      <tr>
        <td >3</td>
        <td >Komisi Tindakan</td>
        <td >Rp. <?php echo format_rupiah($data['treatment']);?></td>
      </tr>

    <?php
    }
  } elseif ($data['role'] == 'bo') {
            $query1=mysql_query("SELECT  sum(transaksi_detail_komisi_bo) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisiobat = $data['obat'];
    ?>
    
      <tr>
        <td >2</td>
        <td >Komisi Obat</td>
        <td >Rp. <?php echo format_rupiah($data['obat']);?></td>
      </tr>


    <?php
    }
    $query1=mysql_query("SELECT  sum(transaksi_detail_komisi_bo) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_bo='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisitindakan = $data['treatment'];
    ?>
      <tr>
        <td >3</td>
        <td >Komisi Tindakan</td>
        <td >Rp. <?php echo format_rupiah($data['treatment']);?></td>
      </tr>

    <?php
    }
  } elseif ($data['role'] == 'dokter') {
            $query1=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as obat from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='obat' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisiobat = $data['obat'];
    ?>
      <tr>
        <td >2</td>
        <td >Komisi Obat</td>
        <td >Rp. <?php echo format_rupiah($data['obat']);?></td>
      </tr>
    <?php
    }
    $query1=mysql_query("SELECT sum(transaksi_detail_komisi_dokter) as treatment from transaksi t, transaksi_detail td, barang b where transaksi_id=transaksi_detail_no_nota and transaksi_detail_barang_id=barang_id and transaksi_dokter='$id' and barang_jenis='treatment' and transaksi_tanggal between '$tgl1' and '$tgl2' ");
    
    while ($data=mysql_fetch_array($query1)) {
      $komisitindakan = $data['treatment'];
    ?>
      <tr>
        <td >3</td>
        <td >Komisi Tindakan</td>
        <td >Rp. <?php echo format_rupiah($data['treatment']);?></td>
      </tr>
    <?php
    }
  }

  ?>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
      <tr>
        <td ></td>
        <td >Total yg diterima</td>
        <td >Rp. <?php echo format_rupiah($gaji+$komisiobat+$komisitindakan);?></td>
      </tr>
  </table>
</div>
</body>
</html>
