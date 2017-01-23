<?php
	session_start();
	$code = strtolower($_GET["code"]);
	$string = strtolower($_SESSION["code"]);
	if($code == $string){
		echo "1";
	}else{
		echo "0";
	}
?>