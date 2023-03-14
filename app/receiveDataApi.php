<?php 
require_once 'connexionBDD.php';
require_once 'GetLastDatas.php';
require_once 'InsertDonnees.php';

// Cette page permet de recolter les données depuis l'api et de les insérer dans la BDD, elle est appellé tout les 10 minutes par le cron du raspberry
$donneesApi = GetApiData();
insertDonneesApi($pdo,$donneesApi->main->temp,$donneesApi->main->humidity,$donneesApi->main->pressure,$donneesApi->name);
?>