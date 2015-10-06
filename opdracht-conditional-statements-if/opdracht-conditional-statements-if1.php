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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <p> <?= $getal ?></p>
    <p> <?= $today ?> </p>
    
</body>
</html>