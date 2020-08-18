<?php

// Database Connection
include "../../include/koneksi.php";

?>
<table >
    <thead>
    <tr>
      <th>Bulan</th>
      <th>Omset</th>
    </tr>
    </thead>
    <tbody>
    <?php
    
    	$text_line = explode(":",$tgl);
		$tgl1=$text_line[0];
		$tgl2=$text_line[1];
    	$query=mysql_query("SELECT laporan_omset_bulan, sum(laporan_omset_jumlah) as total from laporan_omset where laporan_omset_bulan between '$tgl1' and '$tgl2' group by laporan_omset_bulan order by laporan_omset_bulan ASC");
			while ($datatea=mysql_fetch_assoc($query)) {

			$t = $datatea["laporan_omset_bulan"];
			$bersih = $datatea["total"];
		
		?>
			<tr>
				<td><?php echo $t; ?></td>
				<td><?php echo $bersih; ?></td>
			</tr>
		<?php
		}


    ?>
    </tbody>
</table>