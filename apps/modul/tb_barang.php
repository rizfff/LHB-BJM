
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Barang </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM tb_barang WHERE `id_barang`= '$id'");
		echo "<script>document.location='?page=tb_barang';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM tb_barang WHERE `id_barang`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=tb_barang&aksi=prosesSubmit" method="post" class="form-horizontal" enctype="multipart/form-data">
		 <div class="form-body">
	    
	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label"> Jenis Order </label>
          <div class="col-sm-6"> 
        
          <?php echo cmb_dinamis('id_kategori','tb_kategori','nama_kategori','id_kategori',$data["id_kategori"],'Pilih Kategori');?>
        </div>
		</div>
	    
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Ukuran </label>
          <div class="col-sm-6"> 

          	 <?php
$arrket2	= array();
$arrket2[] = "5 Liter";
$arrket2[] = "19 Liter";

?>
 <select class="form-control" name="ukuran" id="ukuran">
           <option>~~ PILIH ~~</option>
            <?php
			 foreach ($arrket2 as $nilai1) {
            if ($data["ukuran"] == $nilai1) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option required value='$nilai1' $cek>$nilai1</option>";
          }?>
           </select>


		
        </div>
		</div>
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Nama Barang </label>
          <div class="col-sm-6"> 
		   <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" required value="<?php echo $data["nama_barang"]; ?>" />
        </div>
		</div>

		

	    <div class="form-group">
            <label for="int" class="col-sm-3 control-label">Harga </label>
          <div class="col-sm-6"> 
		   <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" required value="<?php echo $data["harga"]; ?>" />
        </div>
		</div>
	   
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Gambar </label>
          <div class="col-sm-6"> 
		   <input type="file" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $data["gambar"]; ?>" /> <input type="hidden" class="form-control" name="gambar0" id="gambar" placeholder="Gambar" required value="<?php echo $data["gambar"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="keterangan" class="col-sm-3 control-label">Keterangan </label>
           <div class="col-sm-6">
		    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" required placeholder="Keterangan"><?php echo $data["keterangan"]; ?></textarea>
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_barang" value="<?php echo $data["id_barang"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	    <a class='btn btn-danger' onclick=self.history.back() ><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM tb_barang WHERE `id_barang`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table width="100%" class="table table-bordered table-striped table-condensed flip-content">
	  
	

	    <tr><td>Kategori</td><td><?php echo getname("tb_kategori","id_kategori",$data["id_kategori"],"nama_kategori"); ?></td>
        <td width="410" rowspan="8"><div align="center"><img src="uploads/<?php echo $data["gambar"]; ?>" alt="" width="320" height=262" /></div></td>
	      </tr>
	   
	    <tr><td>Ukuran</td><td><?php echo $data["ukuran"]; ?></td>
	      </tr>
	    <tr>
	      <td>Nama Produk</td><td><?php echo $data["nama_barang"]; ?></td>
	      </tr>
	      <tr>
	      
	    <tr><td>Harga</td><td><?php echo $data["harga"]; ?></td>
	      </tr>
	   
	   
	    <tr><td>Keterangan</td><td><?php echo $data["keterangan"]; ?></td>
	      </tr>
	    <tr><td></td><td><a href="?page=tb_barang" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td>
	      <td>&nbsp;</td>
	    </tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_barang = $_POST['id_barang'];
	  $id_kategori = $_POST['id_kategori'];
	  $ukuran = $_POST['ukuran'];
	  $nama_barang = $_POST['nama_barang'];
	  $harga = $_POST['harga'];
	  $gambar = $_POST['gambar'];
	  $gambar0=strip_tags($_POST["gambar0"]);
	if ($_FILES["gambar"]["name"] != "") {
		$NAME = $_FILES["gambar"]["name"];
		$n=strrchr(trim($NAME,'/\\'),'.'); 
		$name=date("Ymdhis"). $n;
		if(file_exists("uploads/".$gambar0)){
			//unlink("uploads/".$gambar0);
		}
		@copy($_FILES["gambar"]["tmp_name"],"./uploads/".$name);
		$gambar=$name;
		} 
	else {$gambar=$gambar0;}
	if(strlen($gambar)<1){$gambar=$gambar0;}
	  $keterangan = $_POST['keterangan'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO tb_barang (`id_barang`,`id_kategori`,`ukuran`,`nama_barang`,`harga`,`gambar`,`keterangan`) VALUES ('$id_barang','$id_kategori','$ukuran','$nama_barang','$harga','$gambar','$keterangan')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE tb_barang set `id_barang` = '$id_barang',`id_kategori` = '$id_kategori',`ukuran` = '$ukuran',`nama_barang` = '$nama_barang',`harga` = '$harga',`gambar` = '$gambar',`keterangan` = '$keterangan' WHERE id_barang='$id_barang'");
	break;
	}
 echo "<script>document.location='?page=tb_barang';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=tb_barang&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		  
		    <th>Kategori</th>
		    <th>Jenis</th>
		    <th>Nama Produk</th>
		    <th>Harga</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;

			 $query="SELECT * FROM tb_barang order by `id_barang` asc ";

		$result= $mysqli->query($query);
		while($tb_barang=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    
		    <td><?php echo getname("tb_kategori","id_kategori",$tb_barang["id_kategori"],"nama_kategori"); ?></td>
		    <td><?php echo $tb_barang["ukuran"]; ?></td>
		    <td><?php echo $tb_barang["nama_barang"]; ?></td>
		    <td><?php echo $tb_barang["harga"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=tb_barang&aksi=detail&id=<?php echo $tb_barang["id_barang"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=tb_barang&aksi=edit&id=<?php echo $tb_barang["id_barang"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=tb_barang&aksi=hapus&id=<?php echo $tb_barang["id_barang"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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