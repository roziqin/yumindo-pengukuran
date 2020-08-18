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



$t = $_GET['id'];
$idnot = $_GET['id'];

$sql="SELECT * from pengukuran, users_lain where pengukuran_user=id and pengukuran_id='$t' ";
$query=mysql_query($sql);
while ($data=mysql_fetch_array($query)) {

  $idpelanggan=$data['pengukuran_pelanggan'];
  $html='';
$sql3="SELECT * from  users_lain where id='$idpelanggan' ";
$query3=mysql_query($sql3);
$data3=mysql_fetch_array($query3);

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
}
$html.='
	<div style="width: 100%; display: inline-block;"><img src="logoyumindo.png" width="100px" height="auto" style="float: left;display: inline-block;"><div style="float: left; display: inline-block; width: 205px; padding-top: 20px;">Jalan Semanggi Timur Kav 1A, Jalan Soekarno Hatta, Jatimulyo, Kec. Lowokwaru, Kota Malang</div></div>
	<div style="clear: both;"></div>
	<table  width="100%" border="0"  style="font-size: 13px;"">
	  <tr>
	    <td width="10%">Nama Customer</td>
	    <td width="3%">:</td>
	    <td width="42%">'.$pelanggan.'</td>
	    <td  align="right" width="45%" style="font-size:16px; font-weight: 700;">Form Order Bahan</td>
	  </tr>
	</table>

	
	';
	

					if ($data["pengukuran_kualitas"]=='Premium') {
							# code...
							$ketkualitas = 3;
						} elseif ($data["pengukuran_kualitas"]=='Gold') {
							# code...
							$ketkualitas = 2.6;
						} else {
							# code...
							$ketkualitas = 2.3;
						}
						
	                    $sqlte8="SELECT pengukuran_detail_kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan";
						$queryte8=mysql_query($sqlte8);
						while ($datatea8=mysql_fetch_array($queryte8)) {
							
						}
					$html.='
		              	<table id="listbarang" width="100%" border="1"  style="font-size: 13px;border-spacing: 0;" class="print">
		                    <thead>
		                    <tr>
		                      <th rowspan="2" width="200px">Ruang</th>
		                      <th colspan="2" style="text-align: center;">Ukuran</th>
		                      <th rowspan="2" width="40px">Jumlah</th>';
		                      
			                    $databahan1[][]= array();
				            	$yy = 0;
			                    $sqlte7="SELECT pengukuran_detail_kode_bahan_1, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan_1";
								$queryte7=mysql_query($sqlte7);
								while ($datatea7=mysql_fetch_array($queryte7)) {
									if ($datatea7["pengukuran_detail_kode_bahan_1"]!='') {
										# code...

				                      $databahan1[$yy][0] = $datatea7["pengukuran_detail_kode_bahan_1"]; 
										$yy++;	
				                      $html.='<th rowspan="2" width="40px">'.$datatea7["pengukuran_detail_kode_bahan_1"].'</th>';
									
									}
								}
								$jb1 = count($databahan1);

								$databahan[][]= array();
				            	$y = 0;
			                    $sqlte8="SELECT pengukuran_detail_kode_bahan, jenis_nama from pengukuran_detail,jenis where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY pengukuran_detail_kode_bahan";
								$queryte8=mysql_query($sqlte8);
								while ($datatea8=mysql_fetch_array($queryte8)) {

									if ($datatea8["pengukuran_detail_kode_bahan"]!='') {
										$databahan[$y][0] = $datatea8["pengukuran_detail_kode_bahan"]; 
										$y++;	
				                      $html.='<th rowspan="2" width="40px">'.$datatea8["pengukuran_detail_kode_bahan"].'</th>';
				                  }
								
								}
								$jb = count($databahan);

								$datajumlahbahan[][]= array();
				            	$y1 = 0;
			                    $sqlta="SELECT order_bahan_kode_bahan_1, SUM(order_bahan_jumlah_kode_bahan_1) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_kode_bahan_1";
								$queryta=mysql_query($sqlta);
								while ($dataa=mysql_fetch_array($queryta)) {

									if ($dataa["order_bahan_kode_bahan_1"]!='') {
										$datajumlahbahan[$y1][0] = $dataa["order_bahan_kode_bahan_1"];
										$datajumlahbahan[$y1][1] = $dataa["jumlah"]; 
										$y1++;	
				                  }
								
								}
								$djb = count($datajumlahbahan);

								$datajumlahbahan[][]= array();
				            	$y11 = 0;
			                    $sqlta1="SELECT order_bahan_kode_bahan_2, SUM(order_bahan_jumlah_kode_bahan_2) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_kode_bahan_2";
								$queryta1=mysql_query($sqlta1);
								while ($dataa1=mysql_fetch_array($queryta1)) {

									if ($dataa1["order_bahan_kode_bahan_2"]!='') {
										$datajumlahbahan1[$y11][0] = $dataa1["order_bahan_kode_bahan_2"];
										$datajumlahbahan1[$y11][1] = $dataa1["jumlah"]; 
										$y11++;	
				                  }
								
								}
								$djb1 = count($datajumlahbahan1);


								$datajumlahrel[][]= array();
				            	$z1 = 0;
			                    $sqltb="SELECT order_bahan_rel_alat_1, SUM(order_bahan_jumlah_rel_alat_1) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_rel_alat_1";
								$queryb=mysql_query($sqltb);
								while ($datab=mysql_fetch_array($queryb)) {

									if ($datab["order_bahan_rel_alat_1"]!='') {
										$datajumlahrel[$z1][0] = $datab["order_bahan_rel_alat_1"];
										$datajumlahrel[$z1][1] = $datab["jumlah"]; 
										$z1++;	
				                  }
								
								}
								$djr = count($datajumlahrel);

								$datajumlahrel1[][]= array();
				            	$z11 = 0;
			                    $sqltb1="SELECT order_bahan_rel_alat_2, SUM(order_bahan_jumlah_rel_alat_2) as jumlah FROM `order_bahan`, pengukuran_detail WHERE order_bahan_detail_pengukuran_id=pengukuran_detail_id and pengukuran_id='$idnot' GROUP by order_bahan_rel_alat_2";
								$queryb1=mysql_query($sqltb1);
								while ($datab1=mysql_fetch_array($queryb1)) {

									if ($datab1["order_bahan_rel_alat_2"]!='') {
										$datajumlahrel1[$z11][0] = $datab1["order_bahan_rel_alat_2"];
										$datajumlahrel1[$z11][1] = $datab1["jumlah"]; 
										$z11++;	
				                  }
								
								}
								$djr1 = count($datajumlahrel1);

							$html.='
							  <th colspan="3" style="text-align: center;">Rel</th>
		                    </tr>
		                    <tr>
		                      <th style="text-align: center;" width="40px">Tinggi</th>
		                      <th style="text-align: center;" width="40px">Lebar</th>
		                      <th style="text-align: center;" width="40px">Rolet</th>
		                      <th style="text-align: center;" width="40px">Delux</th>
		                      <th style="text-align: center;" width="40px">Lengkung</th>
		                    </tr>
		                    </thead>
		                    <tbody>';
		                    $t = 0;
		                    if ($data["pengukuran_kualitas"]=='Premium') {
		                    	# code...
		                    	$t = 3;
		                    } elseif ($data["pengukuran_kualitas"]=='Gold') {
		                    	$t = 2.6;
		                    }else {
		                    	# code...
		                    	$t = 2.3;
		                    }

			            	$datajenis[][]= array();
			            	$z = 0;
		                    $sqlte9="SELECT jenis_nama from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_id='$idnot' GROUP BY jenis_id";
		                      $queryte9=mysql_query($sqlte9);
		                      while ($datatea9=mysql_fetch_array($queryte9)) {
		                      	$datajenis[$z][0] = $datatea9["jenis_nama"]; 
		                      	$z++;
		                      }

		                      $sqlte1="SELECT * from pengukuran_detail, jenis, kain, model where pengukuran_detail_jenis=jenis_id and pengukuran_detail_bahan=kain_id and pengukuran_detail_model=model_id and pengukuran_id='$idnot' ORDER BY pengukuran_detail_id ASC";
		                      $queryte1=mysql_query($sqlte1);
		                      while ($datatea=mysql_fetch_array($queryte1)) {
		                      		$iddetail = $datatea['pengukuran_detail_id'];
		                      
		                      $sqlte2="SELECT * from order_bahan where order_bahan_detail_pengukuran_id='$iddetail'";
		                      $queryte2=mysql_query($sqlte2);
		                      $data2=mysql_fetch_array($queryte2);
		                      	# code...
		                      	
		                      
		                      $html.='
		                        <tr>
	                              <td>'.$datatea["pengukuran_detail_ruang"].'</td>
		                          <td style="text-align: center;">'.$datatea["pengukuran_detail_tinggi"].'</td>
		                          <td style="text-align: center;">'.$datatea["pengukuran_detail_lebar"].'</td>
		                          <td style="text-align: center;">'.$datatea["pengukuran_detail_jumlah"].'</td>
		                        ';
		                    	$kk = 0;
		                        while ($kk < $jb1) {
		                        	# code...
		                        	if ($databahan1[$kk][0]==$datatea["pengukuran_detail_kode_bahan_1"]) {
		                        		# code...
		                        	$html.='
		                        	<td>
									    '.$data2['order_bahan_jumlah_kode_bahan_2'].'

									</td>';
		                        	
		                        	} else {
		                        		if ($yy!=0) {
			                        		$html.='<td></td>';
		                        		}
		                        	
		                        	}
		                        	$kk++;
		                        }

		                        $k = 0;
		                        while ($k < $jb) {
		                        	# code...
		                        	if ($databahan[$k][0]==$datatea["pengukuran_detail_kode_bahan"]) {
		                        		# code...
		                        	$html.='
		                        	<td>
		                        	'.$data2["order_bahan_jumlah_kode_bahan_1"].'
									</td>';

		                        	} else {
		                        		if ($y!=0) {
			                        		$html.='<td></td>';
		                        		}
		                        	
		                        	}
		                        	$k++;
		                        }

		                        if ("Rolet"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_1"].'
								</td>';
	                        	} elseif ("Rolet"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_2"].'
								</td>';
	                        	} else {
	                        		$html.='<td></td>';
	                        	
	                        	}

	                        	if ("Delux"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_1"].'
								</td>';
	                        	} elseif ("Delux"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_2"].'
								</td>';
	                        	} else {
	                        		$html.='<td></td>';
	                        	
	                        	}

		                        if ("Lengkung"==$datatea["pengukuran_detail_alat_1"]) {
	                        		# code...
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_1"].'
								</td>';
	                        	} elseif ("Lengkung"==$datatea["pengukuran_detail_alat_2"]) {
	                        		# code...
	                        	
	                        	$html.='
	                        	<td>
								    '.$data2["order_bahan_jumlah_rel_alat_2"].'
								</td>';
	                        	} else {
	                        		$html.='<td></td>';
	                        	
	                        	}

		                    $html.='
		                    	</tr>';
		                    }

		                    $html.='<tr>
		                      	<td colspan="4">Jumlah</td>';
		                      	
		                      	for ($i=0; $i < $jb1; $i++) { 
		                      		# code...
		                      		for ($j=0; $j < $djb1 ; $j++) { 
		                      			# code...
		                      			if ($databahan1[$i][0]==$datajumlahbahan1[$j][0]) {
		                        		$html.='
			                        	<td>
			                        		'.$datajumlahbahan1[$j][1].'
										</td>';
		                        		}
		                      		}
		                      	}

		                      	
		                      	for ($i=0; $i < $jb; $i++) { 
		                      		# code...
		                      		for ($j=0; $j < $djb ; $j++) { 
		                      			# code...
		                      			if ($databahan[$i][0]==$datajumlahbahan[$j][0]) {
		                        		$html.='
			                        	<td>
			                        		'.$datajumlahbahan[$j][1].'
										</td>';

		                        		}
		                      		}
		                      	}

                      			$jmlrolet = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Rolet"==$datajumlahrel[$j][0]) {
	                        			$jmlrolet += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Rolet"==$datajumlahrel1[$j][0]) {
	                        			$jmlrolet += $datajumlahrel1[$j][1];
	                        		}	
	                      		}

	                      		$html.='
	                        	<td>
	                        		'.$jmlrolet.'
								</td>';

                      			$jmldelux = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Delux"==$datajumlahrel[$j][0]) {
	                        			$jmldelux += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Delux"==$datajumlahrel1[$j][0]) {
	                        			$jmldelux += $datajumlahrel1[$j][1];
	                        		}	
	                      		}
	                      		$html.='
	                        	<td>
	                        		'.$jmldelux.'
								</td>';


	                        	$jmllengkung = 0;
		                      	for ($j=0; $j < $djr ; $j++) { 
	                      			# code...
	                      			if ("Lengkung"==$datajumlahrel[$j][0]) {
	                        			$jmllengkung += $datajumlahrel[$j][1];
	                        		}	
	                      		}
	                      		for ($j=0; $j < $djr1 ; $j++) { 
	                      			# code...
	                      			if ("Lengkung"==$datajumlahrel1[$j][0]) {
	                        			$jmllengkung += $datajumlahrel1[$j][1];
	                        		}	
	                      		}	                      		
	                      		$html.='
	                        	<td>
	                        		'.$jmllengkung.'
								</td>';


		                   	$html.='
		                   	</tr>
		                    </tbody>
		                </table>';

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
$dompdf->stream("formorderbahan-".$tanggal."-".$pelanggan.".pdf", array("Attachment"=>0));

?>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>