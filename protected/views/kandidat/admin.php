<?php
/* @var $this KandidatController */
/* @var $model Kandidat */

$this->breadcrumbs=array(
	'Kandidats'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Kandidat', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create Kandidat', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kandidat-grid').yiiGridView('update', {
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

<h1>Manage Kandidat</h1>



<a href="#" class="btn btn-primary" id="search-button"><span class="icon icon-search" ></span> Advanced Search</a>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
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
	'id'=>'kandidat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('style'=>'font-size:12pt;text-align:center'),
	'columns'=>array(
		 array(
		'htmlOptions'=>array('style'=>'text-align:center'),
		 'value'=>'CHtml::checkBox("daftarku[]",false,array("value"=>$data->id_kandidat))',
	    'type'=>'raw',
        ),
		 array(
		 'header' => 'No',
		 'value' => '$row+1',
		 'htmlOptions'=>array('style'=>'text-align:center'),
		 ),
		 'no_urut',
		'nama_kandidat',
		'hasil',
		'saksi',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<input type="button" value="Delete All" onClick=cetak() class="btn btn-primary">
</form>