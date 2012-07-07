<?php
header("Content-type: image/png");
include('FarsiGD.php');
$font = 'fonts/FreeFarsi.ttf';
$gd = new FarsiGD();

$arr_test_strings = array(
    'اگر PHP4 را بخونیم در 24 ساعت Teacher4God می شویم',
    'از قدیم گفتن : Take it easy. ینعی دیگه 2 2دوتا 4تا!',
    'Developed by Ali Pour Zahmatkesh',
    'night 2',
    '1night',
    '2 شب',
    'a 1 b 2 c 3 هاهاها',
    'این صفحه فهرست ترانه‌هایی است که در 100 آهنگ داغ بیلبورد در ایالات متحده در اول بوده‌اند.',
    'FA - نهادی ورزشی مربوط به فوتبال در انگلیس (The Football Association)',
    '5 ژوئیه زادروز جرارد توفت برنده جایزه نوبل فیزیک'
,'2تا به 5'
    ,'زادروز ژرژ پمپیدو (تصویر)، سیاستمدار فرانسوی'
,'روز بعد: ۶ ژوئیه - روز قبل:۴ ژوئیه'
,'0.25 * 1.23'
        );


$im = imagecreate(1000, (count($arr_test_strings)+1)*40 );

$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);

$i = 40;
foreach($arr_test_strings as $str) {
    $text = $gd->persianText($str, 'fa', 'normal');
    imagettftext($im, 20, 0, 20, $i, $black, $font, $text);
    $i += 40;
}

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);

?>
