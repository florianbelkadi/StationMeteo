<?php 
//Cette fonction renvoie les dernière données d'un capteur
function GetLastSensorDatas($pdo,$idCapt)
{
    $sqlQueryCapteur = 'SELECT NomCapteurs.NomCapteur,Donnees.DateDonnee,Donnees.Temperature,Donnees.Humidite,Donnees.Pression FROM Donnees JOIN NomCapteurs ON Donnees.Id_NomCapteurs = NomCapteurs.Id_NomCapteurs WHERE NomCapteurs.Id_NomCapteurs = :idCapt ORDER BY Donnees.DateDonnee DESC LIMIT 1; ';
    $sql = $pdo->prepare($sqlQueryCapteur) ;
    $sql->execute(array('idCapt' => $idCapt)) ;
    return $sql->fetch();
}
?>