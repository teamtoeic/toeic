<?php
session_start();
function taocaptcha()
{
	if(file_exists("public/images/captcha/captcha.gif"))
            unlink("public/images/captcha/captcha.gif");
			
	$captcha = imagecreatefromgif('public/images/captcha/cross.gif');
	//set some variables
	$black = imagecolorallocate($captcha, 0, 0, 0);
	$white = imagecolorallocate($captcha, 225, 225, 225);
	$red = imagecolorallocate($captcha, 225, 0, 0);
	$font = 'public/fonts/arial.ttf';
	//random stuff
	$string = md5(microtime() * 10000);
	$text = substr($string, 0, 5);
	$_SESSION['code'] = $text;
	//create some stupid stuff
	imagettftext($captcha, 14, 5, 5, 25, $red, $font, $text);
	// begin to create image
	//header('content-type: image/png');
	imagepng($captcha,"public/images/captcha/captcha.gif");
	//clean up
	imagedestroy($captcha);
	
}

?>