<?php
session_start();
if(isset($_SESSION['captcha']))
{
    unset($_SESSION['captcha']);
}
$rand = strval(rand(0, 9)).strval(rand(0, 9)).strval(rand(0, 9)).strval(rand(0, 9));
$_SESSION['captcha'] = $rand;
$text = $_SESSION['captcha'];

header("Content-type: image/png; Pragma: no-cache; Expires: Fri, 30 Oct 1998 14:19:41 GMT; Cache-Control: no-cache, must-revalidate"); //ustawienie nagłówka strony
$im = imagecreate(40, 20); //utworzenie canvasa 
$black = imagecolorallocate($im, 0, 0, 0); //alokacja koloru r,g,b
$red = imagecolorallocate($im, 255, 0, 0); //alokacja koloru r,g,b
$green = imagecolorallocate($im, 0, 255, 0); //alokacja koloru r,g,b
$white = imagecolorallocate($im, 255, 255, 255); //alokacja koloru r,g,b
imagefilledrectangle($im, 0, 0, 50, 25, $black);
imagecolortransparent($im, $red); //ustawienie czerwonego jako przeźroczystego
imagestring($im, 5, 2, 2, $text, $green); //wypisanie tekstu
//rysowanie linii przerywanej
$style = array($white, $white, $white, $white); //tablica kolejnych pixeli stylu
imagesetstyle($im, $style); //ustawienie stylu
$i = -41;
while ($i < 79) {
    imageline($im, 0, 0 + $i, 50, 25 + $i, IMG_COLOR_STYLED); //rysowanie linii o naszym stylu (IMG_COLOR_STYLED)
    $i += 4;
}
$i = -40;
while ($i < 80) {
    imageline($im, 0, 25 + $i, 50, 0 + $i, IMG_COLOR_STYLED); //rysowanie linii o naszym stylu (IMG_COLOR_STYLED)
    $i += 4;
}
imagepng($im); //generowanie png
imagedestroy($im); //zwolnienie pamięci
?>