<?php 
require_once './connexionBDD.php';

/**
 * getLastWeek retourne les données des 7 dernier jour en faisant une moyenne journalière
 *
 * @param  PDO $pdo connexion à la bdd
 * @return array tableau contenant les valeurs
 */
function getAllSensor($pdo) :array
{
    $sqlQuery = 'SELECT * FROM NomCapteurs';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute() ;
    return $sql->fetchall();
}
?>