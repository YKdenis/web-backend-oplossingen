<?php

$jaartal1 = 1230;

if(( $jaartal1 % 4 == 0 && $jaartal1 % 100 != 0 ) || $jaartal1 % 400 == 0)
{
    
    $string1 = $jaartal1 . " is een schrikkeljaar.";
    
}
else {
    
    $string1 = $jaartal1 . " is geen schrikkeljaar.";
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?= $string1 ?> </p>
</body>
</html>