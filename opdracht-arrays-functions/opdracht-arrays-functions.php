<?php

$dieren = array("olifant", "tijger", "leeuw", "koala", "panter");
$countDieren = count($dieren);
$teZoekenDier = in_array( "leeuw", $dieren);

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
    <p> <?= $countDieren ?> </p>
    <p> <?= $message ?> </p>
</body>
</html>