<?php
$this->breadcrumbs=array(
	'Tpsadmin'=>array('tpsadmin'),
	'Verifikasi pemilih'
);
/* @var $this PemilihController */
/* @var $model Pemilih */
/* @var $form CActiveForm */
?>
<?php $baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/assets/jquery-1.8.3.min.js');
//$cs->registerScriptFile($baseUrl.'/assets/jquery-1.7.2.js');?>

<h1>Verifikasi Pemilih</h1>
<center>
<h4>
<?php if(Yii::app()->user->hasFlash('berhasil_masuk')): ?>
<div class="alert alert-success col-lg-3">
 <?php echo Yii::app()->user->getFlash('berhasil_masuk'); ?>
</div>
<?php endif;?>
<?php if(Yii::app()->user->hasFlash('gagal_masuk')): ?>
<div class="alert alert-danger col-lg-3">
 <?php echo Yii::app()->user->getFlash('gagal_masuk'); ?>
</div>
<?php endif;?>
<?php if(Yii::app()->user->hasFlash('bilik_gagal')): ?>
<div class="alert alert-danger col-lg-3">
 <?php echo Yii::app()->user->getFlash('bilik_gagal'); ?>
</div>
<?php endif;?>
</h4>
<div class="form well">
	
		 <div class="form-group has-success">
             <label><h4>Masukkan NIM Pemilih</h4>
			</label>
			<?php if(true){?>
            <input type="text" name="nim" id="nim" >
			<?php }else{?>
			<input type="text" name="nim" id="nim" disabled>
			<?php }?>
		</div>
		<button class="btn btn-primary" id="ver">Verifikasi</button>
	
</div><!-- form -->
	
	<p id="showDetail" ></p>
	
	</center>

<script>

	$(document).ready(function(){
		
	$("#ver").click(function(){

	var  nim=$("#nim").val();	
		$.ajax({
		  url:'<?php echo $this->createUrl('verifikasi/Verify'); ?>',
		 //a beforeSend: function() { $('#spinner').show(); },
		  data:'nim='+nim,
			type:'GET',
			success:function(data){
				$("#showDetail").html(data);
			},
		});
	});
	});
</script>
