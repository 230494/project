<?php
/* @var $this PemilihController */
/* @var $model Pemilih */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pemilih-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nim'); ?>
		<?php echo $form->textField($model,'nim',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'nim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_pemilih'); ?>
		<?php echo $form->textField($model,'nama_pemilih',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nama_pemilih'); ?>
	</div>

	<?php $typeList = CHtml::listData(Fakultas::model()->findAll(),'id_fakultas','fakultas'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_fakultas'); ?>
		<?php echo $form->dropDownList($model, 'id_fakultas', $typeList, array('empty'=>'Pilih Fakultas')); ?>
		<?php echo $form->error($model,'id_fakultas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->