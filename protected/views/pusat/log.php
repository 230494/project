<?php
/* @var $this PusatController */

$this->breadcrumbs=array(
	'Pusat',
);
/*$myFile = 'http://localhost/evotingipb//log.txt';
			$lines = file($myFile);
$n=1;
$data=array();
$dataBaru=array(array());
foreach($lines as $line){
			$data=explode(" - ", $line);
			$dataBaru[$n][0]=$data[0];
			$dataBaru[$n][1]=$data[1];
			$dataBaru[$n][2]=$data[2];
			$dataBaru[$n][3]=$data[3];
			$dataBaru[$n][4]=$data[4];
			$dataBaru[$n][5]=$data[5];
			$dataBaru[$n][6]=$data[6];
			$n++;
		}	*/
function DataViewOJRS ($x) {
$sql = "select time_format(jam,'%H') as Tanggal2 , count(*) as C  from Log  where   url= '/evotingipb/site/index' OR url= '/evotingipb/' group by Tanggal2  ";
$results =  Yii::app()->db->createCommand($sql)->queryAll() ;
$array = array() ;
$array2 = array() ;
foreach ( $results as $data) {
$array[] = $data['Tanggal2'];
$array2[] = $data['C'];
}
if ($x==1) {
return $array ;
}else {
return $array2;
}}

?>

<script src='http://code.highcharts.com/highcharts.js'></script>
<script src='http://code.highcharts.com/modules/exporting.js'></script>
<script type='text/javascript'>
$(function () {

});
 
function reloadNames() {
    var url = '<?php echo Yii::app()->request->baseUrl; ?>'+'/pusat/getdatalog';
    // This will make a request to names.php (code above) and put the resulting
    // text (which happens to be valid html) into the names div.
	
    jQuery("#rowLog").load(url);
}
jQuery(function() {
    // Schedule the reloadNames function to run every 5 seconds.
    // So, the list of names will be updated every 5 seconds.
    setInterval(reloadNames, 5000);
});

function reloadTraf() {
$('#container').highcharts({
chart: {
type: 'line'
},
title: {
text: 'Traffic Page View'
},
subtitle: {
text: ' '
},
xAxis: {
categories:  <?php echo json_encode(DataViewOJRS(1)) ?>
},
yAxis: {
title: {
text: 'Jumlah Views'
}
},
plotOptions: {
line: {
dataLabels: {
enabled: true
},
enableMouseTracking: false
}
},
series: [{
name: 'Jam',
data:  <?php echo json_encode(DataViewOJRS(2),JSON_NUMERIC_CHECK ) ?>
}]
});

//jQuery("#rowLog").load(url);
};
jQuery(function() {
    // Schedule the reloadNames function to run every 5 seconds.
    // So, the list of names will be updated every 5 seconds.
    setInterval(reloadTraf, 15000);
});

</script>
<h2>Log Aktifitas Pemilih</h2>
<br />
<center>
<div id="container"></div>
<div class="" >
                                            <label>Log</label>
											<div id="rowLog"></div>
											</div>
</center>