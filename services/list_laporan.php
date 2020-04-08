<?php

	include "koneksi.php";
	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 	 		
		$email         = $_POST['email']; 

$sql = "SELECT a.* FROM tb_pemesanan_master a
		JOIN tb_kurir b on b.id_kurir=a.id_kurir
		WHERE b.email='$email' ";
		$result = mysqli_query($conn,$sql);		
		$check = mysqli_fetch_array($result);

		if(isset($check)){		

		$sqlorder = "SELECT a.*,c.nama_pelanggan,c.alamat,c.telepon,d.keterangan
					 FROM tb_pemesanan_master a
					JOIN tb_kurir b on b.id_kurir=a.id_kurir
					JOIN tb_pelanggan c on c.id_pelanggan=a.id_pelanggan
                    JOIN tb_laporan d on d.id_pemesanan=a.id_pemesanan
					WHERE b.email='$email' ";

			$result = $conn->query($sqlorder);

			if ($result->num_rows >0) {
			 	// output data of each row
				while($row[] = $result->fetch_assoc()) {
				 
					 $tem = $row;
					 
					 $json = json_encode($tem);	 
			 
				}		 
			} else {
			 	echo "kosong";
			}		

		}else{

			echo "kosong";				

		}

		echo $json;

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}

	$conn->close();	       
		 	  			
?>