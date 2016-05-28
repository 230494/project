<?php
/* @var $this TpsController */
/* @var $model Tps */

$this->breadcrumbs=array(
	'TPS'=>array('index'),
	$model->id_tps,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List TPS', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create TPS', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-edit"></i> Update TPS', 'url'=>array('update', 'id'=>$model->id_tps)),
	array('label'=>'<i class="icon icon-trash"></i> Delete TPS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tps),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage TPS', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('create')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('create'); ?>
</div>
<?php endif;?>
<?php if(Yii::app()->user->hasFlash('update')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('update'); ?>
</div>
<?php endif;?>
<h1>View TPS : <?php echo $model->nama_tps; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	array(
		'label'=>'Username',
		'value'=>Admin::model()->getUsernameAdmin($model->id_admin),
		),
		array(
		'label'=>'Password',
		'value'=>'*****',
		),
		'alamat_tps',
		array(
		'label'=>'Jumlah DPT',
		'value'=>Tps::model()->getDPT($model->id_tps),
		),
		'latitude',
		'subjumlah_bilik',
	),
)); ?>
