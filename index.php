<?php 

require_once("header.php") ;
require_once 'connexionBDD.php';
include_once 'app/GetLastSensorDatas.php';

// Recupération des dernière données du capteur
$donneesCapteur = GetLastSensorDatas($pdo,$idcapteur);

?>
<div class="donneesParSource">
    <h2>
        <?php echo isset($donneesCapteur['NomCapteur'])?$donneesCapteur['NomCapteur']:"XX";?>
    </h2>
    <h5>
        <?php echo isset($donneesCapteur['DateDonnee'])?$donneesCapteur['DateDonnee']:"Pas de données pour ce capteur";?>
    </h5>
    <div class="boxSecondaire">
        <div class="maisonIcon"></div>
        <div class="temperature">
            <?php echo  isset($donneesCapteur['Temperature'])? $donneesCapteur['Temperature']: "XX";?> °C</div>
    </div>
    <div class="boxSecondaire">
        <div class="humidite">
            <div class="humiditeIcon"></div>
            <div><?php echo  isset($donneesCapteur['Humidite'])? $donneesCapteur['Humidite']: "XX"; ?> %</div>
        </div>
        <div class="pression">
            
            <div class="barometreIcon"></div>
            <div><?php echo  isset($donneesCapteur['Pression'])? $donneesCapteur['Pression']: "XX";?> HPa</div>
        </div>
    </div>
</div>

 <div class="donneesParSource">
    <h2></h2>
    <h3></h3>
    <div class="boxSecondaire">
        <div class="maisonIcon"></div>
        <div class="temperature"> °C</div>
    </div>
    <div class="boxSecondaire">
        <div class="humidite">
            <div class="humiditeIcon"></div>
            <div>%</div>
        </div>
        <div class="pression">
            <div class="barometreIcon"></div>
            <div>HPa</div>
        </div>
    </div>
</div> 






















<?php
require_once("footer.php") ;
?>