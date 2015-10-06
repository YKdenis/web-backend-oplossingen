<?php

    $getal = 1;

    if($getal == 1) {
    
    $today = "maandag";
    
    }
    if($getal == 2) {
    
    $today = "dinsdag";
    
    }
    if($getal == 3) {
    
    $today = "woensdag";
    
    }
    if($getal == 4) {
    
    $today = "donderdag";
    
    }
    if($getal == 5) {
    
    $today = "vrijdag";
    
    }
    if($getal == 6) {
    
    $today = "zaterdag";
    
    }
    if($getal == 7) {
    
    $today = "zondag";
    
    }

    $todayU = strtoupper($today);
    $todayLowA1 = strtoupper(substr($today, 0, 1)) . substr($today, 1, 2) . strtoupper(substr($today, 3, 2)) .
    substr($today, 5, 1) . strtoupper(substr($today, 6, 1));
    $todaylowA2 = substr($todayU, 0, 5) . strtolower(substr($todayU, 5, 1)) . substr($todayU, 6, 1);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <p> <?= $getal ?> </p>
    <p> <?= $today ?> </p>
    <p> <?= $todayU ?> </p>
    <p> <?= $todayLowA1 ?> </p>
    <p> <?= $todaylowA2 ?> </p>
    
</body>
</html>