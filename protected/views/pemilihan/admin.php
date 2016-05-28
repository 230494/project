<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */

$this->breadcrumbs=array(
	'Pemilihans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Pemilihan', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create Pemilihan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pemilihan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('deleteall', '
$(".deleteall-button").click(function(){
        
        var checked = $("#casecategory-grid").yiiGridView("getChecked","casecategory-grid");
		var count=checked.length;
        if (count>0 && confirm("Do you want to delete these "+count+"item(s)"))
        {
                 $.ajax({
                        data:{checked:checked},
                        url:" '.CHtml::normalizeUrl(array("deleteall")).' ",
                        success:function(data){$("#casecategory-grid").yiiGridView("update",{});},              
                });
        }
     
});

');


?>
<?php if(Yii::app()->user->hasFlash('delete')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('delete'); ?>
</div>
<?php endif;?>

<h1>Manage Pemilihan</h1>

<a href="#"  id="search-button" class="btn btn-primary"><i class="icon icon-search"></i> Advanced Search</a>

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
	'id'=>'casecategory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
		'htmlOptions'=>array('style'=>'font-size:12pt;text-align:center'),
	'columns'=>array(
		 array(
		  //'id'=>'id_pemilihan',
     //  'class'=>'CCheckBoxColumn',
       // 'selectableRows' => '500',   
		//'value'  => '$data->id_pemilihan',
		'htmlOptions'=>array('style'=>'text-align:center'),
		 'value'=>'CHtml::checkBox("daftarku[]",false,array("value"=>$data->id_pemilihan))',
	    'type'=>'raw',
        ),
		 array(
		 'header' => 'No',
		 'value' => '$row+1',
		 'htmlOptions'=>array('style'=>'text-align:center'),
		 ),
		'nama_pemilihan',
		'jumlah_bilik',
		 array(
            'name'=>'status',
            'header'=>'status',
            'filter'=>array('1'=>'Aktif','0'=>'Tidak'),
            'value'=>'($data->status=="1")?("Aktif"):("Tidak")',
			 'htmlOptions'=>array('style'=>'text-align:center'),
        ),
		'start_time',
		'end_time',
	 	array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>

<input type="button" value="Delete All" onClick=cetak() class="btn btn-primary">
</form>
</div>