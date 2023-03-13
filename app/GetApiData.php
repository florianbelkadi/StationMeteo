<?php

Function GetApiData()
{
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

return $data;

}

?>




