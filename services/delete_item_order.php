<?php
	include "koneksi.php";
include "notice.php";

	if($_SERVER['REQUEST_METHOD']=='POST'){		 		

		 $id_pemesanan   = $_POST['id_pemesanan'];	
		 $id_barang      = $_POST['id_barang'];		       
		 $qty            = $_POST['qty'];                              
                  
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pemesanan_detail WHERE id_pemesanan='$id_pemesanan' and id_barang='$id_barang'";
		 
		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if there's data already
					 

		 	//delete detail 
          	$querySQL = "DELETE FROM tb_pemesanan_detail where id_pemesanan='$id_pemesanan'  AND id_barang ='$id_barang'";

          	if($conn->query($querySQL) === false) {       
             	echo "failure"; 
          	} else {         

   			          			          	
	             	echo "success";
	   
          	}
		 	

		 }else{
		 //if there's no data
					
			echo "failure";
                  
		 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>