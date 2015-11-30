<?php 

$queryBrouwers = '';
$succes = '';

try {
    $db = new pdo('mysql:host=localhost;dbname=bieren', 'root', 'cohiba');
    $messageContainer = 'Verbonden met database bieren.';
    
    if ( isset($_POST['submit']) ) {
        $queryBrouwers = "insert into brouwers (brnaam, adres, postcode, gemeente, omzet) values (:brnaam, :adres, :postcode, :gemeente, :omzet);";
        $statementBrouwers = $db->prepare($queryBrouwers);
        $statementBrouwers->bindValue(':brnaam', $_POST['brnaam']);
        $statementBrouwers->bindValue(':adres', $_POST['adres']);
        $statementBrouwers->bindValue(':postcode', $_POST['postcode']);
        $statementBrouwers->bindValue(':gemeente', $_POST['gemeente']);
        $statementBrouwers->bindValue(':omzet', $_POST['omzet']);
        
        
        
        if ($statementBrouwers->execute()) {
            
            $lastId = $db->lastInsertId();
            $succes = "Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is " . $lastId . ".";
        }
        else {
            $succes = "Er is een fout opgetreden bij het toevoegen van de brouwerij.";
        }
        
    }
    
}
catch ( \PDOException $e ) {
    $messageContainer = 'Er ging iets mis: ' + $e->getMessage();
}

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>

    <body>
        <h1>Voeg een brouwer toe</h1>

        <form method="post" action="opdracht-crud-insert.php">
            <ul>
                <li>
                    <label for="brnaam">Brouwernaam</label>
                    <input type="text" id="brnaam" name="brnaam">
                </li>
                <li>
                    <label for="adres">adres</label>
                    <input type="text" id="adres" name="adres">
                </li>
                <li>
                    <label for="postcode">postcode</label>
                    <input type="text" id="postcode" name="postcode">
                </li>
                <li>
                    <label for="gemeente">gemeente</label>
                    <input type="text" id="gemeente" name="gemeente">
                </li>
                <li>
                    <label for="omzet">omzet</label>
                    <input type="text" id="omzet" name="omzet">
                </li>
            </ul>
            <input type="submit" name="submit">
        </form>
        <p><?php echo $messageContainer ?></p>
        
        <p><?php echo $succes ?></p>
        
        </div>

    </body>

    </html>
