<?php

// Database Connection
include "../../include/koneksi.php";

?>
<table>
    <thead>
    <tr>
      <th>Tanggal</th>
      <th>Nama Pelanggan</th>
      <th style="text-align: right;">Jumlah</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $jml=0;
    	$query=mysql_query("SELECT * from laporan_omset, pengukuran, users_lain where laporan_omset_bulan='$tgl' and laporan_omset_pengukuran_id=pengukuran_id and id=pengukuran_pelanggan ");
			while ($datatea=mysql_fetch_array($query)) {
			$jml+=$datatea["laporan_omset_jumlah"];
		?>
			<tr>
				<td><?php echo $datatea['laporan_omset_tanggal']; ?></td>
				<td><?php echo $datatea["name"]; ?></td>
				<td style="text-align: right;"><?php echo $datatea["laporan_omset_jumlah"]; ?></td>
			</tr>
		<?php
		}

    ?>
		<tr>
			<th colspan="2" style="border-top: 2px solid #000;">Total</th>
			<th style="text-align: right;border-top: 2px solid #000;"><?php echo $jml; ?></th>
		</tr>
    </tbody>
</table>