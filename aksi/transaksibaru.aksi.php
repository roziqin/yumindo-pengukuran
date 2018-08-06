<?php
	session_start();
	include "../include/koneksi.php";
	$user = $_SESSION['login_user'];



if ($_GET['menu']=='member') {

	mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
	mysql_query("DELETE from member_temp where user_id='$user'");

	echo ("<script>location.href='../transaksi.php?menu=home'</script>");
} elseif ($_GET['menu']=='klinik') {

	mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
	mysql_query("DELETE from member_temp where user_id='$user'");

	echo ("<script>location.href='../transaksiklinik.php?menu=home'</script>");

} elseif ($_GET['menu']=='farmasi') {

	//mysql_query("DELETE from transaksi_temp where transaksi_temp_user_id='$user'");
	mysql_query("DELETE from farmasi_temp where user_id='$user'");
	
	echo ("<script>location.href='../transaksifraktur.php?menu=home'</script>");

}

?>