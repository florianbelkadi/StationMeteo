<?php 
require_once 'connexionBDD.php';

/**
 * getAllSensor retourne les noms des capteurs présents dans la bdd
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

/**
 * getAlltown retourne les noms des villes présents dans la bdd
 *
 * @param  PDO $pdo connexion à la bdd
 * @return array tableau contenant les valeurs
 */
function getAllTown($pdo) :array
{
    $sqlQuery = 'SELECT * FROM Villes';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute() ;
    return $sql->fetchall();
}
?>