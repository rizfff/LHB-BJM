<?php
	include "koneksi.php";
include "notice.php";

	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		  $id_laporan  	 =  $_POST['id_laporan'];
		 $id_pemesanan     	 = $_POST['id_pemesanan'];
         $tgl_terkirim= date('Y-m-d');
          $status= $_POST['status'];
         $keterangan         = $_POST['keterangan'];
         $email              = $_POST['email'];
                  
		 //Creating sql query
		 $sql = "SELECT * FROM tb_laporan WHERE email='$email'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);
				
          	$querySQL = "INSERT INTO tb_laporan (`id_laporan`,`id_pemesanan`,`email`,`tgl_terkirim`,`status`,`keterangan`) VALUES ('$id_laporan','$id_pemesanan','$email','$tgl_terkirim','$status','$keterangan')";

          	if($conn->query($querySQL) === false) {       
             	echo "failure"; 
          	} else {  

             	echo "success";
          	}
               //update status
			$delete = $dbh->query("UPDATE tb_pemesanan_master set status_pemesanan='$status' WHERE id_pemesanan ='$id_pemesanan'");

            if ($delete == FALSE){
                echo "<p>delete Gagal karena:".(mysql_error())."</p>";
            }else { }    
		 
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>

