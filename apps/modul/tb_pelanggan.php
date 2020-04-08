
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Pelanggan </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_pelanggan WHERE `id_pelanggan`= '$id'");
		echo "<script>document.location='?page=tb_pelanggan';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_pelanggan WHERE `id_pelanggan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_pelanggan&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Nama pelanggan </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama pelanggan" required value="<?php echo $data["nama_pelanggan"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Alamat </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required value="<?php echo $data["alamat"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Telepon </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" required value="<?php echo $data["telepon"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Jenis Kelamin </label>
          <div class="col-sm-4"> 
		   
		   <?php
		  $arrket	= array();
$arrket[] = "Pria";
$arrket[] = "Wanita";
?>
 <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
           <option>~~ PILIH ~~</option>
            <?php
			 foreach ($arrket as $nilai) {
            if ($data["jenis_kelamin"] == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }?>
           </select>

        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Foto </label>
          <div class="col-sm-4"> 
          	<input type="file" class="form-control" name="foto" id="foto" placeholder="foto" value="<?php echo $data["foto"]; ?>" /> <input type="hidden" class="form-control" name="foto0" id="foto" placeholder="foto" value="<?php echo $data["foto"]; ?>" />

        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Email </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="<?php echo $data["email"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Password </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="password" id="password" placeholder="Password" required value="<?php echo $data["password"]; ?>" />
        </div>
		</div>

		<div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Latitude </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" required value="<?php echo $data["latitude"]; ?>" />
        </div>
		</div>

		<div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Longitude </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" required value="<?php echo $data["longitude"]; ?>" />
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_pelanggan" value="<?php echo $data["id_pelanggan"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_pelanggan WHERE `id_pelanggan`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table width="322" class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td width="102">Nama pelanggan</td><td width="168"><?php echo $data["nama_pelanggan"]; ?></td>
	      <td width="168" rowspan="6"><img src="../services/foto_konsumen/<?php echo $data["foto"]; ?>" alt="" width="220" height="152" /></td>
	    </tr>
	    <tr><td>Alamat</td><td><?php echo $data["alamat"]; ?></td>
	      </tr>
	    <tr><td>Telepon</td><td><?php echo $data["telepon"]; ?></td>
	      </tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $data["jenis_kelamin"]; ?></td>
	      </tr>
	   
	    <tr><td>Email</td><td><?php echo $data["email"]; ?></td>
	      </tr>
	    <tr><td>Password</td><td><?php echo $data["password"]; ?></td>
	      </tr>
	        <tr><td>Latitude</td><td><?php echo $data["latitude"]; ?></td>
	      </tr>
	        <tr><td>Longitude</td><td><?php echo $data["longitude"]; ?></td>
	      </tr>
	    <tr><td></td><td><a href="?page=tb_pelanggan" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td>
	      <td>&nbsp;</td>
	    </tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_pelanggan = $_POST['id_pelanggan'];
	  $nama_pelanggan = $_POST['nama_pelanggan'];
	  $alamat = $_POST['alamat'];
	  $telepon = $_POST['telepon'];
	  $jenis_kelamin = $_POST['jenis_kelamin'];
	  $foto = $_POST['foto'];
	  $foto0=strip_tags($_POST["foto0"]);
	if ($_FILES["foto"]["name"] != "") {
		$NAME = $_FILES["foto"]["name"];
		$n=strrchr(trim($NAME,'/\\'),'.'); 
		$name=date("Ymdhis"). $n;
		if(file_exists("../services/foto_konsumen/".$foto0)){
		}
		@copy($_FILES["foto"]["tmp_name"],"../services/foto_konsumen/".$name);
		$foto=$name;
		} 
	else {$foto=$foto0;}
	if(strlen($foto)<1){$foto=$foto0;}
	  $email = $_POST['email'];
	  $password = $_POST['password'];
	  $latitude = $_POST['latitude'];
	  $longitude = $_POST['longitude'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_pelanggan (`id_pelanggan`,`nama_pelanggan`,`alamat`,`telepon`,`jenis_kelamin`,`foto`,`email`,`password`,`latitude`,`longitude`) VALUES ('$id_pelanggan','$nama_pelanggan','$alamat','$telepon','$jenis_kelamin','$foto','$email','$password','$latitude','$longitude')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_pelanggan set `id_pelanggan` = '$id_pelanggan',`nama_pelanggan` = '$nama_pelanggan',`alamat` = '$alamat',`telepon` = '$telepon',`jenis_kelamin` = '$jenis_kelamin',`foto` = '$foto',`email` = '$email',`password` = '$password',`latitude` = '$latitude' ,`longitude` = '$longitude' WHERE id_pelanggan='$id_pelanggan'");
	break;
	}
 echo "<script>document.location='?page=tb_pelanggan';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_pelanggan&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Nama pelanggan</th>
		    <th>Alamat</th>
		    <th>Telepon</th>
		    <th>Jenis Kelamin</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_pelanggan order by `id_pelanggan` asc ";
		$result= $mysqli->query($query);
		while($tb_pelanggan=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_pelanggan["nama_pelanggan"]; ?></td>
		    <td><?php echo $tb_pelanggan["alamat"]; ?></td>
		    <td><?php echo $tb_pelanggan["telepon"]; ?></td>
		    <td><?php echo $tb_pelanggan["jenis_kelamin"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_pelanggan&aksi=detail&id=<?php echo $tb_pelanggan["id_pelanggan"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_pelanggan&aksi=edit&id=<?php echo $tb_pelanggan["id_pelanggan"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_pelanggan&aksi=hapus&id=<?php echo $tb_pelanggan["id_pelanggan"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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