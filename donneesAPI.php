<?php
require_once("header.php") ;
require_once 'connexionBDD.php';
include 'app/GetDataByDates.php';
include 'app/htmlData.php';

if(isset($_GET['dateDeb'])&&$_GET['dateDeb']!=null) 
{
    if(isset($_GET['detail'])){
        $donnees = getApiByDatesDetail($pdo,$idcapteur,$_GET['dateDeb'],$_GET['dateFin']);
    }
    else
    {
        $donnees = GetAPIByDates($pdo,$idcapteur,$_GET['dateDeb'],$_GET['dateFin']);
    }
}
else{
    $donnees = getLastWeek($pdo);
}
?>         
<form action="#" class="dataform" method="get">
    <div class="elementform dates" >
        <label for="dateDeb">Du:</label>
        <input class="inputData" type="date" id="dateDeb" name="dateDeb" value="<?php echo isset($_GET['dateDeb'])?$_GET['dateDeb']:'';?>" >
        <label for="dateFin">Au:</label>
        <input class="inputData"  type="date" id="dateFin" name="dateFin" value="<?php echo isset($_GET['dateFin'])?$_GET['dateFin']:'';?>">
    </div>
    <div class="elementform">
        <select name="ville" class="inputData" id="ville">
            <?php 
                foreach ($villes as $ville) 
                {
                    $selected = (isset($_GET['ville'])&& $_GET['ville']== $ville['Id_Villes']) ?'selected':'';
                    echo "<option value='".$ville['Id_Villes']."' ".$selected.">".$ville['NomVille']."</option>";
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
                echo(htmlData($donnee));
            };
        ?>
    </tbody>
</table>


<?php
require_once("footer.php") ;
?>