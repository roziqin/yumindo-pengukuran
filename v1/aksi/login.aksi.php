<?php
session_start();
  	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

include "../include/koneksi.php";
	
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

	$sql="select * from users_lain, roles_lain where role=roles_id and username = '$myusername' and password = '$mypassword' ";
	$result=mysql_query($sql);
	$data=mysql_fetch_array($result);
	$a = $data['id'];
	$ddd = $data['roles_nama'];
	$count=mysql_num_rows($result);
	

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1)
	{
	
	$_SESSION['login_user']	=$a;
	$_SESSION['name']		= $data['name'];
	$_SESSION['login']		= 1;
	$_SESSION['namauser']     = $data['username'];
	$_SESSION['passuser']     = $data['password'];
	$_SESSION['role']		  = $data['roles_nama'];

	if ($ddd=="owner") {
		# code...
		echo ("<script>location.href='../admin.php?menu=home'</script>");
	
	} elseif ($ddd=="admin") {
		# code...
		echo ("<script>location.href='../admin.php?menu=home'</script>");
	
	} elseif ($ddd=="pengukur") {
		# code...
		echo ("<script>location.href='../admin.php?menu=home'</script>");
	
	} elseif ($ddd=="potong-jahit") {
		# code...
		echo ("<script>location.href='../admin.php?menu=home'</script>");
	
	} elseif ($ddd=="steamer-finising") {
		# code...
		echo ("<script>location.href='../admin.php?menu=home'</script>");
	
	}
    
			
	}
	else 
	{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Username & Password tidak sesuai!');
			}
			location.href='../index.php'
			</script>";
	}
}

?>