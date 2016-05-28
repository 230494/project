<?php
/* @var $this PemilihController */
/* @var $model Pemilih */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_pemilih'); ?>
		<?php echo $form->textField($model,'nama_pemilih',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	
	<?php $typeList = CHtml::listData(Fakultas::model()->findAll(),'id_fakultas','fakultas'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_fakultas'); ?>
		<?php echo $form->dropDownList($model, 'id_fakultas', $typeList, array('empty'=>'Pilih Fakultas')); ?>
		<?php echo $form->error($model,'id_fakultas'); ?>
	</div>
	
	<?php $typeList = CHtml::listData(Pemilih::model()->getStatus(),'id','title'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', $typeList, array('empty'=>'Pilih Status')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Cari',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->