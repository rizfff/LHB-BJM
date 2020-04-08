<?php
include "koneksi.php";
$sql1 = "select b.* from tb_pemesanan_master a
			LEFT JOIN tb_pemesanan_detail b on b.id_pemesanan = a.id_pemesanan
			WHERE a.status_pemesanan='Proses Transaksi'
			AND DATE_ADD(a.tanggal_pemesanan, INTERVAL 2 HOUR) < NOW()";
$res1 = mysqli_query($conn,$sql1);	
if ($res1->num_rows >0) {
	$data=$res1->fetch_assoc();

	$sql2 = "UPDATE tb_barang
			set stok=stok+".$data['qty']."
			WHERE id_barang='".$data['id_barang']."'";
	$res2 = mysqli_query($conn,$sql2);
}
$sql3 = "UPDATE tb_pemesanan_master
			set status_pemesanan='Cancel'
			WHERE status_pemesanan='Proses Transaksi'
			AND DATE_ADD(tanggal_pemesanan, INTERVAL 2 HOUR) < NOW()";

$res3 = mysqli_query($conn,$sql3);
$sql = "SELECT * FROM tb_barang ORDER BY RAND() ";
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