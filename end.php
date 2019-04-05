<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="css/bidding-style.css" />
	<style>
	body{
	margin:0;
	padding:0;
	}
			.table2 th, .table2 td{
				border:1px solid white;
				padding:10px;
				margin:0;
				color:white;
			}
			.table2{
				background-color:black;
				opacity:0.8;
				padding:2%;
			}
	</style>
	<script>
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
		</script>
	
</head>
<body>
<?php
			/* just for animation purpose*/

			session_start();
			require_once('connect_algodb.php');
			//require_once('countdown.php');
			require_once('core.php');
			$_SESSION['end']=0;
			$_SESSION['logs']=0;
			$rid=$_SESSION['i']++;
			if($_SESSION['i']>$_SESSION['max']){
				$rid=$_SESSION['max']-1;
				$_SESSION['end']=1;
			}
			$cntnrName="xcute/";
			$num=$_SESSION['num'];
			$num=$cntnrName.$num;
			$animFile="$num/bids.txt";
			$p1Mon=$_SESSION['p1Mon'];
			$p2Mon=$_SESSION['p2Mon'];
			$bpos=$_SESSION['bpos'];
			$p1Bid=0;
			$p2Bid=0;
			$nsteps=25;
			if($_SESSION['max']>0) {

				$lines = file($animFile);//file in to an array
				$splitLine=explode(' ', $lines[$rid]);
				$p1Bid=(int)($splitLine[0]);
				$p2Bid=(int)($splitLine[1]);
				$bMove=(int)($splitLine[2]);
				if($bpos>24) {
					$bpos=24;
				}
				else if($bpos<0) {
					$bpos=0;
				}
			}
			// if($_SESSION['end']){
			// 	$p1Bid=0;
			// 	$p2Bid=0;
			// 	$bMove=0;
			// }
			// echo $bpos.'<br>'.$_SESSION['i'];
		?>

<!--  Bidding Game Animation Start -->

<div  class="cntnr">

		<?php
			if($_SESSION['end']) {
				if ($_SESSION['winner']=="Match Draw") {
					echo '
				<div class="win-label draw">'.$_SESSION['winner'].'</div>
				';	
				}
				else {
					echo '
					<div class="win-label">'.$_SESSION['winner'].' Wins</div>
					';

				}
			}
			echo '
			<div class="vs-label">'.$_SESSION['fplayer1'].'  vs  '.$_SESSION['fplayer2'].'</div>
			';
		// $bpos=($_SESSION['i'])%$nsteps;
		// while($temp<3) {
			echo '
			<div id="draw-cntnr" class="anim-cntnr">
			<span class="p-label">P1</span>
			<span class="p-mon p1-mon">'.($p1Mon).'</span>
			<span class="p-bid p1-bid">'.$p1Bid.'</span>
			';

			for ($i=0;$i<$nsteps;$i++) {
			if($i==$bpos){
				echo '
				<div class="bottle"> 
				<img src="img/bottle.png" alt="bottle">
				</div>
				';
			}
			?>
			<span class="step 
			<?php
			if($i==(int)($nsteps/2)){
				echo 'center-step ';
			}else if($i==0){
				echo 'win-step ';
			}else if($i==24){
				echo 'win-step ';
			}
			if($i==$bpos){
				echo 'active-step ';
			}
			?>
			"></span>
	<?php
	}
echo '
<span class="p-label">P2</span>
<span class="p-mon p2-mon">'.($p2Mon).'</span>
<span class="p-bid p2-bid">'.$p2Bid.'</span>

</div>
';


echo '
	<script>
		var timeout=setTimeout("location.reload(true);",250);
	</script>
';
// }

if($_SESSION['i']>$_SESSION['max']) {
	echo '
	<script>
	
	clearTimeout(timeout);
	
	</script>
	';
}

$_SESSION['p1Mon']=$p1Mon-$p1Bid;
$_SESSION['p2Mon']=$p2Mon-$p2Bid;
if($_SESSION['end']) { $bMove=0; }
$_SESSION['bpos']=$bpos+$bMove;
if($_SESSION['end']) {
	$_SESSION['p1Mon']=0;
	$_SESSION['p2Mon']=0;
}
?>
</div>

<?php 
// for logs

function showLogs()
	{
		$_SESSION['logs']=1;
	}

	if(array_key_exists('logs',$_POST)){
		showLogs();
	}

if($_SESSION['logs']) {
	$logFile="$num/logs.txt";
	$lines = file($logFile); //file in to an array
	echo '
	<div class="log-cntnr">
	<div class="log-title print-cen">Match Logs</div>';
	for($i=0;$i<count($lines);$i++) {
		if($i%3==0) echo '<hr>';
		echo '<div class="print-cen">'.$lines[$i].'</div>';
	}
	echo '</div>';
}


?>

<?php 
if($_SESSION['end']) {
	if ($_SESSION['winner']=="Match Draw") {
					echo '<span class="win-disp"><br>'.$_SESSION['errorMsg'].'<br><form class="logs-form" action="" method="post"><input class="log-btn" type="submit" name="logs" value="Match Logs" /></form><b>'.$_SESSION['winner'].'</b> <a href="trial-exec.php" style="color:rgb(10, 200, 25);"><b> Wanna Play with other</b></a><br><a href="index.php" style="color:white;"><b>HOME</b></a></span>';	
				}
				else {
					echo '<span class="win-disp"><br>'.$_SESSION['errorMsg'].'<br><form class="logs-form" action="" method="post"><input class="log-btn" type="submit" name="logs" value="Match Logs" /></form>'.$_SESSION['winner'].' Won the Game<a href="trial-exec.php" style="color:rgb(10, 200, 25);"><b> Wanna Play with other</b></a><br><a href="index.php" style="color:white;"><b>HOME</b></a></span>';

				}
}

