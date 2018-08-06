<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$year=date('Y');

	if(isset($_POST['gaji'])){

		$bulan=$_POST['bulan'];
		if ($_POST['tahun']!=0) {
			# code...
			$year = $_POST['tahun'];
		}
		$tgl = $bulan."-".$year;
        echo ("<script>location.href='../home.php?menu=lapgaji&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['bulanan'])){

		$bulan1=$_POST['bulan-1'];
		if ($_POST['tahun-1']!=0) {
			# code...
			$year1 = $_POST['tahun-1'];
		}
		$bulan2=$_POST['bulan-2'];
		if ($_POST['tahun-2']!=0) {
			# code...
			$year2 = $_POST['tahun-2'];
		}
		$tgl1 = $year1."-".$bulan1;
		$tgl2 = $year2."-".$bulan2;
        echo ("<script>location.href='../admin.php?menu=laporan&tanggal=$tgl1:$tgl2'</script>");

	}
	elseif(isset($_POST['labarugi'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=laplabarugi&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['penjualan'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=lappenjualan&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['keuangan'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=lapkeuangan&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['logharga'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=logharga&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['logstok'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=logstok&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['loguser'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=loguser&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['logvalidasi'])){

		$tgl=$_POST['tanggal'];
        echo ("<script>location.href='../home.php?menu=logvalidasi&tanggal=$tgl'</script>");

	}
	elseif(isset($_POST['laporanfraktur'])){
		$id=$_POST['id'];
        mysql_query("UPDATE transaksi_fraktur SET transaksi_fraktur_status='1' WHERE transaksi_fraktur_id='$id'");
        echo ("<script>location.href='../home.php?menu=lapfrakturdetail&id=$id'</script>");

	}
?>