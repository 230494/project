<?php
/* @var $this PemilihController */
/* @var $model Pemilih */

$this->breadcrumbs=array(
	'Pemilih'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pemilih', 'url'=>array('index')),
	array('label'=>'Manage Pemilih', 'url'=>array('admin')),
);
?>

<h1>Create Pemilih</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>