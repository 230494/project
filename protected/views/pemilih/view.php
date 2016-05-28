<?php
/* @var $this PemilihController */
/* @var $model Pemilih */

$this->breadcrumbs=array(
	'Pemilihs'=>array('index'),
	$model->nim,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-pencil"></i> Create Pemilih', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-edit"></i> Update Pemilih', 'url'=>array('update', 'id'=>$model->id_pemilih)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Pemilih', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pemilih),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage Pemilih', 'url'=>array('index')),
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
<h1>NIM Pemilih <?php echo $model->nim; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	'nama_pemilih',
	 	array(
		'label'=>'Pemilihan',
		'value'=>Pemilihan::model()->getNamaPemilihan($model->id_pemilihan),
		),
		array(
		'label'=>'Fakultas',
		'value'=>Fakultas::model()->getFakultas($model->id_fakultas),
		),
		 array(
            'label'=>'Status',
            'value'=>($model->status=="1")?("Belum Memilih"):("Sudah Memilih"),
			 ),
		'id_tps',
	),
)); ?>
