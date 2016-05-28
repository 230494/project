<div style="margin-top:-120px">	
<h5>
<?php if(Yii::app()->user->hasFlash('time_end')): ?>
<div class="alert alert-danger col-lg-3">
 <?php echo Yii::app()->user->getFlash('time_end'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('verify')): ?>
<div class="alert alert-success col-lg-3">
 <?php echo Yii::app()->user->getFlash('verify'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('verify1')): ?>
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('verify1'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('verify2')): ?>
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('verify2'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('notverify')): ?>
<div class="alert alert-danger">
 <?php 
 echo Yii::app()->user->getFlash('notverify'); ?>
 </h5>
</div>
<?php endif;?>
		<form method="post" action="<?php echo Yii::app()->controller->createUrl('masukbilik') ; ?>" class='form' align='center'  style="visibility:<?php echo $vis["form"];?>">
		 <input type="hidden" value="<?php echo $model['id_pemilih'];?>" name="id_pemilih" id="id_pemilih"/>
		 <div class='form-group'>
           <label><h4>Nama </b></h4>
           <p class='form-control-static'><?php echo $model['nama_pemilih']; ?></p>
		   </div>
		   
		   <div class='form-group'>
           <label><h4>Fakultas</b> </h4>
           <p class='form-control-static'><?php echo $model['fakultas']; ?></p>
		   </div>
		   <?php
		   if($model['status']=="1"){
			$stat="Belum Memilih";
		   }else if($model['status']=="2"){
		   $stat="Sedang Memilih";
		   }else{
		    $stat="Sudah Memilih";
		   }
		   
		   ?>
		   <div class='form-group'>
           <label><h4>Status </b></h4>
           <p class='form-control-static'><?php echo $stat; ?></p>
		   </div>
		   
		  <?php  if($k = Tps::model()->getNamaTps(Yii::app()->user->getUsername())){
						$jumlahBilik = $k['subjumlah_bilik'];
			?>			
						<div class='form-group' style="visibility:<?php echo $vis["button"]; ?>">
						<label><b>Silahkan Pilih Bilik</b></label>
						
			<?php	$option_bilik = 1;		
						while($option_bilik<=$jumlahBilik){
						//	$bilik_digunakan = mysql_query("SELECT * FROM pemilih WHERE bilik ='$option_bilik' AND status=2 AND pemilihan = '$_SESSION[pemilihan]'");
							if($k = Tps::model()->bilikDigunakan($option_bilik)){	
			
							echo  "<div class=''>";
							echo "<label>";
							echo "<p class='form-control-static'>Bilik No. $option_bilik sedang digunakan, silahkan pilih bilik lainnya <a  class='btn btn-danger btn-small' href=". Yii::app()->controller->createUrl('keluarkanpeserta', array ('id_pemilih'=>$k['id_pemilih']))." > Keluarkan Pemilih</a><br></p>";
							echo  "</label>";
							echo "</div>";
					}else {
							echo "<div class=''>";
							echo "<label>";
							echo "<p class='form-control-static'><input type='radio' name='bilik_ke' id='bilik_$option_bilik' value='$option_bilik' > Bilik No. $option_bilik </p>";
							echo "</label>";
							echo "</div>";
							}
							$option_bilik++;
						}
			}
			else{
				echo "<h5 class='alert alert-danger'>Jumlah Bilik Belum Ditentukan</h5>";
		} ?>
		   	</div>
		
	<input type='submit' class='btn btn-primary btn-large'  style="visibility:<?php echo $vis["button"];?>" id="btnMasuk" value="Masukkan Pemilih" />
	</form>


