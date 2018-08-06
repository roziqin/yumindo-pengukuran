<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bulan=date('Y-m');
$wkt=date('G:i:s');

	if(isset($_POST['proses'])){
		$user = $_SESSION['login_user'];
		$id = $_POST['id'];
		$diagnosa = $_POST['diagnosa'];
		$obat = $_POST['obat'];
		$treatment = $_POST['treatment'];

		$a="INSERT into rekam_medik(rekam_tanggal, rekam_pasien, rekam_dokter, rekam_diagnosa, rekam_obat, rekam_treatment)values('$tgl','$id','$user','$diagnosa','$obat','$treatment')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../home.php?menu=pasien&id=$id'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}

	}

?>