<?php 

require_once("header.php") ;
require_once 'app/connexionBDD.php';
include_once 'app/GetLastDatas.php';

// Recupération des dernières données du capteur
$donneesCapteur = GetLastSensorDatas($pdo,$idcapteur);
// Appel à lAPI pour avoir les dernières données
$donneesApi = GetApiData();
$format = "l d M Y à H:i:s";
$dateApi = date($format, $donneesApi->dt + 3600);
$date =  isset($donneesCapteur['DateDonnee'])? strtotime($donneesCapteur['DateDonnee']):null;
$dateCapteur = date($format,$date);
?>
<div class="donneesParSource">
    <h2>
        <?php echo isset($donneesCapteur['NomCapteur'])?$donneesCapteur['NomCapteur']:"XX";?>
    </h2>
    <h5>
        <?php echo isset($donneesCapteur['DateDonnee'])?$dateCapteur:"Pas de données pour ce capteur";?>
    </h5>
    <div class="boxSecondaire">
        <div class="maisonIcon"></div>
        <div class="temperature">
           <p> <?php echo  isset($donneesCapteur['Temperature'])? $donneesCapteur['Temperature']: "XX";?> °C</p>
           
        </div>
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


<!-- ///////////////////////////////////////////////////////// -->

<div class="donneesParSource">
    <h2>
        <?php echo isset($donneesApi->name)?$donneesApi->name:"XX";?>
    </h2>
    <h5>
        <?php echo isset($donneesApi->dt)?$dateApi:"Pas de données pour ce capteur";?>
    </h5>
    <div class="boxSecondaire">
        <div class="villeIcon"></div>
        <div class="temperature ">
        <p><?php echo  isset($donneesApi->main->temp)? $donneesApi->main->temp: "XX";?> °C </p>
            <p><?php echo  isset($donneesApi->weather[0]->description)? $donneesApi->weather[0]->description: "XX";?> </p>
            </div>
    </div>
    <div class="boxSecondaire">
        <div class="humidite">
            <div class="humiditeIcon"></div>
            <div><?php echo  isset($donneesApi->main->humidity)? $donneesApi->main->humidity: "XX"; ?> %</div>
        </div>
        <div class="pression">
            
            <div class="barometreIcon"></div>
            <div><?php echo  isset($donneesApi->main->pressure)? $donneesApi->main->pressure: "XX";?> HPa</div>
        </div>
    </div>
</div>




<?php
require_once("footer.php") ;
?>