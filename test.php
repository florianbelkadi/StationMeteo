<?php
include 'app/GetDataByDates.php';
include 'connexionBDD.php';
var_dump(getLastWeek($pdo));
$dateDeb = new DateTime("20230201");
echo '<br>';
$now = new DateTime("20230225");
var_dump(getByDates($pdo,3,$dateDeb,$now));