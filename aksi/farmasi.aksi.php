<?php
include "../include/koneksi.php";
	

	if(isset($_POST['tambah'])){
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
	

		$a="INSERT into farmasi(farmasi_nama,farmasi_alamat)values('$nama','$alamat')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=farmasi&id=0'</script>");
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
		$alamat=$_POST['alamat'];

		$id=$_POST['id'];
		$a="UPDATE farmasi set farmasi_nama='$nama',farmasi_alamat='$alamat' where farmasi_id='$id'";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		   echo ("<script>location.href='../home.php?menu=farmasi&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}




