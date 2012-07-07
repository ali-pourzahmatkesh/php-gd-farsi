<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
// Set the content-type
header("Content-type: image/png");
include("fagd.php");
// Create the image

if(!$_GET['text']) {
	$string="برای کامل تر شدن این پروژه ویرایش های خود را ارسال کنید.";
} else {
	$string=$_GET['text'];
}
$im = imagecreate(800, 40);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

// The text to draw
$text = fagd($string,'fa','nastaligh');
// Replace path by your own font path

$font = dirname(__FILE__).'/Nastaligh.ttf';

// Add some shadow to the text
imagettftext($im, 20, 0, 19, 26, $grey, $font, $text);

// Add the text
imagettftext($im, 20, 0, 20, 25, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>
