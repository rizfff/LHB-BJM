<?php
include "koneksi.php";
include "notice.php";

$sql = "SELECT * FROM tb_kategori  order by `id_kategori` asc ";
$result = $conn->query($sql);

if ($result->num_rows >0) {
	 // output data of each row
	 while($row[] = $result->fetch_assoc()) {
	 
		 $tem = $row;
		 
		 $json = json_encode($tem);
	 
	 
	 }
 
} else {
 	echo "0 results";
}
 
 	echo $json;
	$conn->close();
?>