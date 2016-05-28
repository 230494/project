<?php
/* @var $this KandidatController */
/* @var $data Kandidat */
?>

<div class="view nav-piils nav-stacked">
	
	<table>
	<tr>
		<td width="40%">
				<?php
					echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$data->foto,'',array('width'=>100,'height'=>100));
				?>
		</td>
		<td >
		<b><?php echo CHtml::encode($data->getAttributeLabel('no_urut')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->no_urut), array('view', 'id'=>$data->id_kandidat)); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kandidat')); ?>:</b>
		<?php echo CHtml::encode($data->nama_kandidat); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('hasil')); ?>:</b>
		<?php echo CHtml::encode($data->hasil); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('saksi')); ?>:</b>
		<?php echo CHtml::encode($data->saksi); ?>
		<br />
		</td>
	</tr>
	</table>

</div>