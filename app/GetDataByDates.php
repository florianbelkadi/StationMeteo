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
 * getSensorByDates renvoie les données moyennes d'un capteur journalières selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getSensorByDates($pdo,$idCapt, $dateDebut, $dateFin) :array
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
 * getSensorByDatesDetail renvoie les données capteur selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getSensorByDatesDetail($pdo,$idCapt, $dateDebut, $dateFin) :array
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

/** 
 * getAPIByDates renvoie les données moyennes API selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getAPIByDates($pdo,$idVilles, $dateDebut, $dateFin) :array
{

    $dateFin = date('Y-m-d', strtotime($dateFin. ' + 1 days'));

    $sqlQuery = 'SELECT Villes.NomVille ,Donnees.DateDonnee,AVG(Donnees.Temperature) as Temp,AVG(Donnees.Humidite) as Hum,AVG(Donnees.Pression) as Pres
    FROM Donnees JOIN Villes ON Donnees.Id_Villes = Villes.Id_Villes 
    WHERE Villes.Id_Villes = :idVilles 
    AND Donnees.DateDonnee BETWEEN :dateDeb  AND :dateFin
    
    GROUP BY day(Donnees.DateDonnee); ';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute(array(
        'idVilles' => $idVilles,
        'dateDeb' => $dateDebut,
        'dateFin' => $dateFin
    )) ;
    return $sql->fetchall();
}

/** 
 * getAPIByDatesDetail renvoie les données capteur selon une date de début et de fin
 *
 * @param  mixed $pdo
 * @param  DateTime $dateDebut
 * @param  DateTime $dateFin
 * @return array
 */
function getAPIByDatesDetail($pdo,$idVilles, $dateDebut, $dateFin) :array
{

    $dateFin = date('Y-m-d', strtotime($dateFin. ' + 1 days'));

    $sqlQuery = 'SELECT Villes.Id_Villes ,Donnees.DateDonnee,Donnees.Temperature as Temp,Donnees.Humidite as Hum ,Donnees.Pression as Pres
    FROM Donnees JOIN Villes ON Donnees.Id_Villes= Villes.Id_Villes
    WHERE Villes.Id_Villes = :idVilles 
    AND Donnees.DateDonnee BETWEEN :dateDeb  AND :dateFin';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute(array(
        'idVilles' => $idVilles,
        'dateDeb' => $dateDebut,
        'dateFin' => $dateFin
    )) ;
    return $sql->fetchall();
}