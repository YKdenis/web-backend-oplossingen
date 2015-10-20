<?php

    session_start();

    if( isset( $_POST['submit'] )) {
    
        $_SESSION['straat'] = $_POST['straat'];

        $_SESSION['nummer'] = $_POST['nummer'];
        
        $_SESSION['gemeente'] = $_POST['gemeente'];
        
        $_SESSION['postcode'] = $_POST['postcode'];

    }
    else {
        
        $_SESSION['straat'] = 'Unkown';
        $_SESSION['nummer'] = 'Unkown';
        $_SESSION['gemeente'] = 'Unkown';
        $_SESSION['postcode'] = 'Unkown';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

                        
    <h1>Overzichtspagina</h1>
    
    <a href="Registratiepagina.php?session=destroy">Destroy session</a>

    <ul>
        <li>email: <?php echo $_SESSION['email'] ?> <a href="Registratiepagina.php?autofocus=email">wijzig</a></li>
        <li>nickname: <?php echo $_SESSION['nickname'] ?> <a href="Registratiepagina.php?autofocus=nickname">wijzig</a></li>
        <li>straat: <?php echo $_SESSION['straat'] ?> <a href="Adrespagina.php?autofocus=straat">wijzig</a></li>
        <li>nummer: <?php echo $_SESSION['nummer'] ?> <a href="Adrespagina.php?autofocus=nummer">wijzig</a></li>
        <li>gemeente: <?php echo $_SESSION['gemeente'] ?> <a href="Adrespagina.php?autofocus=gemeente">wijzig</a></li>
        <li>postcode: <?php echo $_SESSION['postcode'] ?> <a href="Adrespagina.php?autofocus=postcode">wijzig</a></li>
    </ul>
    
</body>
</html>