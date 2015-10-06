<?php

    $rijen = 10;
    $kolommen =10;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <table>
        
        <?php for($aantalRijen = 0; $rijen > $aantalRijen; $aantalRijen++): ?>
        <tr>
            
            <?php for($aantalKolommen = 0; $kolommen > $aantalKolommen; $aantalKolommen++): ?>
            <td>Kolom</td>
            <?php endfor ?>
            
        </tr>
        <?php endfor ?>
        
    </table>
</body>
</html>