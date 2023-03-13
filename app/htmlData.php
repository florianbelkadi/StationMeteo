<?php 

function htmlData($donnee,$details)
{
    $date = $details==1?$donnee['DateDonnee']:substr($donnee['DateDonnee'],0,10);
    $temp = number_format($donnee['Temp'],2);
    $hum = number_format($donnee['Hum'],2);
    $pres= number_format($donnee['Pres'],2);

    $html = "<tr>
                <td class='datecolonne'>".$date."</td> 
                <td>".$temp."</td>
                <td>".$hum."</td>
                <td>".$pres."</td>
            </tr>";
    return $html;
}
?>