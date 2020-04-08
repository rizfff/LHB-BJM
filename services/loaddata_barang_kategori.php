<?php
include "koneksi.php";
include "notice.php";
$id_kategori=$_GET[id_kategori];
$sql = "SELECT * FROM tb_barang	WHERE id_kategori='$id_kategori' ";
$result = $conn->query($sql);

if ($result->num_rows >0) {
	 // output data of each row
	 while($row[] = $result->fetch_assoc()) {
	 
		 $tem = $row;
		 
		 $json = json_encode($tem);
	 
	 
	 }

 	echo $json;
	$conn->close();
 
} 


?>