<?php
session_start();
require 'generator/generator.php';

if(isset($_GET['p']) && isset($_SESSION['activeTemplate'])){
	$generator = new ImageGenerator('img/designer/src', 'img/pending/t6e');
	$template = $_SESSION['activeTemplate'];
	$pos = $_GET['p'];
	$img = $generator->generate($template, $pos);
}else{
	$generator = new ImageGenerator('img/accepted/src', 'img/accepted/t6e');
	$template = $generator->getRandomTemplate();
	$t6eCode = pathinfo($template, PATHINFO_FILENAME);
	$pos = file_get_contents("img/accepted/t6e/$t6eCode.json");
	$img = $generator->generate($template, $pos);
}

if (count(error_get_last())) exit();

header('Content-Type: image/jpg');
imagejpeg($img);
imagedestroy($img);