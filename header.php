<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Station Météo</title>
</head>

<body>
<?php 
 require_once 'connexionBDD.php';
 include_once 'app/GetAllSensor.php';
 $capteurs = getAllSensor($pdo);
 //Recupération de l'id d'un capteur 
 if (!isset($_GET['capteur'])){
     $idcapteur = $capteurs[0]['Id_NomCapteurs'];
 }
 else
 {
     $idcapteur = $_GET['capteur'];
 }
?>

<header> 
    <div class="menuIcon"></div>
    <div class="menu">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="donneesParDates.php">Mes Stats</a></li>
            <li>
                <form action="index.php" method="GET">
                    <label for="capteur">Changer de capteur</label>
                    <div class="capteurform">
                        <select name="capteur" class="inputData" id="capteur">
                            <?php 
                            foreach ($capteurs as $capteur) 
                             {
                                 echo "<option value=".$capteur['Id_NomCapteurs'].">".$capteur['NomCapteur']."</option>";
                             }
                            ?>
                        </select>
                        <input type="submit" class="boutonMenu inputData" value="OK">
                    </div>
                </form>
            </li>
            <!-- <li><a href="index.php">Changer de ville</a></li>
            <li><a href="index.php">Changer d'unités</a></li> -->
        </ul>
    </div>
    <h1> STATION METEO </h1>
    <div class="refreshIcon"></div>
</header>
