<?php
	include "koneksi.php";

	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 

		$id_pelanggan = $_POST['id_pelanggan'];
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan' ";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	echo "success"."#".$check["nama_pelanggan"]."#".$check["alamat"]."#".$check["telepon"]."#".$check["jenis_kelamin"]."#".$check["foto"]."#".$check["email"]."#".$check["password"]."#".$check["id_pelanggan"]."#";

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>