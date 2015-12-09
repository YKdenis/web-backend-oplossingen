<?php
    session_start();
    $isError = true;
    $count = 1;
    $visible = false;


    try {
        $db = new pdo('mysql:host=localhost;dbname=bieren', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database bieren.';
        
        if( isset( $_POST['Delete'] )) {
            
            $_SESSION['Delete'] = $_POST['Delete'];
            
        }
        if( isset($_POST['ja'])) {
            $deleteQuery = "delete from brouwers where brouwernr = :count";
            $deleteStatement = $db->prepare($deleteQuery);
            $deleteStatement->bindValue(':count', $_SESSION['Delete']);

            if($deleteStatement->execute()) {
                $messageContainer = 'De datarij werd goed verwijderd.';
            }
            else {
                $messageContainer = 'De datarij kon niet verwijderd worden. Probeer opnieuw.';
            }
            $visible = false;
        }
        else if( isset($_POST['nee'] )) {
            
            $visible = false;
            
        }
        
        
        $query = "select * from brouwers";
        $statement = $db->prepare($query);
        
        $statement->execute();
        $isError = false;
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
       <?php echo $messageContainer ?>
        <form method="post" action="opdracht-crud-delete.php">
           
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

                            </tr>
                            <?php } } ?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
        </form>
    </body>

    </html>
