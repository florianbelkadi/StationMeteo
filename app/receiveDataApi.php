<?php 
include_once '../connexionBDD.php';
require_once 'GetApiData.php';
// Cette fonction permet d'inserer la partie commune des données récoltées (Via api) dans la BDD
$donneesApi = GetApiData()
insertDonneesApi($pdo,$donneesApi->main->temp,$donneesApi->main->humidity,$donneesApi->main->pressure,$donneesApi->name);
?>