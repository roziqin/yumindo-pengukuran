<?php
include "../include/koneksi.php";
	

	if(isset($_POST['tambah'])){
		$nama=$_POST['nama'];
		$slug=$_POST['slug'];
	

		$a="INSERT into klinik(klinik_nama,klinik_slug)values('$nama','$slug')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=klinik&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['edit'])) {
		# code...
		$nama=$_POST['nama'];
		$slug=$_POST['slug'];
		//echo $slug;

		$id=$_POST['id'];
		$a="UPDATE klinik set klinik_nama='$nama', klinik_slug='$slug' where klinik_id='$id'";
		$b=mysql_query($a);
		
		if($b){
		   echo ("<script>location.href='../home.php?menu=klinik&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} if(isset($_POST['tambahcabang'])){
		$klinik=$_POST['klinik'];
		$alamat=$_POST['alamat'];
	

		$a="INSERT into klinik_cabang (klinik_cabang_alamat,klinik_cabang_klinik_id)values('$alamat','$klinik')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=klinik&id=0'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['editcabang'])) {
		# code...
		$klinik=$_POST['klinik'];
		$alamat=$_POST['alamat'];
		$slug=$_POST['slug'];
		//echo $slug;

		$id=$_POST['id'];
		$a="UPDATE klinik_cabang set klinik_cabang_alamat='$alamat', klinik_cabang_klinik_id='$klinik' where klinik_cabang_id='$id'";
		$b=mysql_query($a);
		
		if($b){
		   echo ("<script>location.href='../home.php?menu=klinik&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}




