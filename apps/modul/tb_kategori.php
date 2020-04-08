
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Kategori </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_kategori WHERE `id_kategori`= '$id'");
		echo "<script>document.location='?page=tb_kategori';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_kategori WHERE `id_kategori`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_kategori&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Kategori </label>
          <div class="col-sm-4"> 
		   <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Kategori" required value="<?php echo $data["nama_kategori"]; ?>" />
        </div>
		</div>

		<div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Gambar</label>
          <div class="col-sm-4"> 
          	<input type="file" class="form-control" name="foto" id="foto" placeholder="foto" value="<?php echo $data["foto"]; ?>" /> <input type="hidden" class="form-control" name="foto0" id="foto" placeholder="foto" value="<?php echo $data["foto"]; ?>" />

        </div>
		</div>

	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_kategori" value="<?php echo $data["id_kategori"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_kategori WHERE `id_kategori`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td>Kategori</td><td><?php echo $data["nama_kategori"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=tb_kategori" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_kategori = $_POST['id_kategori'];
	  $nama_kategori = $_POST['nama_kategori'];
	  $foto = $_POST['foto'];
	  $foto0=strip_tags($_POST["foto0"]);
	if ($_FILES["foto"]["name"] != "") {
		$NAME = $_FILES["foto"]["name"];
		$n=strrchr(trim($NAME,'/\\'),'.'); 
		$name=date("Ymdhis"). $n;
		if(file_exists("uploads/".$foto0)){
		}
		@copy($_FILES["foto"]["tmp_name"],"./uploads/".$name);
		$foto=$name;
		} 
	else {$foto=$foto0;}
	if(strlen($foto)<1){$foto=$foto0;}

	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_kategori (`id_kategori`,`nama_kategori`,`foto`) VALUES ('$id_kategori','$nama_kategori','$foto')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_kategori set `id_kategori` = '$id_kategori',`nama_kategori` = '$nama_kategori' ,`foto` = '$foto' WHERE id_kategori='$id_kategori'");
	break;
	}
 echo "<script>document.location='?page=tb_kategori';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_kategori&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Kategori</th>
		    <th>gambar</th>
		   
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM tb_kategori order by `id_kategori` asc ";
		$result= $mysqli->query($query);
		while($tb_kategori=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $tb_kategori["nama_kategori"]; ?></td>
		     <td> <img src="uploads/<?php echo $tb_kategori["foto"]; ?>" alt="" width="150" height=150" /></td>

		    <td style="text-align:center" width="200px">
<!-- <a href="?page=tb_kategori&aksi=detail&id=<?php echo $tb_kategori["id_kategori"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> --> 
<a href="?page=tb_kategori&aksi=edit&id=<?php echo $tb_kategori["id_kategori"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_kategori&aksi=hapus&id=<?php echo $tb_kategori["id_kategori"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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