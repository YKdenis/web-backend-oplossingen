<?php
    session_start();
    $isError = true;
    $count = 1;
    $visible = false;


    try {
        $db = new pdo('mysql:host=localhost;dbname=bieren', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database bieren.';
        
        /********************************************* DELETE **************************************/
        
        if( isset( $_POST['Delete'] )) {
            
            $_SESSION['Delete'] = $_POST['Delete'];
            
        }
        
        if( isset( $_POST['Edit'] )) {
            
            $_SESSION['Edit'] = $_POST['Edit'];
            
        }
        
        if( isset($_POST['ja'])) {
            $deleteQuery = "delete from brouwers where brouwernr = :count";
            $deleteStatement = $db->prepare($deleteQuery);
            $deleteStatement->bindValue(':count', $_SESSION['Delete']);

            if($deleteStatement->execute()) {
                $messageContainer = 'De datarij werd goed verwijderd.';
            }
            else {
                $messageContainer = "Aanpassing is niet gelukt. Probeer opnieuw of neem contact op met de '<a href=\"#\">'systeembeheerder'</a>' wanneer deze fout blijft aanhouden.";
            }
            $visible = false;
        }
        else if( isset($_POST['nee'] )) {
            
            $visible = false; 
            
        }
        
        if( isset($_POST["Update"])) {
            
            $updateQuery = "update brouwers set brnaam = :brnaam, adres = :adres, gemeente = :gemeente, postcode = :postcode, omzet = :omzet where brouwernr = :brouwernr";
            $updateStatement = $db->prepare($updateQuery);
            $updateStatement->bindValue(':brouwernr', $_SESSION['Edit']);
            $updateStatement->bindValue(':brnaam', html_escape($_POST["brnaam"])); // html escape moet niet want bindvalue doet het standaard
            $updateStatement->bindValue(':adres', $_POST["adres"]);
            $updateStatement->bindValue(':gemeente', $_POST["gemeente"]);
            $updateStatement->bindValue(':postcode', $_POST["postcode"]);
            $updateStatement->bindValue(':omzet', $_POST["omzet"]);
                                        
            if($updateStatement->execute()) {
                $messageContainer = 'De datarij werdt upgedate.';
            }
            else {
                $messageContainer = 'De datarij kon niet worden upgedate, probeer opnieuw.';
            }
            
        }
        
        
        $query = "select * from brouwers";
        $statement = $db->prepare($query);
        
        $statement->execute();
        $isError = false;
        
        /************************************************ UPDATE ********************************************/
        
        $queryBrouwernaam = "select * from brouwers where brouwernr = :count";
        $brouwernaamStatement = $db->prepare($queryBrouwernaam);
        $brouwernaamStatement->bindValue(':count', isset($_POST['Edit']) ? $_POST['Edit'] : '');
        $brouwernaamStatement->execute();
        
        $brouwernaam = $brouwernaamStatement->fetch(PDO:: FETCH_ASSOC); 
        
        
        
        
    }
catch ( \PDOException $e ){
    $messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
}



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>

    <body>

        <?php if (isset($_POST['Edit']) && $brouwernaam != array()): ?>

            <?php var_dump( $brouwernaam); ?>

                <h1>Brouwerij <?php echo $brouwernaam['brnaam'] ?> nummer <?php echo $_POST['Edit'] ?> wijzigen</h1>

                <form method="post" action="opdracht-crud-update.php">
                    <ul>
                        <li>
                            <label for="brnaam">Brouwernaam</label>
                            <input type="text" id="brnaam" name="brnaam" value="<?php echo $brouwernaam['brnaam'] ?>">
                        </li>
                        <li>
                            <label for="adres">adres</label>
                            <input type="text" id="adres" name="adres" value="<?php echo $brouwernaam['adres'] ?>">
                        </li>
                        <li>
                            <label for="postcode">postcode</label>
                            <input type="text" id="postcode" name="postcode" value="<?php echo $brouwernaam['postcode'] ?>">
                        </li>
                        <li>
                            <label for="gemeente">gemeente</label>
                            <input type="text" id="gemeente" name="gemeente" value="<?php echo $brouwernaam['gemeente'] ?>">
                        </li>
                        <li>
                            <label for="omzet">omzet</label>
                            <input type="text" id="omzet" name="omzet" value="<?php echo $brouwernaam['omzet'] ?>">
                        </li>
                    </ul>
                    <input type="submit" name="Update" value="Waarde wijzigen">
                </form>
                <br />

                <?php else: ?>

                    <h1>Brouwerij niet gevonden.</h1>

                    <?php endif; ?>


                        <?php echo $messageContainer ?>
                            <form method="post" action="opdracht-crud-update.php">

                                <?php if (isset($_POST['Delete'])): ?>
                                    <?php $visible = true ?>

                                        <?php if($visible): ?>
                                            <p>Ben je zeker dat je het wilt verwijderen?</p>
                                            <button name="ja" type="submit" value="true">Ja</button>
                                            <button name="nee" type="submit" value="true">Nee</button>
                                            <?php endif; ?>

                                                <?php endif; ?>


                                                    <table>
                                                        <thead>
                                                           
                                                            <td>
                                                                #
                                                            </td>
                                                            <td>
                                                                Brouwernaam
                                                            </td>
                                                            <td>
                                                                Adres
                                                            </td>
                                                            <td>
                                                                Postcode
                                                            </td>
                                                            <td>
                                                                Gemeente
                                                            </td>
                                                            <td>
                                                                Omzet
                                                            </td>
                                                            <td>
                                                                Verwijder
                                                            </td>
                                                            <td>
                                                                Edit
                                                            </td>
                                                        </thead>

                                                        <tbody>
                                                            <?php if(!$isError) { 
                while( $row = $statement->fetch() ) { ?>

                                                                <tr <?php echo $count % 2==0 ? 'class="achtergrondkleur"' : '' ?> >
                                                                    <td>
                                                                        <?php echo $row['brouwernr']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['brnaam']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['adres']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['postcode']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['gemeente']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['omzet']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" name="Delete" value="<?php echo $row['brouwernr'] ?>">Delete</button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" name="Edit" value="<?php echo $row['brouwernr'] ?>">Edit</button>
                                                                    </td>

                                                                </tr>
                                                                <?php } } ?>
                                                        </tbody>

                                                        <tfoot>

                                                        </tfoot>
                                                    </table>
                            </form>
    </body>

    </html>
