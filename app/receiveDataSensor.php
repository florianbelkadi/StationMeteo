<?php 
require_once 'connexionBDD.php';
require_once 'InsertDonnees.php';
require_once 'GetIdCapteur.php';
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

insertDonneesCapteur($pdo,$data['temp'],$data['humidite'],$data['pression'],$data['capteur']);
?>