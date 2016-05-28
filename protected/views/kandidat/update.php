<?php
/* @var $this KandidatController */
/* @var $model Kandidat */

$this->breadcrumbs=array(
	'Kandidats'=>array('index'),
	$model->id_kandidat=>array('view','id'=>$model->id_kandidat),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kandidat', 'url'=>array('index')),
	array('label'=>'Create Kandidat', 'url'=>array('create')),
	array('label'=>'View Kandidat', 'url'=>array('view', 'id'=>$model->id_kandidat)),
	array('label'=>'Manage Kandidat', 'url'=>array('admin')),
);
?>

<h1>Update Kandidat  No Urut <?php echo $model->no_urut; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'data'=>$data)); ?>