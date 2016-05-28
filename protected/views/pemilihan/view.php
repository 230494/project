<?php
/* @var $this PemilihanController */
/* @var $model Pemilihan */

$this->breadcrumbs=array(
	'Pemilihans'=>array('index'),
	$model->id_pemilihan,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list"></i> List Pemilihan', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-pencil"></i> Create Pemilihan', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-edit"></i> Update Pemilihan', 'url'=>array('update', 'id'=>$model->id_pemilihan)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Pemilihan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pemilihan),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon icon-th-list"></i> Manage Pemilihan', 'url'=>array('admin')),
);
?>
<?php $baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/assets/jquery-1.8.3.min.js');?>
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

<?php if(Yii::app()->user->hasFlash('tambah_waktu_sukses')): ?>
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('tambah_waktu_sukses'); ?>
</div>
<?php endif;?>
 
 <?php if(Yii::app()->user->hasFlash('tambah_waktu_sukses')): ?>
<div class="alert alert-danger">
 <?php echo Yii::app()->user->getFlash('tambah_waktu_gagal'); ?>
</div>
<?php endif;?>
<h1>View Pemilihan : <?php echo $model->nama_pemilihan; ?></h1>
<table>
	<tr>
		<td width="20%">
			<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pemilihan/'.$model->logo,'',array('width'=>150,'height'=>100,));
			?>
		</td>
		<td>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	//'htmlOptions'=>array('style'=>'font-size:10pt'),
	'attributes'=>array(
		'nama_pemilihan',
		'jumlah_bilik',
		array(
		'label'=>'Jumlah DPT',
		'value'=>Pemilih::model()->countByPemilihan($model->id_pemilihan),
		),
		array(
		'label'=>'Jumlah TPS',
		'value'=>Pemilihan::model()->getJumlahTps($model->id_pemilihan),
		),
		'start_time',
		'end_time',
		
	),
)); ?>
</td>
</tr>
</table>
<button class="btn btn-success" id="addTime">Additional Time</button><br /><br />
<form class="form-group has-success" id="form" style="display:none" name="cekForm" onSubmit="return cekNumeric();" action="<?php echo Yii::app()->request->baseUrl.'/pemilihan/tambahwaktu'; ?>" method="POST">
	<input type="text" name="jam" placeholder="jam" style="width:50px;"/> - <input type="text" name="menit"  placeholder="menit" style="width:50px;" /><br /> 
	<input class="btn btn-primary"  id="tambah" value="Tambah" type="submit"/>
</form>


<script>
$( "#addTime" ).click(function() {
	 $( "#form" ).toggle( );
});
function cekNumeric(){
	var jam = document.forms["cekForm"]["jam"].value;
	var menit = document.forms["cekForm"]["menit"].value;
	
   if ( (!/^[0-9]+$/.test(jam) ) || (!/^[0-9]+$/.test(menit))){
      alert("field harus memiliki karakter numerik");
      cekForm.jam.focus();
      return false;
   }else{
  /* $.ajax({
		  url:'<?php echo Yii::app()->request->baseUrl.'/pemilihan/tambahwaktu'; ?>',
		  data:'jam='+jam+'&menit='+menit,
			type:'POST',
			success:function(data){
				document.location = '<?php echo Yii::app()->request->baseUrl; ?>'+'/pemilihan/index' ;
			},
		});
	return true;*/
	 return true;
   }
}
</script>