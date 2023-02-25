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
    $sqlQuery = 'SELECT nomcapteurs.NomCapteur,donnees.DateDonnee,AVG(donnees.Temperature) as TempMoy,AVG(donnees.Humidite) as HumMoy,AVG(donnees.Pression)  as PresMoy

    FROM donnees JOIN nomcapteurs ON donnees.Id_NomCapteurs = nomcapteurs.Id_NomCapteurs 
    
    WHERE donnees.DateDonnee BETWEEN NOW() -INTERVAL 7 DAY   AND NOW() 
    
    GROUP BY day(donnees.DateDonnee); ';
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

    $sqlQuery = 'SELECT nomcapteurs.NomCapteur,donnees.DateDonnee,AVG(donnees.Temperature) as TempMoy,AVG(donnees.Humidite) as HumMoy,AVG(donnees.Pression) as PresMoy
    FROM donnees JOIN nomcapteurs ON donnees.Id_NomCapteurs = nomcapteurs.Id_NomCapteurs 
    WHERE nomcapteurs.Id_NomCapteurs = :idCapt 
    AND donnees.DateDonnee BETWEEN :dateDeb  AND :dateFin
    
    GROUP BY day(donnees.DateDonnee); ';
    $sql = $pdo->prepare($sqlQuery) ;
    $sql->execute(array(
        'idCapt' => $idCapt,
        'dateDeb' => $dateDebut,
        'dateFin' => $dateFin
    )) ;
    return $sql->fetchall();
}
