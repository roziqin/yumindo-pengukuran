<?php
	session_start();
  	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

	include "../config/database.php";
		
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		date_default_timezone_set('Asia/jakarta');
		$tgl=date('Y-m-j');
		$wkt=date('H:i:s');
		$tgl2= $tgl." ".$wkt;
		$tgl1=date('Y-m-j', strtotime('-1 day', strtotime($tgl)));
		// username and password sent from Form
		$myusername=$_POST['username'];
		$mypassword=md5($_POST['password']);
		$sql="SELECT * from users_lain, roles_lain where role=roles_id and username = '$myusername' and password = '$mypassword' ";
		$result=mysqli_query($con,$sql);
		$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$a = $data['id'];
		$ddd = $data['name'];


		
		if($a!='') {
			$x="INSERT into log_user(user,login)values('$a','$tgl2')";
			mysqli_query($con, $x);
			$_SESSION['login_user']	=$a;
			$_SESSION['name']		= $data['name'];
			$_SESSION['login']		= 1;
			$_SESSION['namauser']     = $data['username'];
			$_SESSION['passuser']     = $data['password'];
			$_SESSION['role']		  = $data['roles_nama'];
			$_SESSION['order_type']		  = 'null';
			$_SESSION['print']		  = 'tidak';
			if ($data['roles_nama']=="pengukur" || $data['roles_nama']=="potong-jahit") {
				echo 'transaksi';
			} else {
				echo 'home';
			}
		} else {
			echo 'Username atau Password Salah !';
		}



	}