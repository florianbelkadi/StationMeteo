<?php 
require_once './connexionBDD.php';

/**
 * getAllSensor retourne les nom des capteur présents dans la bdd
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
 * getAlltown retourne les nom des villes présents dans la bdd
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