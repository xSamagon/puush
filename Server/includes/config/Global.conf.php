<?php

$uploadDirectory = "images"; // Directory where the images are saved
$fileMaxSize = 200 * 1024 * 1024;
$whitelist = array(
    'image/jpeg' => 'jpeg',
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/psd' => 'psd',
    'image/bmp' => 'bmp',
    'image/vnd.wap.wbmp' => 'bmp',
    'audio/mpeg' => 'mp3',
	'application/x-rar-compressed' => 'rar',
    'application/x-rar' => 'rar'
);