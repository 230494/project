<?php
/* @var $this TpsController */
/* @var $model Tps */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tps-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model2,$model)); ?>
	<h4 class="page-header">Akun </h4>
	<div class="row">
		<?php echo $form->labelEx($model,'nama_tps'); ?>
		<?php echo $form->textField($model,'nama_tps',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_tps'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model2,'username'); ?>
		<?php echo $form->textField($model2,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model2,'username'); ?>
	</div>
	
	<div class="row">
		<?php
		if(! ($model->isNewRecord)){
			 echo $form->labelEx($model2,'pwd_lama'); 
			 echo $form->passwordField($model2,'pwd_lama',array('size'=>50,'maxlength'=>50)); 
			 echo $form->error($model2,'pwd_lama'); 
		}
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'password'); ?>
		<?php echo $form->passwordField($model2,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model2,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'confirm'); ?>
		<?php echo $form->passwordField($model2,'confirm',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model2,'confirm'); ?>
	</div>
	<h4 class="page-header">Alamat</h4>
	<div class="row">
		<?php echo $form->labelEx($model,'alamat_tps'); ?>
		<?php echo $form->textArea($model,'alamat_tps',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'alamat_tps'); ?>
	</div>
	
	<?php $typeList = CHtml::listData(Fakultas::model()->findAll(),'id_fakultas','fakultas'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_fakultas'); ?>
		<?php echo $form->dropDownList($model, 'id_fakultas', $typeList, array('empty'=>'Pilih Fakultas')); ?>
		<?php echo $form->error($model,'id_fakultas'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>
	<h4 class="page-header">Ketua Panitia</h4>
	<div class="row">
		<?php echo $form->labelEx($model,'kprw'); ?>
		<?php echo $form->textField($model,'kprw'); ?>
		<?php echo $form->error($model,'kprw'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'pprw'); ?>
		<?php echo $form->textField($model,'pprw'); ?>
		<?php echo $form->error($model,'pprw'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'p3w'); ?>
		<?php echo $form->textField($model,'p3w'); ?>
		<?php echo $form->error($model,'p3w'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'subjumlah_bilik'); ?>
		<?php echo $form->textField($model,'subjumlah_bilik'); ?>
		<?php echo $form->error($model,'subjumlah_bilik'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->