<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */

$this->breadcrumbs=array(
	'Pemilihans'=>array('index'),
	$model->id_pemilihan=>array('view','id'=>$model->id_pemilihan),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pemilihan', 'url'=>array('index')),
	array('label'=>'Create Pemilihan', 'url'=>array('create')),
	array('label'=>'View Pemilihan', 'url'=>array('view', 'id'=>$model->id_pemilihan)),
	array('label'=>'Manage Pemilihan', 'url'=>array('admin')),
);
?>

<h1>Update Pemilihan : <?php echo $model->nama_pemilihan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>