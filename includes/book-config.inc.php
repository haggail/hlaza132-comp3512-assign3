<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DBCONNECTION', "mysql:dbname=book");
define('DBUSER', "hlazaro");
define('DBPASS', "");


spl_autoload_register(function ($class) {
    $file = 'classes/' . $class . '.class.php';
    if(file_exists($file))
        include $file;
});

$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));

?>