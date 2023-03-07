<?php 
include_once '../connexionBDD.php';
// Cette foncionn vérifie si le capteur existe deja dans la base de données, le créer s'il n'existe pas et renvoie l'id du capteur
Function GetIdCapteur($pdo,$nomCap)
{
// Recherche dans la table nomCapteur si le capteur existe
$sqlQueryCapteur = 'SELECT id_NomCapteurs FROM NomCapteurs WHERE NomCapteur = :nomCap';
$sql = $pdo->prepare($sqlQueryCapteur) ;
$sql->execute(array('nomCap' => $nomCap)) ;
$nbLigne = $sql->rowCount() ;

// Insere le capteur s'il n'existe pas, renvoie l'id 
if($nbLigne == 0){
    $InsertCapteur = 'INSERT INTO NomCapteurs(NomCapteur) VALUES (:nomCap)';
    $sql = $pdo->prepare($InsertCapteur) ;
    $sql->execute(array('nomCap' => $nomCap)) ;
    $id = (int)($pdo->lastInsertId());
}else{
    $resultat = $sql->fetch();
    $id = $resultat['id_NomCapteurs'];
}

return $id;
}
?>