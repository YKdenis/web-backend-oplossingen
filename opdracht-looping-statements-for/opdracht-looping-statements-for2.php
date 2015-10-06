<?php

    $rijen = 10;
    $kolommen =10;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
    
        .oneven {
            background-color: green;
        }
    
    </style>
</head>
<body>
    <table>
        
        <?php for($currentTafel = 0; $rijen > $currentTafel; $currentTafel++): ?>
        <tr>
            
            <?php for($product = 0; $kolommen > $product; $product++): ?>
            
            <!-- $is_admin = ($user['permissions'] == 'admin' ? true : false); -->
            <td class= <?= ( ($product * $currentTafel) % 2 == 0) ? "" : "oneven"?> > <?php echo $currentTafel * $product ?></td>
            <?php endfor ?>
            
        </tr>
        <?php endfor ?>
        
    </table>
</body>
</html>