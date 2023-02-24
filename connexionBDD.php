<?php
// Réglages BDD 
$db="stationmeteo";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="";
 
$pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
$pdo->exec("SET CHARACTER SET utf8");
 
?>
