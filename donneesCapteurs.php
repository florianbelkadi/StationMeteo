<?php
require_once("header.php") ;
require_once 'app/connexionBDD.php';
include 'app/GetDataByDates.php';
include 'app/htmlData.php';
//recupère la date de la semaine dernière pour pré-remplir le champ date 
$date=date_create();
date_sub($date,date_interval_create_from_date_string("7 days"));
// verifie que $_Get existe est n'est pas null
if(isset($_GET['dateDeb'])&&$_GET['dateDeb']!=null) 
{
    if(isset($_GET['detail'])){
        $donnees = getSensorByDatesDetail($pdo,$idcapteur,$_GET['dateDeb'],$_GET['dateFin']);
        $details = 1;
    }
    else
    {
        $donnees = getSensorByDates($pdo,$idcapteur,$_GET['dateDeb'],$_GET['dateFin']);
        $details = 0;
    }
}
else{
    $donnees = getSensorLastWeek($pdo);
}
?>         
<form action="#" class="dataform" method="get">
    <div class="elementform dates" >
        <label for="dateDeb">Du:</label>
        <input class="inputData" type="date" id="dateDeb" name="dateDeb" value="<?php echo isset($_GET['dateDeb'])?$_GET['dateDeb']:date_format($date,"Y-m-d");?>" >
        <label for="dateFin">Au:</label>
        <input class="inputData"  type="date" id="dateFin" name="dateFin" value="<?php echo isset($_GET['dateFin'])?$_GET['dateFin']:date('Y-m-d');?>">
    </div>
    <div class="elementform">
        <select name="capteur" class="inputData" id="capteur">
            <?php 
                foreach ($capteurs as $capteur) 
                {
                    $selected = (isset($_GET['capteur'])&& $_GET['capteur']== $capteur['Id_NomCapteurs']) ?'selected':'';
                    echo "<option value='".$capteur['Id_NomCapteurs']."' ".$selected.">".$capteur['NomCapteur']."</option>";
                }
            ?>
        </select>
        <input type="checkbox"  name="detail" value="detail" <?php echo isset($_GET['detail'])?'checked':'';?>>
        <label for="detail">Afficher les détails</label>
    </div>
    <input type="submit"  class="elementform inputData boutonPage" value="Chercher">
</form>
<table class="tableau">
    <thead>
        <tr>
            <th colspan="4">
                <?php echo $donnees[0]["NomCapteur"]?>
            </th>
        </tr>
        <tr>
            <th>Date</th>
            <th>Temperature</th>
            <th>Humidité</th>
            <th>Pression</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($donnees as $donnee) {
                echo(htmlData($donnee,$details));
            };
        ?>
    </tbody>
</table>


<?php
require_once("footer.php") ;
?>