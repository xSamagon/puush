<?php
include 'includes/config/Database.conf.php';
include 'includes/classes/Database.class.php';
include 'includes/classes/Puush.class.php';
include 'includes/config/Global.conf.php';

$DB = new Database($dbhost, $dbport, $dbuser, $dbpass, $dbname);

$info = print_r($_POST, true);
$info2 = print_r($_FILES, true);

if (isset($_POST["k"]) == false)
{
    return;
}


if (isset($_FILES['f']) == false)
{
    return;
}

if (!$DB->checkKey($_POST["k"]))
{
    return;
}


$validlnk = $DB->getDomainByKey($_POST["k"]);

$file = $_FILES['f'];

if ($file['size'] > $fileMaxSize)
{
    return;
}

if (Puush::validateFile($file) == false)
{
    return;
}

$extension = Puush::getExtension($file['name']);
$fileName = Puush::generateFileName($extension);

move_uploaded_file($file['tmp_name'], $uploadDirectory."/".$fileName.".".$extension);

echo '0,' . sprintf("http://".$validlnk."/%s.".$extension, $fileName) . ',-1,-1';
