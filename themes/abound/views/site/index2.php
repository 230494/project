<?php 
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/assets/jquery-1.8.3.min.js');
$cs->registerScriptFile($baseUrl.'/assets/bootstrap.js');?>
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
				<?php echo "Bilik No. ".Yii::app()->session['bilik_ke2']; ?>
          	</div>
          
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->

	
<?php

$now = date('Y-m-d H:i:s', time());
?>
<div style="text-align:center">

	<?php 
	if(/*$now<Yii::app()->session['start_time'] || $now>Yii::app()->session['end_time']*/false) {	
	
	echo "<div class='alert alert-error'>";
	echo "<button class='close' type='button' data-dismiss='alert'>&times;</button>";
	echo "<h4>Saat ini sistem tidak dapat melakukan verifikasi. Karena berada di luar waktu penggunaan sistem</h4>";
	echo "</div>";
	
	} else if(/*$now>Yii::app()->session['start_time']&& $now<Yii::app()->session['end_time']*/true) {
    // This is system.
	require_once ('../evotingipb/tracking.php');
	?>
	 <META HTTP-EQUIV = 'Refresh' Content = '10; URL =<?php echo Yii::app()->request->baseUrl.'/site/extend_time2'; ?>'>
	<center style="">
	<h3> Surat Suara Elektronik <?php echo $model["nama_pemilihan"];?></h3>
		<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/pemilihan/'.$model["logo"],'',array('width'=>100,'height'=>100,));
			?>
	<h3><?php echo date('Y');?></h3>
	
	<table class="table">
		<tr>
			<?php 
			$data=Kandidat::model()->findAll();
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
			foreach($data as $r=>$row) {?>
				<td style="padding:0px;text-align:center">
					<a  href="<?php echo Yii::app()->request->baseUrl.'/site/confirm2/'.$row["id_kandidat"];?>">
						<?php
							echo CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$row["foto"].'','',array('width'=>175,'height'=>175,));
						?>
					</a>
				</td>
				<?php }
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
	</center>
<?php
}
else {
    echo "<div class='alert alert-error'>";
	echo "<button class='close' type='button' data-dismiss='alert'>&times;</button>";
	echo "<h4>Sistem dalam Gangguan</h4>";
	echo "</div>";
	}
	
?>
</div>



<div class="row-fluid">
	
  
</div><!--/row-->

          


<script>
            $(function() {
			$(".edit").click(function(){
            var key=$("#idedit").attr("key");
        /*    $.ajax({
                url:'<?php echo $this->createUrl('site/Confirm') ?>',
				data:'key='+key,
                type:'POST',
                success:function(data){
                     $("#tampil").html(data);
                }
            });*/
			 $("#idhapus").val(key);  
			 $("#myModal").modal("show");  
        });
			
		         $(".knob").knob({
                    change : function (value) {
                        //console.log("change : " + value);
                    },
                    release : function (value) {
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : " + this.value);
                    },
                    draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.3)
                                && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.3)
                                    && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });

                // Example of infinite knob, iPod click wheel
                var v, up=0,down=0,i=0
                    ,$idir = $("div.idir")
                    ,$ival = $("div.ival")
                    ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
                    ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
                $("input.infinite").knob(
                                    {
                                    min : 0
                                    , max : 20
                                    , stopper : false
                                    , change : function () {
                                                    if(v > this.cv){
                                                        if(up){
                                                            decr();
                                                            up=0;
                                                        }else{up=1;down=0;}
                                                    } else {
                                                        if(v < this.cv){
                                                            if(down){
                                                                incr();
                                                                down=0;
                                                            }else{down=1;up=0;}
                                                        }
                                                    }
                                                    v = this.cv;
                                                }
                                    });
            });
        </script>