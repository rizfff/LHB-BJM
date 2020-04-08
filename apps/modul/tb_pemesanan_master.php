<div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Pemesanan Galon </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_pemesanan_master WHERE `id_pemesanan`= '$id'");
		echo "<script>document.location='?page=tb_pemesanan_master';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_pemesanan_master WHERE `id_pemesanan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_pemesanan_master&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Kurir </label>
          <div class="col-sm-6"> 

         
          <?php echo cmb_dinamis('id_kurir','tb_kurir','nama_kurir','id_kurir',$data["id_kurir"],'Pilih kurir');?>
		   
        </div>
		</div>
	    <div class="form-group">
            <label for="date" class="col-sm-3 control-label">Tanggal Pemesanan </label>
          <div class="col-sm-6"> 
		   <input type="text" class="form-control" name="tanggal_pemesanan" id="tanggal_pemesanan" placeholder="Tanggal Pemesanan" value="<?php echo $data["tanggal_pemesanan"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Pelanggan </label>
          <div class="col-sm-6"> 
          	 <?php echo cmb_dinamis('id_pelanggan','tb_pelanggan','nama_pelanggan','id_pelanggan',$data["id_pelanggan"],'Pilih Pelanggan');?>

        </div>
		</div>
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Total Harga </label>
          <div class="col-sm-6"> 
		   <input type="text" class="form-control" name="total_harga" id="total_harga" placeholder="Total Harga" value="<?php echo $data["total_harga"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Status Pemesanan </label>
          <div class="col-sm-6"> 
<?php
		  $arrket	= array();
$arrket[] = "Proses Antar";
?>
 <select class="form-control" name="status_pemesanan" id="status_pemesanan">
           <option>~~ PILIH ~~</option>
            <?php
			 foreach ($arrket as $nilai) {
            if ($data["status_pemesanan"] == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }?>
           </select>

          </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_pemesanan" value="<?php echo $data["id_pemesanan"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT a.*,b.nama_pelanggan FROM tb_pemesanan_master a
		JOIN tb_pelanggan b on b.id_pelanggan=a.id_pelanggan WHERE `id_pemesanan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();

		$query3="SELECT sum(subtotal) as total FROM tb_pemesanan_detail WHERE `id_pemesanan`= '$data[id_pemesanan]'";
		$result3= $mysqli->query($query3);
		$data2=$result3->fetch_assoc();
		?>
<table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td width="178">Tanggal Pemesanan</td><td width="430"><?php echo $data["tanggal_pemesanan"]; ?></td></tr>
	    <tr><td>Pelanggan</td><td><?php echo $data["nama_pelanggan"]; ?> </td></tr>
	    <tr><td>Total Harga</td><td><?php echo $data2["total"]+ 3000; ?></td></tr>
	 
	    <tr><td>Status</td><td><?php echo $data["status_pemesanan"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_pemesanan_master" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>

	</table>
    <table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Kode Pemesanan</th>
		    
		    <th>Menu</th>
		    <th>Qty</th>
		  
		    <th>Subtotal</th>
		     <!-- <th>Status Pemesanan</th> -->
		  
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT *FROM tb_pemesanan_detail WHERE `id_pemesanan`= '$data[id_pemesanan]' ";
		$result= $mysqli->query($query);
		while($tb_pemesanan_detail=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_pemesanan_detail["id_pemesanan"]; ?></td>
		     
		    <td><?php echo getname("tb_barang","id_barang",$tb_pemesanan_detail["id_barang"],"nama_barang"); ?></td>
		    <td><?php echo $tb_pemesanan_detail["qty"]; ?></td>

		    <td><?php echo $tb_pemesanan_detail["subtotal"]; ?></td>
		     <!-- <td><?php echo $tb_pemesanan_master["status_pemesanan"]; ?></td> -->
		<!--    <td style="text-align:center" width="200px">
 <a href="?page=pemesanan_detail&aksi=detail&id=<?php echo $tb_pemesanan_detail[""];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=pemesanan_detail&aksi=edit&id=<?php echo $tb_pemesanan_detail[""];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a>  
<a href="?page=pemesanan_detail&aksi=hapus&id=<?php echo $tb_pemesanan_detail["id_menu"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
		    </td>-->
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_pemesanan = $_POST['id_pemesanan'];
	  $id_kurir = $_POST['id_kurir'];
	  $tanggal_pemesanan = $_POST['tanggal_pemesanan'];
	  $id_pelanggan = $_POST['id_pelanggan'];
	  $total_harga = $_POST['total_harga'];
	  $status_pemesanan = $_POST['status_pemesanan'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_pemesanan_master (`id_pemesanan`,`id_kurir`,`tanggal_pemesanan`,`id_pelanggan`,`total_harga`,`status_pemesanan`) VALUES ('$id_pemesanan','$id_kurir','$tanggal_pemesanan','$id_pelanggan','$total_harga','$status_pemesanan')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_pemesanan_master set `id_pemesanan` = '$id_pemesanan',`id_kurir` = '$id_kurir',`tanggal_pemesanan` = '$tanggal_pemesanan',`id_pelanggan` = '$id_pelanggan',`total_harga` = '$total_harga',`status_pemesanan` = '$status_pemesanan' WHERE id_pemesanan='$id_pemesanan'");
	break;
	}
 echo "<script>document.location='?page=tb_pemesanan_master';</script>";
    }
}else {// end aksi?>
	
							<?// <a href="?page=tb_pemesanan_master&aksi=tambah" class="btn btn-primary "><i class="fa"></i> <span class="hidden-480">
								<?//Tambah Data </span></a>
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Kurir</th>
		    <th>Tanggal Pemesanan</th>
		    <th>Pelanggan</th>
		    <th>Total Harga</th>
		    <th>Status Pemesanan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;



			  $query="SELECT a.*,b.nama_pelanggan FROM tb_pemesanan_master a
		JOIN tb_pelanggan b on b.id_pelanggan=a.id_pelanggan order by `id_pemesanan` asc ";
	
		$result= $mysqli->query($query);
		while($tb_pemesanan_master=$result->fetch_assoc())
		 {

		 	$query2="SELECT sum(subtotal) as total FROM tb_pemesanan_detail WHERE `id_pemesanan`= '$tb_pemesanan_master[id_pemesanan]'";
		$result2= $mysqli->query($query2);
		$data=$result2->fetch_assoc();

                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo getname("tb_kurir","id_kurir",$tb_pemesanan_master["id_kurir"],"nama_kurir"); ?></td>
		    <td style="text-align:center"><?php echo $tb_pemesanan_master["tanggal_pemesanan"]; ?></td>
		    <td><?php echo $tb_pemesanan_master["nama_pelanggan"]; ?></td>
		    <td><?php echo "Rp. "; echo $data["total"] + 3000; ?></td>
		    <td style="text-align:center"><?php echo $tb_pemesanan_master["status_pemesanan"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_pemesanan_master&aksi=detail&id=<?php echo $tb_pemesanan_master["id_pemesanan"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_pemesanan_master&aksi=edit&id=<?php echo $tb_pemesanan_master["id_pemesanan"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<!-- <a href="?page=tb_pemesanan_master&aksi=hapus&id=<?php echo $tb_pemesanan_master["id_pemesanan"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a> -->
              
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
		

      <?php }?> 
	  </div>
		</div>
      </section>
      </div> 
    
     
