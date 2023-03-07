<?php

// //Création d'une variable appelée "$curl" qui va permettre d'aller chercher une ressource.
// $curl = curl_init('https://api.openweathermap.org/data/3.0/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=938d726f67ecec755bd8c07f0e270580
// ');
// //Utilisation d'un certificat exporté sur le site
// // curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR .'cert.cer');

// //POur stocker les paramètres dans $data
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_URL, 'https://api.openweathermap.org/data/3.0/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=938d726f67ecec755bd8c07f0e270580
// ');

// //curl_exec pour Exécuter
// $data = curl_exec($curl);
// if ($data === false){
//     var_dump(curl_error($curl)); //curl_error pour récupérer l'erreur
// } else {

// }
// curl_close($curl); //pour fermer
// var_dump($data);


// //$curl = curl_init('http://api.openweathermap.org/data/2.5/forecast?id=524901&appid={27e2a142ffdf63a48c83fd2c5dba623c}');

$apiKey = "27e2a142ffdf63a48c83fd2c5dba623c";
$cityId = "2988358";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=43.3&lon=-0.3667&appid=27e2a142ffdf63a48c83fd2c5dba623c&units=metric";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
var_dump($data);

var_dump($data->name);
?>




