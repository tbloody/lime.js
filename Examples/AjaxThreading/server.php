<?php
session_start();

	/*
		This is an extremely basic server-side file for the AJAX test.
		It allows you to specify a duration (in seconds). This will
		cause the server to pause for that many seconds, emulating a
		busy process, such as a complex relational DB lookup.
	*/
	// This prevents IE from caching the page. VERY annoying problem.
	header ( "Pragma: no-cache" );
	header ( "Cache-Control: no-cache" );
        
        $id = $_POST['id'];
	$delay = 1;
	$t = (time() + (abs ( $delay )));
	while ( time() <= $t ) {};	// Real, REAL basic delay
	
        echo '{"id":"'.$id.'","winState":"';
	
	$toFind=$_SESSION['toFind'];
	if(!$toFind){
		$number = rand(1,144);
		$_SESSION['toFind'] = "button_".$number;
	}
	if($_SESSION['guesses']){
		$_SESSION['guesses'] ++;
	}else{
		$_SESSION['guesses'] = 1;
	}

	if($_SESSION['toFind'] == $id){
		$_SESSION['toFind'] = false;
		$_SESSION['guesses'] = false;
		echo "win";
	}elseif($_SESSION['guesses'] >= 30){
		$_SESSION['toFind'] = false;
		$_SESSION['guesses'] = false;
		echo"lose" ;
	}else{
		echo "none";
	}
	echo "\"}";
?>