<?php 
include_once '../connexionBDD.php';
require_once 'GetIdCapteur.php';
// Cette foncionn permet d'inserer la partie commune des données récoltées (Via api ou capteur) dans la BDD
Function insertDonnees($pdo,$temp,$hum,$pres,$capt)
{
//Recupération de l'id du capteur 
$idCapteur = GetIdCapteur($pdo,$capt);

// Ecriture de la requête
$sqlQueryDonnees = 'INSERT INTO Donnees(Temperature,Humidite,Pression,DateDonnee,Id_NomCapteurs) VALUES (:Temperature, :Humidite, :Pression, :DateDonnee,:idCapt)';

// Préparation
$insertDonnee = $pdo->prepare($sqlQueryDonnees);
$date = new DateTime();
$date = $date->format('y/m/d  H:i:s');

// Exécution 
$insertDonnee->execute([
   'Temperature' =>  $temp,
    'Humidite' =>  $hum,
   'Pression' => $pres,
   'DateDonnee' => $date,
   'idCapt' => $idCapteur
]);
}
?>