<?php
/* @var $this PemilihController */
/* @var $model Pemilih */
$user =new EWebUser;
$this->breadcrumbs=array(
	'Pemilih'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Pemilih', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create Pemilih', 'url'=>array('create'),'visible'=>$user->getLevel()==1),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pemilih-grid').yiiGridView('update', {
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

<?php if(Yii::app()->user->hasFlash('sukses')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('sukses'); ?>
</div>

<?php endif;?>
<h1>Manage Pemilih</h1>

<p>

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

	<?php 
	if($user->getLevel()==1){
	$form=$this->beginWidget('CActiveForm', array(
        'id'=>'import-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=> array('enctype'=>'multipart/form-data'),
    )); ?>

    <div class="row">
            <?php echo $form->labelEx($model2,'file_excel'); ?>
            <?php echo $form->Filefield($model2,'file_excel'); ?>
            <?php echo $form->error($model2,'file_excel'); ?>
    </div>
	    <div class="row button">
<?php echo CHtml::submitButton('Import',array('class'=>'btn btn-primary')); ?>
    <div >
</div>
<?php $this->endWidget(); 
}?>

</p>


<a href="#" class="btn btn-primary" id="search-button"><span class="icon icon-search" ></span> Advanced Search</a>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pemilih-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('style'=>'text-align:center;font-size:12pt'),
	'columns'=>array(
	 array(
		 'value'=>'CHtml::checkBox("daftarku[]",false,array("value"=>$data->id_pemilih))',
	    'type'=>'raw','visible'=>$user->getLevel()==1
        ),
		 array(
		 'header' => 'No',
		 'value' => '$row+1',
			 ),
		'nim',
		'nama_pemilih',
	/*array(
            'name'=>'id_fakultas',
            'header'=>'Fakultas',
            'filter'=>Chtml::listData(Fakultas::model()->findAll(),'id_fakultas','fakultas'),
            'value'=>'Fakultas::model()->getFakultas($data->id_fakultas)',
			 ),*/
		 array(
            'name'=>'status',
            'header'=>'status',
            'filter'=>array('1'=>'Belum Memilih','3'=>'Sudah Memilih'),
            'value'=>'($data->status=="1")?("Belum Memilih"):("Sudah Memilih")',
			 ),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}{view}'
		),
	),
)); ?>

<?php if($user->getLevel()==1){?>
<input type="button" value="Delete All" onClick=cetak() class="btn btn-primary">
<a href="<?php echo Yii::app()->request->baseUrl.'/pemilih/export'; ?>" class="btn btn-primary">Export Excel</a>
<?php }?>
</form>
</div>
