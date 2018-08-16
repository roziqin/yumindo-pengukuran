<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bulan=date('Y-m');
$wkt=date('G:i:s');
	/*
	if (isset($_POST['inputpelanggan'])) {
		# code...
		
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		
		$user = $_SESSION['login_user'];
		
		$a="INSERT into pelanggan_temp(pelanggan_temp_nama,pelanggan_temp_email,pelanggan_temp_alamat,pelanggan_temp_telepon,peiolanggan_temp_user,pelanggan_temp_kualitas)values('$nama','$email','$alamat','$telepon','$user','Premium')";
		$b=mysql_query($a);
	    	echo ("<script>location.href='../home.php?menu=home'</script>");
		
		
		
		
	} else*/
	if (isset($_POST['inputpengukuran'])) {
		$user = $_SESSION['login_user'];
		
		$ruang = $_POST['ruang'];

		$jenisid = $_POST['jenis'];
		$sqljenis="SELECT * from jenis WHERE jenis_id='$jenisid'";
		$queryjenis=mysql_query($sqljenis);
		$datajenis=mysql_fetch_array($queryjenis);
		$jenis = $datajenis['jenis_nama'];
		$hargabahankain = $_POST['hargabahan'];
		$bahanid = $_POST['bahan'];
		$modelid = $_POST['model'];
		$kodebahan = $_POST['kodebahan'];
		$kodebahan1 = $_POST['kodebahan1'];
		$jumlah = $_POST['jumlah'];
		$kt = $_POST['kt'];
		$relwarna = $_POST['relwarna'];
		$relukuran = $_POST['lebar'];
		$relukuranasli = $_POST['lebar'];
		$relalat1 = $_POST['relalat1'];
		$relalat2 = $_POST['relalat2'];
		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$panjangasli = $_POST['panjang'];
		$lebarasli = $_POST['lebar'];
		$harga = 0;
		$hasilhitung = 0;
		$kk = $_POST['kualitas'];
		$bahan_lembar = 0;

		if ($_POST['kualitas']=='Premium') {
			# code...
			$kualitas = 3;
			$kualitas_vitras = 2.6;
		} elseif ($_POST['kualitas']=='Gold') {
			$kualitas = 2.6;
			$kualitas_vitras = 2.6;
		}else {
			# code...
			$kualitas = 2.3;
			$kualitas_vitras = 2.3;
		}
		

		if ($panjang < 100) {
			$panjang = 100;
			# code...
		} 
		if ($lebar < 100) {
			$lebar = 100;
			# code...
		} 
		$luas = $panjang * $lebar;
		$luasasli = $panjangasli * $lebarasli;

        $bahan_kain = ($lebar * $kualitas)/100;
        $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;

	    $sqlkainzz="SELECT * from kain WHERE kain_id='$bahanid'";
		$querykainzz=mysql_query($sqlkainzz);
		$datakainzz=mysql_fetch_array($querykainzz);

		$sqlmodelzz="SELECT * from model WHERE model_id='$modelid'";
		$querymodelzz=mysql_query($sqlmodelzz);
		$datamodelzz=mysql_fetch_array($querymodelzz);

		if ($datamodelzz['model_nama']=='Triplet' && $datakainzz['kain_nama']=='Kain Blackout') {
			# code...
	        $bahan_kain = ($lebar * 2.6)/100;
		
		} elseif ($datakainzz['kain_nama'] == 'Kain Lokal') {
			$bahan_lembar = ceil($lebar/50);
			$bahan_kain = $bahan_lembar * (($panjang+50)/100);
		} else {
			# code...
		}
		

        $bahan_rel = $lebar / 100;

        if ($datamodelzz['model_nama']=='Minimalis/ Smoke Ring' && $datakainzz['kain_nama']=='Kain Lokal') {
			# code...
	        $bahan_ring = $bahan_lembar*8;
		} else {
	        $bahan_ring = $bahan_kain*8;
		}

        
        $bahan_hook = 1;
        $bahan_tali = 1;


        $sqlvittali="SELECT * from bahan WHERE bahan_nama='tali'";
		$queryvittali=mysql_query($sqlvittali);
		$datavittali=mysql_fetch_array($queryvittali);
		
		if ($jenis == 'Poni Motif') {

			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				$hasilhitung += $bahan_rel * 560000;
			
			} elseif ($datamodel['model_nama']=='Papan') {
				$hasilhitung += $bahan_rel * 325000;

			} elseif ($datamodel['model_nama']=='Drappery') {
				$hasilhitung += $bahan_rel * 500000;

			} 

		} elseif ($jenis == 'Poni Polos') {

			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				$hasilhitung += $bahan_rel * 250000;
			
			} elseif ($datamodel['model_nama']=='Papan') {
				$hasilhitung += $bahan_rel * 200000;

			} elseif ($datamodel['model_nama']=='Drappery') {
				$hasilhitung += $bahan_rel * 350000;

			} 

		} elseif ($jenis == 'Kaca Film') {

			$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$queryte=mysql_query($sqlte);
			$databarang=mysql_fetch_array($queryte);
			
            $hasilhitung = $panjang/100 * $databarang['bahan_harga'];
            echo $hasilhitung;
            $modelid = 0;

		} elseif ($jenis == 'Vitras') {
			
			# code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);


			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring' && $datakain['kain_nama']=='Kain Blackout') {
				# code...
				$nn = 'minimalis vitras rel';
			} elseif ($datamodel['model_nama']=='jam Pasir') {
				if ($lebarasli < 40) {
					$lebar = 40;
				}
		        $bahan_rel = $lebar / 100;
				$nn = 'jam pasir vitras rel';
			} else {
				# code...
				$nn = 'triplet vitras rel';
			}

            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
            echo $hasilhitung." - ";
		
			
        } elseif ($jenis == 'Gorden') { 

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            echo $hasilhitung." - ";
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
				
			}

            

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
            echo $hasilhitung." - ";


			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            //$hasilhitung += $bahan_hook * $datahook['bahan_harga'];
            //echo $hasilhitung." - ";
           
        
        } elseif ($jenis == 'Gorden & Vitras') {

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

        	$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
            

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];
	            echo $hasilhitung.'<br>';

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
			}


			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
       

            /*
			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            $hasilhitung += $bahan_hook * $datahook['bahan_harga'];
			*/

            

            # code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);
            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];
       
            
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

			$sqlmodel1="SELECT * from model WHERE model_id='$modelid'";
			$querymodel1=mysql_query($sqlmodel1);
			$datamodel1=mysql_fetch_array($querymodel1);

			$sqlkain1="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain1=mysql_query($sqlkain1);
			$datakain1=mysql_fetch_array($querykain1);
			if ($datamodel1['model_nama']=='Minimalis/ Smoke Ring' && $datakain1['kain_nama']=='Kain Blackout') {
				# code...
				$nnn = 'minimalis vitras rel';
			} else {
				# code...
				$nnn = 'triplet vitras rel';

			}

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
         


		} else {
        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$queryte=mysql_query($sqlte);
			$databarang=mysql_fetch_array($queryte);
			
            $hasilhitung = ($luas / 10000) * $hargabahankain;
            $modelid = 0;

        }

        $h = $hasilhitung * $jumlah;

		$a="INSERT into pengukuran_detail_temp(pengukuran_temp_id,pengukuran_detail_temp_ruang,pengukuran_detail_temp_jenis,pengukuran_detail_temp_bahan,pengukuran_detail_temp_kode_bahan,pengukuran_detail_temp_kode_bahan_1,pengukuran_detail_temp_model,pengukuran_detail_temp_jumlah,pengukuran_detail_temp_kt,pengukuran_detail_temp_alat_1,pengukuran_detail_temp_alat_2,pengukuran_detail_temp_alat_warna,pengukuran_detail_temp_alat_ukuran,pengukuran_detail_temp_tinggi,pengukuran_detail_temp_lebar,pengukuran_detail_temp_kualitas,pengukuran_detail_temp_harga,pengukuran_detail_temp_user,pengukuran_detail_temp_harga_bahan)values(0,'$ruang','$jenisid','$bahanid','$kodebahan','$kodebahan1','$modelid','$jumlah','$kt','$relalat1','$relalat2','$relwarna','$relukuranasli','$panjangasli','$lebarasli','$kk','$h','$user','$hargabahankain')";
		$b=mysql_query($a);
		echo mysql_error();
	    echo ("<script>location.href='../home.php?menu=home'</script>");

	} elseif (isset($_POST['tambahpengukuran'])) {
		$user = $_SESSION['login_user'];
		
		$ruang = $_POST['ruang'];
		$idukur = $_POST['idukur'];
		$jenisid = $_POST['jenis'];
		$sqljenis="SELECT * from jenis WHERE jenis_id='$jenisid'";
		$queryjenis=mysql_query($sqljenis);
		$datajenis=mysql_fetch_array($queryjenis);
		$jenis = $datajenis['jenis_nama'];
		$hargabahankain = $_POST['hargabahan'];;
		$bahanid = $_POST['bahan'];
		$modelid = $_POST['model'];
		$kodebahan = $_POST['kodebahan'];
		$kodebahan1 = $_POST['kodebahan1'];
		$jumlah = $_POST['jumlah'];
		$kt = $_POST['kt'];
		$relwarna = $_POST['relwarna'];
		$relukuran = $_POST['lebar'];
		$relukuranasli = $_POST['lebar'];
		$relalat1 = $_POST['relalat1'];
		$relalat2 = $_POST['relalat2'];
		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$panjangasli = $_POST['panjang'];
		$lebarasli = $_POST['lebar'];
		$harga = 0;
		$hasilhitung = 0;
		$kk = $_POST['kualitas'];
    $bahan_lembar = 0;

    if ($_POST['kualitas']=='Premium') {
      # code...
      $kualitas = 3;
      $kualitas_vitras = 2.6;
    } elseif ($_POST['kualitas']=='Gold') {
      $kualitas = 2.6;
      $kualitas_vitras = 2.6;
    }else {
      # code...
      $kualitas = 2.3;
      $kualitas_vitras = 2.3;
    }
    

    if ($panjang < 100) {
      $panjang = 100;
      # code...
    } 
    if ($lebar < 100) {
      $lebar = 100;
      # code...
    } 
    $luas = $panjang * $lebar;
    $luasasli = $panjangasli * $lebarasli;

    $bahan_kain = ($lebar * $kualitas)/100;
    $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;

    $sqlkainzz="SELECT * from kain WHERE kain_id='$bahanid'";
    $querykainzz=mysql_query($sqlkainzz);
    $datakainzz=mysql_fetch_array($querykainzz);

    $sqlmodelzz="SELECT * from model WHERE model_id='$modelid'";
    $querymodelzz=mysql_query($sqlmodelzz);
    $datamodelzz=mysql_fetch_array($querymodelzz);

    if ($datamodelzz['model_nama']=='Triplet' && $datakainzz['kain_nama']=='Kain Blackout') {
      # code...
          $bahan_kain = ($lebar * 2.6)/100;
    
    } elseif ($datakainzz['kain_nama'] == 'Kain Lokal') {
      $bahan_lembar = ceil($lebar/50);
      $bahan_kain = $bahan_lembar * (($panjang+50)/100);
    } else {
      # code...
    }
    

        $bahan_rel = $lebar / 100;

        if ($datamodelzz['model_nama']=='Minimalis/ Smoke Ring' && $datakainzz['kain_nama']=='Kain Lokal') {
      # code...
          $bahan_ring = $bahan_lembar*8;
    } else {
          $bahan_ring = $bahan_kain*8;
    }

        
        $bahan_hook = 1;
        $bahan_tali = 1;


        $sqlvittali="SELECT * from bahan WHERE bahan_nama='tali'";
    $queryvittali=mysql_query($sqlvittali);
    $datavittali=mysql_fetch_array($queryvittali);
    

		
		if ($jenis == 'Poni Motif') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 560000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 325000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 500000;

				} 

			} elseif ($jenis == 'Poni Polos') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 250000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 200000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 350000;

				} 

			} elseif ($jenis == 'Kaca Film') {

				$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = $panjang/100 * $databarang['bahan_harga'];
	            echo $hasilhitung;
	            $modelid = 0;

			} elseif ($jenis == 'Vitras') {
			
			# code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);


			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring' && $datakain['kain_nama']=='Kain Blackout') {
			# code...
				$nn = 'minimalis vitras rel';
			} elseif ($datamodel['model_nama']=='jam Pasir') {
				if ($lebarasli < 40) {
				  $lebar = 40;
				}
			    $bahan_rel = $lebar / 100;
				$nn = 'jam pasir vitras rel';
			} else {
			# code...
				$nn = 'triplet vitras rel';
			}

		    $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

		    $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
      
				
            echo $hasilhitung." - ";
		
			
        } elseif ($jenis == 'Gorden') { 

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            echo $hasilhitung." - ";
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];


            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
		          # code...
		          $nn = 'triplet rel lokal';
		        } else {
		          # code...
		          $nn = 'triplet rel blackout';
		        }
			}

            

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
            echo $hasilhitung." - ";


			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            //$hasilhitung += $bahan_hook * $datahook['bahan_harga'];
            //echo $hasilhitung." - ";

        
        } elseif ($jenis == 'Gorden & Vitras') {

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

        	$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
            


            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

			} else {
				# code...
		        if ($datakainzz['kain_nama'] == 'Kain Lokal') {
		          # code...
		          $nn = 'triplet rel lokal';
		        } else {
		          # code...
		          $nn = 'triplet rel blackout';
		        }
			}

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];

            /*
			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            $hasilhitung += $bahan_hook * $datahook['bahan_harga'];
			*/

            

            # code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);
            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
            


			$sqlmodel1="SELECT * from model WHERE model_id='$modelid'";
			$querymodel1=mysql_query($sqlmodel1);
			$datamodel1=mysql_fetch_array($querymodel1);

			$sqlkain1="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain1=mysql_query($sqlkain1);
			$datakain1=mysql_fetch_array($querykain1);
			if ($datamodel1['model_nama']=='Minimalis/ Smoke Ring' && $datakain1['kain_nama']=='Kain Blackout') {
				# code...
				$nnn = 'minimalis vitras rel';
			} else {
				# code...
				$nnn = 'triplet vitras rel';

			}

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
         


		} else {
        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$queryte=mysql_query($sqlte);
			$databarang=mysql_fetch_array($queryte);
			
            $hasilhitung = ($luas / 10000) * $hargabahankain;
            $modelid = 0;

        }

        $h = $hasilhitung * $jumlah;

		$a="INSERT into pengukuran_detail(pengukuran_id,pengukuran_detail_ruang,pengukuran_detail_jenis,pengukuran_detail_bahan,pengukuran_detail_kode_bahan,pengukuran_detail_kode_bahan_1,pengukuran_detail_model,pengukuran_detail_jumlah,pengukuran_detail_kt,pengukuran_detail_alat_1,pengukuran_detail_alat_2,pengukuran_detail_alat_warna,pengukuran_detail_alat_ukuran,pengukuran_detail_tinggi,pengukuran_detail_lebar,pengukuran_detail_kualitas,pengukuran_detail_harga,pengukuran_detail_user,pengukuran_detail_harga_bahan)values('$idukur','$ruang','$jenisid','$bahanid','$kodebahan','$kodebahan1','$modelid','$jumlah','$kt','$relalat1','$relalat2','$relwarna','$relukuranasli','$panjangasli','$lebarasli','$kk','$h','$user','$hargabahankain')";
		$b=mysql_query($a);
		echo mysql_error();

		$sqlukur="SELECT SUM(pengukuran_detail_harga) as jumlah FROM pengukuran_detail WHERE pengukuran_id='$idukur'";
		$queryukur=mysql_query($sqlukur);
		$dataukur=mysql_fetch_array($queryukur);
		$total = $dataukur["jumlah"];

		mysql_query("UPDATE pengukuran SET pengukuran_total_harga='$total' WHERE pengukuran_id='$idukur'");
	    	echo ("<script>location.href='../admin.php?menu=detail&id=$idukur'</script>");

	} elseif (isset($_POST['editpengukuran'])) {
		$user = $_SESSION['login_user'];
		$idtemp = $_POST['idtemp'];
		$ruang = $_POST['ruang'];

		$jenisid = $_POST['jenis'];
		$sqljenis="SELECT * from jenis WHERE jenis_id='$jenisid'";
		$queryjenis=mysql_query($sqljenis);
		$datajenis=mysql_fetch_array($queryjenis);
		$jenis = $datajenis['jenis_nama'];
		$hargabahankain = $_POST["hargabahan"];
		$bahanid = $_POST['bahan'];
		$modelid = $_POST['model'];
		$kodebahan = $_POST['kodebahan'];
		$kodebahan1 = $_POST['kodebahan1'];
		$jumlah = $_POST['jumlah'];
		$kt = $_POST['kt'];
		$relwarna = $_POST['relwarna'];
		$relukuran = $_POST['lebar'];
		$relukuranasli = $_POST['lebar'];
		$relalat1 = $_POST['relalat1'];
		$relalat2 = $_POST['relalat2'];
		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$panjangasli = $_POST['panjang'];
		$lebarasli = $_POST['lebar'];
		$harga = 0;
		$hasilhitung = 0;
		$kk = $_POST['kualitas'];
		$bahan_lembar = 0;

		if ($_POST['kualitas']=='Premium') {
			# code...
			$kualitas = 3;
			$kualitas_vitras = 2.6;
		} elseif ($_POST['kualitas']=='Gold') {
			$kualitas = 2.6;
			$kualitas_vitras = 2.6;
		}else {
			# code...
			$kualitas = 2.3;
			$kualitas_vitras = 2.3;
		}
		

		if ($panjang < 100) {
			$panjang = 100;
			# code...
		} 
		if ($lebar < 100) {
			$lebar = 100;
			# code...
		} 
		$luas = $panjang * $lebar;
		$luasasli = $panjangasli * $lebarasli;

        $bahan_kain = ($lebar * $kualitas)/100;
        $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;

	    $sqlkainzz="SELECT * from kain WHERE kain_id='$bahanid'";
		$querykainzz=mysql_query($sqlkainzz);
		$datakainzz=mysql_fetch_array($querykainzz);

		$sqlmodelzz="SELECT * from model WHERE model_id='$modelid'";
		$querymodelzz=mysql_query($sqlmodelzz);
		$datamodelzz=mysql_fetch_array($querymodelzz);

		if ($datamodelzz['model_nama']=='Triplet' && $datakainzz['kain_nama']=='Kain Blackout') {
			# code...
	        $bahan_kain = ($lebar * 2.6)/100;
		
		} elseif ($datakainzz['kain_nama'] == 'Kain Lokal') {
			$bahan_lembar = ceil($lebar/50);
			$bahan_kain = $bahan_lembar * (($panjang+50)/100);
		} else {
			# code...
		}
		

        $bahan_rel = $lebar / 100;

        if ($datamodelzz['model_nama']=='Minimalis/ Smoke Ring' && $datakainzz['kain_nama']=='Kain Lokal') {
			# code...
	        $bahan_ring = $bahan_lembar*8;
		} else {
	        $bahan_ring = $bahan_kain*8;
		}

        
        $bahan_hook = 1;
        $bahan_tali = 1;


        $sqlvittali="SELECT * from bahan WHERE bahan_nama='tali'";
		$queryvittali=mysql_query($sqlvittali);
		$datavittali=mysql_fetch_array($queryvittali);


		
		if ($jenis == 'Poni Motif') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 560000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 325000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 500000;

				} 

			} elseif ($jenis == 'Poni Polos') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 250000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 200000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 350000;

				} 

			} elseif ($jenis == 'Kaca Film') {

				$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = $panjang/100 * $databarang['bahan_harga'];
	            echo $hasilhitung;
	            $modelid = 0;

			} elseif ($jenis == 'Vitras') {
			
			# code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);


			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring' && $datakain['kain_nama']=='Kain Blackout') {
				# code...
				$nn = 'minimalis vitras rel';
			} elseif ($datamodel['model_nama']=='jam Pasir') {
				if ($lebarasli < 40) {
					$lebar = 40;
				}
		        $bahan_rel = $lebar / 100;
				$nn = 'jam pasir vitras rel';
			} else {
				# code...
				$nn = 'triplet vitras rel';
			}

            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
            echo $hasilhitung." - ";
		
			
        } elseif ($jenis == 'Gorden') { 

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            echo $hasilhitung." - ";
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
				
			}

            

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
            echo $hasilhitung." - ";


			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            //$hasilhitung += $bahan_hook * $datahook['bahan_harga'];
            //echo $hasilhitung." - ";
           
        
        } elseif ($jenis == 'Gorden & Vitras') {

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

        	$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
            

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];
	            echo $hasilhitung.'<br>';

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
			}


			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
       

            /*
			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            $hasilhitung += $bahan_hook * $datahook['bahan_harga'];
			*/

            

            # code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);
            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];
       
            
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

			$sqlmodel1="SELECT * from model WHERE model_id='$modelid'";
			$querymodel1=mysql_query($sqlmodel1);
			$datamodel1=mysql_fetch_array($querymodel1);

			$sqlkain1="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain1=mysql_query($sqlkain1);
			$datakain1=mysql_fetch_array($querykain1);
			if ($datamodel1['model_nama']=='Minimalis/ Smoke Ring' && $datakain1['kain_nama']=='Kain Blackout') {
				# code...
				$nnn = 'minimalis vitras rel';
			} else {
				# code...
				$nnn = 'triplet vitras rel';

			}

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
         


		} else {
        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$queryte=mysql_query($sqlte);
			$databarang=mysql_fetch_array($queryte);
			
            $hasilhitung = ($luas / 10000) * $hargabahankain;
            $modelid = 0;

        }

        $h = $hasilhitung * $jumlah;

		$a="UPDATE pengukuran_detail_temp set pengukuran_detail_temp_ruang='$ruang', pengukuran_detail_temp_jenis='$jenisid', pengukuran_detail_temp_bahan='$bahanid', pengukuran_detail_temp_kode_bahan='$kodebahan', pengukuran_detail_temp_kode_bahan_1='$kodebahan1', pengukuran_detail_temp_model='$modelid', pengukuran_detail_temp_jumlah='$jumlah', pengukuran_detail_temp_kt='$kt', pengukuran_detail_temp_alat_1='$relalat1', pengukuran_detail_temp_alat_2='$relalat2', pengukuran_detail_temp_alat_warna='$relwarna', pengukuran_detail_temp_alat_ukuran='$relukuranasli', pengukuran_detail_temp_tinggi='$panjangasli', pengukuran_detail_temp_lebar='$lebarasli', pengukuran_detail_temp_kualitas='$kk', pengukuran_detail_temp_harga='$h', pengukuran_detail_temp_user='$user', pengukuran_detail_temp_harga_bahan='$hargabahankain' where pengukuran_detail_temp_id='$idtemp'";
		$b=mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../home.php?menu=home'</script>");
	
	} elseif (isset($_POST['editpengukurandetail'])) {
		
		$user = $_SESSION['login_user'];
		$idtemp = $_POST['idtemp'];
		$ruang = $_POST['ruang'];

		$jenisid = $_POST['jenis'];
		$sqljenis="SELECT * from jenis WHERE jenis_id='$jenisid'";
		$queryjenis=mysql_query($sqljenis);
		$datajenis=mysql_fetch_array($queryjenis);
		$jenis = $datajenis['jenis_nama'];
		$hargabahankain = $_POST["hargabahan"];
		$bahanid = $_POST['bahan'];
		$modelid = $_POST['model'];
		$kodebahan = $_POST['kodebahan'];
		$kodebahan1 = $_POST['kodebahan1'];
		$jumlah = $_POST['jumlah'];
		$kt = $_POST['kt'];
		$relwarna = $_POST['relwarna'];
		$relukuran = $_POST['lebar'];
		$relukuranasli = $_POST['lebar'];
		$relalat1 = $_POST['relalat1'];
		$relalat2 = $_POST['relalat2'];
		$panjang = $_POST['panjang'];
		$lebar = $_POST['lebar'];
		$panjangasli = $_POST['panjang'];
		$lebarasli = $_POST['lebar'];
		$harga = 0;
		$hasilhitung = 0;
		$kk = $_POST['kualitas'];
		$bahan_lembar = 0;

		if ($_POST['kualitas']=='Premium') {
			# code...
			$kualitas = 3;
			$kualitas_vitras = 2.6;
		} elseif ($_POST['kualitas']=='Gold') {
			$kualitas = 2.6;
			$kualitas_vitras = 2.6;
		}else {
			# code...
			$kualitas = 2.3;
			$kualitas_vitras = 2.3;
		}
		

		if ($panjang < 100) {
			$panjang = 100;
			# code...
		} 
		if ($lebar < 100) {
			$lebar = 100;
			# code...
		} 
		$luas = $panjang * $lebar;
		$luasasli = $panjangasli * $lebarasli;

        $bahan_kain = ($lebar * $kualitas)/100;
        $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;

	    $sqlkainzz="SELECT * from kain WHERE kain_id='$bahanid'";
		$querykainzz=mysql_query($sqlkainzz);
		$datakainzz=mysql_fetch_array($querykainzz);

		$sqlmodelzz="SELECT * from model WHERE model_id='$modelid'";
		$querymodelzz=mysql_query($sqlmodelzz);
		$datamodelzz=mysql_fetch_array($querymodelzz);

		if ($datamodelzz['model_nama']=='Triplet' && $datakainzz['kain_nama']=='Kain Blackout') {
			# code...
	        $bahan_kain = ($lebar * 2.6)/100;
		
		} elseif ($datakainzz['kain_nama'] == 'Kain Lokal') {
			$bahan_lembar = ceil($lebar/50);
			$bahan_kain = $bahan_lembar * (($panjang+50)/100);
		} else {
			# code...
		}
		

        $bahan_rel = $lebar / 100;

        if ($datamodelzz['model_nama']=='Minimalis/ Smoke Ring' && $datakainzz['kain_nama']=='Kain Lokal') {
			# code...
	        $bahan_ring = $bahan_lembar*8;
		} else {
	        $bahan_ring = $bahan_kain*8;
		}

        
        $bahan_hook = 1;
        $bahan_tali = 1;


        $sqlvittali="SELECT * from bahan WHERE bahan_nama='tali'";
		$queryvittali=mysql_query($sqlvittali);
		$datavittali=mysql_fetch_array($queryvittali);

		
		if ($jenis == 'Poni Motif') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 560000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 325000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 500000;

				} 

			} elseif ($jenis == 'Poni Polos') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 250000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 200000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 350000;

				} 

			} elseif ($jenis == 'Kaca Film') {

				$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = $panjang/100 * $databarang['bahan_harga'];
	            echo $hasilhitung;
	            $modelid = 0;

			} elseif ($jenis == 'Vitras') {
			
			# code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);


			$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

			if ($datamodel['model_nama']=='Minimalis/ Smoke Ring' && $datakain['kain_nama']=='Kain Blackout') {
				# code...
				$nn = 'minimalis vitras rel';
			} elseif ($datamodel['model_nama']=='jam Pasir') {
				if ($lebarasli < 40) {
					$lebar = 40;
				}
		        $bahan_rel = $lebar / 100;
				$nn = 'jam pasir vitras rel';
			} else {
				# code...
				$nn = 'triplet vitras rel';
			}

            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
            echo $hasilhitung." - ";
		
			
        } elseif ($jenis == 'Gorden') { 

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

			$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            echo $hasilhitung." - ";
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
				
			}

            

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
            echo $hasilhitung." - ";


			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            //$hasilhitung += $bahan_hook * $datahook['bahan_harga'];
            //echo $hasilhitung." - ";
           
        
        } elseif ($jenis == 'Gorden & Vitras') {

        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
			$querymodel=mysql_query($sqlmodel);
			$datamodel=mysql_fetch_array($querymodel);

        	$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$querykain=mysql_query($sqlkain);
			$datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];
            

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
				# code...
				$nn = 'minimalis rel';

				$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
				$queryring=mysql_query($sqlring);
				$dataring=mysql_fetch_array($queryring);

	            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];
	            echo $hasilhitung.'<br>';

			} else {
				# code...
				if ($datakainzz['kain_nama'] == 'Kain Lokal') {
					# code...
					$nn = 'triplet rel lokal';
				} else {
					# code...
					$nn = 'triplet rel blackout';
				}
			}


			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);
	
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
       

            /*
			$sqlhook="SELECT * from bahan WHERE bahan_nama='hook'";
			$queryhook=mysql_query($sqlhook);
			$datahook=mysql_fetch_array($queryhook);

            $hasilhitung += $bahan_hook * $datahook['bahan_harga'];
			*/

            

            # code...
			$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
			$querytea=mysql_query($sqltea);
			$datavitras=mysql_fetch_array($querytea);
            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];
       
            
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

			$sqlmodel1="SELECT * from model WHERE model_id='$modelid'";
			$querymodel1=mysql_query($sqlmodel1);
			$datamodel1=mysql_fetch_array($querymodel1);

			$sqlkain1="SELECT * from kain WHERE kain_id='$bahanid'";
			$querykain1=mysql_query($sqlkain1);
			$datakain1=mysql_fetch_array($querykain1);
			if ($datamodel1['model_nama']=='Minimalis/ Smoke Ring' && $datakain1['kain_nama']=='Kain Blackout') {
				# code...
				$nnn = 'minimalis vitras rel';
			} else {
				# code...
				$nnn = 'triplet vitras rel';

			}

			$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
			$queryvitrel=mysql_query($sqlvitrel);
			$datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
				
         


		} else {
        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
			$queryte=mysql_query($sqlte);
			$databarang=mysql_fetch_array($queryte);
			
            $hasilhitung = ($luas / 10000) * $hargabahankain;
            $modelid = 0;

        }

        $h = $hasilhitung * $jumlah;

		$a="UPDATE pengukuran_detail set pengukuran_detail_ruang='$ruang', pengukuran_detail_jenis='$jenisid', pengukuran_detail_bahan='$bahanid', pengukuran_detail_kode_bahan='$kodebahan', pengukuran_detail_kode_bahan_1='$kodebahan1', pengukuran_detail_model='$modelid', pengukuran_detail_jumlah='$jumlah', pengukuran_detail_kt='$kt', pengukuran_detail_alat_1='$relalat1', pengukuran_detail_alat_2='$relalat2', pengukuran_detail_alat_warna='$relwarna', pengukuran_detail_alat_ukuran='$relukuranasli', pengukuran_detail_tinggi='$panjangasli', pengukuran_detail_lebar='$lebarasli', pengukuran_detail_kualitas='$kk', pengukuran_detail_harga='$h', pengukuran_detail_harga_bahan='$hargabahankain' where pengukuran_detail_id='$idtemp'";
		$b=mysql_query($a);
		echo mysql_error();

		$idukur = $_POST["idukur"];
		$sqlukur="SELECT SUM(pengukuran_detail_harga) as jumlah FROM pengukuran_detail WHERE pengukuran_id='$idukur'";
		$queryukur=mysql_query($sqlukur);
		$dataukur=mysql_fetch_array($queryukur);
		$total = $dataukur["jumlah"];

		mysql_query("UPDATE pengukuran SET pengukuran_total_harga='$total' WHERE pengukuran_id='$idukur'");
	    echo ("<script>location.href='../admin.php?menu=detail&id=$idukur'</script>");
	
	} elseif (isset($_POST['prosessekarang'])) {
		
        $_SESSION['print'] = "ya";
		$user = $_SESSION['login_user'];
		$tot = $_POST['subtotal'];
		$catatan = $_POST['catatan'];
		$catatanjahit = $_POST['catatan-jahit'];
		
		$kualitas = "Premium";
		$diskon = 0;

		$text_line = explode(".",$_POST['dp']);
		$length=count($text_line);
		if ($length==1) {
			$dp=$text_line[0];
			# code...
		}elseif ($length==2) {
			$dp=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		if ($dp==0) {
			# code...
			$status = "Penawaran";
		} else {
			$status = "Deal";
		}


	    $idpelanggan = $_SESSION['id_pelanggan'];


		$qn1= "SELECT MAX( pelanggan_temp_id_pelanggan ) AS noid FROM pelanggan_temp where pelanggan_temp_user='$user'";
        $rn1=mysql_query($qn1);
        $dn1=mysql_fetch_array($rn1);
        $idp = $dn1['noid'];
        
		$a="INSERT into pengukuran(pengukuran_tanggal,pengukuran_bulan,pengukuran_pelanggan,pengukuran_user,pengukuran_keterangan,pengukuran_catatan_jahit,pengukuran_total_harga,pengukuran_diskon,pengukuran_dp,pengukuran_dp_awal,pengukuran_status,pengukuran_kualitas)values('$tgl','$bulan','$idp','$user','$catatan','$catatanjahit','$tot','$diskon','$dp','0','$status','$kualitas')";
		$b=mysql_query($a);
		echo mysql_error();

		$qn= "SELECT MAX( pengukuran_id ) AS noid FROM pengukuran where pengukuran_user='$user'";
        $rn=mysql_query($qn);
        $dn=mysql_fetch_array($rn);
        $no_not = $dn['noid'];
        $_SESSION['no-id'] = $no_not;
		

        $sql="SELECT * from pengukuran_detail_temp where pengukuran_detail_temp_user='$user'";
        $query=mysql_query($sql);
        while ($data1=mysql_fetch_array($query)) {
        	$pengukuran_id = $no_not;
        	$pengukuran_ruang = $data1['pengukuran_detail_temp_ruang'];
        	$pengukuran_jenis = $data1['pengukuran_detail_temp_jenis'];
        	$pengukuran_bahan = $data1['pengukuran_detail_temp_bahan'];
        	$pengukuran_kode_bahan = $data1['pengukuran_detail_temp_kode_bahan'];
        	$pengukuran_harga_bahan = $data1['pengukuran_detail_temp_harga_bahan'];
        	$pengukuran_kode_bahan_1 = $data1['pengukuran_detail_temp_kode_bahan_1'];
        	$pengukuran_model = $data1['pengukuran_detail_temp_model'];
        	$pengukuran_jumlah = $data1['pengukuran_detail_temp_jumlah'];
        	$pengukuran_kt = $data1['pengukuran_detail_temp_kt'];
        	$pengukuran_alat_1 = $data1['pengukuran_detail_temp_alat_1'];
        	$pengukuran_alat_2 = $data1['pengukuran_detail_temp_alat_2'];
        	$pengukuran_alat_warna = $data1['pengukuran_detail_temp_alat_warna'];
        	$pengukuran_alat_ukuran = $data1['pengukuran_detail_temp_alat_ukuran'];
        	$pengukuran_panjang = $data1['pengukuran_detail_temp_tinggi'];
        	$pengukuran_lebar = $data1['pengukuran_detail_temp_lebar'];
        	$pengukuran_kualitas = $data1['pengukuran_detail_temp_kualitas'];
        	$pengukuran_harga = $data1['pengukuran_detail_temp_harga'];
        	$pengukuran_user = $data1['pengukuran_detail_temp_user'];
        	if ($status=="Deal") {
        		# code...
        		$deal_tanggal='$tgl';
        	} else {
				$deal_tanggal = '0000-00-00';        		
        	}

        	$a="INSERT into pengukuran_detail(pengukuran_id,pengukuran_detail_ruang,pengukuran_detail_jenis,pengukuran_detail_bahan,pengukuran_detail_kode_bahan,pengukuran_detail_harga_bahan,pengukuran_detail_kode_bahan_1,pengukuran_detail_model,pengukuran_detail_jumlah,pengukuran_detail_kt,pengukuran_detail_alat_1,pengukuran_detail_alat_2,pengukuran_detail_alat_warna,pengukuran_detail_alat_ukuran,pengukuran_detail_tinggi,pengukuran_detail_lebar,pengukuran_detail_kualitas,pengukuran_detail_harga,pengukuran_detail_user)values('$pengukuran_id','$pengukuran_ruang','$pengukuran_jenis','$pengukuran_bahan','$pengukuran_kode_bahan','$pengukuran_harga_bahan','$pengukuran_kode_bahan_1','$pengukuran_model','$pengukuran_jumlah','$pengukuran_kt','$pengukuran_alat_1','$pengukuran_alat_2','$pengukuran_alat_warna','$pengukuran_alat_ukuran','$pengukuran_panjang','$pengukuran_lebar','$pengukuran_kualitas','$pengukuran_harga','$pengukuran_user')";
        	
        	$b=mysql_query($a);
        	echo mysql_error();

	        	
        }
 
		$a="UPDATE booking_pengukuran set booking_pengukuran_status='Penawaran' where booking_pengukuran_pelanggan='$idpelanggan' and booking_pengukuran_user='$user'";
		mysql_query($a);

echo mysql_error();
		mysql_query("DELETE from pengukuran_detail_temp where pengukuran_detail_temp_user='$user'");
		mysql_query("DELETE from pelanggan_temp where pelanggan_temp_user='$user'");


	    echo ("<script>location.href='../home.php?menu=sukses'</script>");

	} elseif (isset($_POST['negoharga'])) {
		$totaljumlah = 0;
		$tj = 0;
      $user = $_SESSION['login_user'];
      $diskon = $_POST['diskon'];
      $idp = $_POST['id'];
      $ketkua = $_POST['kualitas'];
      $kualitas = '';
			# code...
        
        if ($_POST['kualitas']=='Premium') {
			# code...
			$kualitas = 3;
			$kualitas_vitras = 2.6;
		} elseif ($_POST['kualitas']=='Gold') {
			$kualitas = 2.6;
			$kualitas_vitras = 2.6;
		}else {
			# code...
			$kualitas = 2.3;
			$kualitas_vitras = 2.3;
		}

        
		$sql="SELECT * from pengukuran_detail where pengukuran_id='$idp'";
        $query=mysql_query($sql);
        while ($data1=mysql_fetch_array($query)) {

			$jenisid = $data1['pengukuran_detail_jenis'];
			$sqljenis="SELECT * from jenis WHERE jenis_id='$jenisid'";
			$queryjenis=mysql_query($sqljenis);
			$datajenis=mysql_fetch_array($queryjenis);
			$jenis = $datajenis['jenis_nama'];

			$hargabahan = $data1['pengukuran_detail_harga_bahan'];
			$bahanid = $data1['pengukuran_detail_bahan'];
			$modelid = $data1['pengukuran_detail_model'];
			$jumlah = $data1['pengukuran_detail_jumlah'];
			$panjang = $data1['pengukuran_detail_tinggi'];
			$lebar = $data1['pengukuran_detail_lebar'];

		    $panjangasli = $data1['pengukuran_detail_tinggi'];
		    $lebarasli = $data1['pengukuran_detail_lebar'];
			$harga = 0;
			$hasilhitung = 0;
			

			if ($panjang < 100) {
				$panjang = 100;
				# code...
			} 
			if ($lebar < 100) {
				$lebar = 100;
				# code...
			} 
			$luas = $panjang * $lebar;
		    $luasasli = $panjangasli * $lebarasli;

	        $bahan_kain = ($lebar * $kualitas)/100;
		    $bahan_kain_vitras = ($lebar * $kualitas_vitras)/100;

		    $sqlkainzz="SELECT * from kain WHERE kain_id='$bahanid'";
		    $querykainzz=mysql_query($sqlkainzz);
		    $datakainzz=mysql_fetch_array($querykainzz);

		    $sqlmodelzz="SELECT * from model WHERE model_id='$modelid'";
		    $querymodelzz=mysql_query($sqlmodelzz);
		    $datamodelzz=mysql_fetch_array($querymodelzz);

		    if ($datamodelzz['model_nama']=='Triplet' && $datakainzz['kain_nama']=='Kain Blackout') {
		      # code...
		          $bahan_kain = ($lebar * 2.6)/100;
		    
		    } elseif ($datakainzz['kain_nama'] == 'Kain Lokal') {
		      $bahan_lembar = ceil($lebar/50);
		      $bahan_kain = $bahan_lembar * (($panjang+50)/100);
		    } else {
		      # code...
		    }
	        $bahan_rel = $lebar / 100;

	        if ($datamodelzz['model_nama']=='Minimalis/ Smoke Ring' && $datakainzz['kain_nama']=='Kain Lokal') {
		      # code...
		          $bahan_ring = $bahan_lembar*8;
		    } else {
		          $bahan_ring = $bahan_kain*8;
		    }
	        $bahan_hook = 1;
	        $bahan_tali = 1;

	        $sqlvittali="SELECT * from bahan WHERE bahan_nama='tali'";
		    $queryvittali=mysql_query($sqlvittali);
		    $datavittali=mysql_fetch_array($queryvittali);
			
			if ($jenis == 'Poni Motif') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 560000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 325000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 500000;

				} 

			} elseif ($jenis == 'Poni Polos') {

				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					$hasilhitung += $bahan_rel * 250000;
				
				} elseif ($datamodel['model_nama']=='Papan') {
					$hasilhitung += $bahan_rel * 200000;

				} elseif ($datamodel['model_nama']=='Drappery') {
					$hasilhitung += $bahan_rel * 350000;

				} 

			} elseif ($jenis == 'Kaca Film') {

				$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = $panjang/100 * $databarang['bahan_harga'];
	            
			
			} elseif ($jenis == 'Vitras') {
				
				# code...
				$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
				$querytea=mysql_query($sqltea);
				$datavitras=mysql_fetch_array($querytea);


				$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

				$sqlkain="SELECT * from kain WHERE kain_id='$bahanid'";
				$querykain=mysql_query($sqlkain);
				$datakain=mysql_fetch_array($querykain);

				if ($datamodel['model_nama']=='Minimalis/ Smoke Ring' && $datakain['kain_nama']=='Kain Blackout') {
		        # code...
		        $nn = 'minimalis vitras rel';
		      } elseif ($datamodel['model_nama']=='jam Pasir') {
		        if ($lebarasli < 40) {
		          $lebar = 40;
		        }
		            $bahan_rel = $lebar / 100;
		        $nn = 'jam pasir vitras rel';
		      } else {
		        # code...
		        $nn = 'triplet vitras rel';
		      }

		            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];

		            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];



		      $sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
		      $queryvitrel=mysql_query($sqlvitrel);
		      $datavitrel=mysql_fetch_array($queryvitrel);

            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
        
    
       
			
				
	        } elseif ($jenis == 'Gorden') { 

	        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
      $querymodel=mysql_query($sqlmodel);
      $datamodel=mysql_fetch_array($querymodel);

      $sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
      $querykain=mysql_query($sqlkain);
      $datakain=mysql_fetch_array($querykain);

            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
      
            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];

            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
        # code...
        $nn = 'minimalis rel';

        $sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
        $queryring=mysql_query($sqlring);
        $dataring=mysql_fetch_array($queryring);

              $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

      } else {
        # code...
        if ($datakainzz['kain_nama'] == 'Kain Lokal') {
          # code...
          $nn = 'triplet rel lokal';
        } else {
          # code...
          $nn = 'triplet rel blackout';
        }
        
      }

            

      $sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
      $queryvitrel=mysql_query($sqlvitrel);
      $datavitrel=mysql_fetch_array($queryvitrel);
  
            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
	            
	           
	        
	        } elseif ($jenis == 'Gorden & Vitras') {

	        	$sqlmodel="SELECT * from model WHERE model_id='$modelid'";
				$querymodel=mysql_query($sqlmodel);
				$datamodel=mysql_fetch_array($querymodel);

	        	$sqlkain="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$querykain=mysql_query($sqlkain);
				$datakain=mysql_fetch_array($querykain);

	            $hasilhitung += $bahan_kain * $datakain['bahan_harga'];
	            $hasilhitung += $bahan_tali * $datavittali['bahan_harga'];


	            if ($datamodel['model_nama']=='Minimalis/ Smoke Ring') {
					# code...
					$nn = 'minimalis rel';

					$sqlring="SELECT * from bahan WHERE bahan_nama='ring'";
					$queryring=mysql_query($sqlring);
					$dataring=mysql_fetch_array($queryring);

		            $hasilhitung += $bahan_ring * $dataring['bahan_harga'];

				} else {
					# code...
			        if ($datakainzz['kain_nama'] == 'Kain Lokal') {
			          # code...
			          $nn = 'triplet rel lokal';
			        } else {
			          # code...
			          $nn = 'triplet rel blackout';
			        }
				}

				$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nn'";
				$queryvitrel=mysql_query($sqlvitrel);
				$datavitrel=mysql_fetch_array($queryvitrel);
		
	            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
	            

	            # code...
				$sqltea="SELECT * from bahan WHERE bahan_nama='vitras'";
				$querytea=mysql_query($sqltea);
				$datavitras=mysql_fetch_array($querytea);
	            $hasilhitung += $bahan_kain_vitras * $datavitras['bahan_harga'];
       			$hasilhitung += $bahan_tali * $datavittali['bahan_harga'];


				$sqlmodel1="SELECT * from model WHERE model_id='$modelid'";
				$querymodel1=mysql_query($sqlmodel1);
				$datamodel1=mysql_fetch_array($querymodel1);

				$sqlkain1="SELECT * from kain WHERE kain_id='$bahanid'";
				$querykain1=mysql_query($sqlkain1);
				$datakain1=mysql_fetch_array($querykain1);
				if ($datamodel1['model_nama']=='Minimalis/ Smoke Ring' && $datakain1['kain_nama']=='Kain Blackout') {
					# code...
					$nnn = 'minimalis vitras rel';
				} else {
					# code...
					$nnn = 'triplet vitras rel';

				}

				$sqlvitrel="SELECT * from bahan WHERE bahan_nama='$nnn'";
				$queryvitrel=mysql_query($sqlvitrel);
				$datavitrel=mysql_fetch_array($queryvitrel);

	            $hasilhitung += $bahan_rel * $datavitrel['bahan_harga'];
					


			} else {
				
	            $hasilhitung = ($luas / 10000) * $hargabahan;
	        }

	        $h = $hasilhitung * $jumlah;
			$tj += $h;
			$id = $data1['pengukuran_detail_id'];
        	$a="UPDATE pengukuran_detail set pengukuran_detail_kualitas='$ketkua', pengukuran_detail_harga='$h' where pengukuran_detail_id='$id'";
			mysql_query($a);

			        		        

        }

        
        if ($_POST["diskonket"]=="Prosentase") {
        	# code...

	      $diskon = ($tj*$_POST['diskon']/100);
        } elseif ($_POST["diskonket"]=="Tunai") {
        	# code...
	      $diskon = $_POST['diskon'];
        } else {
        	$diskon=0;
        }
        $totaljumlah = $tj - $diskon;
        

        $text_line = explode(".",$_POST['dp']);
		$length=count($text_line);
		if ($length==1) {
			$dp=$text_line[0];
			# code...
		}elseif ($length==2) {
			$dp=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		if ($dp>0) {
			# code...
			$status = "Deal";
			$tanggaldeal = $tgl;
			$b="INSERT into laporan_omset(laporan_omset_tanggal,laporan_omset_bulan,laporan_omset_pengukuran_id,laporan_omset_jumlah)values('$tgl','$bulan','$idp','$dp')";
			mysql_query($b);
		} else {
			$status = "Penawaran";
			$tanggaldeal = '0000-00-00';

		}

		$ketdiskon=$_POST["diskonket"];
    	$bank=$_POST["bank"];
    	$ppn = $_POST['ppn'];
    	echo $bank;
		mysql_query("UPDATE pengukuran set pengukuran_diskon='$diskon', pengukuran_kualitas='$ketkua', pengukuran_total_harga='$totaljumlah', pengukuran_dp='$dp', pengukuran_dp_awal='$dp', pengukuran_status='$status', pengukuran_tanggal_deal='$tanggaldeal', pengukuran_bank='$bank', pengukuran_ppn='$ppn', pengukuran_ket_diskon='$ketdiskon' where pengukuran_id='$idp'");
        echo mysql_error();
    	echo ("<script>location.href='../admin.php?menu=detail&id=$idp'</script>");

	} elseif (isset($_POST['gantistatus'])) {
		# code...
		
		$status = $_POST['status'];
		$id = $_POST['id'];
		$text_line = explode(".",$_POST['dp']);
		$length=count($text_line);
		if ($length==1) {
			$dp=$text_line[0];
			# code...
		}elseif ($length==2) {
			$dp=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$dp=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}
		
		$user = $_SESSION['login_user'];
		
		
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_dp='$dp', pengukuran_tanggal_deal='$tgl' where pengukuran_id='$id'";
		mysql_query($a);
	    	echo ("<script>location.href='../admin.php?menu=detail&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['prosesukur'])) {
		# code...
		
		$id = $_POST['id'];
		$idpelanggan = $_POST['idpelanggan'];
		
		$user = $_SESSION['login_user'];
		$_SESSION['id_pelanggan'] = $idpelanggan;
		$b="INSERT into pelanggan_temp(pelanggan_temp_id_pelanggan,pelanggan_temp_user)values('$idpelanggan','$user')";
		mysql_query($b);

		$a="UPDATE booking_pengukuran set booking_pengukuran_status='Pengukuran', booking_pengukuran_user='$user' where booking_pengukuran_id='$id'";
		mysql_query($a);
	    echo ("<script>location.href='../home.php?menu=home'</script>");
		
		
		
		
	} elseif (isset($_POST['orderbahan'])) {
		# code...
		
		$id = $_POST['id'];
		$idpengukuran = $_POST['idpengukuran'];
		$kodebahan = $_POST['kodebahan'];
		$jumlah = $_POST['jumlah'];
		$kodebahan1 = $_POST['kodebahan1'];
		$jumlah_1 = $_POST['jumlah_1'];

		$relalat1 = $_POST['relalat1'];
		$jumlahrelalat1 = $_POST['jumlahrelalat1'];
		$relalat2 = $_POST['relalat2'];
		$jumlahrelalat2 = $_POST['jumlahrelalat2'];
		
		$user = $_SESSION['login_user'];
		
		echo $kodebahan." - ".$kodebahan1;

		$a="INSERT into order_bahan (order_bahan_detail_pengukuran_id,order_bahan_kode_bahan_1,order_bahan_jumlah_kode_bahan_1,order_bahan_kode_bahan_2,order_bahan_jumlah_kode_bahan_2,order_bahan_rel_alat_1,order_bahan_jumlah_rel_alat_1,order_bahan_rel_alat_2,order_bahan_jumlah_rel_alat_2,order_bahan_user)values('$id','$kodebahan','$jumlah','$kodebahan1','$jumlah_1','$relalat1','$jumlahrelalat1','$relalat2','$jumlahrelalat2','$user')";
		mysql_query($a);
		echo mysql_error();
		echo ("<script>location.href='../admin.php?menu=detailorderbahan&id=$idpengukuran'</script>");
		
		
	} elseif (isset($_POST['cekorderbahan'])) {
		# code...
		
		$id = $_POST['idorder'];
		
		$user = $_SESSION['login_user'];
		$idpengukuran = $_POST['idpengukuran'];
		
		$a="UPDATE order_bahan set order_bahan_status='Cek' where order_bahan_id='$id'";
		mysql_query($a);
		echo mysql_error();
		echo ("<script>location.href='../admin.php?menu=detailorderbahan&id=$idpengukuran'</script>");
		
		
		
		
	} elseif (isset($_POST['gantistatusbooking'])) {
		# code...
		
		$id = $_POST['id'];

		$tanggal = date('Y-m-d', strtotime($_POST['tanggal'] . ' +0 day'));
		
		$user = $_SESSION['login_user'];
		
		
		$a="UPDATE booking_pengukuran set booking_pengukuran_status='Follow Up', booking_pengukuran_tanggal_booking='$tanggal' where booking_pengukuran_id='$id'";
		mysql_query($a);
	    echo ("<script>location.href='../admin.php?menu=detailbooking&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['gantitanggalbooking'])) {
		# code...
		
		$id = $_POST['id'];
		$tanggal = date('Y-m-d', strtotime($_POST['tanggal'] . ' +0 day'));
		$user = $_SESSION['login_user'];
		
		
		$a="UPDATE booking_pengukuran set booking_pengukuran_tanggal_booking='$tanggal' where booking_pengukuran_id='$id'";
		mysql_query($a);
		echo ("<script>location.href='../admin.php?menu=detailbooking&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['gantistatuspotong'])) {
		# code...
		
		$status = $_POST["status"];
		$id = $_POST['idpengukuran'];
		
		
		$user = $_SESSION['login_user'];
		//echo $status;

		
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_potong='$tgl', pengukuran_user_potong='$user' where pengukuran_id='$id'";
		mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detailpotong&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['pelunasan'])) {
		# code...
		
		$status = "Selesai Potong";
		$id = $_POST['id'];
		$sisa = $_POST['sisa'];
		$dp = $_POST['dp'];

		$text_line = explode(".",$_POST['bayar']);
		$length=count($text_line);
		if ($length==1) {
			$bayar=$text_line[0];
			# code...
		}elseif ($length==2) {
			$bayar=$text_line[0]."".$text_line[1];
			# code...
		}elseif ($length==3) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2];
		}elseif ($length==4) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
		}elseif ($length==5) {
			# code...
			$bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
		}

		$tot = $sisa - $bayar;
		$totbayar = $dp + $bayar;
		$status = $_POST['status'];
		if ($tot==0) {
			# code...
			$status = 'Lunas';
			$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_dp='$totbayar', pengukuran_pelunasan='$bayar', pengukuran_tanggal_lunas='$tgl' where pengukuran_id='$id'";
			mysql_query($a);
			
		} else {
			# code...
			$a="UPDATE pengukuran set pengukuran_dp='$totbayar' where pengukuran_id='$id'";
			mysql_query($a);

		}

		$b="INSERT into laporan_omset(laporan_omset_tanggal,laporan_omset_bulan,laporan_omset_pengukuran_id,laporan_omset_jumlah)values('$tgl','$bulan','$id','$bayar')";
		
		
		
		$user = $_SESSION['login_user'];
		

		
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detail&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['gantistatuspotongselesai'])) {
		# code...
		
		$status = "Selesai Potong";
		$id = $_POST['idpengukuran'];
		
		
		$user = $_SESSION['login_user'];
		

		
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_user_potong='$user' where pengukuran_id='$id'";
		mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detailpotong&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['gantistatusmulaipotong'])) {
		# code...
		
		$status = "Mulai Potong";
		$id = $_POST['idpengukuran'];
		
		
		$user = $_SESSION['login_user'];
		

		
		$a="UPDATE pengukuran set pengukuran_status='$status' where pengukuran_id='$id'";
		mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detailorderbahan&id=$id'</script>");
		
		
		
		
	} elseif (isset($_POST['gantistatusjahit'])) {
		# code...
		
		$status = $_POST['status'];
		$id = $_POST['idpengukuran'];
		
		
		$user = $_SESSION['login_user'];
		

		
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_jahit='$tgl', pengukuran_user_jahit='$user' where pengukuran_id='$id'";
		mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detailsteamer&id=$id'</script>");	
	
	} elseif (isset($_POST['gantistatuspasang'])) {
		# code...
		
		$status = $_POST['status'];
		$id = $_POST['idpengukuran'];
		
		
		$user = $_SESSION['login_user'];
		

		
		$a="UPDATE pengukuran set pengukuran_status='$status', pengukuran_tanggal_pasang='$tgl', pengukuran_user_pasang='$user' where pengukuran_id='$id'";
		mysql_query($a);
		echo mysql_error();
	    	echo ("<script>location.href='../admin.php?menu=detailpemasangan&id=$id'</script>");	
	}