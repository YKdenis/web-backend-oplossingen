<?php

    $getal = 0;
    $getal2 = 0;
    $getallen = array();
    $getallen2 = array();

    while( $getal <= 100) {
        
        $getallen[] = $getal;
        $getal++;
        
    }
    // implode: een array in een string steken met als lijm ", "
    $message = implode(", ", $getallen);

    while($getal2 <= 100) {
        
        if($getal2 > 40 && $getal2 < 80 && $getal2 % 3 == 0)
        {
            
        $getallen2[] = $getal2;
            
        }
        $getal2++;
        
    }

    $message2 = implode(", ", $getallen2);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?= $message ?> </p>
    <p> <?= $message2 ?> </p>
</body>
</html>