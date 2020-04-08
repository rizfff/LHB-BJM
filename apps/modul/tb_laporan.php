
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Laporan </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_laporan WHERE `id_laporan`= '$id'");
		echo "<script>document.location='?page=tb_laporan';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_laporan WHERE `id_laporan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_laporan&aksi=prosesSubmit" method="post" class="form-horizontal">
		 <div class="form-body">
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Id Pemesanan </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="id_pemesanan" id="id_pemesanan" placeholder="Id Pemesanan" value="<?php echo $data["id_pemesanan"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Email </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="email" id="email" placeholder="Id Kurir" value="<?php echo $data["email"]; ?>" />
        </div>
		</div>
	    
	    <div class="form-group">
            <label for="date" class="col-sm-3 control-label">Tgl Terkirim </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="tgl_terkirim" id="tgl_terkirim" placeholder="Tgl Terkirim" value="<?php echo $data["tgl_terkirim"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Status </label>
          <div class="col-sm-4"> 
		  <?php
		  $arrket	= array();
$arrket[] = "Pending";
$arrket[] = "Cancel";
$arrket[] = "Finish";
?>
 <select class="form-control" name="status_pemesanan" id="status">
           <option>~~ PILIH ~~</option>
            <?php
			 foreach ($arrket as $nilai) {
            if ($data["status"] == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }?>
           </select>
        </div>
		</div>
	    <div class="form-group">
            <label for="keterangan" class="col-sm-3 control-label">Keterangan </label>
           <div class="col-sm-4">
		    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $data["keterangan"]; ?></textarea>
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_laporan" value="<?php echo $data["id_laporan"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_laporan WHERE `id_laporan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td>Id Pemesanan</td><td><?php echo $data["id_pemesanan"]; ?></td></tr>
	    <tr><td>Id Kurir</td><td><?php echo $data["email"]; ?></td></tr>
	    <tr><td>Tgl Terkirim</td><td><?php echo $data["tgl_terkirim"]; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $data["status"]; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $data["keterangan"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_laporan" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_laporan = $_POST['id_laporan'];
	  $id_pemesanan = $_POST['id_pemesanan'];
	  $email = $_POST['email'];
	  $id_barang = $_POST['id_barang'];
	  $tgl_terkirim = $_POST['tgl_terkirim'];
	  $status = $_POST['status'];
	  $keterangan = $_POST['keterangan'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_laporan (`id_laporan`,`id_pemesanan`,`email`,`tgl_terkirim`,`status`,`keterangan`) VALUES ('$id_laporan','$id_pemesanan','$email','$tgl_terkirim','$status','$keterangan')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_laporan set `id_laporan` = '$id_laporan',`id_pemesanan` = '$id_pemesanan',`email` = '$email',`tgl_terkirim` = '$tgl_terkirim',`status` = '$status',`keterangan` = '$keterangan' WHERE id_laporan='$id_laporan'");
	break;
	}
 echo "<script>document.location='?page=tb_laporan';</script>";
    }
}else {// end aksi?>
	
							<!-- <a href="?page=tb_laporan&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a>  -->
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Id Pemesanan</th>
		    <th>Email</th>
		    <th>Tgl Terkirim</th>
		    <th>Status</th>
		    <th>Keterangan</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_laporan order by `id_laporan` asc ";
		$result= $mysqli->query($query);
		while($tb_laporan=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_laporan["id_pemesanan"]; ?></td>
		    <td><?php echo $tb_laporan["email"]; ?></td>
		    <td><?php echo $tb_laporan["tgl_terkirim"]; ?></td>
		    <td><?php echo $tb_laporan["status"]; ?></td>
		    <td><?php echo $tb_laporan["keterangan"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_laporan&aksi=detail&id=<?php echo $tb_laporan["id_laporan"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<!-- <a href="?page=tb_laporan&aksi=edit&id=<?php echo $tb_laporan["id_laporan"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_laporan&aksi=hapus&id=<?php echo $tb_laporan["id_laporan"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a> -->
              
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