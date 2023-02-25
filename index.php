<?php 

require_once("header.php") ;
require_once 'connexionBDD.php';
include 'app/GetLastSensorDatas.php';
$donneesCapteur = GetLastSensorDatas($pdo,3);
?>
<div class="donneesParSource">
    <h2><?php echo $donneesCapteur['NomCapteur']?></h2>
    <h3><?php echo $donneesCapteur['DateDonnee']?></h3>
    <div class="boxSecondaire">
        <div class="maisonIcon"></div>
        <div class="temperature"><?php echo $donneesCapteur['Temperature'] ?> °C</div>
    </div>
    <div class="boxSecondaire">
        <div class="humidite">
            <div class="humiditeIcon"></div>
            <div><?php echo $donneesCapteur['Humidite'] ?> %</div>
        </div>
        <div class="pression">
            
            <div class="barometreIcon"></div>
            <div><?php echo $donneesCapteur['Pression'] ?> HPa</div>
        </div>
    </div>
</div>

<div class="donneesParSource">
    <h2><?php echo $donneesCapteur['NomCapteur']?></h2>
    <h3><?php echo $donneesCapteur['DateDonnee']?></h3>
    <div class="boxSecondaire">
        <div class="maisonIcon"></div>
        <div class="temperature"><?php echo $donneesCapteur['Temperature'] ?> °C</div>
    </div>
    <div class="boxSecondaire">
        <div class="humidite">
            <div class="humiditeIcon"></div>
            <div><?php echo $donneesCapteur['Humidite'] ?> %</div>
        </div>
        <div class="pression">
            <div class="barometreIcon"></div>
            <div><?php echo $donneesCapteur['Pression'] ?> HPa</div>
        </div>
    </div>
</div>






















<?php
require_once("footer.php") ;
?>