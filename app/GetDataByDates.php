<?php 
require_once './connexionBDD.php';

/**
 * getLastWeek retourne les données des 7 dernier jour en faisant une moyenne journalière
 *
 * @param  PDO $pdo connexion à la bdd
 * @return array tableau contenant les valeurs
 */
function getLastWeek($pdo) :array
{
    $sqlQuery = 'SELECT NomCapteurs.NomCapteur,Donnees.DateDonnee,AVG(Donnees.Temperature) as Temp,AVG(Donnees.Humidite) as Hum,AVG(Donnees.Pression)  as Pres

    FROM Donnees JOIN NomCapteurs ON Donnees.Id_NomCapteurs = NomCapteurs.Id_NomCapteurs 
    
    WHERE Donnees.DateDonnee BETWEEN NOW() -INTERVAL 7 DAY   AND NOW() 
    
    GROUP BY day(Donnees.DateDonnee); ';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute() ;
    return $sql->fetchall();
}

/** 
 * getByDates renvoie les donnée moyen journalières selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getByDates($pdo,$idCapt, $dateDebut, $dateFin) :array
{

    $dateFin = date('Y-m-d', strtotime($dateFin. ' + 1 days'));

    $sqlQuery = 'SELECT NomCapteurs.NomCapteur,Donnees.DateDonnee,AVG(Donnees.Temperature) as Temp,AVG(Donnees.Humidite) as Hum,AVG(Donnees.Pression) as Pres
    FROM Donnees JOIN NomCapteurs ON Donnees.Id_NomCapteurs = NomCapteurs.Id_NomCapteurs 
    WHERE NomCapteurs.Id_NomCapteurs = :idCapt 
    AND Donnees.DateDonnee BETWEEN :dateDeb  AND :dateFin
    
    GROUP BY day(Donnees.DateDonnee); ';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute(array(
        'idCapt' => $idCapt,
        'dateDeb' => $dateDebut,
        'dateFin' => $dateFin
    )) ;
    return $sql->fetchall();
}

/** 
 * getByDatesDetail renvoie les données selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getByDatesDetail($pdo,$idCapt, $dateDebut, $dateFin) :array
{

    $dateFin = date('Y-m-d', strtotime($dateFin. ' + 1 days'));

    $sqlQuery = 'SELECT NomCapteurs.NomCapteur,Donnees.DateDonnee,Donnees.Temperature as Temp,Donnees.Humidite as Hum ,Donnees.Pression as Pres
    FROM Donnees JOIN NomCapteurs ON Donnees.Id_NomCapteurs = NomCapteurs.Id_NomCapteurs 
    WHERE NomCapteurs.Id_NomCapteurs = :idCapt 
    AND Donnees.DateDonnee BETWEEN :dateDeb  AND :dateFin';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute(array(
        'idCapt' => $idCapt,
        'dateDeb' => $dateDebut,
        'dateFin' => $dateFin
    )) ;
    return $sql->fetchall();
}
