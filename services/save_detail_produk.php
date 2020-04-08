<?php
	include "koneksi.php";
include "notice.php";

	function autonumber($tabel){

	include "koneksi.php";
	    //auto number	    	
	    $auto = mysqli_query($conn, "select count(id_pemesanan) as jml from $tabel order by id_pemesanan desc limit 1") or die(mysqli_error());
	    $jumlah_record = mysqli_num_rows($auto);
	    if($jumlah_record == 0)
	        $nomor = 1;
	    
	    else{
	        $row = mysqli_fetch_array($auto);
	        $nomor = intval($row['jml'])+1;
	    }
	      
	      $gabung = "IDORDER-".$nomor;

	    return $gabung;		
	}


	if($_SERVER['REQUEST_METHOD']=='POST'){
		 		
		$id_pelanggan            = $_POST['id_pelanggan'];   
        //check, new transaction or not
		$sql2    = "SELECT * FROM tb_pemesanan_master WHERE status_pemesanan='Proses Pemesanan' and id_pelanggan ='$id_pelanggan'";
		$result2 = mysqli_query($conn,$sql2);
		$check2  = mysqli_fetch_array($result2);

		if(isset($check2)){  // if yes
			$id_pemesanan   =	$check2["id_pemesanan"];
			$cekstatus = "2"; // 2 procc | 1 baru
		}
		else { // if new
			$id_pemesanan   = autonumber('tb_pemesanan_master');
			$cekstatus = "1"; // 2 proses | 1 baru
		}
 

		 $id_barang      = $_POST['id_barang'];   
		 $qty            = $_POST['qty'];         
         $subtotal       = $_POST['subtotal'];      
         date_default_timezone_set('Asia/Makassar');
         $tanggal_pemesanan = date('Y-m-d');   
                  
		 //Creating sql query
		 $sql = "SELECT * FROM tb_pemesanan_detail WHERE id_pemesanan='$id_pemesanan' and id_barang='$id_barang'";

		 //executing query
		 $result = mysqli_query($conn,$sql);

		 //fetching result
		 $check = mysqli_fetch_array($result);

		 //if we got some result
		 if(isset($check)){
		 //if yes
					 	
		 	echo "failure";

		 }else{
		 //if no
		 	
		 	if($cekstatus=="1"){
		 		//Save
		 		$querySQL2 = "INSERT INTO tb_pemesanan_master (id_pemesanan, tanggal_pemesanan,id_pelanggan,status_pemesanan) VALUES ('$id_pemesanan', '$tanggal_pemesanan', '$id_pelanggan', 'Proses Pemesanan')";

	          	if($conn->query($querySQL2) === false) {       
	             	echo "failure"; 
	          	} else {            		
	             	echo "success";
	          	}
		 	}
		 	
					
			//save new detail	
          	$querySQL = "INSERT INTO tb_pemesanan_detail (id_pemesanan, id_barang, qty, subtotal) VALUES ('$id_pemesanan', '$id_barang', '$qty', '$subtotal')";
				if($conn->query($querySQL) === false) {       
	             	echo "failure"; 
	          	} else {            		
	             	echo "success";
	          	}
                  
	 }
		mysqli_close($conn);

	}else {

	  echo "Pesan Web : Tidak Konek dengan Server";

	}
	
?>