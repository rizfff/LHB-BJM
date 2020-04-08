<?php
	include "koneksi.php";

	//error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 
		 $id_pelanggan = $_POST['id_pelanggan'];

		 //Creating sql query
		 $sql = "SELECT count(b.id_pemesanan) as jml FROM tb_pemesanan_master a inner join tb_pemesanan_detail b on a.id_pemesanan = b.id_pemesanan WHERE a.status_pemesanan='Proses Pemesanan' and a.id_pelanggan='$id_pelanggan' ";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	
		 	//Tampil Data Customer
		 	echo "success"."#".$check["jml"];

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>