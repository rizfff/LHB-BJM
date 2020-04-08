<?php

	include "koneksi.php";
	error_reporting(0);
	$sql = "UPDATE tb_pemesanan_master
			set status_pemesanan='Cancel'
			WHERE status_pemesanan='Proses Transaksi'
			AND DATE_ADD(tanggal_pemesanan, INTERVAL 2 HOUR) < NOW()";
	$result = mysqli_query($conn,$sql);	
	$conn->close();
	echo json_encode(array('status' =>'sukses'));			
?>