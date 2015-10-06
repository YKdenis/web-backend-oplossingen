<?php

    $lettertje = "e";
    $cijfertje = 3;
    $langstewoord = "zandzeepsodemineralenwatersteenstralen";

    $langstewoordE = str_replace ($lettertje ,$cijfertje, $langstewoord);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <p> <?= $langstewoordE ?> </p>
    
</body>
</html>