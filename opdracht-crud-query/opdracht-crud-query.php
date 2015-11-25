<?php

    $count = 1;
    $isError = true;

    try {
        $db = new pdo('mysql:host=localhost;dbname=bieren', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database bieren.';
        
        $query = "select * from bieren inner join brouwers on (bieren.brouwernr = brouwers.brouwernr) where bieren.naam like 'du%' and brouwers.brnaam like '%a%'";
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
     <p><?php echo $messageContainer ?></p> 
     <table>
         <thead>
               <td>
                   #
               </td>
               <td>
                   Biernummer
               </td>
               <td>
                   Naam
               </td>
               <td>
                   Brouwernummer
               </td>
               <td>
                   Soortnummer
               </td>
               <td>
                   Alcohol
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
         </thead>
         
         <tbody>
             
             <?php if(!$isError) { 
                while( $row = $statement->fetch() ) { ?>
              
               <tr <?php echo $count % 2 == 0 ? 'class="achtergrondkleur"' : '' ?> >
                  <td>
                       <?php echo $count++; ?>
                   </td>
                   <td>
                       <?php echo $row['biernr']; ?>
                   </td>
                   <td>
                       <?php echo $row['naam']; ?>
                   </td>
                   <td>
                       <?php echo $row['brouwernr']; ?>
                   </td>
                   <td>
                       <?php echo $row['soortnr']; ?>
                   </td>
                   <td>
                       <?php echo $row['alcohol']; ?>
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
                     
             </tr>
        <?php } } ?>     
         </tbody>
         
         
     </table>
</body>
</html>