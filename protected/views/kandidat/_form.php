<?php
/* @var $this KandidatController */
/* @var $model Kandidat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kandidat-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'no_urut'); ?>
		<?php echo $form->textField($model,'no_urut'); ?>
		<?php echo $form->error($model,'no_urut'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'nama_kandidat'); ?>
		<?php echo $form->textField($model,'nama_kandidat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nama_kandidat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pemilihan'); ?>
		<?php echo '<font style="font-size:12pt">'.$data["nama_pemilihan"].'</font>';
		echo $form->hiddenField($model,'id_pemilihan', array('type'=>'hidden','value'=>$data["id_pemilihan"])); ?>
		<?php echo $form->error($model,'id_pemilihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saksi'); ?>
		<?php echo $form->textArea($model,'saksi',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'saksi'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->fileField($model,'foto',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>
	<br />
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); 
		echo $form->hiddenField($model,'foto_lama', array('type'=>'hidden','value'=>$model["foto"])); ?>
	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->