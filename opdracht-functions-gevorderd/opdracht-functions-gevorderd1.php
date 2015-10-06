<?php

    $md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
    $key1 = "2";
    $key2 = "8";
    $key3 = "a";
    
    function voorkomen2( $str1, $key )
    {
        
        $strLength = strlen ( $str1 );
        $arrayStr = array();
        $counter = 0.0;
        
        for($currentKey = 0; $currentKey < $strLength; $currentKey++)
        {
            
            $arrayStr[] = substr( $str1, $currentKey, 1 );
            
        }
        
        for($currentKey = 0; $currentKey < $strLength; $currentKey++)
        {
            
            if($arrayStr[$currentKey] == $key) {
                
                $counter++;
                
            }
            
        }
        
        $percentage = $counter / $strLength * 100;
        
        return $percentage;
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
        <p> <?php echo "De needle '" . $key1 . "' komt " . voorkomen2( $md5HashKey, $key1  ) . "% voor in de hash key '" . $md5HashKey . "'"?> </p>
        
                <p> <?php echo "De needle '" . $key2 . "' komt " . voorkomen2( $md5HashKey, $key2  ) . "% voor in de hash key '" . $md5HashKey . "'"?> </p>
                
                        <p> <?php echo "De needle '" . $key3 . "' komt " . voorkomen2( $md5HashKey, $key3  ) . "% voor in de hash key '" . $md5HashKey . "'"?> </p>

</body>
</html>