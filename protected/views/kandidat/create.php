<?php
/* @var $this KandidatController */
/* @var $model Kandidat */

$this->breadcrumbs=array(
	'Kandidats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kandidat', 'url'=>array('index')),
	array('label'=>'Manage Kandidat', 'url'=>array('admin')),
);
?>

<h1>Create Kandidat</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'data'=>$data)); ?>