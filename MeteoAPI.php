<?php

//Création d'une variable appelée "$curl" qui va permettre d'aller chercher une ressource.
$curl = curl_init('https://api.openweathermap.org/data/3.0/onecall?lat=43.3&lon=-0.366667&appid=27e2a142ffdf63a48c83fd2c5dba623c');
//Utilisation d'un certificat exporté sur le site
curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR .'cert.cer');

//POur stocker les paramètres dans $data
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//curl_exec pour Exécuter
$data = curl_exec($curl);
if ($data === false){
    var_dump(curl_error($curl)); //curl_error pour récupérer l'erreur
} else {

}
curl_close($curl); //pour fermer



//$curl = curl_init('http://api.openweathermap.org/data/2.5/forecast?id=524901&appid={27e2a142ffdf63a48c83fd2c5dba623c}');


?>


