
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>E-Voting IPB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free yii themes, free web application theme">
    <meta name="author" content="Webapplicationthemes.com">
	<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
	  
	?>
	
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">
	<?php  
	
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
	
	//   $cs->registerCssFile($baseUrl.'/css/bootstrap_2.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	
	  ?>
      <!-- styles for style switcher -->
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-red.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl;?>/css/style-brown.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl;?>/css/style-green.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl;?>/css/style-grey.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl;?>/css/style-orange.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl;?>/css/style-purple.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl;?>/css/style-red.css" />
	
	  <?php
	  $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/charts.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	 $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	 $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
		
	 
	?>
	
  </head>
  <?php $model=Pemilihan::model()->getCurrentPemilihan(); 
  if(! empty($model)){
	   $time=$model['end_time']; 
	   $timeEnd=explode(" ",$time);
	   $tanggal=explode("-", $timeEnd[0]);
	   $tanggal1=explode("-", $tanggal[0]);
	   $tanggal2=explode("-", $tanggal[1]);
	   $tanggal3=explode("-", $tanggal[2]);
	   switch($tanggal2[0]){
		   case "01": $tanggal2="January";break;
			case "02":$tanggal2="February";break;
			case "03": $tanggal2="March";break;
			case "04": $tanggal2="April";break;
			case "05": $tanggal2="May";break;
			case "06": $tanggal2="June";break;
			case "07": $tanggal2="July";break;
			case "08": $tanggal2="August";break;
			case "09": $tanggal2="September";break;
			case "10": $tanggal2="October";break;
			case "11": $tanggal2="November";break;
			case "12": $tanggal2="Desember";break;
			//case "12": return "Januari";break;	   t
	   }
	   $time=explode(":", $timeEnd[1]);
	    $timeBaru=explode(":", $timeEnd[1]);
	 }
	   ?>

<body>

<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php')?>
</section><!-- /#navigation-main -->
    
<section class="main-body">
    <div class="container-fluid">
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>
</section>

<!-- Require the footer -->
<?php require_once('tpl_footer.php')?>

  </body>
</html>