<?php
require_once("header.php") ;
require_once 'connexionBDD.php';
include 'app/GetDataByDates.php';
include 'app/htmlData.php';

if(isset($_GET['dateDeb'])&&$_GET['dateDeb']!=null) 
{
   $donnees = GetByDates($pdo,3,$_GET['dateDeb'],$_GET['dateFin']);
}
else{
    $donnees = getLastWeek($pdo);
}
?>         
<form action="#" method="get">
    <div class="elementform dates" >
        <label for="dateDeb">Du:</label>
        <input type="date" id="dateDeb" name="dateDeb">
        <label for="dateFin">Au:</label>
        <input type="date" id="dateFin" name="dateFin">
    </div>
    <!-- TODO ajouter une chexkbox pour avoir les données détaillée ou pas -->
    <input type="submit"  class="elementform" value="Chercher">
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