<?php
// Réglages BDD 
$db="station_meteo";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="mdp";
 
$pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
$pdo->exec("SET CHARACTER SET utf8");
 
?>
