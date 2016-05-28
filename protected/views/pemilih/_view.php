<?php
/* @var $this PemilihController */
/* @var $data Pemilih */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nim')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nim), array('view', 'id'=>$data->id_pemilih)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_pemilih')); ?>:</b>
	<?php echo CHtml::encode($data->nama_pemilih); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_fakultas')); ?>:</b>
	<?php echo CHtml::encode($data->id_fakultas); ?>
	<br />


</div>