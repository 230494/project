<?php
/* @var $this TpsController */
/* @var $model Tps */

$this->breadcrumbs=array(
	'Tps'=>array('index'),
	$model->id_tps=>array('view','id'=>$model->id_tps),
	'Update',
);

$this->menu=array(
	array('label'=>'List TPS', 'url'=>array('index')),
	array('label'=>'Create TPS', 'url'=>array('create')),
	array('label'=>'View TPS', 'url'=>array('view', 'id'=>$model->id_tps)),
	array('label'=>'Manage TPS', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
 
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('wrong_pwd')): ?>
 
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('wrong_pwd'); ?>
</div>
<?php endif;?>
<h1>Update TPS  <?php echo $model->nama_tps; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'model3'=>$model3)); ?>