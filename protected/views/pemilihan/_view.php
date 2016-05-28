<?php
/* @var $this PemilihanController */
/* @var $data Pemilihan */
?>

<div class="view">

	<table>
	<tr>
		<td class="col-md-8">
				<?php
					echo CHtml::image(Yii::app()->request->baseUrl.'/images/pemilihan/'.$data->logo.'','',array('width'=>100,'height'=>100));
				?>
		</td>
	<td  class="col-md-4">
	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_pemilihan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nama_pemilihan), array('view', 'id'=>$data->id_pemilihan)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_bilik')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_bilik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

		<?php 
		if($data->status=="1"){
		$mode="Aktif"; $a="disabled";
		}else{
		$mode ="Aktifkan";$a="";
		}
		
		echo CHtml::link(CHtml::encode($mode), array('pemilihan/mode', 'id'=>$data->id_pemilihan), array('class'=>'btn btn-success btn-xs  '.$a.'')); ?>
	
	</td>
	
	</tr>
	</table>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	*/ ?>

</div>