?>

































<!-- Bidding Game Animation End -->



<?php
exit(0);


$_SESSION['end']=0;
if($_SESSION['i']>$_SESSION['max']){
	$_SESSION['end']=1;
}

$rows=5;$cols=5;


$start=0;$end=4;

function disp(){
	echo "\n";
	global $rows,$cols;
	?>
	
	<div class="" style="position:absolute;" >
	<div style="background-image:url('img/w-2.jpg');">
	<table style="border:1px solid black;"  cellspacing=0>
	<?php
	for ($i=0;$i<$rows;$i++){
	?>	<tr>
	<?php
		for ($j=0;$j<$cols;$j++){
	?><td style="border:1px solid black; width:50px; height:50px ; "class="<?php if($_SESSION['a'][$i][$j]==-1) echo 'cross';?>" >
	<?php
	if($_SESSION['a'][$i][$j]==1){
		?>
		<svg width="50" height="50" >
<circle cx="25" cy="25" r="15" fill="rgb(242, 9, 25)"/>
</svg>
		<?php
	}else if($_SESSION['a'][$i][$j]==2){
		?>
		<svg width="50" height="50" >
<circle cx="25" cy="25" r="15" fill="black"/>
</svg>
		
	<?php
	}else if($_SESSION['a'][$i][$j]==-1){
	
	}?>
	</td>
	<?php
		}
	?></tr>
	<?php
	}
	?>
	</table>
	</div>
	</div>
	<?php
}

function dispTable(){
	echo "\n";
	$_SESSION['a']=array(
		array(0,0,1,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,0,0,0),
		array(0,0,2,0,0)
		);
	?>
	
	<div class="" style="position:absolute; top:50%" >
	
	<table class="table2" style="border:1px solid black;"  cellspacing=0>
		<tr>
		<th>Sr No.</th>
		<th>Player</th>
		<th>Move</th>
		<th>Cross</th>
		
		</tr>
		
		<?php
		$pp1=-1;
		$pp2=-1;
			for($i=0;$i<=$_SESSION['max'];$i++){
				?>
				<tr>
				<?php
				if($i%2==0){
					$pp1++;
					$player=1;
					$x=$_SESSION['p1r'][$pp1];
					$y=$_SESSION['p1c'][$pp1];
					$x2=$_SESSION['p1r2'][$pp1];
					$y2=$_SESSION['p1c2'][$pp1];
					
				}else{
					$pp2++;
					$player=2;
					$x=$_SESSION['p2r'][$pp2];
					$y=$_SESSION['p2c'][$pp2];
					$x2=$_SESSION['p2r2'][$pp2];
					$y2=$_SESSION['p2c2'][$pp2];
				}
				?>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $player; ?></td>
				<td><?php echo '('.$x.','.$y.')'; ?></td>
				<td><?php echo '('.$x2.','.$y2.')'; ?></td>
				
				</tr>
				<?php
			}
		?>
		</tr>
		<tr>
		<td colspan=5><?php
		echo 'winner is'.$_SESSION['winner'];
		?></td>
		</tr>
	</table>
	</div>
	<br><br><br><br>
	<br><br><br><br>
	<br><br><br><br>
	
	<?php
}

function editM($player,$x,$y){
	global $start,$end;
	for($r=$start;$r<=$end;$r++){
		for($c=$start;$c<=$end;$c++){
			if($_SESSION['a'][$r][$c]==$player){
				$_SESSION['a'][$r][$c]=0;
				$_SESSION['a'][$x][$y]=$player;
			}
		}
	}
}
function editC($x,$y){
	
	$_SESSION['a'][$x][$y]=-1;
	
}


if($_SESSION['end']==0){
	$player=0;$x=0;$y=0;$x2=0;$y2=0;
	if($_SESSION['i']%2==0){
		$_SESSION['pp1']++;
		$player=1;
		$x=$_SESSION['p1r'][$_SESSION['pp1']];
		$y=$_SESSION['p1c'][$_SESSION['pp1']];
		$x2=$_SESSION['p1r2'][$_SESSION['pp1']];
		$y2=$_SESSION['p1c2'][$_SESSION['pp1']];
		
	}else{
		$_SESSION['pp2']++;
		$player=2;
		$x=$_SESSION['p2r'][$_SESSION['pp2']];
		$y=$_SESSION['p2c'][$_SESSION['pp2']];
		$x2=$_SESSION['p2r2'][$_SESSION['pp2']];
		$y2=$_SESSION['p2c2'][$_SESSION['pp2']];
	}
		disp();
		editM($player,$x,$y);
		editC($x2,$y2);
		disp();
		
		?>
		<script type="text/javascript">
		var timeout = setTimeout("location.reload(true);",1000);
		  
		</script>
		<?php
}else{
	disp();
	dispTable();
$_SESSION['i']=-1;
$_SESSION['pp1']=-1;
$_SESSION['pp2']=-1;
$_SESSION['a']=array(
array(0,0,1,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,2,0,0)
);
	$winner=$_SESSION['winner'];
	$num=$_SESSION['num'];
	//$_SESSION['winner']=0;

		
	$query="UPDATE `gameboard` SET `winner`='$winner' WHERE `id`='$num'";
	if($run=mysqli_query($mysqli,$query)){
	}else{
		echo 'Error Occured';
	}
	
	echo '<span class="win-disp"><br>player '.$winner.' Won the Game<a href="trial-exec.php" style="color:rgb(242, 9, 25);"><b> Wanna Play with other</b></span>';

		?>
		
		<script type="text/javascript">
			
			clearTimeout(timeout);
			
	</script>
	<?php
}

?>


<script src="js/jquery.js"></script>
</body>
</html>