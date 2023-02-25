<?php 

function htmlData($donnee)
{
    $date = substr($donnee['DateDonnee'],0,10);
    $temp = number_format($donnee['TempMoy'],2);
    $hum = number_format($donnee['HumMoy'],2);
    $pres= number_format($donnee['PresMoy'],2);

    $html = "<tr>
                <td>".$date."</td> 
                <td>".$temp."</td>
                <td>".$hum."</td>
                <td>".$pres."</td>
            </tr>";
    return $html;
}
?>