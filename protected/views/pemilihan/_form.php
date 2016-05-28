<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pemilihan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_pemilihan'); ?>
		<?php echo $form->textField($model,'nama_pemilihan',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nama_pemilihan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah_bilik'); ?>
		<?php echo $form->textField($model,'jumlah_bilik'); ?>
		<?php echo $form->error($model,'jumlah_bilik'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker');
    $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'start_time', //attribute name
		 'language'=>'en',
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(  'dateFormat' =>'yy-mm-dd ',) // jquery plugin options
    ));
?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker');
    $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'end_time', //attribute name
		 'language'=>'en',
                'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array(  'dateFormat' =>'yy-mm-dd ',) // jquery plugin options
    ));
?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo  $form->fileField($model,'logo');//CHtml::activeFileField($model, 'logo'); ?>  <font color='red'>.jpg/.png dan pastikan ukuran file max 5Mb</font>
		<?php echo $form->error($model,'logo'); ?>
	</div><br />
<?php echo $model->logo ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->