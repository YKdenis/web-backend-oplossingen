<?php
    // setcookie('test', time() + 360);
    // print_r ($_COOKIE['test']);

    $info = file_get_contents('info.txt');
    $infoArray = explode(',' , $info);
    $message = 'Vul uw gegevens in';
    

    if( isset($_GET['removecookie']) ) {
        
        if( $_GET['removecookie'] === 'true')
        {   
            setcookie ('testCookie', "", 1);
            setcookie ('testCookie', false);
            unset($_COOKIE['testCookie']);
            header( 'Location:inloggen.php' );
            
        }
        
    }
    
    if( isset($_POST['submit']) ) {
        
        if( isset($_POST['username']) && isset($_POST['password']) ) {
            
            $key1 = array_search( $_POST['username'], $infoArray );
            $key2 = array_search( $_POST['password'], $infoArray );
        
            if( $key2 - $key1 == 1 ) {

                    $cookie_value = $_POST['username'];

                    $cookieTimer = isset($_POST['remember']) ? (time() + 2592000) : 0;

                    setcookie('testCookie', $cookie_value, $cookieTimer);


                    header("Location: dashboard.php");

            }

            else {

                $message = 'Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.';

            }
        }



    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <title>Document</title>
</head>
<body>
    <h1>Inloggen</h1>
    <p><?php echo $message ?></p>

    <form method="post" action="inloggen.php">
        <ul>
            <li>
                <label for="gebruikersnaam">gebruikersnaam</label>
                <input type="text" id="gebruikersnaam" name="username">
            </li>
            <li>
                <label for="paswoord">paswoord</label>
                <input type="text" id="paswoord" name="password">
            </li>
            <li><input type="checkbox" id="remember" name="remember">
                <label for="remember">Mij onthouden</label>

            </li>
        </ul>
        <input type="submit" name="submit">
    </form>

</body>
</html>