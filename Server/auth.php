<?php
include 'includes/config/Database.conf.php';
include 'includes/classes/Database.class.php';

$DB = new Database($dbhost, $dbport, $dbuser, $dbpass, $dbname);

if (isset($_POST["e"]) && isset($_POST["p"]))
{
    echo $DB->userLogin($_POST["e"], $_POST["p"]);
}
else if (isset($_POST["e"]) && isset($_POST["k"]))
{
    echo $DB->userLoginByKey($_POST["e"], $_POST["k"]);
}
else
{
    echo "-1";
}
