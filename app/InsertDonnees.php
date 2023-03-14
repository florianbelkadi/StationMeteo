<?php 
include_once 'connexionBDD.php';
require_once 'GetId.php';
date_default_timezone_set('Europe/Paris');

// Cette fonction permet d'inserer les données récoltées via capteur dans la BDD
Function insertDonneesCapteur($pdo,$temp,$hum,$pres,$capt)
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

////////////////////////////////////////////////////////////////////////////////////////////////////

// Cette fonction permet d'inserer la partie commune des données récoltées (Via api) dans la BDD
Function insertDonneesApi($pdo,$temp,$hum,$pres,$nomVille)
{
//Recupération de l'id de la ville 
$idVille = GetIdVille($pdo,$nomVille);

// Ecriture de la requête
$sqlQueryDonnees = 'INSERT INTO Donnees(Temperature,Humidite,Pression,DateDonnee,Id_Villes) VALUES (:Temperature, :Humidite, :Pression, :DateDonnee,:idVille)';

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
   'idVille' => $idVille
]);
}

?>