<?php

session_start();

$strings = '123456789';
$i = 0;
$characters = 3;
$code = '';
while ($i < $characters)
{
    $code .= substr($strings, mt_rand(0, strlen($strings)-1), 1);
    $i++;
}

$_SESSION['captcha'] = $code;

//generate image
$im = imagecreatetruecolor(200, 40);
$foreground = imagecolorallocate($im, 0, 0, 0);
$shadow = imagecolorallocate($im, 255, 0, 127);
$background = imagecolorallocate($im, 255, 255, 255);

imagefilledrectangle($im, 0, 0, 200, 200, $background);

// use your own font!
$font = 'font.ttf';
$color = imagecolorallocate($im, 255, 0, 127);

//draw text:
imagettftext($im, 20, 0, 9, 28, $shadow, $font, $code);
imagettftext($im, 00, 0, 2, 32, $foreground, $font, $code);



//send image to browser
header ("Content-type: image/png");
imagepng($im);
imagedestroy($im);