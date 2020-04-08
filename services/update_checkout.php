<?php
	include "koneksi.php";


	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		 $id_pemesanan   = $_POST['id_pemesanan'];
		 $id_pelanggan          = $_POST['id_pelanggan'];
		 $total_harga    = $_POST['total_harga'];         
                  
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pemesanan_master WHERE id_pelanggan='$id_pelanggan'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if yes
					 	
			$querySQL = "UPDATE tb_pemesanan_master SET total_harga='$total_harga', status_pemesanan ='Pesan' WHERE id_pelanggan ='$id_pelanggan' and id_pemesanan='$id_pemesanan'";

          	if($conn->query($querySQL) === false) {  

             	echo "failure"; 

          	} else {            	

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