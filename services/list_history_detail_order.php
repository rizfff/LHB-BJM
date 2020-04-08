<?php

	include "koneksi.php";
	error_reporting(0);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 	 		
		$id_pemesanan         = $_POST['id_pemesanan']; 

		$sql = "SELECT * FROM tb_pemesanan_master where id_pemesanan ='$id_pemesanan'";
		$result = mysqli_query($conn,$sql);		
		$check = mysqli_fetch_array($result);

		if(isset($check)){							 

		 	$sqlorder = "SELECT @no:=@no+1 nomor, a.id_pemesanan, a.id_barang, b.nama_barang, b.harga, a.qty, a.subtotal from tb_pemesanan_detail a inner join tb_barang b on a.id_barang=b.id_barang inner join tb_pemesanan_master c on c.id_pemesanan=a.id_pemesanan ,(SELECT @no:= 0) AS no where c.id_pemesanan ='$id_pemesanan' and status_pemesanan!='Proses Pemesanan'";
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