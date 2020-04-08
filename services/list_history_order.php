<?php

	include "koneksi.php";
	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 	 		
		$id_pelanggan         = $_POST['id_pelanggan']; 

		$sql = "SELECT * FROM tb_pemesanan_master where id_pelanggan ='$id_pelanggan'";
		$result = mysqli_query($conn,$sql);		
		$check = mysqli_fetch_array($result);

		if(isset($check)){							 
            
		 	$sqlorder = "SELECT id_pemesanan, tanggal_pemesanan, total_harga, status_pemesanan from tb_pemesanan_master where id_pelanggan ='$id_pelanggan' and status_pemesanan!='Proses Pemesanan'";
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