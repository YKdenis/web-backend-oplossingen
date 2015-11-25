<?php
    $queryBieren = '';
    $count = 1;
    
    $selectedBrouwer = isset($_GET['brouwernr']) ? $_GET['brouwernr'] : 0;

    try {
        $db = new pdo('mysql:host=localhost;dbname=bieren', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database bieren.';
        
        $queryBrouwers = "select brouwernr, brnaam from brouwers";
        $statementBrouwers = $db->prepare($queryBrouwers);
        
        $statementBrouwers->execute();
        
        if ( isset($_GET['submit']) ) {
        $queryBieren = "select biernr, naam from bieren where brouwernr = :nummer";
        $statementBieren = $db->prepare($queryBieren);
        $statementBieren->bindValue(':nummer', $_GET['brouwernr']);
        $statementBieren->execute();
}
        
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
     <p><?php echo $messageContainer ?></p> 
     
     <form method="get" action="opdracht-crud-query2.php">
        
        <!-- $_GET['brouwernr'] retourneert de value van de option dat is aangeduid -->
        <select name="brouwernr">
           <?php while( $row = $statementBrouwers->fetch() ) { ?>
            <option <?php echo $selectedBrouwer == $row['brouwernr'] ? 'selected' : '' ?> value="<?php echo $row['brouwernr'] ?>" ><?php echo $row['brnaam'] ?></option>
            <?php } ?>
        </select>
        

        <input type="submit" name="submit" value="Geef mij alle bieren van deze brouwerij">
    </form>

     <table>
        <?php if ($queryBieren != '' ) { ?>
         <thead>
            <td>
                Aantal
            </td>
            <td>
                Naam
            </td>
         </thead>
         
         <tbody>
            <?php while( $row = $statementBieren->fetch() ) { ?>
            <tr>
                <td>
                    <?php echo $row['biernr']; ?>
                </td>
                <td>
                    <?php echo $row['naam']; ?>
                </td>
             </tr>
             <?php } } ?>
         </tbody>
         
         
     </table>
</body>
</html>