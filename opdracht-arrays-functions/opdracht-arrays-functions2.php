<?php

$dieren = array("olifant", "tijger", "leeuw", "koala", "panter");
$countDieren = count($dieren);
$teZoekenDier = in_array( "leeuw", $dieren);
sort($dieren);
$zoogdieren = array("rat", "hond", "kat");
$dierenLijst[0] = $dieren;
$dierenLijst[1] = $zoogdieren;

if($teZoekenDier) {
    
    $message = "Het gezochte dier is gevonden.";
    
}
else {
    
    $message = "Het gezochte dier is niet gevonden.";
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <p> <?php var_dump( $dieren) ?> </p>
    <p> <?= $countDieren ?> </p>
    <p> <?= $message ?> </p>
    <p> <?php var_dump( $dierenLijst) ?> </p>
</body>
</html>