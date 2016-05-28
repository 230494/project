<?php
/* @var $this TpsController */
/* @var $model Tps */

$this->breadcrumbs=array(
	'TPS'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List TPS', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create TPS', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tps-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php if(Yii::app()->user->hasFlash('delete')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('delete'); ?>
</div>
<?php endif;?>
<h1>Manage TPS</h1>


<a href="#" class="search-button btn btn-primary" id="search-button"><span class="icon icon-search" ></span> Advanced Search</a>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="wide form">
<script>
function cetak()
{
	if(confirm("Are you sure you want to delete this item? ")){
    document.dataku.action="cetak";
    document.dataku.submit();
	}
}
</script>
<form method="POST" name="dataku">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tps-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('style'=>'text-align:center;font-size:12pt'),
	'columns'=>array(
		 array(
		 'value'=>'CHtml::checkBox("daftarku[]",false,array("value"=>$data->id_tps))',
	    'type'=>'raw',
        ),
		 array(
		 'header' => 'No',
		 'value' => '$row+1',
			 ),
		'nama_tps',
		'alamat_tps',
		'kprw',
		'pprw',
		'p3w',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<input type="button" value="Delete All" onClick=cetak() class="btn btn-primary">
</form>
</div>