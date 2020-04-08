<?php
	include "koneksi.php";

	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 
		$email = $_POST['email'];
		 //Creating sql query
		 $sql = "SELECT * FROM tb_konsumen WHERE email='$email' ";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	echo "success"."/".$check["nama_konsumen"]."/".$check["alamat"]."/".$check["telepon"]."/".$check["foto"]."/".$check["id_konsumen"];

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>