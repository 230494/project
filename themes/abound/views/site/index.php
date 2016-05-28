<?php 
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile($baseUrl.'/assets/jquery-1.8.3.min.js');
$cs->registerScriptFile($baseUrl.'/assets/bootstrap.js');

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<?php
$gridDataProvider = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
    array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
	array('id'=>4, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript','usage'=>'<span class="inlinebar">1,3,16,5,12,5</span>'),
    array('id'=>5, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));
?>

<div class="subnav navbar navbar-fixed-top"  >
    <div class="navbar-inner">
    	<div class="container" >
       
        	<div class="style-switcher pull-center"   style="text-align:center;font-size:17pt">
				<?php echo "Bilik No. ".Yii::app()->session['bilik_ke']; ?>
          	</div>
          
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->
		 
<?php

$now = date('Y-m-d H:i:s', time());

?>
<div style="text-align:center">

	<?php 
	if(isset(Yii::app()->session['nama_pemilihan'])){
	
	if(/*$now<Yii::app()->session['start_time'] || $now>Yii::app()->session['end_time']*/false) {	
	echo " <META HTTP-EQUIV = 'Refresh' Content = '5'>";
	 
	echo "<div class='alert alert-danger'>";
	echo "<h4>Saat Ini Sistem Tidak Dapat Melakukan Pemilihan. Karena Berada Di Luar Waktu Penggunaan Sistem</h4>";
	echo "</div>";
	
	} else if(/*$now>Yii::app()->session['start_time']&& $now<Yii::app()->session['end_time']*/true) {
    // This is system.
	require_once ('../evotingipb/tracking.php');
	
	?>
	 <META HTTP-EQUIV = 'Refresh' Content = '10; URL =<?php echo Yii::app()->request->baseUrl.'/site/extend_time'; ?>'>
	<center style="">
	<h4> Surat Suara Elektronik <?php 
	
	echo Yii::app()->session['nama_pemilihan']; ?></h4>
		<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pemilihan/'.$model["logo"],'',array('width'=>100,'height'=>100,));
			?>
	<h3><?php 
	$data=Kandidat::model()->getAllKandidat();
	
	echo date('Y');
	
	?></h3>
	<?php  if(! empty($data)){?>
	<table class="table">
		<tr>
			<?php 
			foreach($data as $r=>$row) {?>
				<td style="padding:0px;text-align:center">
						<?php
							echo "<h3>No Urut ".$row["no_urut"]."</h3>";
						?>
				</td>
				<?php }
				?>
		</tr>
		<tr>
			<?php 
			
			foreach($data as $r=>$row) {
			?>
				<td style="padding:0px;text-align:center">
					<a  href="<?php echo Yii::app()->request->baseUrl.'/site/confirm/'.$row['id_kandidat']; ?>"  >
						<?php
						
							echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$row["foto"].'','',array('width'=>175,'height'=>175,));
						?>
					</a>
				</td>
				<?php
				
				}
				?>
		</tr>
		<tr>
			<?php 
			foreach($data as $r=>$row) {?>
				<td style="padding:0px;text-align:center">
						<?php
							echo "<h4>".$row["nama_kandidat"]."</h4>";;
						?>
				</td>
				<?php }
				?>
		</tr>
	</table>
	<input type="hidden" id="nilaiSementara" value=""/>
	<?php }else{
	 echo "<div class='alert alert-error'>";
	echo "<h4>Kandidat Belum Terdaftar</h4>";
	echo "</div>";
	
	}?>
	</center>
<?php
}
else {
    echo "<div class='alert alert-error'>";
	echo "<h4>Sistem dalam Gangguan</h4>";
	echo "</div>";
	}
	
	}else{
	echo " <META HTTP-EQUIV = 'Refresh' Content = '5'>";
	 echo "<div class='alert alert-error'>";
	echo "<h4>Pemilihan Belum Diaktifkan</h4>";
	echo "</div>";
	
	}
	//echo Yii::app()->session['id_pemilihan'];
?>
</div>

<div class="row-fluid">
	
  
</div><!--/row-->
