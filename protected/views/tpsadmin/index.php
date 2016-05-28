<?php
/* @var $this TpsadminController */

$this->breadcrumbs=array(
	'Tpsadmin'
);
$now=date('Y-m-d H:i:s',time());
?>
<h3>Panitia <?php echo Yii::app()->session["nama_pemilihan"]. " - Wilayah " .Yii::app()->session['nama_tps']." | Administrator";?> </h3>

<center>

<?php if(Yii::app()->user->hasFlash('berhasil_kirim')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('berhasil_kirim'); ?>
</div>
<?php endif;?>

<?php if(Yii::app()->user->hasFlash('gagal_kirim')): ?>
 
<div class="alert alert-success">
 <?php echo Yii::app()->user->getFlash('gagal_kirim'); ?>
</div>
<?php endif;?>

<table>
	<tr>
		<td style="padding:20px">
 <a onClick="cekPemilihan('verifikasi')" href="#"  >
	
                    <div class="panel panel-primary">
					        <div class="panel-body" align="center">
                            <?php
			
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/menu/verf.png','',array('width'=>120,'height'=>120,));
			?></div>
                        <div class="panel-heading" align="center">
                          Verifikasi Pemilih
                        </div>
                    </div>
    
	 </a>
	 </td>
<td style="padding:20px">
	  <a onClick="cekPemilihan('pemilih')" href="#"  >
	 
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
	 </tr>
</table>

<a href="#" class='btn btn-primary btn-large' onClick="cekKirimSuara('kirimsuratsuara')">Kirim Surat Suara</a>
</center>
<script>
function cekPemilihan(controller){
	if('<?php echo Yii::app()->session['nama_pemilihan'];?>'){
		document.location = '<?php echo Yii::app()->request->baseUrl; ?>'+'/'+controller;
		return true;
	}else{
		alert('Admin PPR  Belum Mengaktifkan Pemilihan');
		window.close();
		return false;
	}

}

function cekKirimSuara(kirimsuratsuara){
	if('<?php  $now<Yii::app()->session['start_time'] || $now>Yii::app()->session['end_time']; ?>'  ){
		document.location = '<?php echo Yii::app()->request->baseUrl; ?>'+'/tpsadmin/'+kirimsuratsuara;
		return true;
	}else{
		alert('Tidak Dapat Mengirim Surat Suara, Pemilihan Masih Berlangsung');
		window.close();
		return false;
	}

}
</script>


