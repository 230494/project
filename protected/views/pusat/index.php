<?php
/* @var $this PusatController */

$this->breadcrumbs=array(
	'Pusat',
);
?>
<h3>Komisi Pemilihan Raya dan Panitia Pemilihan Raya | Administrator</h3>
<br />
<center>
<table>
	<tr>
		<td style="padding:20px">
			<a href="<?php echo Yii::app()->request->baseUrl.'/pemilihan'; ?>">
			 
							<div class="panel panel-primary">
									<div class="panel-body" align="center">
									<?php
					
						echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/pemilihan.png','',array('width'=>120,'height'=>120,));
					?></div>
								<div class="panel-heading" align="center">
									Pemilihan
								</div>
							</div>
		   
			 </a>
		</td>
	 <td style="padding:20px">
	 <a onClick="cekPemilihan('kandidat')"  type="submit"  href="#">
	
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/kandidat.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                            Kandidat
                        </div>
                    </div>
     </a>
	 </td>
	 <td style="padding:20px">
	 <a onClick="cekPemilihan('pemilih')" href="#">
	
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/pemilih.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                            Pemilih
                        </div>
                    </div>
    
	 </a>
	 </td>
	 
	 <td style="padding:20px">
	 <a onClick="cekPemilihan('monitor')" href="#" >
	
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/monitor.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                            Peta TPS
                        </div>
                    </div>
    
	 </a>
	 </td>
	
	 <td style="padding:20px">
	   <a onClick="cekPemilihan('tps')" href="#">
	 
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/berita.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                          TPS
                        </div>
                    </div>
	 </a>
	 </td>
	 <td style="padding:20px">
	  <a onClick="cekPemilihan('hasil')" href="#" >
	 
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/hasil.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                          Hasil Suara
                        </div>
                    </div>
   
	 </a>
	 </td>
	 </tr>
	 </table>	 
</center>

<script>
function cekPemilihan(controller){
	if('<?php echo Yii::app()->session['nama_pemilihan'];?>'){
		document.location = '<?php echo Yii::app()->request->baseUrl; ?>'+'/'+controller;
		return true;
	}else{
		alert('Anda Belum Mengaktifkan Pemilihan, Silahkan Aktifkan Pemilihan');
		return false;
	}

}
</script>
