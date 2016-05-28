<?php
/* @var $this TpsController */
/* @var $data Tps */
?>

<div class="view">

	<b><span style="font-size:14pt"><?php echo CHtml::encode($data->getAttributeLabel('nama_tps'), array('style'=>array('font-size'=>'16pt'))); ?>:</b>
	<span style="font-size:14pt"><?php echo CHtml::link(CHtml::encode($data->nama_tps), array('view', 'id'=>$data->id_tps)); ?></span>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_tps')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_tps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlahDPT')); ?>:</b>
	<?php echo CHtml::encode(Tps::model()->getDPT($data->id_tps)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subjumlah_bilik')); ?>:</b>
	<?php echo CHtml::encode($data->subjumlah_bilik); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php 
	if($data->status==0){
		echo "<span class='label label-important'>belum diterima</span>"; 
	}else{
		echo "<span class='label label-success'>sudah diterima</span>"; 
	}?>
	<br />


</div>