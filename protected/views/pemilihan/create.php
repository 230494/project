<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */

$this->breadcrumbs=array(
	'Pemilihans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pemilihan', 'url'=>array('index')),
	array('label'=>'Manage Pemilihan', 'url'=>array('admin')),
);
?>

<h1>Create Pemilihan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>