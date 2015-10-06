<?php

    $tables = 10;
    $producten = 10;

    $arrayTables = array();

    for($currentTable = 0; $tables > $currentTable; $currentTable++) {
        
        $arrayProducten = array();
        
        for($product = 0; $producten > $product; $product++) {
            
            $arrayProducten[] = $product * $currentTable;
            
        }
        
        $arrayTables[] = $arrayProducten;
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p> <?php echo var_dump( $arrayTables ) ?> </p>
</body>
</html>