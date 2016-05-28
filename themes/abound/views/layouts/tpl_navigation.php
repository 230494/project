
 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/assets/jquery.syotimer.js';?>"></script>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
       <a class="brand" href="#">
	      	<?php
			$data="icon.png";
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$data.'','',array('width'=>15,'height'=>15,));
			?>
	   Pemungutan Suara Elektronik IPB<small></small></a>
          
          <div class="nav-collapse">
			<?php 
		// echo 	'<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/assets/jquery.1.7.2.js';</script>';
			$user =new EWebUser;
			
			$this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array(($user->getLevel()==2) ? ('/tpsadmin/index') : ('/pusat/index') ),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Verifikasi', 'url'=>array('/verifikasi/index'), 'visible'=>$user->getLevel()==2),
						  array('label'=>'TPS', 'url'=>array('/tps/index'), 'visible'=>$user->getLevel()==1),
                        array('label'=>'Pemilih', 'url'=>array('/pemilih/index'), 'visible'=>!Yii::app()->user->isGuest),
						 //array('label'=>'TPS', 'url'=>array('/tps/index'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Hasil Suara', 'url'=>array('/hasil/index'), 'visible'=>$user->getLevel()==1),
						array('label'=>'Log Aktifitas', 'url'=>array('/pusat/log'), 'visible'=>$user->getLevel()==1),
						  /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
                        //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); 
			
				?>
    	</div>
    </div>
	</div>
</div>

  <script type="text/javascript">
        $(document).ready(function(){
		<?php if(isset (Yii::app()->session['nama_pemilihan'])){?>
            $('#simple_timer').syotimer({
                year: <?php echo $tanggal[0];?>,
                month: <?php echo $tanggal[1];?>,
                day: <?php echo $tanggal[2];?>,
                hour: <?php echo $timeBaru[0];?>,
                minute: <?php echo $timeBaru[1];?>,
				second:<?php echo $timeBaru[2];?>
            });       
			<?php }else{?>
			  $('#simple_timer').html('<b style="color:red">Pemilihan Tidak Diaktifkan</b>');
			<?php }?>
        });
    </script>
   
<div class="subnav navbar navbar-fixed-top"  >
    <div class="navbar-inner">
    	<div class="container" >

        	<div class="style-switcher pull-center"   style="text-align:center;font-size:15pt;text-decoration:blink;color:red" id="simple_timer">
				
          	</div>
			
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->

