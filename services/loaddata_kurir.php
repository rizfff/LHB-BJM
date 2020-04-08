<?php
	include "koneksi.php";

	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 
		$email = $_POST['email'];
		 //Creating sql query
		 $sql = "SELECT * FROM tb_kurir WHERE email='$email' ";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	echo "success"."#".$check["nama_kurir"]."#".$check["alamat"]."#".$check["no_telpon"]."#".$check["status"]."#".$check["gambar"]."#".$check["email"]."#".$check["password"]."#".$check["id_kurir"]."#";

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>