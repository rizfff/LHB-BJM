<?php
	include "koneksi.php";

	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 
		 $id_barang = $_POST['id_barang'];
		 //Creating sql query
		 $sql = "SELECT * FROM tb_barang a join tb_kategori b on a.id_kategori= b.id_kategori WHERE id_barang='$id_barang' ";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //displaying success
		 	echo "success"."#".$check["nama_kategori"]."#".$check["ukuran"]."#".$check["nama_barang"]."#".$check["harga"]."#".$check["gambar"]."#".$check["keterangan"];

		 }else{
		 //displaying failure
		 	echo "failure";
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>