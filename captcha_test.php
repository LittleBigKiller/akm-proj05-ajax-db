<?php
session_start();
$text = $_SESSION['captcha'];

header("Content-type: text/html"); //ustawienie nagłówka strony
echo $text
?>