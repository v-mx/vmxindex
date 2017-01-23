<?php
	//http://php.net/manual/zh/ref.image.php
	header("Content-type: text/html; charset=utf-8");
	header('content-type:image/png');
	session_start();
	$image = imagecreatetruecolor(100, 30);
	$bgcolor = imagecolorallocate($image, 255, 255,255);
	imagefill($image, 0, 0, $bgcolor);
	$font = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$code = "";
	
	for($i=0;$i<4;$i++){
		$fontsize = 5;
		$string =substr($font,rand(0,strlen($font)-1),1);
		$code.=$string;
		$color = imagecolorallocate($image, rand(20,80), rand(20,80), rand(20,80));
		$x = ($i*25)+rand(5,10);
		$y = rand(5,10);
		imagestring($image, $fontsize, $x, $y, $string, $color);
	}
//	
	for($i=0;$i<200;$i++){
		$pointcolor = imagecolorallocate($image, rand(80,180), rand(80,180), rand(80,180));
		imagesetpixel($image, rand(1,99),rand(1,29), $pointcolor);
	}
//	
	for($i=0;$i<4;$i++){
		$linecolor = imagecolorallocate($image, rand(100,220), rand(100,220), rand(100,220));
		imageline($image, rand(1,99),rand(1,29), rand(1,99),rand(1,29), $linecolor);
	}
//	
	imagepng($image);
	imagedestroy($image);

	$_SESSION["code"]=$code;

?>

