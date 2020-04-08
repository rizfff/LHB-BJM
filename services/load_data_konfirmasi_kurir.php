<?php
	include "koneksi.php";

	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 
		 $email = $_POST['email'];

		 //Creating sql query
		 $sql = "SELECT * FROM tb_pemesanan_master WHERE email='$email' and status_pemesanan = 'Proses Pengiriman'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	
		 	//Tampil Data Customer
		 	echo "success"."->".$check["id_pemesanan"]."->".$check["tanggal_pemesanan"]."->".$check["total_harga"];

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>