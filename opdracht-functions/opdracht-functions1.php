<?php

    function berekenSom( $getal1, $getal2 ) 
    {
        
        $som = $getal1 + $getal2;
        
        return $som;
        
    }

    function vermenigvuldig( $getal1, $getal2 )
    {
        
        $product = $getal1 * $getal2;
        
        return $product;
        
    }

    function isEven ($getal1) 
    {
        
        if( $getal1 % 2 == 0 )
        {
            
            $isItEven = true;
            
        }
        else 
        {
            
            $isItEven = false;
            
        }
        
        return $isItEven;
    }

    function stringInfo( $string1 ) 
    {
    
        $stringU = strtoupper($string1);
        $strLength = strlen( $string1);
        
        $strInfo = array( $stringU, $strLength );
        
        return $strInfo;
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?php echo berekenSom( 2, 5 ) ?> </p>
    <p> <?php echo vermenigvuldig( 2, 5 ) ?> </p>
    <p> <?php var_dump (isEven( 5 )) ?> </p>
    <p> <?php var_dump( stringInfo( "deeznuts" )) ?> </p>
</body>
</html>