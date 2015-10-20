<?php
    
    session_start();

    // destroy geef je mee in de query. Je haalt deze op met de GET van session

    if( isset($_GET['session'] ) ) {
        
        if( $_GET['session'] == 'destroy' ) {
            
            session_destroy();
            header ( 'location: Registratiepagina.php' ); // verwijderen van de session=destroy in de query
            
        }
        
    }



    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    $nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';

    $emailfocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "email"  ? 'autofocus' : '';

    $nicknamefocus = isset($_GET['autofocus']) && $_GET['autofocus'] == "nickname"  ? 'autofocus' : '' ;

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>

        <h1>Deel 1: registratiegegevens</h1>
        <form method="post" action="Adrespagina.php">
            <ul>
                <li>
                    <label for="email">e-mail</label>
                    <input type="text" id="email" name="email" value= "<?php echo $email ?>" <?php echo $emailfocus ?> >
                </li>
                <li>
                    <label for="nickname">nickname</label>
                    <input type="text" id="nickname" name="nickname" value= "<?php echo $nickname ?>" <?php echo $nicknamefocus ?> > 
                </li>
            </ul>
            <input type="submit" name="submit" value="Volgende">
        </form>

    </body>
</html>