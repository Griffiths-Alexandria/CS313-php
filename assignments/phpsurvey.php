<?php
$vote = $_REQUEST['vote'];

//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$saber = $array[0];
$phaser = $array[1];
$sonic = $array[2];
$disk = $array[3];
$cricket = $array[4];
$wookie = $array[5];

if ($vote == 0) {
  $saber = $saber + 1;
}
if ($vote == 1) {
  $phaser = $phaser + 1;
}
if ($vote == 2) {
  $sonic = $sonic + 1;
}
if ($vote == 3) {
  $disk = $disk + 1;
}
if ($vote == 4) {
  $cricket = $cricket + 1;
}
if ($vote == 5) {
  $wookie = $wookie + 1;
}

//insert votes to txt file
$insertvote = $saber."||".$phaser."||".$sonic."||".$disk."||".$cricket."||".$wookie;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>

<h2>Result:</h2>
<table>
<tr>
<td>Lightsaber:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($saber/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($saber/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>
<td>Phaser:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($phaser/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($saber/($phaser+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>
<td>Sonic Screwdriver:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($sonic/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($sonic/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>
<td>Identity Disk:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($disk/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($disk/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>
<td>The Noisy Cricket:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($cricket/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($cricket/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>
<td>Wookie:</td>
<td>
<img src="/poll.gif"
width='<?php echo(100*round($wookie/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>'
height='20'>
<?php echo(100*round($wookie/($saber+$phaser+$sonic+$disk+$cricket+$wookie),2)); ?>%
</td>
</tr>

</table>