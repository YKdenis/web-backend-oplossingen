<?php

    $naam = "Denis";
    $achternaam = "Inghelbrecht";
    $volledigeNaam = $naam." ".$achternaam;
    $aantalKarakters = strlen($volledigeNaam);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <p><?= $volledigeNaam ?></p>
    <p><?= $aantalKarakters ?></p>
    
</body>
</html>