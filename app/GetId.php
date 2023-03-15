<?php 
include_once 'connexionBDD.php';
// Cette fonction vérifie si le capteur existe deja dans la base de données, le créer s'il n'existe pas et renvoie l'id du capteur
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Cette fonction vérifie si la ville existe deja dans la base de données, la créer si elle n'existe pas et renvoie l'id de la ville
Function GetIdVille($pdo,$nomVille)
{
// Recherche dans la table nomVille si la ville existe
$sqlQueryVille = 'SELECT Id_Villes FROM Villes WHERE NomVille = :nomVille';
$sql = $pdo->prepare($sqlQueryVille) ;
$sql->execute(array('nomVille' => $nomVille)) ;
$nbLigne = $sql->rowCount() ;

// Insere la ville si elle n'existe pas, renvoie l'id 
if($nbLigne == 0){
    $InsertVille = 'INSERT INTO Villes(NomVille) VALUES (:nomVille)';
    $sql = $pdo->prepare($InsertVille) ;
    $sql->execute(array('nomVille' => $nomVille)) ;
    $id = (int)($pdo->lastInsertId());
}else{
    $resultat = $sql->fetch();
    $id = $resultat['Id_Villes'];
}

return $id;
}

?>