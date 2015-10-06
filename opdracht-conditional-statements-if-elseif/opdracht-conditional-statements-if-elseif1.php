<?php

    $getal = 19;

    if($getal > 0 && $getal <= 10) {
        
        $string = $getal . " ligt tussen 0 en 10.";
        
    }
    else if($getal > 10 && $getal <= 20) {
        
        $string = $getal . " ligt tussen 10 en 20.";
        
    }
    else if($getal > 20 && $getal <= 30) {
        
        $string = $getal . " ligt tussen 20 en 30.";
        
    }
    else if($getal > 30 && $getal <= 40) {
        
        $string = $getal . " ligt tussen 30 en 40.";
        
    }
    else if($getal > 40 && $getal <= 50) {
        
        $string = $getal . " ligt tussen 40 en 50.";
        
    }
    else if($getal > 50 && $getal <= 60) {
        
        $string = $getal . " ligt tussen 50 en 60.";
        
    }
    else if($getal > 60 && $getal <= 70) {
        
        $string = $getal . " ligt tussen 60 en 70.";
        
    }
    else if($getal > 70 && $getal <= 80) {
        
        $string = $getal . " ligt tussen 70 en 80.";
        
    }
    else if($getal > 80 && $getal <= 90) {
        
        $string = $getal . " ligt tussen 80 en 90.";
        
    }
    else if($getal > 90 && $getal <= 100) {
        
        $string = $getal . " ligt tussen 90 en 100.";
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?= $string ?> </p>
</body>
</html>