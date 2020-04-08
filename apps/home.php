
<?php
   if($_SESSION["ses_level"]=="admin"){
$satu=$mysqli->query("SELECT id_pelanggan FROM tb_pelanggan")->num_rows;
$dua=$mysqli->query("SELECT id_pemesanan FROM tb_pemesanan_master")->num_rows;
$tiga=$mysqli->query("SELECT id_barang  FROM tb_barang")->num_rows;
}else {
$satu=$mysqli->query("SELECT id_pelanggan FROM tb_pelanggan")->num_rows;
$dua=$mysqli->query("SELECT id_pemesanan FROM tb_pemesanan_master")->num_rows;
$tiga=$mysqli->query("SELECT id_barang  FROM tb_barang")->num_rows;
}

?>    
 <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $satu+0;?></h3>

              <p>Total Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $dua+0;?></h3>

              <p>Total Pemesanan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $tiga+0;?></h3>

              <p>Total  Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-dropbox"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
  <!-- width="1268" height="550" -->
   <div class="logo"><img src="../assets/dist/img/bgdistro.jpg"/> </div>


