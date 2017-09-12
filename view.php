<?php

// by https://github.com/ajanvier/puush

include 'includes/config/Database.conf.php';
include 'includes/classes/Database.class.php';
include 'includes/classes/Puush.class.php';
include 'includes/config/Global.conf.php';

$DB = new Database($dbhost, $dbport, $dbuser, $dbpass, $dbname);


if (!isset($_GET['image']))
{
    exit ('ERR No image provided.');
}


$image = basename(urldecode($_GET['image']));


$matched = glob($uploadDirectory."/". $image.".*");

if (empty($matched))
{
    exit ('ERR No image found.');
}


$matched = $matched[0];

// Get the extension
$ext = strtolower(Puush::getExtension($matched));

global $whitelist;
// Look for an appropriate mime type
$mime = array_search($ext, $whitelist);

// Did we find one?
if ($mime !== FALSE)
{
    header('Content-type: ' . $mime);
    //header('Expires: 0');
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60* 24))); // 1 day :D
    //header('Cache-Control: must-revalidate');
    header('Cache-Control: public, max-age=86400');

    // Prepare to send the image
    ob_clean();
    flush();

    // Send the image
    readfile($matched);
    $DB->updateViewCount($_GET['image']);
}