<?php

$totaljumlah = 0;
		$tj = 0;
      $user = $_SESSION['login_user'];
      $diskon = $_POST['diskon'];
      $idp = $_GET['id'];
      $ketkua = $_POST['kualitas'];
			# code...

/*------------------------- Premium ------------------------------*/
        
			# code...
		$kualitas = 3;
		$kualitas_vitras = 2.6;

        
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
	        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = ($luas / 10000) * $hargabahan;
	        }


	        $h = $hasilhitung * $jumlah;
			$tj += $h;

		}

		/*------------------------- Gold ------------------------------*/

			# code...
		$kualitas = 2.6;
		$kualitas_vitras = 2.6;

        
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
	        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = ($luas / 10000) * $hargabahan;
	        }

	        $h = $hasilhitung * $jumlah;
			$tj1 += $h;
		}


		/*------------------------- Silver ------------------------------*/
        
			# code...
		$kualitas = 2.3;
		$kualitas_vitras = 2.3;

        
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
	        	$sqlte="SELECT * from kain, bahan WHERE kain_bahan=bahan_id and kain_id='$bahanid'";
				$queryte=mysql_query($sqlte);
				$databarang=mysql_fetch_array($queryte);
				
	            $hasilhitung = ($luas / 10000) * $hargabahan;
	        }

	        $h = $hasilhitung * $jumlah;
			$tj2 += $h;
		}
		

?>
<table border="1" style="text-align: center;float: left;margin-left: 100px;">
	<tr>
		<th colspan="3" style="text-align: center;">Harga Penawaran</th>
	</tr>
	<tr>
		<th width="150px" style="text-align: center;">Premium</th>
		<th width="150px" style="text-align: center;">Gold</th>
		<th width="150px" style="text-align: center;">Silver</th>
	</tr>
	<tr>
		<td><?php echo 'Rp '.format_rupiah($tj) ; ?></td>
		<td><?php echo 'Rp '.format_rupiah($tj1) ; ?></td>
		<td><?php echo 'Rp '.format_rupiah($tj2) ; ?></td>
	</tr>
</table>