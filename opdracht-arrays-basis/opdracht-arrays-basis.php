<?php

$dieren = array("Olifant", "Koala", "Tijger", "Beer", "Leeuw", "Krokodil", "Kangeroe", "Kat", "Luipaard", "Panter");

$dieren2[] = "Olifant";
$dieren2[] = "Koala";
$dieren2[] = "Tijger";
$dieren2[] = "Beer";
$dieren2[] = "Leeuw";
$dieren2[] = "Krokodil";
$dieren2[] = "Kangeroe";
$dieren2[] = "Kat";
$dieren2[] = "Luipaard";
$dieren2[] = "Panter";

$voertuigen["landvoertuigen"] = array("longboard", "auto", "bus", "fiets", "eenwieler");
$voertuigen["watervoertuigen"] = array("jetski", "boot", "surfplank", "waterfiets");
$voertuigen["luchtvoertuigen"] = array("vliegtuig", "helicopter", "zeppelin");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <pre> <?php var_dump( $voertuigen )?> </pre> </p>
</body>
</html>