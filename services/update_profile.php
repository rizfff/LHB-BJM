<?php

	include "koneksi.php";
include "notice.php";


	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		 $id_pelanggan  = $_POST['id_pelanggan'];
		 $nama_pelanggan= $_POST['nama_pelanggan'];
		 $email          = $_POST['email'];
		 $telepon        = $_POST['telepon'];
         $password       = $_POST['password'];        
         $alamat         = $_POST['alamat'];
         $foto           = $_POST['foto'];
          $jenis_kelamin         = $_POST['jenis_kelamin']; 
          $latitude         = $_POST['latitude'];
         $longitude           = $_POST['longitude'];        
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pelanggan WHERE email='$email'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if yes
					 	
		 	$namafoto = str_replace(" ", "", $nama_pelanggan);
		 	$path     = "foto_konsumen/".$namafoto."123.png";
		 	$namafile = $namafoto."123.png";
					
			if(empty($_POST['password'])){
				if($foto=="KOSONG"){
					$querySQL = "UPDATE tb_pelanggan set nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon',jenis_kelamin='$jenis_kelamin', email='$email', latitude='$latitude', longitude='$longitude' where id_pelanggan='$id_pelanggan'";
				}else {
					$querySQL = "UPDATE tb_pelanggan set nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon',jenis_kelamin='$jenis_kelamin', foto='$namafile', email='$email', latitude='$latitude', longitude='$longitude' where id_pelanggan='$id_pelanggan'";
				}				
			}else {
				if($foto=="KOSONG"){
					$querySQL = "UPDATE tb_pelanggan set nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon',jenis_kelamin='$jenis_kelamin', email='$email', password='$password', latitude='$latitude', longitude='$longitude' where id_pelanggan='$id_pelanggan'";
				}else {
					$querySQL = "UPDATE tb_pelanggan set nama_pelanggan='$nama_pelanggan', alamat='$alamat', telepon='$telepon',jenis_kelamin='$jenis_kelamin', foto='$namafile', email='$email', password='$password' , latitude='$latitude', longitude='$longitude'where id_pelanggan='$id_pelanggan'";	
				}
          		
          	}

          	if($conn->query($querySQL) === false) {       
             	echo "failure"; 
          	} else {  
          		if($foto!="KOSONG"){
          			file_put_contents($path,base64_decode($foto));
          		}

             	echo "success";
          	}


		 }else{
		 //if no		 
		 	echo "failure";                  
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>