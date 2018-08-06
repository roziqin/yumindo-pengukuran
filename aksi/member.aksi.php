<?php
include "../include/koneksi.php";
	

	if(isset($_POST['addmember'])){

		$id=$_POST['idmember'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		$tanggal=$_POST['tanggal'];
		$nohp=$_POST['nohp'];
		$gender=$_POST['gender'];
		$pekerjaan=$_POST['pekerjaan'];
		$riwayatperawatan=$_POST['riwayatperawatan'];
		$riwayatalergi=$_POST['riwayatalergi'];
		

		$a="INSERT into member(member_id,member_nama,member_alamat,member_tgl_lahir,member_hp,member_gender,member_riwayat_perawatan_sebelumnya,member_riwayat_alergi,member_pekerjaan)values('$id','$nama','$alamat','$tanggal','$nohp','$gender','$riwayatperawatan','$riwayatalergi','$pekerjaan')";
		$b=mysql_query($a);
		echo mysql_error();
		if($b){
		    echo ("<script>location.href='../transaksi.php?menu=home'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	} elseif (isset($_POST['editmember'])) {
		# code...
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		$tanggal=$_POST['tanggal'];
		$nohp=$_POST['nohp'];
		$gender=$_POST['gender'];
		$pekerjaan=$_POST['pekerjaan'];
		$riwayatperawatan=$_POST['riwayatperawatan'];
		$riwayatalergi=$_POST['riwayatalergi'];

		$a="UPDATE member set member_nama='$nama',member_alamat='$alamat',member_tgl_lahir='$tanggal', member_hp='$nohp', member_gender='$gender', member_riwayat_perawatan_sebelumnya='$riwayatperawatan', member_riwayat_alergi='$riwayatalergi', member_pekerjaan='$pekerjaan' where member_id='$id'";
		$b=mysql_query($a);
		
		if($b){
		    echo ("<script>location.href='../home.php?menu=member&id=0'</script>");
			
		}else{
			echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal disimpan');
			}
			</script>";
		}
	}




