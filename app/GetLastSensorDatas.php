<?php 
//Cette fonction renvoie les dernière données d'un capteur
function GetLastSensorDatas($pdo,$idCapt)
{
    $sqlQueryCapteur = 'SELECT nomcapteurs.NomCapteur,donnees.DateDonnee,donnees.Temperature,donnees.Humidite,donnees.Pression FROM donnees JOIN nomcapteurs ON donnees.Id_NomCapteurs = nomcapteurs.Id_NomCapteurs WHERE nomcapteurs.Id_NomCapteurs = :idCapt ORDER BY donnees.DateDonnee DESC LIMIT 1; ';
    $sql = $pdo->prepare($sqlQueryCapteur) ;
    $sql->execute(array('idCapt' => $idCapt)) ;
    return $sql->fetch();
}
?>