<?php 
    include_once '../connexionBDD.php';

Function insertDonnees($pdo,$temp,$hum,$pres)
{
// Ecriture de la requête
$sqlQueryDonnees = 'INSERT INTO donnees(Temperature,Humidite,Pression,DateDonnee) VALUES (:Temperature, :Humidite, :Pression, :DateDonnee)';

// Préparation
$insertDonnee = $pdo->prepare($sqlQueryDonnees);
$date = new DateTime();
$date = $date->format('y/m/g  H:i:s');
var_dump($date);
// Exécution 
$insertDonnee->execute([
   'Temperature' =>  $temp,
    'Humidite' =>  $hum,
   'Pression' => $pres,
   'DateDonnee' => $date
]);
// Recuperation du dernier ID
$lastId = $pdo->lastInsertId();

return $lastId;
}
?>