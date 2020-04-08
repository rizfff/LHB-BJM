<?php

	include "koneksi.php";
include "notice.php";


	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		 $id_kurir   = $_POST['id_kurir'];
		 $nama_kurir = $_POST['nama_kurir'];
		 $email          = $_POST['email'];
		 $no_telpon        = $_POST['no_telpon'];
         $password       = $_POST['password'];        
         $alamat         = $_POST['alamat'];
         $gambar           = $_POST['gambar'];
          $status         = $_POST['status'];         
		 //Creating sql query
		 $sql = "SELECT * FROM tb_kurir WHERE email='$email'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if yes
					 	
		 	$namagambar = str_replace(" ", "", $nama_kurir);
		 	$path     = "foto_kurir/".$namagambar."123.png";
		 	$namafile = $namagambar."123.png";
					
			if(empty($_POST['password'])){
				if($gambar=="KOSONG"){
					$querySQL = "UPDATE tb_kurir set nama_kurir='$nama_kurir', alamat='$alamat', no_telpon='$no_telpon',status='$status', email='$email' where id_kurir='$id_kurir'";
				}else {
					$querySQL = "UPDATE tb_kurir set nama_kurir='$nama_kurir', alamat='$alamat', no_telpon='$no_telpon',status='$status', gambar='$namafile', email='$email' where id_kurir='$id_kurir'";
				}				
			}else {
				if($gambar=="KOSONG"){
					$querySQL = "UPDATE tb_kurir set nama_kurir='$nama_kurir', alamat='$alamat', no_telpon='$no_telpon',status='$status', email='$email', password='$password' where id_kurir='$id_kurir'";
				}else {
					$querySQL = "UPDATE tb_kurir set nama_kurir='$nama_kurir', alamat='$alamat', no_telpon='$no_telpon',status='$status', gambar='$namafile', email='$email', password='$password' where id_kurir='$id_kurir'";	
				}
          		
          	}

          	if($conn->query($querySQL) === false) {       
             	echo "failure"; 
          	} else {  
          		if($gambar!="KOSONG"){
          			file_put_contents($path,base64_decode($gambar));
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