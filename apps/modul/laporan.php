

<?php 
   date_default_timezone_set('Asia/Makassar');
   $tglAwal 	= isset($_POST['cmbTglAwal']) ? $_POST['cmbTglAwal'] : "01-".date('m-Y');
   $tglAkhir 	= isset($_POST['cmbTglAkhir']) ? $_POST['cmbTglAkhir'] : date('d-m-Y');
   
   ?>  
<div class="row">
   <!-- left column -->
   <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">LAPORAN </h3>
         </div>
         <!-- /.box-header -->
         <!-- form start -->
         <div class="box-body">
            <form action="" method="post" class="form-horizontal">
               <div class="form-group">
                  <label class="control-label col-md-3">Periode</label>
                  <div class="col-md-12">
                     <div class="input-daterange input-group">
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input value="<?php echo $tglAwal;?>" id="periode_awal" type="text" class="input-sm form-control date-picker" name="cmbTglAwal" id="cmbTglAwal" placeholder="Tanggal Awal "/>
                        </div>
                        <span class="input-group-addon">s/d</span>
                        <div class="input-group">
                           <input value="<?php echo $tglAkhir;?>" id="periode_akhir" type="text" class="input-sm form-control date-picker" name="cmbTglAkhir" id="cmbTglAkhir" placeholder="Tanggal Akhir "/>
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php if($level=="admin"){?>
               <div class="form-group">
                  <label class="control-label col-md-3">
               </div>
               <?php }?>
               <div class="form-group">
                  <div class="col-md-9">
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-12"> 
                  </div>
               </div>
               <tr>
                  <td></td>
                  <td>
                  <button type="button" id="btn_preview" class="btn btn-primary"><span class='glyphicon glyphicon-save'></span> Submit</button>
                 
               </tr>
               </table>
            </form>
            <?php if ($_GET['aksi'] == 'prosesSubmit') {
               $uid = $_POST['uid'];
               ?>
            </form>
         </div>
      </div>
	  <?php
   }
   ?>  
	 <div class="box box-primary">
         <div class="box-body"  id="hasil_laporan">

		 </div>
	</div>
   </div>
</div>
<div >



<script>
   $('#btn_preview').click(function(){   
   var start_periode = $('#periode_awal').val();
   var periode_akhir = $('#periode_akhir').val();
   if(periode_awal==='' || periode_akhir===''){
	   alert('periode harus lengkap !');
	}else{
	   $.ajax({ 
		   url: 'modul/laporanall.php',
		   data: {"periode_awal": start_periode,"periode_akhir": periode_akhir},
		   type: 'post',
		   success: function(result){
            //alert(result);
				$('#hasil_laporan').html(result); 
	   		}
	   });
	}
   });
</script>

