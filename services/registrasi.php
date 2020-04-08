<?php
	include "koneksi.php";
	include "notice.php";

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		 $nama_pelanggan = $_POST['nama_pelanggan'];
		 $email          = $_POST['email'];
		 $telepon        = $_POST['telepon'];
         $password       = $_POST['password'];
         $jenis_kelamin  = $_POST['jenis_kelamin'];
         $alamat         = $_POST['alamat'];
         $foto           = $_POST['foto'];
                  
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pelanggan WHERE email='$email'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if there's data already
					 	
		 	echo "failure";

		 }else{
		 //if there's no data		 
		 	$namafoto = str_replace(" ", "", $nama_pelanggan);
		 	$path     = "foto_konsumen/".$namafoto."123.png";
		 	$namafile = $namafoto."123.png";
					
          	$querySQL = "INSERT INTO tb_pelanggan (nama_pelanggan, alamat, telepon, jenis_kelamin, foto, email, password) VALUES ('$nama_pelanggan', '$alamat', '$telepon', '$jenis_kelamin', '$namafile', '$email', '$password')";

          	if($conn->query($querySQL) === false) {       
             	echo "failure"; 
          	} else {  

          		file_put_contents($path,base64_decode($foto));

             	echo "success";
          	}
                  
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>