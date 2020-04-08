
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span>  Kurir </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_kurir WHERE `id_kurir`= '$id'");
		echo "<script>document.location='?page=tb_kurir';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_kurir WHERE `id_kurir`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_kurir&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Nama Kurir </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="nama_kurir" id="nama_kurir" placeholder="Nama Kurir" required value="<?php echo $data["nama_kurir"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Alamat </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required value="<?php echo $data["alamat"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Email </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="<?php echo $data["email"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">No Telpon </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="No Telpon" required value="<?php echo $data["no_telpon"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Gambar </label>
          <div class="col-sm-4"> 
		   <input type="file" class="form-control" name="gambar" id="gambar" placeholder="gambar" value="<?php echo $data["gambar"]; ?>" /> <input type="hidden" class="form-control" name="gambar0" id="gambar" placeholder="gambar" required value="<?php echo $data["gambar"]; ?>" />
        </div>
		</div>
	 
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Password </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="password" id="password" placeholder="Password" required value="<?php echo $data["password"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Status </label>
          <div class="col-sm-4"> 
		   <?php
		  $arrket	= array();
$arrket[] = "Kurir";

?>
 <select class="form-control" name="status" id="status">
           <option>~~ PILIH  ~~</option>
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
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_kurir" value="<?php echo $data["id_kurir"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_kurir WHERE `id_kurir`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td width="191">Nama Kurir</td><td width="431"><?php echo $data["nama_kurir"]; ?></td>
	      <td width="280" rowspan="8"><div align="center"><img src="../services/foto_kurir/<?php echo $data["gambar"]; ?>" alt="" width="280" height="280" /></div></td>
	    </tr>
	    <tr><td>Alamat</td><td><?php echo $data["alamat"]; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $data["email"]; ?></td></tr>
	    <tr><td>No Telpon</td><td><?php echo $data["no_telpon"]; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $data["password"]; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $data["status"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_kurir" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_kurir = $_POST['id_kurir'];
	  $nama_kurir = $_POST['nama_kurir'];
	  $alamat = $_POST['alamat'];
	  $email = $_POST['email'];
	  $no_telpon = $_POST['no_telpon'];
	  $gambar = $_POST['gambar'];
	  $gambar0=strip_tags($_POST["gambar0"]);
	if ($_FILES["gambar"]["name"] != "") {
		$NAME = $_FILES["gambar"]["name"];
		$n=strrchr(trim($NAME,'/\\'),'.'); 
		$name=date("Ymdhis"). $n;
		if(file_exists("../services/foto_kurir/".$gambar0)){
		}
		@copy($_FILES["gambar"]["tmp_name"],"../services/foto_kurir/".$name);
		$gambar=$name;
		} 
	else {$gambar=$gambar0;}
	if(strlen($gambar)<1){$gambar=$gambar0;}
	  $password = $_POST['password'];
	  $status = $_POST['status'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_kurir (`id_kurir`,`nama_kurir`,`alamat`,`email`,`no_telpon`,`gambar`,`password`,`status`) VALUES ('$id_kurir','$nama_kurir','$alamat','$email','$no_telpon','$gambar','$password','$status')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_kurir set `id_kurir` = '$id_kurir',`nama_kurir` = '$nama_kurir',`alamat` = '$alamat',`email` = '$email',`no_telpon` = '$no_telpon',`gambar` = '$gambar',`password` = '$password',`status` = '$status' WHERE id_kurir='$id_kurir'");
	break;
	}
 echo "<script>document.location='?page=tb_kurir';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_kurir&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Kurir</th>
		    <th>Alamat</th>
		    <th>Email</th>
		    <th>No Telpon</th>
		    <th>Gambar</th>
		    <th>Status</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_kurir order by `id_kurir` asc ";
		$result= $mysqli->query($query);
		while($tb_kurir=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_kurir["nama_kurir"]; ?></td>
		    <td><?php echo $tb_kurir["alamat"]; ?></td>
		    <td><?php echo $tb_kurir["email"]; ?></td>
		    <td><?php echo $tb_kurir["no_telpon"]; ?></td>
		     <td><img src="../services/foto_kurir/<?php echo $tb_kurir["gambar"]; ?>" height="80" width="80" /></td>
		    <td><?php echo $tb_kurir["status"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_kurir&aksi=detail&id=<?php echo $tb_kurir["id_kurir"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_kurir&aksi=edit&id=<?php echo $tb_kurir["id_kurir"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_kurir&aksi=hapus&id=<?php echo $tb_kurir["id_kurir"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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