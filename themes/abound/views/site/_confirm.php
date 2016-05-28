<div style="text-align:center">
	<div class='alert alert-info'>
	
	<h2>Anda Yakin Memilih Kandidat Ini</h2>
	</div>

		<a href="" >
		<div class="">
			<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$data['foto'].'','',array('width'=>100,'height'=>100,));
			?>
			</div>
		</a>
		
    	
	<br /><br />
	<a class="btn btn-primary btn-circle btn-xl" href="<?php echo Yii::app()->request->baseUrl.'/site/count/'.$data['id_kandidat'].''; ?>"><h3>Pilih</h3></a>	<a class="btn btn-danger btn-circle btn-xl" href="<?php echo Yii::app()->request->baseUrl.'/site/index'; ?>"><h3>Tidak</h3></a>
</div>