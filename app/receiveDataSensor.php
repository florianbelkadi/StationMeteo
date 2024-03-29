<?php 
require_once 'connexionBDD.php';
require_once 'InsertDonnees.php';
require_once 'GetId.php';
// Cette page permet de recolter les données depuis le capteur et de les insérer dans la BDD, elle est appellé toute les 10 minutes par l'esp qui lui transmet un json en POST

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