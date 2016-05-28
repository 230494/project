<?php
/* @var $this MonitorController */

$this->breadcrumbs=array(
	'Monitor',
);

	 

?>
<style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: auto;     
     border: 1px solid black;
     white-space: nowrap;
  }
</style>
<h1><?php echo "Peta Tempat Pemungutan Suara"; ?></h1>
<?php
Yii::import('ext.EGMap.*');

$gMap = new EGMap();
$gMap->setJsName('map');
	 $gMap->zoom = 17;
	 $gMap->width = '100%';
	 $gMap->height = 500;
	$mapTypeControlOptions = array(
        'position'=> EGMapControlPosition::LEFT_BOTTOM,
        'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);
//$gMap->option('mapTypeControlOptions',$mapTypeControlOptions);

// set center
$gMap->setCenter(-6.5583565,106.7256512);

// Create GMapInfoWindows

foreach ($tps as $rr) {
	$hasilKandidat=Kandidat::model()->getHasilKandidatByMonitor($rr['id_tps']);
	$content="";
foreach($hasilKandidat as $ss){ 
	$content=$content.'<tr><td>'.CHtml::image(Yii::app()->request->baseUrl.'/images/kandidat/'.$ss['foto'],'',array('width'=>20,'height'=>20,)).' </td><td>'.$ss['nama_kandidat'].'</td><td> : '.$ss['hasil_suara'].'</td></tr>';
} 
$table='<div>
<table>
'.$content.'
<tr><td>'.CHtml::image(Yii::app()->request->baseUrl.'/images/menu/pemilih.png','',array('width'=>20,'height'=>20,)).'</td><td>Pemilih</td><td>: '.Pemilih::model()->getPemilihTPS($rr['id_tps']).'</td></tr>
<tr><td>'.CHtml::image(Yii::app()->request->baseUrl.'/images/menu/pemilih.png','',array('width'=>20,'height'=>20,)).'</td><td>Abstain</td><td>: '.Pemilih::model()->getPemilihTPS($rr['id_tps']).'</td></tr>
</table>
</div>';
$info_window_a = new EGMapInfoWindow($table);
//$info_window_b = new EGMapInfoWindow($rr['nama_tps']);
        
// Create custom icon   
$noUrut=Kandidat::model()->getHasilKandidatByMax($rr['id_tps']);
if($noUrut==1){
	$marker="1.png";
}elseif($noUrut==2){
	$marker="2.png";
}elseif($noUrut==3){
	$marker="3.png";
}else{
	$marker="4.png";
}
$icon = new EGMapMarkerImage(Yii::app()->request->baseUrl.'/images/'.$marker);
$icon->setAnchor(22, 63);
$icon->setOrigin(0, 0);
        
// Create marker

$marker = new EGMapMarkerWithLabel($rr['longitude'],$rr['latitude'], array('title' => 'Marker With Custom Image','icon'=>$icon));
// Set its infoWindow (INFO_WINDOW is shared -please check 
// addHtmlInfoWindow params for more info)
$marker->addHtmlInfoWindow($info_window_a);
$gMap->addMarker($marker);
        
// Now Create marker with label
//$marker = new EGMapMarkerWithLabel($rr['longitude'], $rr['latitude'], array('title' => $rr['nama_tps']));

// Options for the style of the label
// Please see plugin reference for more details
// (included link on source code)
$options = array(
 'backgroundColor'=>'yellow',
 'opacity'=>'0.75',
 //'width'=>'100px'
);
// Setting marker label options
$marker_options = array(
  'labelContent'=> $rr['nama_tps'],
  'labelStyle'=>$options,
  'draggable'=>false,
  'labelClass'=>'labels',
  'labelAnchor'=>new EGMapPoint(22,0),
  'raiseOnDrag'=>false
);

$marker->setOptions($marker_options);

// We can also set its options this way
//$marker->setOption('labelContent', '$425K');
// Once set, options are CJavaScript::encoded internally
//$marker->setOption('labelStyle',$options);
//$marker->setOption('draggable',true);
//$marker->setOption('labelClass','labels');
//$marker->setOption('raiseOnDrag',true);
//$marker->setLabelAnchor(new EGMapPoint(22,0));

// attach second info window    
//$marker->addHtmlInfoWindow($info_window_b);
        
$gMap->addMarker($marker);
}
$gMap->renderMap();
/*
FMIPA -> -6.557938, 106.731261
FAPERTA-> -6.558972, 106.729963

*/


?>
<h6>Legenda:</h6>
<table><tr>
<?php foreach ($data as $rr):
if($rr['no_urut']==1){
	$marker="1.png";
}elseif($rr['no_urut']==2){
	$marker="2.png";
}elseif($rr['no_urut']==3){
	$marker="3.png";
}else{
	$marker="4.png";
}
?>
<td style="padding:20px"><img src="<?php echo Yii::app()->request->baseUrl.'/images/'.$marker; ?>" width="30px" height="30px" />  <?php echo "      ".$rr['nama_kandidat']; ?></td>
<?php endforeach;?>
</tr></table>