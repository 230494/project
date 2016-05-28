<?php
//harviacode.com
date_default_timezone_set('Asia/Jakarta');
$refferer = Yii::app()->request->urlReferrer ? Yii::app()->request->urlReferrer:'No Refferer';
$ip = $_SERVER['REMOTE_ADDR'];
$url=$_SERVER['REQUEST_URI'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$tanggal = date('Y-m-d', time());
$waktu = date('H:i:s', time());

if (strpos($browser, 'Safari') )
{
    $browser = 'Safari';
} else if ( strpos($browser, 'Netscape') )
{
    $browser = 'Netscape (Gecko/Netscape)';
}
else if ( strpos($browser, 'Firefox') )
{
    $browser = 'Mozilla Firefox (Gecko/Firefox)';
} else if ( strpos($browser, 'MSIE') )
{
    $browser = 'Internet Explorer (MSIE/Compatible) ';
}
else if ( strpos($browser, 'Opera') )
{
    $browser = 'Opera';
}
else if (strpos($browser, 'Chrome') )
{
    $browser = 'Google Chrome';
}

$data = $tanggal." - ".$waktu.' - '.$ip." -  ".$browser." - ".Yii::app()->session['nim']." - ".$refferer." - ".$url."\r\n";
if(isset(Yii::app()->session['nim'])){
	$model3=new Log;
	$model3->tanggal=$tanggal;
	$model3->jam=$waktu;
	$model3->ip=$ip;
	$model3->browser=$browser;
	$model3->nim=Yii::app()->session['nim'];
	$model3->refferer=$refferer;
	$model3->url=$url;
	$model3->save();
}
file_put_contents('log.txt', $data, FILE_APPEND);

?>