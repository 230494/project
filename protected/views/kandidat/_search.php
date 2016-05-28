<?php
/* @var $this KandidatController */
/* @var $model Kandidat */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'no_urut'); ?>
		<?php echo $form->textField($model,'no_urut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_kandidat'); ?>
		<?php echo $form->textField($model,'nama_kandidat',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	
	<div class="row">
		<?php echo $form->label($model,'hasil'); ?>
		<?php echo $form->textField($model,'hasil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'saksi'); ?>
		<?php echo $form->textField($model,'saksi',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->