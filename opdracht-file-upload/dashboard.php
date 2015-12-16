<?php

    if(!isset($_COOKIE['login']))
    {
        header( 'Location:login-form.php' );
    }

    $gegevens = explode(',', $_COOKIE['login']);
    $email = $gegevens[0];
    $salted_email = $gegevens[1];

    try 
    {
        $db = new pdo('mysql:host=localhost;dbname=opdracht_file_upload', 'root',
        'cohiba'); 
        $messageContainer	=	'Verbonden met database.';

        $queryGetSalt = "select salt from users where email = :email";
        $statementGetSalt = $db->prepare($queryGetSalt);
        $statementGetSalt->bindValue(':email', $email);
        $statementGetSalt->execute();
        
        $saltDb = $statementGetSalt->fetch( PDO:: FETCH_ASSOC);
         
        $resalted_email =  hash('sha512', $saltDb['salt'] . $email);
        if($salted_email != $resalted_email)
        {
            setcookie("login", "", time()-3600);
        }
        
    }
    catch ( \PDOException $e ){
        $messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
        echo $messageContainer;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Dashboard</h1>
    <a href="login-form.php?uitgelogd=true">Uitloggen</a>
    <a href="gegevens-wijzigen-form.php">Gegevens wijzigen</a>
</body>
</html>