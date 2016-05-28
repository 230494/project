<?php
/* @var $this TpsController */
/* @var $model Tps */

$this->breadcrumbs=array(
	'TPS'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TPS', 'url'=>array('index')),
	array('label'=>'Manage TPS', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
 
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif;?>
<h1>Create TPS</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2)); ?>