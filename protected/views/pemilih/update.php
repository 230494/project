<?php
/* @var $this PemilihController */
/* @var $model Pemilih */

$this->breadcrumbs=array(
	'Pemilihs'=>array('index'),
	$model->nim=>array('view','id'=>$model->nim),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Pemilih', 'url'=>array('create')),
	array('label'=>'View Pemilih', 'url'=>array('view', 'id'=>$model->id_pemilih)),
	array('label'=>'Manage Pemilih', 'url'=>array('index')),
);
?>

<h1>Update Pemilih <?php echo $model->nim; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>