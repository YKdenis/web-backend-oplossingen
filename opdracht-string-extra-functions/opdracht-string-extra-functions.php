<?php

    $fruit = "kokosnoot";
    $aantalKarakters = strlen($fruit);
    $O = "o";
    $whereIsO = strpos($fruit, $O);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p><?= $aantalKarakters ?></p>
    <p> <?= $whereIsO ?></p>
</body>
</html>