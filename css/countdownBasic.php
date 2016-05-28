<link rel="stylesheet" href="jquery.countdown.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="jquery.plugin.js"></script>
<script src="jquery.countdown.js"></script>
<script>
$(function () {
	var austDay = new Date();
	austDay = new Date(2016, 4, 06,10,2,30);
	$('#defaultCountdown').countdown({until: austDay});
	$('#year').text(austDay.getFullYear());
});
</script>

<div id="defaultCountdown" style="color:blue;font-size:20pt">Pemilihan Berakhir</div>
