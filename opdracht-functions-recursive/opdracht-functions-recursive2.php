<?php

    $money = 100000;

    function rentevoet ( $deposit)
    {
        static $counter = 0;
        static $opvolging = array();
        
        $deposit += floor( $deposit * 0.08);
        
        
        if($counter < 10)
        {
            $counter++;
            $opvolging[] = $deposit;
            return rentevoet ( $deposit );
            
        }
        else
        {
            
            return $opvolging;
            
        }
        
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?php var_dump( rentevoet( $money )) ?></p>
</body>
</html>