<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	
	<div class="row">
		<?php echo $form->label($model,'nama_pemilihan'); ?>
		<?php echo $form->textField($model,'nama_pemilihan',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_bilik'); ?>
		<?php echo $form->textField($model,'jumlah_bilik'); ?>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->