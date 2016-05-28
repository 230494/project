<?php
/* @var $this PemilihanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pemilihan',
);

$this->menu=array(
	array('label'=>' <i class="icon icon-pencil"></i> Create Pemilihan', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage Pemilihan', 'url'=>array('admin')),
);
?>

<h1>Pemilihan</h1>

<h5>
<?php if(Yii::app()->user->hasFlash('non-aktif')): ?>
<div class="alert alert-success col-lg-3">
 <?php echo Yii::app()->user->getFlash('non-aktif'); ?>
</div>
<?php endif;?>
<?php if(Yii::app()->user->hasFlash('aktif')): ?>
<div class="alert alert-success col-lg-3">
 <?php echo Yii::app()->user->getFlash('aktif'); ?>
</div>
<?php endif;?>
</h5>
<a href="<?php echo Yii::app()->request->baseUrl.'/pemilihan/mode'; ?>" class="btn btn-danger">Non-Aktifkan Semua Pemilihan</a>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
