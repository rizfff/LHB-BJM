<?php
include "koneksi.php";


$sql = "SELECT * FROM tb_kurir ORDER BY RAND() ";
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