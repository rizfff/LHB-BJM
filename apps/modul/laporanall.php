
<?php
 include "../../include/notice.php";
include "../../include/koneksi.php";
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="1" >
   <tr>
     <th scope="col"><h3>
       <center>
       LAPORAN PENJUALAN AIR MINUM ISI ULANG<strong></strong></h3></th>
   </tr>

</table>
<a href="javascript:window.print()">PRINT </a>

<table table width="100%" border="0" style="font-family: Tahoma, Arial; font-size: 8pt; border-collapse: collapse" bordercolor="#000000" cellspacing="0" cellpadding="2" align="center">


                <h4>Rekap Penjualan Air Minum Isi Ulang</h4>
                              <table class="table table-bordered table-striped table-condensed flip-content" id="mytable">
							<thead class="flip-content">
                <tr>
                	<th style="text-align:center" width="50px">No</th>
		    <th style="text-align:center">Kurir</th>
		    <th style="text-align:center">Tanggal Pemesanan</th>
		    <!--<th style="text-align:center">Tanggal Terkirim</th>-->
		    <th style="text-align:center">Pelanggan</th>
		    <th style="text-align:center">Total Harga</th>
		    <th style="text-align:center">Status Pemesanan</th>
		  
                </tr>
            </thead>
	    <tbody>
            <?php
             date_default_timezone_set('Asia/Makassar');
             $awal = $_POST['periode_awal'];
             $akhir = $_POST['periode_akhir'];
             $awal = date('Y-m-d', strtotime($awal));
             $akhir = date('Y-m-d', strtotime($akhir));
			//echo date('Y-m-d', strtotime($awal));

            $start = 0;
			 $query="SELECT a.*,b.nama_pelanggan,c.nama_kurir FROM tb_pemesanan_master a
					JOIN tb_pelanggan b on b.id_pelanggan=a.id_pelanggan
					JOIN tb_kurir c on c.id_kurir=a.id_kurir
					where date(a.tanggal_pemesanan)>= '$awal' AND date(a.tanggal_pemesanan)<= '$akhir' order by a.id_pemesanan asc ";
			$result= $mysqli->query($query);

	while($tb_pemesanan_master=$result->fetch_assoc())
		 {
              
		$query2="SELECT sum(subtotal) as total FROM tb_pemesanan_detail WHERE `id_pemesanan`= '$tb_pemesanan_master[id_pemesanan]'";
		$result2= $mysqli->query($query2);
		$data=$result2->fetch_assoc();
		$total2=$data["total"]+3000;
		$total3+=$total2;
		  ?>
<?php
		$query3="SELECT tgl_terkirim FROM tb_laporan WHERE `id_pemesanan`= '$tb_pemesanan_master[id_pemesanan]'";
		$result3= $mysqli->query($query3);
		$data=$result3->fetch_assoc();
		$tanggalkirim=$data["tgl_terkirim"];
?>
                <tr>
		    <td ="4" style="text-align:right"><?php echo ++$start ?></td>
		    <td ="4"><?php echo $tb_pemesanan_master["nama_kurir"]; ?></td>
		    <td ="4" style="text-align:center"><?php echo $tb_pemesanan_master["tanggal_pemesanan"]; ?></td>
		    <!--<td ="4" style="text-align:center"><?php echo $tanggalkirim; ?></td>-->
		    <td ="4"><?php echo $tb_pemesanan_master["nama_pelanggan"]; ?></td>
		    <td ="4"><?php echo "Rp. "; echo $total2; ?></td>
		    <td ="4" style="text-align:center"><?php echo $tb_pemesanan_master["status_pemesanan"]; ?></td>
          		</tr>

                  <?php } ?>
				<tr>
			<td colspan="4" style="text-align:right"><?php echo "Total Keseluruhan" ?></td>
		    <td colspan="2"><?php echo "Rp. "; echo $total3; ?></td>
          		</tr>
</table>
  
							