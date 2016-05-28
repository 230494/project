<?php
/* @var $this KandidatController */
/* @var $model Kandidat */

$this->breadcrumbs=array(
	'Kandidat'=>array('index'),
	$model->id_kandidat,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Kandidat', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create Kandidat', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-edit"></i> Update Kandidat', 'url'=>array('update', 'id'=>$model->id_kandidat)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Kandidat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_kandidat),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage Kandidat', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('create')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('create'); ?>
</div>
<?php endif;?>
<?php if(Yii::app()->user->hasFlash('update')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('update'); ?>
</div>
<?php endif;?>
<h1>View No Urut Kandidat : <?php echo $model->no_urut; ?></h1>
<table>
	<tr>
		<td width="20%">
			<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$model->foto.'','',array('width'=>150,'height'=>100,));
			?>
		</td>
		<td>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nama_kandidat',
		'hasil',
		'saksi',
		array(
		'label'=>'Pemilihan',
		'value'=>$data["nama_pemilihan"],
		),
	),
)); ?>
</td>
</tr>
</table>