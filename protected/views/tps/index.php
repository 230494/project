<?php
/* @var $this TpsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'TPS',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-pencil"></i> Create TPS', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage TPS', 'url'=>array('admin')),
);
?>

<h1>Tempat Pemungutan Suara</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
