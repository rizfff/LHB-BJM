
          <div class="row"> 
                    <section class="col-lg-12">
                     
                         <div class="panel panel-default">   
                        <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Informasi </h3> 
                        </div>
                        <div class="panel-body">
<?php
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
		$id = $_GET['id'];
        $sql=$mysqli->query("DELETE FROM informasi WHERE `id_informasi`= '$id'");
		echo "<script>document.location='?page=informasi';</script>";

	 } elseif ($_GET['aksi'] == 'tambah' || $_GET['aksi'] == 'edit') {
		 $id = $_GET['id'];
		if($id==''){$button="Save";}else{$button='Update';}
		 $query="SELECT * FROM informasi WHERE `id_informasi`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <form action="?page=informasi&aksi=prosesSubmit" method="post" class="form-horizontal">
		 <div class="form-body">
	   
	    <div class="form-group">
            <label for="varchar" class="col-sm-3 control-label">Judul Halaman </label>
          <div class="col-sm-6"> 
		   <input type="text" class="form-control" name="judul_halaman" id="judul_halaman" placeholder="Judul Halaman" value="<?php echo $data["judul_halaman"]; ?>" />
        </div>
		</div>
	    <div class="form-group">
            <label for="isi_halaman" class="col-sm-3 control-label">Isi Halaman </label>
           <div class="col-sm-9">
		    <textarea class="form-control" rows="12" name="isi_halaman" id="isi_halaman" placeholder="Isi Halaman"><?php echo $data["isi_halaman"]; ?></textarea>
        </div>
		</div>
	   </div>
        			<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
	    <input type="hidden" name="id_informasi" value="<?php echo $data["id_informasi"]; ?>" /> 
	    <input type="hidden" name="statusTombol" value="<?php echo $button ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> <?php echo $button ?></button> 
	</div>
				</div>
              </div>
			  </form>
   
   <?php } elseif ($_GET['aksi'] == 'detail') {
	    $id = $_GET['id'];
		 	
		 $query="SELECT * FROM informasi WHERE `id_informasi`= '$id'";
		$result= $mysqli->query($query);
		$data=$result->fetch_assoc();
		?>

        <table class="table table-bordered table-striped table-condensed flip-content">
	    <tr><td>Halaman</td><td><?php echo $data["halaman"]; ?></td></tr>
	    <tr><td>Judul Halaman</td><td><?php echo $data["judul_halaman"]; ?></td></tr>
	    <tr><td>Isi Halaman</td><td><?php echo $data["isi_halaman"]; ?></td></tr>
	    <tr><td></td><td><a href="?page=informasi" class="btn btn-info"><i class="fa fa-reply"></i> Kembali</a></td></tr>
	</table>
       
<?php } elseif ($_GET['aksi'] == 'prosesSubmit') {
	   
	  $id_informasi = $_POST['id_informasi'];
	  $halaman = $_POST['halaman'];
	  $judul_halaman = $_POST['judul_halaman'];
	  $isi_halaman = $_POST['isi_halaman'];
	switch($_POST['statusTombol']) {
	case 'Save':
			$query=$mysqli->query("INSERT INTO informasi (`id_informasi`,`halaman`,`judul_halaman`,`isi_halaman`) VALUES ('$id_informasi','$halaman','$judul_halaman','$isi_halaman')");
	break;
	case 'Update':
			$query=$mysqli->query("UPDATE informasi set `id_informasi` = '$id_informasi',`halaman` = '$halaman',`judul_halaman` = '$judul_halaman',`isi_halaman` = '$isi_halaman' WHERE id_informasi='$id_informasi'");
	break;
	}
 echo "<script>document.location='?page=informasi&aksi=edit&id=$id_informasi';</script>";
    }
}else {// end aksi?>
	
							<a href="?page=informasi&aksi=tambah" class="btn btn-primary "><i class="fa fa-plus"></i> <span class="hidden-480">
								Tambah Data </span></a> 
<br>
                           
								
							
							<table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                    <th width="80px">No</th>
		    <th>Halaman</th>
		    <th>Judul Halaman</th>
		    <th>Isi Halaman</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
			 $query="SELECT * FROM informasi order by `id_informasi` asc ";
		$result= $mysqli->query($query);
		while($informasi=$result->fetch_assoc())
		 {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $informasi["halaman"]; ?></td>
		    <td><?php echo $informasi["judul_halaman"]; ?></td>
		    <td><?php echo $informasi["isi_halaman"]; ?></td>
		    <td style="text-align:center" width="200px">
<a href="?page=informasi&aksi=detail&id=<?php echo $informasi["id_informasi"];?>" class="btn btn-primary btn-xs purple"><i class="fa fa-search"></i> Detail</a> 
<a href="?page=informasi&aksi=edit&id=<?php echo $informasi["id_informasi"];?>" class="btn btn-warning btn-xs purple"><i class="fa fa-edit"></i> Edit</a> 
<a href="?page=informasi&aksi=hapus&id=<?php echo $informasi["id_informasi"];?>" class="btn btn-danger btn-xs purple" onclick="javasciprt: return confirm('Are You Sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
              
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