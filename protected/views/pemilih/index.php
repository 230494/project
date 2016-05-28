<?php
/* @var $this PemilihController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pemilih',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-pencil"></i> Create Pemilih', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage Pemilih', 'url'=>array('admin')),
);
?>

<h1>Pemilih</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
