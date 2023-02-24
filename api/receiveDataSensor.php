<?php 
require '../connexionBDD.php';
require 'InsertDonnees.php';
/* Reception du JSON */
$jsonData = file_get_contents("php://input");
        
/* Verifie si JSON est vide */
if (strlen($jsonData) > 0) {
    /* Decoder JSON */
    $data = json_decode($jsonData, true);
    /* Verifie les erreurs et le format final */
    if (!(json_last_error() == JSON_ERROR_NONE and is_array($data)))
        die('Données JSON invalides.');
} else
    die('Aucune données JSON.');

//Insertion dans l atable données et recuperation du dernier ID 
$lastId = insertDonnees($pdo,$data['temp'],$data['humidite'],$data['pression']);

// Requete pour inserer dans la table capteurs
$sqlQuerySensorName = 'INSERT INTO capteurs(Id_Donnees,NomCapteur) VALUES (:Id, :NomCapteur)';
// Préparation
$insertSensorName = $pdo->prepare($sqlQuerySensorName);
// Exécution 
$insertSensorName->execute([
   'Id' => $lastId,
    'NomCapteur' =>  $data['capteur']
]);

?>