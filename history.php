<?php

include 'includes/config/Database.conf.php';
include 'includes/classes/Database.class.php';
include 'includes/classes/Puush.class.php';
include 'includes/config/Global.conf.php';

$DB = new Database($dbhost, $dbport, $dbuser, $dbpass, $dbname);

if (!isset($_POST["k"]) || $DB->checkKey($_POST["k"]) == false)
    return;
// Zahl in der ersten Zeile entspricht den zu versteckenden Items im Context menü
// Im Kontext Menü können maximal 5 Items angezeigt werden
// Jedes Item kommt in eine Zeile
// Thumbnail: /api/thumb

//?????,Datum,Link,Text,Views,LoadThumbNail(0/1)

// EXAMPLE:

//4
//0,11.09.2017 23:26:28,https://puu.sh/vZaEB/0.png,Dieses Feature Folgt,0,0


$domain = $DB->getDomainByKey($_POST["k"]);
$lastFiles = $DB->getLastFilesByKey($_POST["k"]);
echo (5-sizeof($lastFiles))."\r\n";

foreach ($lastFiles as $file)
{
    echo sprintf("0,%s,http://%s/%s,%s,%d,%d\r\n", $file["date"], $domain, $file["name"], $file["orginalname"], $file["viewcount"], $file["thumbenabled"]);
}

?>