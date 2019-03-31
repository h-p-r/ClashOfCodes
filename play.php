<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>

<script src="js/jquery.js"></script>


</body>
</html>
<?php
session_start();
require_once('connect_algodb.php');
//require_once('countdown.php');
require_once('core.php');
if((!isset($_SESSION['player2']))) {
    redirect_to('login.php');
}
$_SESSION['winner']=0;
if((isset($_SESSION['player2']))){
/*for storing moves*/
// $_SESSION['wpl']=array();                 // contains sequence of moves by player 1 or 2
// $_SESSION['wbox']=array();                // contains box which was selected
// $_SESSION['wside']=array();               // contains the side selected
// $_SESSION['nbox']=array();                // contains the number of box created in each move
$cntnrName="xcute/";
/*data initialization*/
//user data
$num=$_SESSION['num'];
$num=$cntnrName.$num;
$userid1=$_SESSION['player1'];
$userid2=$_SESSION['player2'];
$error_msg="";
$p1_name=$fplayer1=$_SESSION['fplayer1'];
$p2_name=$fplayer2=$_SESSION['fplayer2'];
// code files
$my_file1="codes/$userid1".".cpp";
$my_file2="codes/$userid2".".cpp";
$moniter_file="codes/moniter.cpp";
//actual files
$moniter="$num/moniter.cpp";
$p1_code=$my_file1;
$p2_code=$my_file2;
$input1="$num/input1.txt";
$input2="$num/input2.txt";
$bidsFile="$num/bids.txt";
$moniter_input="$num/moniter_input.txt";
make_file('',$input1);
make_file('',$input2);
make_file('',$moniter_input);
// $file_contents = file_get_contents($moniter_file);
// make_file($file_contents ,$moniter);
make_file('',$bidsFile);
chmod($input1,0766);
chmod($input2,0766);
chmod($moniter_input,0766);
chmod($bidsFile,0766);
// $file_contents = file_get_contents($my_file1);
// make_file($file_contents ,$p1_code);
// $file_contents = file_get_contents($my_file2);
// make_file($file_contents ,$p2_code);
// $file_contents = file_get_contents($moniter_file);
// make_file($file_contents ,$moniter);

$p1m=0;
$move=0;
//input -256 to  moniter
//save output to input1
// file_put_contents($moniter_input,"-256");
// shell_exec("cd $num");
shell_exec("chroot /opt/lampp/htdocs/ClashOfCodes/xcute /bin/bash");
$error=shell_exec("g++ -o $num/om $moniter_file   2>&1");
	if(empty($error)){
        // $output=shell_exec("./$num/om < $moniter_input");
        $output='12'."\n".'0';
        file_put_contents($input1,$output);
        file_put_contents($input2,$output);


		$p1_e=0;$p2_e=0;

        $error1=shell_exec("g++ -o $num/op1 $p1_code   2>&1");
		if(!empty($error1)){
			$p1_e=1;
		}
		$error2=shell_exec("g++ -o $num/op2 $p2_code   2>&1");
		if(!empty($error2)){
			$p2_e=1;
		}

        $winner='0';

		if($p1_e==1&&$p2_e==0){
			$error_msg = 'error in p1';
			$winner = $p2_name;

		}else if($p1_e==0&&$p2_e==1){
			$error_msg = 'error in p2';
			$winner = $p1_name;

		}else if($p1_e==1&&$p2_e==1){
			$error_msg = 'error in both';

		}else{

            $p1_box=0;
            $p2_box=0;

            $turn='1';
			                                                    //give input1 to p1_code
                                                            //append output and input1-> moniter_input
                                                        //get output and give it to input2 if number end here
			while(true){
			    // if($turn=='1')
                // {
                    $output1=shell_exec("./$num/op1 < $input1");
                    if(empty($output1)){
                    //no output
                        $error_msg="p1 didn't made move";
                        $winner = $p2_name;
                        break;
                    }
                    $output2=shell_exec("./$num/op2 < $input2");
                    if(empty($output2)){
                    //no output
                        $error_msg="p2 didn't made move";
                        $winner = $p1_name;
                        break;
                    }
                    
                        sscanf($output1, "%d",$a);
                        echo '<hr><span class="print">'.$p1_name.' bid '.$a.'</span>';

                        sscanf($output2, "%d",$b);
                        echo '<hr><span class="print">'.$p2_name.' bid '.$b.'</span>';


                        // $_SESSION['wpl'][$p1m]=1;
                        // $_SESSION['wbox'][$p1m]=$x;
                        // $_SESSION['wside'][$p1m]=$y;
                        // $p1m++;
                        // $move++;

                        // $file_contents = file_get_contents($input1);
                        file_put_contents($moniter_input,$output1.' '.$output2);
			            // echo file_get_contents($moniter_input);

                        $outputm=shell_exec("cd $num; ./om < moniter_input.txt");
                        if(!empty($outputm)){

                            sscanf($outputm,"%d",$type);
                            if($type==-1){
                            //wrong move
                                $error_msg="p1 made wrong move";
                                $winner = $p2_name;
                                break;
                            }else if($type==-2){
                            //wrong move
                                $error_msg="p2 made wrong move";
                                $winner = $p1_name;
                                break;
                            }else if($type==-3){
                                // Player 1 won
                                $winner = $p1_name;
                                break;
                            }else if($type==-4){
                                // Player 2 won
                                $winner = $p2_name;
                                break;
                            }else if($type==-51){
                                // Player 1 won
                                $winner = $p1_name;
                                break;
                            }else if($type==-52){
                                // Player 2 won
                                $winner = $p2_name;
                                break;
                            }else if($type==-53){
                                // tie
                                $winner = '0';
                                break;
                            }else if($type==-61){
                                // Player 1 won
                                $winner = $p1_name;
                                break;
                            }else if($type==-62){
                                // Player 2 won
                                $winner = $p2_name;
                                break;
                            }else if($type==-63){
                                // tie
                                $winner = '0';
                                break;
                            }

                            $bidsLines = file($bidsFile);
                            $rlen=count($bidsLines);
                            $newInp11='';
                            $newInp12='';
                            $newInp21='';
                            $newInp22='';
                            $bpos=12;
                            for ($i=0;$i<$rlen;$i++) {
                                $splitLine=explode(' ', $lines[$i]);
                                $newInp11=$newInp11.$splitLine[0].' ';
                                $newInp12=$newInp12.$splitLine[2].' ';

                                $newInp21=$newInp21.$splitLine[1].' ';
                                $newInp22=$newInp22.$splitLine[2].' ';
                                $bmove=(int)($splitLine[2]);
                                $bpos+=$bmove;
                            }

                            file_put_contents($input1,'1'."\n".$bpos."\n".$rlen."\n".$newInp11."\n".$newInp12);
                            file_put_contents($input2,'2'."\n".$bpos."\n".$rlen."\n".$newInp21."\n".$newInp22);
                            // also remove the initial number from output
                       
                        }
		
			}
            if($winner=='0'){
                $winner="Match Draw";
            }
		}

    }
    else{
		//echo $error;
		$error_msg="$error Internal error in moniter";
    }
    if($winner=="Match Draw") {
        echo ' '.$error_msg.' '.$winner;
    }
    else {
        echo ' '.$error_msg.' '.$winner.' Wins';
    }
// $animFile = "anim.txt";
$lines = file($bidsFile); //file in to an array
$_SESSION['i']=0;
$_SESSION['max']=count($lines);
$_SESSION['p1Mon']=100;
$_SESSION['bpos']=12;
$_SESSION['p2Mon']=100;
$_SESSION['winner']=$winner;
$_SESSION['errorMsg']=$error_msg;
$uid=$_SESSION['num'];
// update winner in gameboard
    $query="UPDATE `gameboard` SET `winner`='$winner' WHERE `id`='$uid'";
	if($run=mysqli_query($mysqli,$query)){
	}else{
		echo 'Error Occured';
	}


echo '<span class="win-disp"><br>player '.$_SESSION['winner'].' Won the Game<a href="trial-exec.php" style="color:rgb(242, 9, 25);"><b> Wanna Play with other</b></span>';
//for animation
redirect_to('end.php');
}
?>