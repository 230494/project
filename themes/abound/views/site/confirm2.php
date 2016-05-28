<?php
/* @var $this SiteController */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
require_once ('../evotingipb/tracking.php');
?>
<META HTTP-EQUIV = 'Refresh' Content = '5; URL =<?php echo Yii::app()->request->baseUrl.'/site/index2'; ?>'>
<div class="subnav navbar navbar-fixed-top"  >
    <div class="navbar-inner">
    	<div class="container" >
       
        	<div class="style-switcher pull-center"   style="text-align:center;font-size:17pt">
				<?php echo "Bilik No. ".Yii::app()->session['bilik_ke2']; ?>
          	</div>
          
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->
<?php
$gridDataProvider = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
    array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
	array('id'=>4, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>5, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));
?>


<div style="text-align:center">
	
		<?php 		
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pemilihan/'.$model['logo'],'',array('width'=>100,'height'=>100,));
			?>
	<br /><br />
	<?php if(! isset(Yii::app()->session['id_pemilih2'])): ?>
	<div class='alert alert-danger'>
	
	<h4><strong>PemilihTidak Terautentikasi</strong></h4>
	</div>
<?php endif;?>

	<?php

	if(isset(Yii::app()->session['id_pemilih2'])): ?>
	<div class='alert alert-info'>
	
	<h4>Yakin Memilih Kandidat No Urut <?php echo $dat['no_urut']; ?> ?</h4>
	</div>

		<a href="" >
		<div class="">
			<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$dat['foto'].'','',array('width'=>200,'height'=>200,));
			?>
			</div>
		</a>
		
    	<h4><?php echo $dat["nama_kandidat"]; ?></h4>
	<br />
	<a class="btn btn-primary btn-circle btn-xl" href="<?php  echo Yii::app()->request->baseUrl.'/site/count2/'.$dat['id_kandidat']; ?>"><h3>Pilih</h3></a>	
	<a class="btn btn-danger btn-circle btn-xl" href="<?php echo Yii::app()->request->baseUrl.'/site/index2'; ?>"><h3>Tidak</h3></a>
<?php endif; ?>
	</div>