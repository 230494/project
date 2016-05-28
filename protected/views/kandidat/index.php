<?php
/* @var $this KandidatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kandidats',
);

$this->menu=array(
	array('label'=>' <i class="icon icon-pencil"></i> Create Kandidat', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-th-list"></i>  Manage Kandidat', 'url'=>array('admin')),
);
?>

<h1>Kandidat</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
